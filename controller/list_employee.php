<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
chdir(__DIR__);
require('pages_count.php');
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
// rikiavimas + puslapiavimas +
// nukreipimas is neegzistuojancio psl i pirmaji (su zinute)+
// validi zinutes vieta +
// iskelti puslapiu skaiciavima i funkcija +
// update employee

$offset = 0;
$limit = 10;
$page = 0;
$test = pagesCount($limit);
extract($test);
$list = getOrderedEmployeeList($order, $dir, $limit, $offset);
$action = getActionStatuts();
require('../view/makeList.php');
