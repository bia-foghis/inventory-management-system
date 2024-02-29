<?php

require 'connect.php';

if (isset($_POST['option'])) {

  $option = $_POST['option'];
  if ($option === 'with_orders') {
    $query = "SELECT customers.CustomerID, customers.CompanyName, orders.OrderNumber FROM customers
              JOIN orders ON customers.CustomerID = orders.CustomerID GROUP BY customers.CustomerID";
  } elseif ($option === 'without_orders') {
    $query = "SELECT customers.CustomerID, customers.CompanyName, orders.OrderNumber FROM customers
              LEFT JOIN orders ON customers.CustomerID = orders.CustomerID WHERE orders.CustomerID IS NULL";
  } else {
    $error = "No customers found";
  }
}

$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
  $customers = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Customers - Inventory Management System</title>
  <link rel="stylesheet" href="css/link.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
  <form method="post">
    <div class="form-container">
    <label>
      <input type="radio" name="option" value="with_orders" <?php if (isset($_POST['option']) && $_POST['option'] === 'with_orders') echo 'checked'; ?>>
      Show customers with orders
    </label>
    <label>
      <input type="radio" name="option" value="without_orders" <?php if (isset($_GET['option']) && $_GET['option'] === 'without_orders') echo 'checked'; ?>>
      Show customers without orders
    </label>
    
    <button type="submit">Submit</button>
    </div>
  </form>
    <?php if (isset($customers)): ?>
      <table>
        <tr>
          <th>Customer ID</th>
          <th>Company Name</th>
          <th>Order Number</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
        <tr>
          <td><?php echo $customer['CustomerID']; ?></td>
          <td><?php echo $customer['CompanyName']; ?></td>
          <td>
            <?php
              if ($customer['OrderNumber']) {
                echo $customer['OrderNumber'];
              } else {
                echo "No order";
              }
            ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
