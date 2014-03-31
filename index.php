<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:12
 */
require('db.php');
$result = mysqli_query($mysqli, 'SELECT * FROM Employee');
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
    <?php while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['Lastname']; ?></td>
            <td><?php echo $row['hourlyRate']; ?></td>
            <form method="post" action="update_employee.php"><td><input type='submit' value='Update' name="<?php echo $row['id'];?>"></td>
            <td><input type='submit' value='Delete' name='delete'></td></form>
        </tr>
    <?php }; ?>
</table>
<a href='http://localhost/add_new.php'>--->>>Add new employee<<<---</a>
</html>
