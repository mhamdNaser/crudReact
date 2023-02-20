<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');

// Include the config file
require_once 'config.php';

// ... PDO connection code

$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($query);

$stmt->bindParam(':id', $id);

if($stmt->execute()){
    echo json_encode(array("message" => "User was deleted."));
} else{
    echo json_encode(array("message" => "Unable to delete user."));
}
// // get the id parameter from the URL
// $id = $_GET['id'];

// // prepare SQL statement to delete the record with the specified id
// $sql = "DELETE FROM table_name WHERE id = :id";

// // prepare the statement
// $stmt = $conn->prepare($sql);

// // bind the parameters
// $stmt->bindParam(':id', $id);

// // execute the delete query
// if ($stmt->execute()) {
//     echo "Record deleted successfully";
// } else {
//     echo "Error deleting record: " . $stmt->errorInfo()[2];
// }

// // close database connection
// $conn = null;