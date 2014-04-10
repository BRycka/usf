<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table border="1">
    <thead>
    <tr>
        <th><a href="?orderBy=name&amp;direction=<?php echo $opositeDirection; ?>">Name</a></th>
        <th><a href="?orderBy=lastname&amp;direction=<?php echo $opositeDirection; ?>">Lastname</a></th>
        <th><a href="?orderBy=hourlyRate&amp;direction=<?php echo $opositeDirection; ?>">Hourly rate</a></th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    </thead>
    <?php
    foreach ($list as $row):
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['hourlyRate']; ?></td>
            <td><a href="/controller/update_employee.php?id=<?php echo $row['id'] ?>">Update</a></td>
            <td>
                <form method="post" action="/controller/delete_employee.php" style="margin-bottom: 0;">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input type="submit" name="delete" value="Delete"
                           onclick="return confirm('Are you sure you want to delete?');">
                </form>
            </td>
        </tr>
</tbody>
<?php endforeach; ?>
</table>
<a href="/controller/add_employee.php"><?php echo htmlspecialchars('--->>>Add new employee<<<---'); ?></a>
</body>
</html>
