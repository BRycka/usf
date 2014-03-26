<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 25/03/14
 * Time: 13:11
 *
 * pasalinti tarpus +
 * hourlyRate butu su kableliu ir > 0 pvz 25.5 +
 * islaikytu reiksmes po neteisingu duomenu +
 * klaidos pranesimai butu PINK, blogo laukelio krastai RED +
 * leisk ivesti du vardus Stase Anele +
 */
function testing_letters($data)
{
    $used = 0;
    $masyvas = array('A', 'a', 'Ą', 'ą', 'B', 'b', 'C', 'c', 'Č', 'č', 'D', 'd', 'E', 'e', 'Ę', 'ę',
        'Ė', 'ė', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'Į', 'į', 'Y', 'y', 'J', 'j',
        'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's',
        'Š', 'š', 'T', 't', 'U', 'u', 'Ų', 'ų', 'Ū', 'ū', 'V', 'v', 'Z', 'z', 'Ž', 'ž', ' ');
    $count = mb_strlen($data, 'utf-8')- 1;
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
    $count = strlen($data)- 1;
    for ($i = 0; $i <= $count; $i++) {
        if (!array_key_exists($data[$i], $masyvas)) {
            return false;
        }
    return true;
}
}
//------prepared statement------
$mysqli = new mysqli("localhost", "root", "", "USF");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
/* change character set to utf8 */
$mysqli->set_charset("utf8");
/* Print current character set */
//$charset = $mysqli->character_set_name();
//printf ("Current character set is %s\n", $charset);
if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
    $status = array();
    $name = trim($_POST['name']);
    $lastname = trim($_POST['lastname']);
    $rate = trim($_POST['rate']);
    if ($name == '') {
        $status['error_empty_name'] = "<p>missing data in this field</p>";
    }
    if ($lastname == '') {
        $status['error_empty_lastname'] = "<p>missing data in this field</p>";
    }
    if ($rate == '') {
        $status['error_empty_rate'] = "<p>missing data in this field</p>";
    }
    if (testing_letters($name) == false) {
        $status['error_name'] = "<p>incorrect name field</p>";
    }
    if (testing_letters($lastname) == false) {
        $status['error_lastname'] = "<p>incorrect lastname field</p>";
    }
    if (testing_numbers($rate) == false) {
        $status['error_rate'] = "<p>incorrect rate field</p>";
    }
    if(isset($rate) && $rate <= 0 ) {
        $status['error_low'] = "<p>rate must be > 0</p>";
    }
    $data = explode(" ",$_POST['name']);
    if (count($data) > 2) {
        $status['error_twoNames'] = "<p>just two names possible</p>";
    }
    if (empty($status)) {
        $stmt = $mysqli->prepare("INSERT INTO Employee (username, Lastname, hourlyRate) VALUES (?,?,? )");
        $stmt->bind_param("ssd", $name, $lastname, round($rate, 1));
        $stmt->execute();
        $stmt->close();
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=success");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        p {color:pink;}
        p {margin-top:1px; margin-bottom: 1px;}
    </style>
</head>
<body>
<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == "success") {
        echo "Successfully inserted";
    }
}
?>
<form method="post" action="/">
    <fieldset style="width:250px">
        <legend><strong>Add user</strong></legend>
        <?php
            if(isset($status['error_name']) || isset($status['error_empty_name']) || isset($status['error_twoNames'])){
                $name_color = "red";
            }
        ?>
        <input type="text" name="name" style="border: 1px solid <?php echo $name_color; ?>" placeholder="Name" value="<?php if(isset($_POST['name'])){ echo htmlspecialchars($_POST['name']);} ?>">
        <?php
        if (isset($status['error_name'])) {
            echo $status['error_name'];
        }
        if (isset($status['error_empty_name'])) {
            echo $status['error_empty_name'];
        }
        if (isset($status['error_twoNames'])){
            echo $status['error_twoNames'];
        }
        ?>
        <?php
        if(isset($status['error_lastname']) || isset($status['error_empty_lastname'])){
            $lastname_color = "red";
        }
        ?>
        <input type="text" name="lastname" style="border: 1px solid <?php echo $lastname_color; ?>" placeholder="Lastname" value="<?php if(isset($_POST['lastname'])){echo htmlspecialchars($_POST['lastname']);} ?>">
        <?php
        if (isset($status['error_lastname'])) {
            echo $status['error_lastname'];
        }
        if (isset($status['error_empty_lastname'])) {
            echo $status['error_empty_lastname'];
        }
        ?>
        <?php
        if(isset($status['error_rate']) || isset($status['error_empty_rate']) || isset($status['error_low'])){
            $rate_color = "red";
        }
        ?>
        <input type="double" name="rate" style="border: 1px solid <?php echo $rate_color; ?>" placeholder="Hourly rate" value="<?php if(isset($_POST['rate'])){echo htmlspecialchars($_POST['rate']);} ?>">
        <?php
        if (isset($status['error_low']) && !isset($status['error_empty_rate']) && !isset($status['error_rate'])){
            echo $status['error_low'];
        }
        if (isset($status['error_rate']) && !isset($status['error_empty_rate'])) {
            echo $status['error_rate'];
        }
        if (isset($status['error_empty_rate'])) {
            echo $status['error_empty_rate'];
        }
        ?>
        <input type="submit" value="Add">
    </fieldset>
</form>
</body>
</html>
