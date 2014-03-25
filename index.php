<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 25/03/14
 * Time: 13:11
 */

//lt raides, tik sk, tarpai, klaidos.
//------prepared statement------
$mysqli = new mysqli("localhost", "root", "", "USF");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {

    $name = ($_POST['name']);
    $lastname = ($_POST['lastname']);
    $rate = ($_POST['rate']);
    if ($name != '' && $lastname != '' && $rate != '') {
        if (preg_match("/[a-zA-Zą-žĄ-Ž]/", $_POST['name'])) {
            if (preg_match("/[a-zA-Zą-žĄ-Ž]/", $_POST['lastname'])) {
                if (preg_match("/[1-9]/", $_POST['rate'])) {
                    $stmt = $mysqli->prepare("INSERT INTO Employee (`name`, Lastname, hourlyRate) VALUES (?,?,? )");
                    $stmt->bind_param("ssi", $name, $lastname, $rate);
                    $stmt->execute();
                    $stmt->close();
                    $status = "success";
                } else {
                    $status = "error_rate";
                }
            } else {
                $status = "error_lastname";
            }
        } else {
            $status = "error_name";
        }
    } else {
        $status = 'error';
    }
    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=$status");

}

?>
<!DOCTYPE html>
<html>
<body>
<?php if (isset($_GET['status'])) {
    if ($_GET['status'] == 'error') {
        echo "erroras";
    } else {
        echo "successfully inserted";
    }
}
?>
<form method="post">
    <fieldset style="width:250px">
        <legend><strong>Add user</strong></legend>
        <input type="text" name="name" placeholder="Name"><br>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error_name') {
                echo "error in name field";
            }
        }
        ?>
        <input type="text" name="lastname" placeholder="Lastname"><br>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error_lastname') {
                echo "error in lastname field";
            }
        }
        ?>
        <input type="text" name="rate" placeholder="Hourly rate"><br>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'error_rate') {
                echo "error in rate field";
            }
        }
        ?>
        <input type="submit" value="Add">
    </fieldset>
</form>
</body>
</html>
