<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
require('../model/db.php');
require('check_errors.php');
require('../view/makeForm.php');

$id = $_GET['id'];
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    $status = checkForm($name, $lastname, $rate);
    if (checkExist($status) != null) {
        $status['exist'] = checkExist();
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
    $employee['name'] = htmlspecialchars($employee['name']);
    $employee['lastname'] = htmlspecialchars($employee['lastname']);
    $employee['hourlyRate'] = htmlspecialchars($employee['hourlyRate']);
} else {
    $employee['name'] = htmlspecialchars($_POST['name']);
    $employee['lastname'] = htmlspecialchars($_POST['lastname']);
    $employee['hourlyRate'] = htmlspecialchars($_POST['rate']);
}
makeForm('Update', $employee['name'], $employee['lastname'], $employee['hourlyRate'], $status);
