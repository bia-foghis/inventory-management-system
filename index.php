<?php

require 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the username and password from the form
  $username = $_POST["username"];
  $password = $_POST["password"];

  session_start();
  $_SESSION["username"] = $username;

  // Prepare and execute the SQL query
  $query = "SELECT * FROM employees WHERE Username = '$username' AND Password = '$password'";
  $result = $conn->query($query);

  // Check if the query returned any rows
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION["employeeId"] = $row["EmployeeID"];
    // Redirect to the main HTML page
    header("Location: home.html");
    exit();
  } else {
    // Invalid login, display an error message
    echo '<p class="error-message">Invalid username or password</p>';
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Inventory Management System</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header">
        <h2>Inventory Management <br> System</h2>
      </div>
      <div class="login">
        <form method="post">
          <div class="input-container">
            <label for="username">Username</label>
            <input placeholder="username" name="username" type="text">
          </div>
          <div class="input-container">
            <label for="password">Password</label>
            <input placeholder="password" name="password" type="password">
          </div>
          <button type="submit">Login</button>
        </form>
      </div>
    </div>
  </body>
</html>