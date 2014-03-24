<?php
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
        $stmt = $mysqli->prepare("INSERT INTO Employee (`name`, Lastname, hourlyRate) VALUES (?,?,? )");
        $stmt->bind_param("ssi", $name, $lastname, $rate);
        $stmt->execute();
        $stmt->close();
        $status="success";
    } else {
        $status = 'error';
    }
    header("Location: http://".$_SERVER['SERVER_NAME']."/?status=$status");

}

?>
<!DOCTYPE html>
<html>
<body>
    <?php if(isset($_GET['status'])){
        if($_GET['status'] == 'error'){
            echo "erroras";
        }else{
            echo "veikia";
        }
    }?>
    <form method="post">
        <fieldset style="width:250px">
            <legend><strong>Add user</strong></legend>
            <input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="lastname" placeholder="Lastname"><br>
            <input type="text" name="rate" placeholder="Hourly rate"><br>
            <input type="submit" value="Add">
        </fieldset>
    </form>
</body>
</html>
