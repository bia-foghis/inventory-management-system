<?php

$host = "localhost";  
$username = "root";  
$password = ""; 
$database = "Inventory";  

// Create a new MySQLi object
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Return the connection object
return $conn;

?>