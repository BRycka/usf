<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 10/04/14
 * Time: 10:21
 */
require '../model/db.php';
if (isset($_POST['delete']) && isset($_POST['id'])) {
    deleteEmployee($_POST['id']);
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=deleted");
}
