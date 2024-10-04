<?php
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: POST, OPTIONS");
      header("Access-Control-Allow-Headers: Content-Type");
      
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
          http_response_code(200);
          exit();
      }
        
        require('../../models/Department.class.php');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = file_get_contents('php://input');
            $data = json_decode($input, true);
        
            if ($data && isset($data['name']) && isset($data['description']) && isset($data['entrepreneurs'])) {
                Department::create_department($data['name'], $data['description'], $data['entrepreneurs']);
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo 'Missing or invalid parameters';
            }
        }
?>