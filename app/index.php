<?php

spl_autoload_register(function ($class) {
    require($class.'.php');
});


// Given the URL http://localhost/app/index.php?employees=1
// This means we want the employee with ID = 1
// We read the value 1 using $_GET["employees"]

// but what if we want all employees thus the URL doesn't have the id as a value:
// http://localhost/app/index.php?employees

// Our objective is to read the "employees" and match it with a controller within our app

//echo "URL = ".$_GET['url'];

echo "GET = ".var_dump($_GET);


$resourceName = array_keys($_GET)[0];
//echo $resource;

// We need to construct the controller name from the resource name

// what do we need to do?
// to match our controller name "EmployeeController"
// starting with "employees" as included in the query string
// 1- We need to Capitalize the first letter "E"
// 2- We need to remove the "s"
// 3- We need to append the keyword "Controller"

$controllerClass = substr(ucfirst($resourceName), 0, strlen($resourceName)-1)."Controller";

// Add the namespace / which corresponds to the folder so that the require works
// using the fully qualified class name:
$controllerClass = "\\controllers\\".$controllerClass;

//echo $controllerClass;

// The class_exists check is calling the function given to spl_autoload_register() and passing the $controllerClass as parameter
if(class_exists($controllerClass)){

    $employeeController = new $controllerClass();

    $data = $employeeController->read();

    // If we used return in the view then we can echo the data here
    //echo $data;



}else{
    echo "<br>";
    echo "The requested resource is not found.";
}