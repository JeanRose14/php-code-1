<?php
// Start PHP mode
header("Content-Type: application/json"); // Tell the browser/client the response is JSON
require("../db.php"); // Load the DB class (note: file is actually at db/DB.PHP)

// Create a DB object and open a connection to MySQL
$db = new DB();
$conn = $db->createConnection();

// SQL: select every row from the "users" table
$queryStr = "SELECT * FROM users";
// Run the query and store the result set
$result = $conn->query($queryStr);

// fetch_all(1) = fetch all rows as associative arrays (MYSQLI_ASSOC)
// json_encode converts them to JSON, print_r outputs the JSON string
print_r(json_encode($result->fetch_all(1)));