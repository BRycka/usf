<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 14/04/14
 * Time: 16:41
 */
class index{
    public function tempAction(){
        $require = 'view/temperatureGraph.php';
        require $require;
        return $require;
    }
    public function registerAction(){
        $require = 'view/register.php';
        require $require;
        return $require;
    }
    public function loginAction(){
        $require = 'view/login.php';
        require $require;
        return $require;
    }
    public function dashboardAction(){
        $require = 'view/dashboard.php';
        require $require;
        return $require;
    }
    public function lightingAction(){
        $require = 'view/lighting.php';
        require $require;
        return $require;
    }
    public function lightsOnAction() {
        require 'help/lightsOn.php';
    }
    public function lightsOffAction() {
        require 'help/lightsOff.php';
    }
}
