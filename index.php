<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('db.php');
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    if (!mysqli_query($mysqli, "DELETE FROM Employee WHERE id = $id")) {
        echo "error ";
    } else {
        echo "successfully deleted";
        echo '<script> window.location="/"; </script> ';
    }
}
$orderBy = array('username', 'Lastname', 'hourlyRate');

$order = 'username';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
}

//$query = 'SELECT * FROM aTable ORDER BY '.$order;
?>
<html>
<head>
    <style>
        /*table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):after {*/
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
        <th><a href="?orderBy=username">Name</a></th>
        <th><a href="?orderBy=Lastname">Lastname</a></th>
        <th><a href="?orderBy=hourlyRate">Hourly rate</a></th>
        <th class="sorttable_nosort">Update</th>
        <th class="sorttable_nosort">Delete</th>
    </tr>
    </thead>
    <?php
    $statment = $mysqli->stmt_init();
    if (!$statment->prepare('SELECT * FROM Employee ORDER BY ' . $order)) {
        echo 'blogai';
        return;
    }

    if (!$statment->execute()) {
        echo 'blogai2';
        return;
    }

    $row = array(
        'id' => null,
        'username' => null,
        'Lastname' => null,
        'hourlyRate' => null
    );
    $statment->bind_result($row['id'], $row['username'], $row['Lastname'], $row['hourlyRate']);
    while ($statment->fetch()) {
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['Lastname']; ?></td>
            <td><?php echo $row['hourlyRate']; ?></td>
            <td><a href="update_employee.php?id=<?php echo $row['id'] ?>">Update</a></td>
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
<a href="add_employee.php">--->>>Add new employee<<<---</a>
</body>
</html>
