<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('model/db.php');
require('check_errors.php');
if (isset($_POST['id'])){
    $id = $_POST['id'];
}
if (isset($_POST['delete'])) {
    deleteEmployee($id);
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=deleted");
}
$orderBy = array('name', 'lastname', 'hourlyRate');
$order = 'name';
$dir = 'asc';
$opositeDirection = 'desc';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
    if (isset($_GET['direction']) && $_GET['direction'] == 'desc') {
        $dir = 'desc';
        $opositeDirection = 'asc';
    }
}
$list = getOrderedEmployeeList($order, $dir);
getActionStatuts();
require('view/makeList.php');
