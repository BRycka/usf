<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 02/04/14
 * Time: 12:04
 */
function check($name, $lastname, $rate){
    $status = array();
    //name errors
    if ($name !== '') {
        if (testing_letters($name) !== false) {
            $data = explode(" ", $_POST['name']);
            if (count($data) > 2) {
                $status['name'] = "<p>just two names possible</p>";
            }
        }else{
            $status['name'] = "<p>incorrect name field</p>";
        }
    }else{
        $status['name'] = "<p>missing data in this field</p>";
    }
    //lastname errors
    if ($lastname !== '') {
        if (testing_letters($lastname) == false) {
            $status['lastname'] = "<p>incorrect lastname field</p>";
        }
    }else{
        $status['lastname'] = "<p>missing data in this field</p>";
    }
    //rate errors
    if ($rate !== '') {
        if (testing_numbers($rate) !== false || is_numeric($rate)) {
            if ($rate <= 0) {
                $status['rate'] = "<p>rate must be > 0</p>";
            }
        }else{
            $status['rate'] = "<p>incorrect rate field</p>";
        }
    }else{
        $status['rate'] = "<p>missing data in this field</p>";
    }
    return $status;
}
