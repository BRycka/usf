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
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            p {
                color: pink;
            }

            p {
                margin-top: 1px;
                margin-bottom: 1px;
            }
        </style>
    </head>

    <body>
    <?php
    if (isset($status['success'])) {
        echo $status['success'];
    }
    ?>
    <form method="post" action="">
        <fieldset style="width:250px">
            <legend><strong><?php echo $action; ?> employee</strong></legend>
            <?php
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
            if (isset($status['name'])) {
                $name_color = "red";
            } else {
                $name_color = "black";
            }
            ?>
            <input type="text" name="name" style="border: 1px solid <?php echo $name_color; ?>" placeholder="Name"
                   value="<?php echo htmlspecialchars($row['username']); ?>">
            <?php
            if (isset($status['name'])) {
                echo $status['name'];
            }
            ?>
            <?php
            if (isset($status['lastname'])) {
                $lastname_color = "red";
            } else {
                $lastname_color = "black";
            }
            ?>
            <input type="text" name="lastname" style="border: 1px solid <?php echo $lastname_color; ?>"
                   placeholder="Lastname" value="<?php echo htmlspecialchars($row['Lastname']); ?>">
            <?php
            if (isset($status['lastname'])) {
                echo $status['lastname'];
            }
            ?>
            <?php
            if (isset($status['rate'])) {
                $rate_color = "red";
            } else {
                $rate_color = "black";
            }
            ?>
            <input type="double" name="rate" style="border: 1px solid <?php echo $rate_color; ?>"
                   placeholder="Hourly rate" value="<?php echo htmlspecialchars($row['hourlyRate']); ?>">
            <?php
            if (isset($status['rate'])) {
                echo $status['rate'];
            }
            ?>
            <input type="submit" value="<?php echo $action; ?>">
        </fieldset>
    </form>
    <a href='/'>Main page</a>
    </body>
    </html>
<?php
}
