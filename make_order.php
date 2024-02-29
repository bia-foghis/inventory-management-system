<?php

require 'connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $orderNr=$_POST["orderNr"];
  $productId=$_POST["productId"];
  $quantity=$_POST["quantity"];
  $employeeId = $_SESSION["employeeId"];

  $query= "INSERT INTO orders (OrderNumber, EmployeeID, ProductId, Quantity)
         VALUES ('$orderNr', '$employeeId', '$productId', '$quantity')";
  $result = $conn->query($query);
  
  if($result){
    $_SESSION['message'] = '<p class="message">Order added successfully</p>';
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
  }else
  {
    $_SESSION['message'] = '<p class="message">Error adding order</p>';
  }
  
}

$message = ""; // Initialize the message variable
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  unset($_SESSION['message']); // Remove the message from the session
}

?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Orders - Inventory Management System</title>
    <link rel="stylesheet" href="css/link.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php echo $message; ?> <!-- Display the message here -->
    <div class="container">
    <h2>Make order:</h2>
    <form method="post">
      <div class="form-container">
        <label for="orderNr">Order number:</label>
        <input type="text" name="orderNr" required>
        <br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" required>
        <br>

        <label for="productId">Product Id:</label>
        <select name="productId" required>
          <option value="">Select Id</option>
          <?php
            $query = "SELECT ProductID FROM products";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["ProductID"] . '">' . $row["ProductID"] . '</option>';
            }
          ?>
        </select>
        <br>

        <input type="submit" value="Save order">
    </div>
    </form>
    </div>
  </body>
</html>