<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('db.php');
require('check_errors.php');
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $mysqli->prepare("DELETE FROM Employee WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?status=deleted");
    }
}
$orderBy = array('name', 'lastname', 'hourlyRate');

$order = 'name';
$dir = 'asc';
$opositeDirection = 'desc';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
    if(isset($_GET['direction']) && $_GET['direction'] == 'desc'){
        $dir = 'desc';
        $opositeDirection = 'asc';
    }
}
echo status();
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
<a href="add_employee.php"><?php echo htmlspecialchars('--->>>Add new employee<<<---'); ?></a>
</body>
</html>
