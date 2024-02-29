<?php

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: index.php");
  exit();
}

require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_SESSION["username"];
  $password=$_POST["password"];

  $query= "UPDATE employees SET Password = '$password' WHERE Username = '$username'";
  $result = $conn->query($query);

  if ($result) {
    echo '<p class="message">Password updated successfully</p>';
  } else {
    echo '<p class="message">Error updating password</p>';
  }
}

// Close the database connection
$conn->close();

?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account - Inventory Management System</title>
    <link rel="stylesheet" href="css/link.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <h2>Change password:</h2>
    <form method="post">
      <div class="form-container">
        <label for="password">Enter new password:</label>
        <input placeholder="password" type="password" name="password" required>
        <br>

        <input type="submit" value="Save">
    </div>
    </form>
    </div>
  </body>
</html>