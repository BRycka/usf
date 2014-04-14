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
$app = function (Request $request, Response $response) use($loop) {
    $request->on('data', function($data) use($request, $response){
        $post = array();
        var_dump($request->getPath());

        parse_str($data, $post);
        $urlParams = explode('/', trim($request->getPath(), '/'));
        require_once 'controller/' . $urlParams[0] . '.php';
        $controller = new $urlParams[0]($request->getQuery(), $post);

        ob_start();
        $method=$urlParams[1].'Action';
        if(method_exists($controller, $method)){
        $return = $controller->$method();
            null;
        }else{
            echo "neegzistuoja";
        }
        $headers = array('Content-Type' => 'text/html');
        $status=200;
        if(is_array($return)){
            $headers += $return['headers'];
            $status = $return['status'];
        }
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