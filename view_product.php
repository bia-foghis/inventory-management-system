<?php
require 'connect.php';

$query = "SELECT ProductID, ProductName, QuantityInStock, Price, SupplierID FROM products ORDER BY QuantityInStock DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
   $error = "No products found";
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Products - Inventory Management System</title>
  <link rel="stylesheet" href="css/data.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="data-container">
    <?php if (isset($products)): ?>
      <table>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Quantity in Stock</th>
          <th>Price</th>
          <th>Supplier ID</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
          <td><?php echo $product['ProductID']; ?></td>
          <td><?php echo $product['ProductName']; ?></td>
          <td><?php echo $product['QuantityInStock']; ?></td>
          <td><?php echo $product['Price']; ?></td>
          <td><?php echo $product['SupplierID']; ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
