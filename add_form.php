<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
require('db.php');
require('filters.php');
require('check_errors.php');
require('form.php');
function form($action)
{
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);
        $rate = trim($_POST['rate']);
        $status = check($name, $lastname, $rate);
        if (empty($status)) {
            global $mysqli;
            $stmt = $mysqli->prepare("INSERT INTO Employee (username, Lastname, hourlyRate) VALUES (?,?,? )");
            $stmt->bind_param("ssd", $name, $lastname, $rate);
            $stmt->execute();
            $stmt->close();
            header("Location: http://" . $_SERVER['SERVER_NAME']);
        }
    }
    $name_value = null;
    $lastname_value = null;
    $rate_value = null;
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
        $name_value = htmlspecialchars($_POST['name']);
        $lastname_value = htmlspecialchars($_POST['lastname']);;
        $rate_value = htmlspecialchars($_POST['rate']);;
    }
    if(empty($status)){
        $status = null;
    }
    makeForm($action, $name_value, $lastname_value, $rate_value, $status);
}
