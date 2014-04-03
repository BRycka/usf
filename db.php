<?php

/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 31/03/14
 * Time: 10:18
 */
//$mysqli = new mysqli("localhost", "root", "", "USF");
$mysqli = new mysqli("localhost", "limituotas", "limituotas", "USF");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
/* change character set to utf8 */
$mysqli->set_charset("utf8");
/* Print current character set */
//$charset = $mysqli->character_set_name();
//printf ("Current character set is %s\n", $charset);
