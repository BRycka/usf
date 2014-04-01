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
        echo "error";
    } else {
        echo "successfully deleted";
        echo '<script> window.location="/"; </script> ';
    }
}

?>
<html>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Lastname</th>
        <th>Hourly rate</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php
    $result = mysqli_query($mysqli, 'SELECT * FROM Employee');
    while ($row = mysqli_fetch_array($result)) {
        ?>
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
    <?php }; ?>
</table>
<a href="add_employee.php">--->>>Add new employee<<<---</a>
</html>
