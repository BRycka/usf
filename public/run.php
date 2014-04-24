<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 14/04/14
 * Time: 11:58
 */
require 'vendor/autoload.php';
//require_once('model/data_base.php');
//require_once('help/pages_count.php');
//require_once('help/check_errors.php');
require_once 'help/frontController.php';
require_once 'help/memoryObserver.php';
$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);
$app = new frontController();
$memory = new memoryObserver($loop);
$http->on('request', array($app, 'dispatch'));
echo "Server running at http://127.0.0.1:1337\n";
$socket->listen(1337);
$loop->run();
