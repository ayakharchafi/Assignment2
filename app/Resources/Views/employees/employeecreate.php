<?php

namespace views;


class EmployeeCreate{

    public function render($data) {
        $usermessage = isset($data['usermessage']) ? htmlspecialchars($data['usermessage']) : '';

        $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Employee Form</title>
                </head>
                <body>
                    <h2>Employee Registration</h2>
                    <form action="" method="POST">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" required><br>
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName"><br>
                        <label for="departmentID">Department ID:</label>
                        <input type="number" id="departmentID" name="departmentID" required><br>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required><br><br>
                        <button type="submit">Submit</button>
                    </form>
                    <br><p>' . $usermessage . '</p>
                </body>
                </html>';
    
        return $html;
    }    

}

