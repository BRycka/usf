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

function update_form($action, $id)
{
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);
        $rate = trim($_POST['rate']);
        $status = check($name, $lastname, $rate);
        if (empty($status)) {
            global $mysqli;
            $stmt = $mysqli->prepare("UPDATE Employee SET username=?, Lastname=?, hourlyRate=? WHERE id=?");
            $stmt->bind_param("ssdi", $name, $lastname, $rate, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: http://" . $_SERVER['SERVER_NAME']);
        }
    }
    global $mysqli;
    $stmt=$mysqli->prepare("SELECT * FROM Employee WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = array(
        'id' => null,
        'username' => null,
        'Lastname' => null,
        'hourlyRate' => null
    );
    $stmt->bind_result($row['id'], $row['username'], $row['Lastname'], $row['hourlyRate']);
    $stmt->fetch();


    if(!isset($_POST['name'])){
        $name_value = htmlspecialchars($row['username']);
        $lastname_value = htmlspecialchars($row['Lastname']);
        $rate_value = htmlspecialchars($row['hourlyRate']);
    }else{
        $name_value = htmlspecialchars($_POST['name']);
        $lastname_value = htmlspecialchars($_POST['lastname']);
        $rate_value = htmlspecialchars($_POST['rate']);
    }
    if(empty($status)){
        $status = null;
    }
    makeForm($action, $name_value, $lastname_value, $rate_value, $status);
}
