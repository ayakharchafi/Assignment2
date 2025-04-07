<?php

namespace controllers;

use models\Employee;
use views\EmployeeList;
use views\EmployeeCreate;

require(dirname(__DIR__)."/models/employee.php");
require(dirname(__DIR__)."/resources/views/employees/employeeslist.php");
require(dirname(__DIR__)."/resources/views/employees/employeecreate.php");


class EmployeeController {

    private Employee $employee;

    public function read(){

        $employee = new Employee();
        $data = $employee->read();
        
        (new EmployeeList())->render($data);
    }

    public function create() {
        $usermessage = ""; 

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if($requestMethod == 'GET') {
            $usermessage = "Please enter new employee's details";
        } else if ($requestMethod == 'POST') {
            $data = [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'title' => $_POST['title'],
                'departmentID' => $_POST['departmentID']
            ];

            foreach ($data as $index => $item) {
                $data[$index] = $this->validateInput($item);
            }            

            $employee = new Employee($data['firstName'], $data['lastName'], $data['title'], $data['departmentID']);
    
            if($employee->create()) {
                header("HTTP/1.1 302 Found");
                header("location: /app/employees");
                exit;
            } else {
                $usermessage = "Please input all required fields.";
                if(!ctype_alpha($data['title'])){
                    $usermessage = "Please input a title with only letters";
                }
            }
        }

        $view = new EmployeeCreate();
        echo $view->render(['usermessage' => $usermessage]);
    }

    public function validateInput($data) {
        // Trim whitespace from the beginning and end of the input
        $data = trim($data);
        // Remove backslashes from the input
        $data = stripslashes($data);
        // Convert special characters to HTML entities
        $data = htmlspecialchars($data);
        return $data;
    }
}