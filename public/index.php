<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 07/04/14
 * Time: 15:54
 */
// define our application directory
chdir(__DIR__ . '/..');
require 'model/data_base.php';
require 'help/check_errors.php';
ob_start();
// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

switch($_action) {
    case 'add_employee':
        require 'controller/add_employee.php';
        break;
    case 'update_employee':
        require 'controller/update_employee.php';
        break;
    case 'delete_employee':
        require 'controller/delete_employee.php';
        break;
    case 'list_employee':
        require 'controller/list_employee.php';
        break;
    case 'about';
        require'view/about.php';
        break;
    case 'index':
    default:
        require('view/dashboard.php');
        break;
}
$content = ob_get_contents();
ob_end_clean();
require('view/layout.php');
