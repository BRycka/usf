<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 25/03/14
 * Time: 13:11
 *
 * pasalinti tarpus +
 * hourlyRate butu su kableliu ir > 0 pvz 25.5 +
 * islaikytu reiksmes po neteisingu duomenu +
 * klaidos pranesimai butu PINK, blogo laukelio krastai RED +
 * leisk ivesti du vardus Stase Anele +
 */
require('db.php');
require('add_form.php');
?>
<!DOCTYPE html>
<html>
<body>
<?php
form('Add');
echo "<a href='http://localhost'>Main page</a>";
?>
</body>
</html>
