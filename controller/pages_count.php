<?php
/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 10/04/14
 * Time: 13:36
 */
function pagesCount($limit){
    $result = [];
    $result['isBackButton'] = false;
    $result['isNextButton'] = false;
    $result['page'] = 0;

    $employeeCount = getAllEmployeeCount();
    $result['pagesCount'] = ceil($employeeCount / $limit);
    if(isset($_GET['page'])){
        $result['page'] = (int)$_GET['page'];
    }
    if ($result['page'] < 0 || $result['page'] >= $result['pagesCount']) {
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=0&status=badId");
        return;
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