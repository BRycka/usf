<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('controller/db.php');
require('model/check_errors.php');
require('view/form.php');
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM Employee WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=deleted");
    }
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

