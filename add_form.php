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
function form($action)
{
    if (isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['rate'])) {
        $name = trim($_POST['name']);
        $lastname = trim($_POST['lastname']);
        $rate = trim($_POST['rate']);
        $status = check($name, $lastname, $rate);
        if (empty($status)) {
            global $mysqli;
            $stmt = $mysqli->prepare("INSERT INTO Employee (username, Lastname, hourlyRate) VALUES (?,?,? )");
            $stmt->bind_param("ssd", $name, $lastname, $rate);
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
            if (isset($status['name'])) {
                $name_color = "red";
            } else {
                $name_color = "black";
            }
            ?>
            <input type="text" name="name" style="border: 1px solid <?php echo $name_color; ?>" placeholder="Name"
                   value="<?php if (isset($_POST['name'])) {
                       echo htmlspecialchars($_POST['name']);
                   } ?>">
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
                   placeholder="Lastname" value="<?php if (isset($_POST['lastname'])) {
                echo htmlspecialchars($_POST['lastname']);
            } ?>">
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
                   placeholder="Hourly rate" value="<?php if (isset($_POST['rate'])) {
                echo htmlspecialchars($_POST['rate']);
            } ?>">
            <?php
            if (isset($status['rate'])) {
                echo $status['rate'];
            }
            ?>
            <input type="submit" value="<?php echo $action; ?>">
        </fieldset>
    </form>
    <a href='http://localhost'>Main page</a>
    </body>
    </html>
<?php
}
