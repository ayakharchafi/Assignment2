<?php
namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__) . "/core/db/dbconnectionmanager.php");
class Department{
    private $departmentId;
    private $name;
    private $dbConnection;

    public function __construct($name=null) {
        $this->name =$name;
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    public function getdepartmentId() {
        return $this->id;
    }
    public function setdepartmentId($departmentId) {
        $this->departmentId = $departmentId;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    // department must have a name
    public function isValid() {
        return !empty($this->name);
    }
    function validateInput($data) {
        // Trim whitespace from the beginning and end of the input
        $data = trim($data);
        // Remove backslashes from the input
        $data = stripslashes($data);
        // Convert special characters to HTML entities
        $data = htmlspecialchars($data);
        return $data;
    }
    public function create() {
        $this->name = $this->validateInput($this->name);
        if (!$this->isValid()) {
            throw new \Exception("Department name cannot be empty.");
        }

        $query = "INSERT INTO departments (name) VALUES (:name)";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(":name", $this->name);
        return $stmt->execute();
    }
    
}
