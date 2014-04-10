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
if (isset($status['exist'])) {
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
               value="<?php echo $name_value; ?>">
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
               placeholder="lastname" value="<?php echo $lastname_value; ?>">
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
        <input type="text" name="rate" style="border: 1px solid <?php echo $rate_color; ?>"
               placeholder="Hourly rate" value="<?php echo $rate_value; ?>">
        <?php
        if (isset($status['rate'])) {
            echo $status['rate'];
        }
        ?>
        <input type="submit" value="<?php echo $action; ?>">
    </fieldset>
</form>
<a href='/'>Main page</a>
</body>
</html>
