<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
$db = new data_base();
$action = 'Update';
if(!isset($_GET['id']) || !($employee = $db->getEmployeeById($_GET['id'])) || $employee['id'] == 0) {
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=notExist");
    return;
}
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    $status = checkEmployeeForm($name, $lastname, $rate, $id);
    if (empty($status)) {
        $db->updateEmployee($name, $lastname, $rate, $id);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=updated");
        return;
    }
}
if (empty($status)) {
    $status = null;
}

if (!isset($_POST['name'])) {
    $name_value = htmlspecialchars($employee['name']);
    $lastname_value = htmlspecialchars($employee['lastname']);
    $rate_value = htmlspecialchars($employee['hourlyRate']);
} else {
    $name_value = htmlspecialchars($_POST['name']);
    $lastname_value = htmlspecialchars($_POST['lastname']);
    $rate_value = htmlspecialchars($_POST['rate']);
}

require('view/makeForm.php');
