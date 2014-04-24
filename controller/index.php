<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 14/04/14
 * Time: 16:41
 */
class index{
    public function aboutAction(){
        require 'view/about.php';
    }

    public function dashboardAction(){
        require 'view/dashboard.php';
    }
    public function memoryAction(){
        require 'view/memoryUsage.php';
    }
}