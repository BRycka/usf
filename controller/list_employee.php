<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
chdir(__DIR__);
require('../model/db.php');
require('check_errors.php');
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
// rikiavimas + puslapiavimas
// nukreipas is neegzistuojancio psl i pirmaji (su zinute)
// validi zinutes vieta +
// iskelti puslapiu skaiciavima i funkcija
// update employee

$isNextButton = false;
$isBackButton = false;
$page = 0;
$offset = 0;
$back = 0;
$limit = 10;
$employeeCount = getAllEmployeeCount();
$pagesCount = ceil($employeeCount / $limit);
if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
}
if ($page < 0 || $page >= $pagesCount) {
    $page = 0;
}
if($page < $pagesCount-1){
    $isNextButton = true;
}
if($page > 0){
    $isBackButton = true;
}
$offset = $limit * $page;
$next = $page + 1;
$back = $page - 1;
$list = getOrderedEmployeeList($order, $dir, $limit, $offset);
$action = getActionStatuts();
require('../view/makeList.php');
