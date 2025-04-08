<?php
namespace controllers;

use models\Department;

require(dirname(__DIR__) . "/models/department.php");

class DepartmentController {

    public function create($departmentName) {
        $department = new Department();
        $department->setName($departmentName);

        try {
            if ($department->create()) {
                echo "Department created successfully!";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
// test
$controller = new DepartmentController();
$controller->create("Accounting");
