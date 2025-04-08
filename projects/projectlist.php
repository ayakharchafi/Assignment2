<?php

namespace views\projects;

class ProjectList {

    public function render($data) {
        require("Resources\\Views\\templates\\header.php");

        $html = "
        <table>
            <thead>
                <tr>
                    <th>Project ID</th>
                    <th>Name</th>
                    <th>Budget</th>
                </tr>
            </thead>";

        foreach ($data as $project) {
            $html .= "<tr>";
            $html .= "<td>{$project["projectID"]}</td>";
            $html .= "<td>{$project["name"]}</td>";
            $html .= "<td>$" . number_format($project["budget"], 2) . "</td>";
            $html .= "</tr>";
        }
        
        $html .= "</table>";
      
        echo $html;  

        require("Resources\\Views\\templates\\footer.php");
    }
}