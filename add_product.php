<?php

require 'connect.php';

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name=$_POST["product_name"];
  $quantity=$_POST["quantity"];
  $price=$_POST["price"];
  $supplierId=$_POST["supplierId"];

  $query= "INSERT INTO products (ProductName, QuantityInStock, Price, SupplierID)
         VALUES ('$name', '$quantity', '$price', '$supplierId')";
  $result = $conn->query($query);
  
  if($result){
    $_SESSION['message'] = '<p class="message">Product added successfully</p>';
    // Redirect to the same page
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
  }else
  {
    $_SESSION['message'] = '<p class="message">Error inserting product</p>';
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
    <title>Products - Inventory Management System</title>
    <link rel="stylesheet" href="css/link.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php echo $message; ?> <!-- Display the message here -->
    <div class="container">
    <h2>Add product:</h2>
    <form method="post">
      <div class="form-container">
        <label for="product_name">Product name:</label>
        <input type="text" name="product_name" required>
        <br>

        <label for="quantity">Quantity in stock:</label>
        <input type="text" name="quantity" required>
        <br>

        <label for="price">Price:</label>
        <input type="text" name="price" required>
        <br>

        <label for="supplierId">Supplier Id:</label>
        <select name="supplierId" required>
          <option value="">Select Id</option>
          <?php
            $query = "SELECT SupplierID FROM suppliers";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["SupplierID"] . '">' . $row["SupplierID"] . '</option>';
            }
            ?>
        </select>
        <br>

        <input type="submit" value="Submit">
    </div>
    </form>
    </div>
  </body>
</html>