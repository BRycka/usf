<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 15/04/14
 * Time: 16:34
 */
class graph {
    public function testAction(){
       echo json_encode(
            array(
                "temperature_record" => array(
                    array(
                        "unix_time" => time()*1000,
                        "celsius" => memoryObserver::$memoryUsage
                    )
                )
            )
        );
        return array(
            "headers" => array("Content-Type" => "application/json"),
            "status" => 200
        );
    }
}
