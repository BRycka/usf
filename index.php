<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "USF";
$connect = mysql_connect("$host", "$username", "$password") or die("Unable to connect to database");
mysql_select_db("$db_name") or die("cannot select DB");

//add employee
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $name = ($_POST['name']);
    $lastname = ($_POST['lastname']);
    $rate = ($_POST['rate']);
    if ($name != '' && $lastname != '' && $rate != '') {
        mysql_query("INSERT INTO Employee (name, Lastname, hourlyRate) VALUES ('{$name}','{$lastname}','{$rate}')");
        echo "Successfully added";
    } else {
        echo "missing data";
    }
}
?>
<html>
<fieldset style="width:250">
    <legend><strong>Add user</strong></legend>
    <form method="post">
        <input type="text" name="name" placeholder="Name"><br>
        <input type="text" name="lastname" placeholder="Lastname"><br>
        <input type="text" name="rate" placeholder="Hourly rate"><br>
        <input type="submit" value="Add">
    </form>
</fieldset>
</html>
