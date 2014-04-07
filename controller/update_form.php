<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
require('../model/db.php');
require('check_errors.php');
require('../view/form.php');

function updateEmployeeForm($action, $id)
{
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);
        $rate = trim($_POST['rate']);
        $status = checkForm($name, $lastname, $rate);
        if(checkExist($status) != null ){
            $status['exist'] = checkExist();
        }
        if (empty($status)) {
            updateEmployee($name, $lastname, $rate, $id);
        }
    }
    if(empty($status)){
        $status = null;
    }
    getEmployeeById($id, $action, $status);
}
