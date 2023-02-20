<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

// Include the config file
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Receive data from request body
  $request_body = file_get_contents('php://input');
  $users = json_decode($request_body);

  if ($users !== null) {
    // Sanitize user input
    $username = htmlspecialchars($users->username);
    $email = htmlspecialchars($users->email);
    $password = htmlspecialchars($users->password);

    // Insert data into database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    
    if ($stmt->execute()) {
      $response = ['status' => 1, 'message' => "Record created successfully"];
    } else {
      $response = ['status' => 0, 'message' => "Record failed to create"];
    }
  } else {
    $response = ['status' => 0, 'message' => "Invalid JSON data"];
  }
} else {
  $response = ['status' => 0, 'message' => "Unsupported request method"];
}

echo json_encode($response);
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: *');
// header('Content-Type: application.json');

// // // Include the config file
// require_once 'config.php';

// $_SERVER['REQUEST_METHOD'];// there is a case of GEt when we want to bring data , and case of POSt when we want to send data
//         // Recieve data from database
    
//         $users = json_decode(file_get_contents('php://input')); // to make php read this as an object from react
        
//         $db = $pdo->prepare("INSERT INTO users (username, email, password) VALUES ( :username, :email, :pass)");
//         $db->bindValue(':username' , $users->username); // to reach the name email and mobile from data 
//         $db->bindValue(':email' , $users->email);
//         $db->bindValue(':pass' , $users->pass);
//         if($db -> execute()) {
//             $response = ['status' =>1, 'message'=>"Record created succcesfully"];
//         }else{
//             $response = ['status' =>0, 'message'=>"Record Faild to creat"];
//         }
//         echo json_encode($response); // to send this message as a Json (you can read it in inspect -- Newtwork)

?>