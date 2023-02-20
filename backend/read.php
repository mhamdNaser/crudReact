<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application.json');
// Include the config file
require_once 'config.php';

// Prepare a SELECT statement
$sql = "SELECT * FROM users";
$result = $pdo->query($sql);

// $rows = array();
// Loop through each row in the result set
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Process the row data as needed
    // For example, you can access individual columns like this:
    // $column_value = $row["column_name"];
    $rows[] = $row;
}
$json = json_encode($rows);
print_r($json);

// Write the JSON string to a file
file_put_contents("db.json", $json);

