<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
require('../model/db.php');
require('check_errors.php');
$action = 'Update';
$id = null;
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    $status = checkForm($name, $lastname, $rate);
    if (checkExist($id) != null) {
        $status['exist'] = checkExist($id);
    }
    if (empty($status)) {
        updateEmployee($name, $lastname, $rate, $id);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=updated");
    }
}
if (empty($status)) {
    $status = null;
}
$employee = getEmployeeById($id);
if (!isset($_POST['name'])) {
    $name_value = htmlspecialchars($employee['name']);
    $lastname_value = htmlspecialchars($employee['lastname']);
    $rate_value = htmlspecialchars($employee['hourlyRate']);
} else {
    $name_value = htmlspecialchars($_POST['name']);
    $lastname_value = htmlspecialchars($_POST['lastname']);
    $rate_value = htmlspecialchars($_POST['rate']);
}
require('../view/makeForm.php');
