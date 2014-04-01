<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:28
 */
require('db.php');
require('update_form.php');
$id = $_GET['id'];
update_form('Update', $id);
