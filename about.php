<?php

session_start();

// Get the logged-in username from the session
if (!isset($_SESSION["username"])) {
  // Redirect to the login page if the user is not logged in
  header("Location: index.php");
  exit();
}

// Retrieve employee data based on the logged-in username
require 'connect.php';

$username = $_SESSION["username"];

$query = "SELECT EmployeeID, First_Name, Last_Name, Username, Password FROM employees WHERE Username = '$username'";
$result = $conn->query($query);

// Check if a matching employee record was found
if ($result->num_rows > 0) {
  // Fetch the employee data
  $employee = $result->fetch_assoc();
} else {
  // If no matching employee record found, display an error or handle it as desired
  $error = "Employee data not found";
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Account - Inventory Management System</title>
    <link rel="stylesheet" href="css/data.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="data-container">
      <?php if (isset($employee)): ?>
      <div class="employee-details">
        <h3>Employee Information</h3>
        <p><strong>Employee ID:</strong> <?php echo $employee['EmployeeID']; ?></p>
        <p><strong>First Name:</strong> <?php echo $employee['First_Name']; ?></p>
        <p><strong>Last Name:</strong> <?php echo $employee['Last_Name']; ?></p>
        <p><strong>Username:</strong> <?php echo $employee['Username']; ?></p>
        <p><strong>Password:</strong> <?php echo $employee['Password']; ?></p>
      </div>
    </div>
    <?php else: ?>
      <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
  </body>
</html>
