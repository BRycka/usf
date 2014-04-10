<?php

/**
 * @return mysqli
 * @throws Exception
 * connecting to data base
 */
function connectToDb()
{
    static $mysqli;
    if (null === $mysqli) {
        $mysqli = new mysqli("localhost", "limituotas", "limituotas", "USF");
//            $mysqli = new mysqli("localhost", "root", "", "USF");
        if ($mysqli->connect_errno) {
            throw new Exception("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        }
        $mysqli->set_charset("utf8");

    }
    return $mysqli;
}

/**
 * @param $order
 * @param $dir
 * getting all employee list
 */
function getOrderedEmployeeList($order, $dir)
{
    $list = [];
    $mysqli = connectToDb();
    $statment = $mysqli->stmt_init();
    $statment->prepare('SELECT * FROM Employee ORDER BY ' . $order . ' ' . $dir . ' LIMIT 2 OFFSET 11');
    $statment->execute();
    $row = array(
        'id' => null,
        'name' => null,
        'lastname' => null,
        'hourlyRate' => null
    );
    $statment->bind_result($row['id'], $row['name'], $row['lastname'], $row['hourlyRate']);
    while ($statment->fetch()) {
        $list[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'lastname' => $row['lastname'],
            'hourlyRate' => $row['hourlyRate']
        );
    }

    $statment->close();
    return $list;
}

/**
 * @param $name
 * @param $lastname
 * @param $rate
 * @param $id
 * updating employee data
 */
function updateEmployee($name, $lastname, $rate, $id)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("UPDATE Employee SET `name`=?, lastname=?, hourlyRate=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $lastname, $rate, $id);
    $stmt->execute();
    $stmt->close();
}

/**
 * @param $id
 * @param $action
 * @param $status
 * getting employee by id
 */
function getEmployeeById($id)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("SELECT * FROM Employee WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = array(
        'id' => null,
        'name' => null,
        'lastname' => null,
        'hourlyRate' => null
    );
    $stmt->bind_result($row['id'], $row['name'], $row['lastname'], $row['hourlyRate']);
    $stmt->fetch();
    $employee = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'lastname' => $row['lastname'],
        'hourlyRate' => $row['hourlyRate']
    );
    $stmt->close();
    return $employee;
}

/**
 * @param $name
 * @param $lastname
 * @param $rate
 * adding employee
 */
function addEmployee($name, $lastname, $rate)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("INSERT INTO Employee (`name`, lastname, hourlyRate) VALUES (?,?,? )");
    $stmt->bind_param("ssd", $name, $lastname, $rate);
    $stmt->execute();
    $stmt->close();
}

/**
 * deleting employee
 */
function deleteEmployee($id)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("DELETE FROM Employee WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
function isEmployeeExist($name, $lastname, $id){
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("SELECT count(*) FROM Employee WHERE `name` = ? AND `lastname` = ? AND NOT(`id` = ?) ");
    $stmt->bind_param("ssi", $name, $lastname, $id);
    $stmt->execute();
    $count = 0;
    $stmt->bind_result($count);
    $stmt->fetch();
    return $count != 0;
}
