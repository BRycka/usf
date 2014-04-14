<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 10/04/14
 * Time: 10:21
 */
$db = new data_base();
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $db->deleteEmployee($_POST['id']);
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=deleted");
}
