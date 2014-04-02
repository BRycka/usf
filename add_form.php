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
            $stmt = $mysqli->prepare("INSERT INTO Employee (`name`, lastname, hourlyRate) VALUES (?,?,? )");
            $stmt->bind_param("ssd", $name, $lastname, $rate);
            $stmt->execute();
            $stmt->close();
            header("Location: http://" . $_SERVER['SERVER_NAME']);
        }
        global $mysqli;
        $result = mysqli_query($mysqli, "SELECT name, lastname FROM Employee");
        while($row=mysqli_fetch_array($result)){
            if($_POST['name'] == $row['name'] && $_POST['lastname'] == $row['lastname']){
                $status['exist']="<p>Employee with this name and lastname already exists</p>";
            }
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
