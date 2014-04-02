<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 02/04/14
 * Time: 11:53
 */

function testing_letters($data)
{
    $masyvas = array('A', 'a', 'Ą', 'ą', 'B', 'b', 'C', 'c', 'Č', 'č', 'D', 'd', 'E', 'e', 'Ę', 'ę',
        'Ė', 'ė', 'F', 'f', 'G', 'g', 'H', 'h', 'I', 'i', 'Į', 'į', 'Y', 'y', 'J', 'j',
        'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's',
        'Š', 'š', 'T', 't', 'U', 'u', 'Ų', 'ų', 'Ū', 'ū', 'V', 'v', 'Z', 'z', 'Ž', 'ž', ' ');
    $count = mb_strlen($data, 'utf-8') - 1;
    for ($i = 0; $i <= $count; $i++) {
        if (array_search(mb_substr($data, $i, 1, 'utf-8'), $masyvas) === false) {
            return false;
        }
    }
    return true;
}

function testing_numbers($data)
{
    $masyvas = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $masyvas = array_fill_keys($masyvas, true);
    $count = strlen($data) - 1;
    for ($i = 0; $i <= $count; $i++) {
        if (!array_key_exists($data[$i], $masyvas)) {
            return false;
        }
    }
    return true;
}
