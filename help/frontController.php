<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 15/04/14
 * Time: 13:55
 */
use React\Http\Request;
use React\Http\Response;

class frontController
{
    public function dispatch(Request $request, Response $response)
    {
//        $filename = 'public' . $request->getPath();
        //var_dump($filename);
//        $mimeTypes = array(
//            "css" => "text/css",
//            "html" => "text/html",
//            "js" => "application/javascript",
//        );
//        if(strpos($filename,'.')){
//        $extension = end(explode('.', $filename));
//        $mimeType = $mimeTypes[$extension];
//        }
//        if (file_exists($filename) && $mimeType !== null) {
//            $response->writeHead(null, array('Content-Type' => $mimeType,
//                'Content-Length' => filesize($filename)
//            ));
//            $response->end(file_get_contents($filename));
//            return;
//        }
        $request->on('data', function ($data) use ($request, $response) {

            $post = array();
        var_dump($request->getPath());

            parse_str($data, $post);
            $urlParams = explode('/', trim($request->getPath(), '/'));
            $filename = 'controller/' . $urlParams[0] . '.php';
            //echo "1 ";
            //var_dump($filename, getcwd());
            //echo "2 ";
            $headers = array('Content-Type' => 'text/html');
            $status = 200;
            $method = $urlParams[1] . 'Action';
            if (file_exists($filename)) {
                require_once $filename;
            } else {
                $response->writeHead(303, array("Location" => "/index/dashboard"));
                $response->end();
                return;
//            $urlParams[0] = 'index';
//            $method = 'dashboardAction';
            }
            $controller = new $urlParams[0]($request->getQuery(), $post);
//        $test = new check_errors($urlParams[3]);
            ob_start();
            $return = null;

            if($urlParams[0] !== null){
                if (method_exists($controller, $method)) {
                    $return = $controller->$method();
                } else {
                    echo "neegzistuoja";
                }
            }else{
                $index = new index();
                $return = $index->dashboardAction();
            }


            if (is_array($return)) {
                $headers = array_merge($headers, $return['headers']);
                $status = $return['status'];
            }
            $content = ob_get_contents();
            ob_end_clean();
            if($headers['Content-Type'] !== "application/json") {
                ob_start();
                require('view/layout.php');
                $content = ob_get_contents();
                ob_end_clean();
            }
            $response->writeHead($status, $headers);
            $response->end($content);
        });

    }
}
