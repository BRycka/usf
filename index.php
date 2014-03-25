<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 25/03/14
 * Time: 13:11
 */

//------prepared statement------
$mysqli = new mysqli("localhost", "root", "", "USF");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $status = array();
    $name = ($_POST['name']);
    $lastname = ($_POST['lastname']);
    $rate = ($_POST['rate']);
    if (!preg_match("/^[a-zą-ž]+$/i", $_POST['name'])) {
        $status['error_name'] = "incorrect name field";
    }
    if (!preg_match("/^[a-zą-ž]+$/i", $_POST['lastname'])) {
        $status['error_lastname'] = "incorrect lastname field";
    }
    if (!preg_match("/^[1-9]+$/", $_POST['rate'])) {
        $status['error_rate'] = "incorrect rate field";
    }
    if (empty($status)) {
        $stmt = $mysqli->prepare("INSERT INTO Employee (username, Lastname, hourlyRate) VALUES (?,?,? )");
        $stmt->bind_param("ssi", $name, $lastname, $rate);
        $stmt->execute();
        $stmt->close();
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=success");
    }

}
/* change character set to utf8 */
$mysqli->set_charset("utf8");

?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<html>
<body>
<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == "success") {
        echo "Successfully inserted";
    }
}
?>
<form method="post">
    <fieldset style="width:250px">
        <legend><strong>Add user</strong></legend>
        <input type="text" name="name" placeholder="Name"><br>
        <?php
        if (isset($status['error_name'])) {
            echo $status['error_name'];
        }
        ?>
        <input type="text" name="lastname" placeholder="Lastname"><br>
        <?php
        if (isset($status['error_lastname'])) {
            echo $status['error_lastname'];
        }
        ?>
        <input type="text" name="rate" placeholder="Hourly rate"><br>
        <?php
        if (isset($status['error_rate'])) {
            echo $status['error_rate'];
        }
        ?>
        <input type="submit" value="Add">
    </fieldset>
</form>
</body>
</html>
