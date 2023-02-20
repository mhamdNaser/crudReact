<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');

// Include the config file
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  // Receive data from request body
  $request_body = file_get_contents('php://input');
  $data = json_decode($request_body);

  if ($data !== null) {
    // Sanitize user input
    $username = htmlspecialchars($data->username);
    $email = htmlspecialchars($data->email);
    $password = htmlspecialchars($data->password);
        
    if ($stmt->execute()) {
      $response = ['status' => 1, 'message' => "Record created successfully"];
    } else {
      $response = ['status' => 0, 'message' => "Record failed to create"];
    }

        $id = isset($data->id) ? $data->id : '';
        if ($id !== '') {
          // Update data in database
          $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
          $stmt->bindParam(':username', $username);
          $stmt->bindParam(':email', $email);
          $stmt->bindParam(':password', $password);
          $stmt->bindParam(':id', $id);
          
          if ($stmt->execute()) {
            $response = ['status' => 1, 'message' => "Record updated successfully"];
          } else {
            $response = ['status' => 0, 'message' => "Record failed to update"];
          }
        } else {
          $response = ['status' => 0, 'message' => "Invalid or missing ID"];
        }
        $response = ['status' => 0, 'message' => "Invalid operation"];
    }
  } else {
    $response = ['status' => 0, 'message' => "Invalid JSON data"];
}

echo json_encode($response);
?>