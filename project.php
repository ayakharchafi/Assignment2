<?php

namespace models;

use database\DBConnectionManager;

require(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Project {
    private $projectID;
    private $name;
    private $budget;

    private $dbConnection;

    // Constructor
    public function __construct($name = null, $budget = null) {
        $this->name = $name;
        $this->budget = $budget;
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Getter and setter 
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getBudget() {
        return $this->budget;
    }

    public function setBudget($budget) {
        $this->budget = $budget;
    }

    public function getProjectID() {
        return $this->projectID;
    }

    public function setProjectID($id) {
        $this->projectID = $id;
    }

    // Read all Projects
    public function read() {
        $query = "SELECT * FROM projects";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Read single Project by ID
    public function readOne() {
        $query = "SELECT * FROM projects WHERE projectID = :projectID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':projectID', $this->projectID);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Project::class);
    }
    
    public function create() {
        // Validate required fields
        if (empty($this->name) || empty($this->budget)) {
            return false;
        }
        
        // Validate budget is numeric and positive
        if (!is_numeric($this->budget) || $this->budget <= 0) {
            return false;
        }

        $query = "INSERT INTO projects (name, budget) VALUES (:name, :budget)";
        $stmt = $this->dbConnection->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':budget', $this->budget);

        return $stmt->execute();
    }
}
