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
require_once 'help/alertSms.php';
$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);
$app = new frontController();
$termometer = new \PhpGpio\Sensors\DS18B20();
$temp = new memoryObserver($loop, $termometer);
$alert = new alertSms();
$temp->addCallback(array($alert, 'alert'));
$http->on('request', array($app, 'dispatch'));
echo "Server running at http://0.0.0.0:1337\n";
$socket->listen(1337, "0.0.0.0");
echo $termometer->read() . " °C\n";
echo $temp->getMemoryUsage() . " °C\n";
$loop->run();
