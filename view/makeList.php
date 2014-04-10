<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php echo $action ?>
<table border="1">
    <thead>
    <tr>
        <?php if(isset($_GET['page'])){?>
            <th><a href="?orderBy=name&amp;direction=<?php echo $opositeDirection;?>&amp;page=<?php echo $_GET['page']?>">Name</a></th>
            <th><a href="?orderBy=lastname&amp;direction=<?php echo $opositeDirection; ?>&amp;page=<?php echo $_GET['page']?>">Lastname</a></th>
            <th><a href="?orderBy=hourlyRate&amp;direction=<?php echo $opositeDirection; ?>&amp;page=<?php echo $_GET['page']?>">Hourly rate</a></th>
        <?php }else{?>
        <th><a href="?orderBy=name&amp;direction=<?php echo $opositeDirection; ?>">Name</a></th>
        <th><a href="?orderBy=lastname&amp;direction=<?php echo $opositeDirection; ?>">Lastname</a></th>
        <th><a href="?orderBy=hourlyRate&amp;direction=<?php echo $opositeDirection; ?>">Hourly rate</a></th>
        <?php }?>
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
<?php if(isset($_GET['orderBy'])){
    if ($isBackButton) { ?>
        <a href="?orderBy=<?php echo $_GET['orderBy']?>&amp;direction=<?php echo $_GET['direction'];?>&amp;page=<?php echo $back; ?>">back</a>
    <?php } ?>
    <?php echo $page + 1; ?> from <?php echo $pagesCount; ?> pages
    <?php if ($isNextButton) { ?>
        <a href="?orderBy=<?php echo $_GET['orderBy']?>&amp;direction=<?php echo $_GET['direction'];?>&amp;page=<?php echo $next; ?>">next</a>

    <?php }}else{
if ($isBackButton) { ?>
    <a href="/controller/list_employee.php?page=<?php echo $back; ?>">back</a>
<?php } ?>
<?php echo $page + 1; ?> from <?php echo $pagesCount; ?> pages
<?php if ($isNextButton) { ?>
    <a href="/controller/list_employee.php?page=<?php echo $next; ?>">next</a>
<?php } }?>
<br>
<a href="/controller/add_employee.php"><?php echo htmlspecialchars('--->>>Add new employee<<<---'); ?></a>
</body>
</html>
