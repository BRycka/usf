<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
$db = new data_base();
$action = 'Add';
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    $status = checkEmployeeForm($name, $lastname, $rate);
    if (empty($status)) {
        $db->addEmployee($name, $lastname, $rate);
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=added");
        return;
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
require('view/makeForm.php');
