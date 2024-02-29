<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["orderNr"])) {

  $orderNr = $_POST["orderNr"];

  $query = "SELECT orders.OrderNumber, products.ProductID, products.ProductName, products.Price, orders.Quantity, orders.CustomerID
            FROM orders
            INNER JOIN products ON orders.ProductId = products.ProductID
            WHERE orders.OrderNumber = '$orderNr'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);

    // Calculate total price using SUM and a separate query
    $totalPriceQuery = "SELECT SUM(products.Price * orders.Quantity) AS TotalPrice
                        FROM orders
                        INNER JOIN products ON orders.ProductId = products.ProductID
                        WHERE orders.OrderNumber = '$orderNr'";
    $totalPriceResult = $conn->query($totalPriceQuery);
    $totalPriceRow = $totalPriceResult->fetch_assoc();
    $totalPrice = $totalPriceRow['TotalPrice'];
  } else {
    $error = "No order with such number found";
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Orderss - Inventory Management System</title>
  <link rel="stylesheet" href="css/link.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Order details:</h2>
    <form method="post">
      <div class="form-container">
        <label for="orderNr">Order Number:</label>
        <select name="orderNr" required>
          <option value="">Select number</option>
          <?php
            $query = "SELECT OrderNumber FROM orders GROUP BY OrderNumber";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row["OrderNumber"] . '">' . $row["OrderNumber"] . '</option>';
            }
            ?>
        </select>
        <br>

        <input type="submit" value="View details">
      </div>
    </form>
    <table>
        <thead>
        <tr>
          <th>Order Number</th>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Customer ID</th>
        </tr>
        </thead>
        <tbody>
        <?php
          if (isset($orders)) {

            foreach ($orders as $order) {
              echo '<tr>';
              echo '<td>' . $order['OrderNumber'] . '</td>';
              echo '<td>' . $order['ProductID'] . '</td>';
              echo '<td>' . $order['ProductName'] . '</td>';
              echo '<td>' . $order['Price'] . '</td>';
              echo '<td>' . $order['Quantity'] . '</td>';
              echo '<td>' . $order['CustomerID'] . '</td>';
              echo '</tr>';
            }
            echo '<p>Total price of the order is: ' . $totalPrice;
          }
        ?>
      </tbody>
      </table>
  </div>
</body>
</html>
