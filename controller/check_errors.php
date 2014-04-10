<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 02/04/14
 * Time: 12:04
 */
function testing_letters($data)
{
    $masyvas = array('A', 'a', 'Ą', 'ą', 'B', 'b', 'C', 'c', 'Č', 'č', 'D', 'd', 'E', 'e', 'Ę', 'ę',
        'Ė', 'ė', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'Į', 'į', 'Y', 'y', 'J', 'j',
        'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's',
        'Š', 'š', 'T', 't', 'U', 'u', 'Ų', 'ų', 'Ū', 'ū', 'V', 'v', 'Z', 'z', 'Ž', 'ž', ' ');
    $count = mb_strlen($data, 'utf-8') - 1;
    for ($i = 0; $i <= $count; $i++) {
        if (array_search(mb_substr($data, $i, 1, 'utf-8'), $masyvas) === false) {
            return false;
        }
    }
    return true;
}

function testing_numbers($data)
{
    $masyvas = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $masyvas = array_fill_keys($masyvas, true);
    $count = strlen($data) - 1;
    for ($i = 0; $i <= $count; $i++) {
        if (!array_key_exists($data[$i], $masyvas)) {
            return false;
        }
    }
    return true;
}

function checkEmployeeExist($name, $lastname, $id = null)
{
    $exist = isEmployeeExist($name, $lastname, $id);
    if($exist){
        return "<p>Employee with this name and lastname already exists</p>";
    }
    return null;
}

function getActionStatuts()
{
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'updated') {
            echo "successfully updated";
        }
        if ($_GET['status'] == 'added') {
            echo "successfully added";
        }
        if ($_GET['status'] == 'deleted') {
            echo "successfully deleted";
        }
        if ($_GET['status'] == 'notExist') {
            echo "id not exist";
        }
    }
}

function checkEmployeeForm($name, $lastname, $rate, $id = 0)
{
    $status = array();
    //name errors
    if ($name !== '') {
        if (testing_letters($name) !== false) {
            $data = explode(" ", $_POST['name']);
            if (count($data) > 2) {
                $status['name'] = "<p>just two names possible</p>";
            }
        } else {
            $status['name'] = "<p>incorrect name field</p>";
        }
    } else {
        $status['name'] = "<p>missing data in this field</p>";
    }
    //lastname errors
    if ($lastname !== '') {
        if (testing_letters($lastname) == false) {
            $status['lastname'] = "<p>incorrect lastname field</p>";
        }
    } else {
        $status['lastname'] = "<p>missing data in this field</p>";
    }
    //rate errors
    if ($rate !== '') {
        if (testing_numbers($rate) !== false || is_numeric($rate)) {
            if ($rate <= 0) {
                $status['rate'] = "<p>rate must be > 0</p>";
            }
        } else {
            $status['rate'] = "<p>incorrect rate field</p>";
        }
    } else {
        $status['rate'] = "<p>missing data in this field</p>";
    }
    $employeeExistStatus = checkEmployeeExist($name, $lastname, $id);
    if ($employeeExistStatus != null) {
        $status['exist'] = $employeeExistStatus;
    }
    return $status;
}
