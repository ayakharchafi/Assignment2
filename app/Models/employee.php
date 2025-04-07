<?php

namespace models;

use database\DBConnectionManager;

//"../core/db/dbconnectionmanager.php"
// OR
// __DIR__ -> c:\xampp\htdocs\app\Models
// dirname(__DIR__) ->c:\xampp\htdocs\app\
require(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Employee {
    private $employeeID;
    private $firstName;
    private $lastName;
    private $title;
    private $departmentID;

    private $dbConnection;

    // Constructor
    public function __construct($firstName = null, $lastName = null, $title = null, $departmentID = null) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        if(isset($title)){
            if(!ctype_alpha($title)){
            $this->title = 'invalid';
            }
        }
        $this->departmentID = $departmentID;
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Getter and setter for firstName
    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    // Getter and setter for lastName
    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    // Getter and setter for title
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if(isset($title)){
            if(!ctype_alpha($title)){
            $this->title = "invalid";
            }
        }
    }

    // Set the department for this employee
    public function setDepartmentID(Department $departmentID) {
        $this->departmentID = $departmentID;
    }

    // Get the department for this employee
    public function getDepartmentID() {
        return $this->departmentID;
    }

    // Getter and setter for id (in case you are using a database)
    public function getEmployeeID() {
        return $this->employeeID;
    }

    public function setEmployeeID($id) {
        $this->employeeID = $id;
    }

    // Read all Employees
    public function read() {
        $query = "SELECT * FROM employees";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Read single Employee by ID
    public function readOne() {
        $query = "SELECT * FROM employees WHERE employeeID = :employeeID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':employeeID', $this->employeeID);
        echo "ID: ".$this->employeeID;
    //    $stmt ->setFetchMode(\PDO::FETCH_CLASS, 'Employee');
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Employee::class);
    }
    
    public function create() {
        if (empty($this->firstName) && empty($this->departmentID) && empty($this->title)) {
            return false;
        }
        if(!ctype_alpha($this->title)){
            
            return false;
        }

        $query = "INSERT INTO employees (firstName, lastName, title, departmentID) VALUES (:firstName, :lastName, :title, :departmentID)";
        $stmt = $this->dbConnection->prepare($query);

        $stmt->bindParam(':firstName', $this->firstName);
        $stmt->bindParam(':lastName', $this->lastName);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':departmentID', $this->departmentID);

        return $stmt->execute();
    }
}