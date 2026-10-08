<?php
// Start PHP mode
header("Content-Type: application/json"); // Tell the browser/client the response is JSON
require("../db.php"); // Load the DB class (note: file is actually at db/DB.PHP)

// Create a DB object and open a connection to MySQL
$db = new DB();
$conn = $db->createConnection();

// Read the raw JSON body sent by the client (e.g. fetch())
$input = file_get_contents("php://input");
// Decode the JSON string into a PHP associative array
$user = json_decode($input, true);

// Pull each field out of the decoded array
$name = $user["name"];      // User's name
$age = $user["age"];        // User's age
$address = $user["address"]; // User's address

// Build an INSERT statement - WARNING: unsafe string interpolation (SQL injection risk)
$queryStr = "INSERT INTO users (name, age, address) VALUES ('$name', '$age', '$address')";
// Execute the insert; $result is TRUE on success, FALSE on failure
$result = $conn->query($queryStr);

// Default response: assume failure until proven otherwise
$response = [
    "success" => false,
    "message" => ""
];
// If the insert succeeded, update the response
if ($result === TRUE) {
    $response["success"] = true;
    $response["message"] = "User added!";
} else {
    // Otherwise report the error back to the client
    $response["message"] = "Error adding user";
}

// Output the response array as JSON
echo json_encode($response);