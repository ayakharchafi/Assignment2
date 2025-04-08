<?php

namespace controllers;

use models\Project;

class ProjectsController {

    public function create() {
        $usermessage = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->validateInput($_POST['name']);
            $budget = $this->validateInput($_POST['budget']);
            
            $project = new Project($name, $budget);
            
            if ($project->create()) {
                $usermessage = 'Project created successfully!';
            } else {
                $usermessage = 'Failed to create project. Please ensure all required fields are filled and budget is valid.';
            }
        }
        
        $view = new \views\projects\ProjectCreate();
        echo $view->render(['usermessage' => $usermessage]);
    }
    
    public function list() {
        $project = new Project();
        $projects = $project->read();
        
        $view = new \views\projects\ProjectList();
        $view->render($projects);
    }
    
    private function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}