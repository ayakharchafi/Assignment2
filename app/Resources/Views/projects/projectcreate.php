<?php

namespace views\projects;

class ProjectCreate {

    public function render($data) {
        $usermessage = isset($data['usermessage']) ? htmlspecialchars($data['usermessage']) : '';

        $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Project Form</title>
                </head>
                <body>
                    <h2>Project Registration</h2>
                    <form action="" method="POST">
                        <label for="name">Project Name:</label>
                        <input type="text" id="name" name="name" required><br>
                        <label for="budget">Budget ($):</label>
                        <input type="number" id="budget" name="budget" min="0.01" step="0.01" required><br><br>
                        <button type="submit">Submit</button>
                    </form>
                    <br><p>' . $usermessage . '</p>
                </body>
                </html>';
    
        return $html;
    }    
}
