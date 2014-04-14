<?php echo $action ?>
<table border="1">
    <thead>
    <tr>
        <th><a href="list?orderBy=name&amp;direction=<?php echo $opositeDirection; ?>&amp;page=<?php echo $page?>">Name</a></th>
        <th><a href="list?orderBy=lastname&amp;direction=<?php echo $opositeDirection; ?>&amp;page=<?php echo $page?>">Lastname</a></th>
        <th><a href="list?orderBy=hourlyRate&amp;direction=<?php echo $opositeDirection; ?>&amp;page=<?php echo $page?>">Hourly rate</a></th>
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
            <td><a href="update?id=<?php echo $row['id'] ?>">Update</a></td>
            <td>
                <form method="post" action="delete?action=delete_employee" style="margin-bottom: 0;">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Delete"
                           onclick="return confirm('Are you sure you want to delete?');">
                </form>
            </td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>
<?php if ($isBackButton) { ?>
    <a href="?action=list_employee&amp;orderBy=<?php echo $order?>&amp;direction=<?php echo $dir;?>&amp;page=<?php echo $back; ?>">back</a>
<?php } ?>
<?php echo $page + 1; ?> from <?php echo $pagesCount; ?> pages
<?php if ($isNextButton) { ?>
    <a href="?action=list_employee&amp;orderBy=<?php echo $order?>&amp;direction=<?php echo $dir;?>&amp;page=<?php echo $next; ?>">next</a>
<?php } ?>
<br>
<a href="add?action=add_employee"><?php echo htmlspecialchars('--->>>Add new employee<<<---'); ?></a>
<br>
<a href="/index/dashboard">Dashboard</a>
