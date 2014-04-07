<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 02/04/14
 * Time: 14:24
 */

function makeForm($action, $name, $lastname, $rate, $status)
{
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
        if(isset($status['exist'])){
            echo $status['exist'];
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
                   value="<?php echo $name; ?>">
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
                   placeholder="lastname" value="<?php echo $lastname; ?>">
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
                   placeholder="Hourly rate" value="<?php echo $rate; ?>">
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
<?php }

function makeList($opositeDirection, $dir, $order){
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            table.sortable th:after {
                content: " \25B4\25BE";
            }
            table.sortable th.sorttable_nosort:after{
                content: "";
            }
        </style>
    </head>
    <body>
    <table border="1" class="sortable">
        <thead>
        <tr>
            <th><a href="?orderBy=name&amp;direction=<?php echo $opositeDirection; ?>">Name</a></th>
            <th><a href="?orderBy=lastname&amp;direction=<?php echo $opositeDirection; ?>">Lastname</a></th>
            <th><a href="?orderBy=hourlyRate&amp;direction=<?php echo $opositeDirection; ?>">Hourly rate</a></th>
            <th class="sorttable_nosort">Update</th>
            <th class="sorttable_nosort">Delete</th>
        </tr>
        </thead>
        <?php
        //global $mysqli;
        $con = new dataBase();
//        var_dump($con);
        $con->connect();
        global $mysqli;

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
                <td><a href="model/update_employee.php?id=<?php echo $row['id'] ?>">Update</a></td>
                <td>
                    <form method="post" action="/" style="margin-bottom: 0px;">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete?');">
                    </form>
                </td>
            </tr>
            </tbody>
        <?php } ?>
    </table>
    <a href="model/add_employee.php"><?php echo htmlspecialchars('--->>>Add new employee<<<---'); ?></a>
    </body>
    </html>
<?php }

