<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 11:57
 */
function form($action){
?>
<html>
    <body>
        <form method="post" action="" >
            <fieldset style="width:250px">
                <legend><strong><?php echo $action;?> employee</strong></legend>
                <?php
                if(isset($status['error_name']) || isset($status['error_empty_name']) || isset($status['error_twoNames'])){
                    $name_color = "red";
                }
                ?>
        <input type="text" name="name" style="border: 1px solid <?php echo $name_color; ?>" placeholder="Name" value="<?php if(isset($_POST['name'])){ echo htmlspecialchars($_POST['name']);} ?>">
        <?php
        if (isset($status['error_name'])) {
            echo $status['error_name'];
        }
        if (isset($status['error_empty_name'])) {
            echo $status['error_empty_name'];
        }
        if (isset($status['error_twoNames'])){
            echo $status['error_twoNames'];
        }
        ?>
        <?php
        if(isset($status['error_lastname']) || isset($status['error_empty_lastname'])){
            $lastname_color = "red";
        }
        ?>
        <input type="text" name="lastname" style="border: 1px solid <?php echo $lastname_color; ?>" placeholder="Lastname" value="<?php if(isset($_POST['lastname'])){echo htmlspecialchars($_POST['lastname']);} ?>">
        <?php
        if (isset($status['error_lastname'])) {
            echo $status['error_lastname'];
        }
        if (isset($status['error_empty_lastname'])) {
            echo $status['error_empty_lastname'];
        }
        ?>
        <?php
        if(isset($status['error_rate']) || isset($status['error_empty_rate']) || isset($status['error_low'])){
            $rate_color = "red";
        }
        ?>
        <input type="double" name="rate" style="border: 1px solid <?php echo $rate_color; ?>" placeholder="Hourly rate" value="<?php if(isset($_POST['rate'])){echo htmlspecialchars($_POST['rate']);} ?>">
        <?php
        if (isset($status['error_low']) && !isset($status['error_empty_rate']) && !isset($status['error_rate'])){
            echo $status['error_low'];
        }
        if (isset($status['error_rate']) && !isset($status['error_empty_rate'])) {
            echo $status['error_rate'];
        }
        if (isset($status['error_empty_rate'])) {
            echo $status['error_empty_rate'];
        }
        ?>
        <input type="submit" value="<?php echo $action;?>">
        </fieldset>
        </form>
    </body>
</html>
<?php
}
