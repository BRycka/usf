<?php

/**
 * Created by PhpStorm.
 * User: ricblt
 * Date: 14/04/14
 * Time: 15:01
 */
class employee
{
    private $get;
    private $post;

    public function  __construct($get, $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function addAction()
    {
        $db = new data_base();
        $action = 'Add';
        if (isset($this->post['name']) && isset($this->post['lastname']) && isset($this->post['rate'])) {
            $name = trim($this->post['name']);
            $lastname = trim($this->post['lastname']);
            $rate = trim($this->post['rate']);
            $status = checkEmployeeForm($name, $lastname, $rate);
            if (empty($status)) {
                $db->addEmployee($name, $lastname, $rate);
                return array(
                    "headers" => array("Location" => "/employee/list?status=added"),
                    "status" => 303
                );
            }
        }
        $name_value = null;
        $lastname_value = null;
        $rate_value = null;
        if (isset($this->post['name']) && isset($this->post['lastname']) && isset($this->post['rate'])) {
            $name_value = htmlspecialchars($this->post['name']);
            $lastname_value = htmlspecialchars($this->post['lastname']);;
            $rate_value = htmlspecialchars($this->post['rate']);;
        }
        if (empty($status)) {
            $status = null;
        }
        require('view/makeForm.php');
    }

    public function deleteAction(){
        $db = new data_base();
        if (isset($this->post['delete']) && isset($this->post['id'])) {
            $db->deleteEmployee($this->post['id']);
            var_dump($this->post['id']);
            //header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=deleted");
            return array(
                "headers" => array("Location" => "/employee/list/deleted"),
                "status" => 303
            );
        }
    }

    public function listAction(){
        $db = new data_base();
        $orderBy = array('name', 'lastname', 'hourlyRate');
        $order = 'name';
        $dir = 'asc';
        $opositeDirection = 'desc';
        if (isset($this->get['orderBy']) && in_array($this->get['orderBy'], $orderBy)) {
            $order = $this->get['orderBy'];
            if (isset($this->get['direction']) && $this->get['direction'] == 'desc') {
                $dir = 'desc';
                $opositeDirection = 'asc';
            }
        }
        $offset = 0;
        $limit = 10;
        $page = 0;
        $employeeCount = $db->getAllEmployeeCount();
        if(isset($this->get['page'])){
            $page = (int)$this->get['page'];
        }
        $test = pagesCount($limit, $page, $employeeCount);
        if(!$test){
//            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?page=0&status=badId");
//            return;
            return array(
                "headers" => array("Location" => "/employee/list"),
                "status" => 303
            );
        }
        extract($test);
        $list = $db->getOrderedEmployeeList($order, $dir, $limit, $offset);
        $action = getActionStatuts();
        require('view/makeList.php');
    }

    public function updateAction(){
        $db = new data_base();
        $action = 'Update';
        if(!isset($this->get['id']) || !($employee = $db->getEmployeeById($this->get['id'])) || $employee['id'] == 0) {
            header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=notExist");
            return;
        }
        if (isset($this->post['name']) && isset($this->post['lastname']) && isset($this->post['rate']) && isset($this->get['id'])) {
            $id = $this->get['id'];
            $name = trim($this->post['name']);
            $lastname = trim($this->post['lastname']);
            $rate = trim($this->post['rate']);
            $status = checkEmployeeForm($name, $lastname, $rate, $id);
            if (empty($status)) {
                $db->updateEmployee($name, $lastname, $rate, $id);
//                header("Location: http://" . $_SERVER['SERVER_NAME'] . "/?action=list_employee&status=updated");
//                return;
                return array(
                    "headers" => array("Location" => "/employee/list?status=updated"),
                    "status" => 303
                );
            }
        }
        if (empty($status)) {
            $status = null;
        }

        if (!isset($this->post['name'])) {
            $name_value = htmlspecialchars($employee['name']);
            $lastname_value = htmlspecialchars($employee['lastname']);
            $rate_value = htmlspecialchars($employee['hourlyRate']);
        } else {
            $name_value = htmlspecialchars($this->post['name']);
            $lastname_value = htmlspecialchars($this->post['lastname']);
            $rate_value = htmlspecialchars($this->post['rate']);
        }

        require('view/makeForm.php');
    }
}