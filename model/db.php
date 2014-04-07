<?php

/**
 * @return mysqli
 * @throws Exception
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

function getAllEmployeeList($order, $dir)
{
    $mysqli = connectToDb();
    $statment = $mysqli->stmt_init();
    $statment->prepare('SELECT * FROM Employee ORDER BY ' . $order . ' ' . $dir);
    $statment->execute();
    $row = array(
        'id' => null,
        'name' => null,
        'lastname' => null,
        'hourlyRate' => null
    );
    $statment->bind_result($row['id'], $row['name'], $row['lastname'], $row['hourlyRate']);

    while ($statment->fetch()) {
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['hourlyRate']; ?></td>
            <td><a href="../controller/update_employee.php?id=<?php echo $row['id'] ?>">Update</a></td>
            <td>
                <form method="post" action="/" style="margin-bottom: 0;">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input type="submit" name="delete" value="Delete"
                           onclick="return confirm('Are you sure you want to delete?');">
                </form>
            </td>
        </tr>
        </tbody>
    <?php
    }
    $statment->close();
}

function updateEmployee($name, $lastname, $rate, $id)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("UPDATE Employee SET `name`=?, lastname=?, hourlyRate=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $lastname, $rate, $id);
    if ($stmt->execute()) {
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=updated");
    }
    $stmt->close();
}

function getEmployeeById($id, $action, $status)
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
    if (!isset($_POST['name'])) {
        $name_value = htmlspecialchars($row['name']);
        $lastname_value = htmlspecialchars($row['lastname']);
        $rate_value = htmlspecialchars($row['hourlyRate']);
    } else {
        $name_value = htmlspecialchars($_POST['name']);
        $lastname_value = htmlspecialchars($_POST['lastname']);
        $rate_value = htmlspecialchars($_POST['rate']);
    }
    makeForm($action, $name_value, $lastname_value, $rate_value, $status);
}

function addEmployee($name, $lastname, $rate)
{
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("INSERT INTO Employee (`name`, lastname, hourlyRate) VALUES (?,?,? )");
    $stmt->bind_param("ssd", $name, $lastname, $rate);
    if ($stmt->execute()) {
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=added");
    }
    $stmt->close();
}

function deleteEmployee()
{
    $id = $_POST['id'];
    $mysqli = connectToDb();
    $stmt = $mysqli->prepare("DELETE FROM Employee WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=deleted");
    }
}
