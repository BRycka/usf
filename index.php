<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('db.php');
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
                <form method="post" action="/">
                    <input name="id" value="2" type="hidden">
                    <input type='submit' value='Delete' name="<?php echo $row['id']; ?>">
                </form>
            </td>
        </tr>
    <?php }; ?>
</table>
<a href="add_employee.php">--->>>Add new employee<<<---</a>
</html>
