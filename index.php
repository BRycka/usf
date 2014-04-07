<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('model/db.php');
require('controller/check_errors.php');
require('view/form.php');
if (isset($_POST['delete'])) {
    deleteEmployee();
}
$orderBy = array('name', 'lastname', 'hourlyRate');
$order = 'name';
$dir = 'asc';
$opositeDirection = 'desc';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
    if(isset($_GET['direction']) && $_GET['direction'] == 'desc'){
        $dir = 'desc';
        $opositeDirection = 'asc';
    }
}
status();
makeList($opositeDirection, $dir, $order);

