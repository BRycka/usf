<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 14/04/14
 * Time: 11:58
 */
require 'vendor/autoload.php';
require_once('model/data_base.php');
require_once('help/pages_count.php');
require_once('help/check_errors.php');
use React\Http\Request;
use React\Http\Response;

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);
$app = function (Request $request, Response $response) use ($loop) {
    $filename = 'public' . $request->getPath();
    var_dump($filename);
    //atvaizduoti atminties sunaudojima
    $mimeTypes = array(
        "css" => "text/css",
        "html" => "text/html",
        "js" => "application/javascript",
    );
    $extension = end(explode('.', $filename));
    $mimeType = $mimeTypes[$extension];
    var_dump($mimeType);
    if (file_exists($filename)) {
        $response->writeHead(null, array('Content-Type' => $mimeType,
            'Content-Length' => filesize($filename)
        ));
        $response->end(file_get_contents($filename));
        return;
    }
    $request->on('data', function ($data) use ($request, $response) {

        $post = array();
//        var_dump($request->getPath());

        parse_str($data, $post);
        $urlParams = explode('/', trim($request->getPath(), '/'));
        $filename = 'controller/' . $urlParams[0] . '.php';
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
        if (method_exists($controller, $method)) {
            $return = $controller->$method();
        } else {
            echo "neegzistuoja";
        }
        if (is_array($return)) {
            $headers += $return['headers'];
            $status = $return['status'];
        }
        $content = ob_get_contents();
        ob_end_clean();
        ob_start();
        require('view/layout.php');
        $content = ob_get_contents();
        ob_end_clean();
        $response->writeHead($status, $headers);
        $response->end($content);
    });

};
$http->on('request', $app);
echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();