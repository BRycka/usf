<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
require('../model/db.php');
require('check_errors.php');
$action = 'Add';
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    $status = checkForm($name, $lastname, $rate);
    if (checkExist() != null) {
        $status['exist'] = checkExist();
    }
    if (empty($status)) {
        addEmployee($name, $lastname, $rate);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=added");
    }
}
$name_value = null;
$lastname_value = null;
$rate_value = null;
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name_value = htmlspecialchars($_POST['name']);
    $lastname_value = htmlspecialchars($_POST['lastname']);;
    $rate_value = htmlspecialchars($_POST['rate']);;
}
if (empty($status)) {
    $status = null;
}
require('../view/makeForm.php');
