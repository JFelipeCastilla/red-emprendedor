<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS, PUT");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require('../../models/Township.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);
  
  $township_id = intval($_GET['township_id']);

  if ($data && isset($data['township_name']) && isset($data['amount_entrepreneur']) && isset($data["department_fk"])) {
      Township::update_township($township_id, $data['township_name'], $data['amount_entrepreneur'], $data["department_fk"]);
  } else {
      header('HTTP/1.1 400 Bad Request');
      echo 'Missing or invalid parameters';
  }
}
?>