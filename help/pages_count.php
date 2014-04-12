<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 10/04/14
 * Time: 13:36
 */
function pagesCount($limit, $page, $employeeCount){
    $result = [];
    $result['isBackButton'] = false;
    $result['isNextButton'] = false;
    $result['page'] = $page;

    $result['pagesCount'] = ceil($employeeCount / $limit);

    if ($result['page'] < 0 || $result['page'] >= $result['pagesCount']) {
        return false;
    }
    if($result['page'] < $result['pagesCount']-1){
        $result['isNextButton'] = true;
    }
    if($result['page'] > 0){
        $result['isBackButton'] = true;
    }
    $result['offset'] = $limit * $result['page'];
    $result['next'] = $result['page'] + 1;
    $result['back'] = $result['page'] - 1;
    return $result;
}