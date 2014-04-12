<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
//chdir(__DIR__);
require(USF_DIR . 'help/pages_count.php');
require(USF_DIR . 'model/db.php');
require(USF_DIR . 'help/check_errors.php');
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
// rikiavimas + puslapiavimas +
// nukreipimas is neegzistuojancio psl i pirmaji (su zinute)+
// validi zinutes vieta +
// iskelti puslapiu skaiciavima i funkcija +
// update employee

$offset = 0;
$limit = 10;
$page = 0;
$employeeCount = getAllEmployeeCount();
if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
}
$test = pagesCount($limit, $page, $employeeCount);
if(!$test){
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=0&status=badId");
    return;
}
extract($test);
$list = getOrderedEmployeeList($order, $dir, $limit, $offset);
$action = getActionStatuts();
require(USF_DIR . 'view/makeList.php');
