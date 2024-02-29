<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Main - Inventory Management System</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="sidebar-container">
    <div class="sidebar">
      <h3>Account</h3>
      <ul>
        <li><a class="sidebar-link" href="about.php" target="mainFrame">About</a></li>
        <li><a class="sidebar-link" href="password.php" target="mainFrame">Change password</a></li>
      </ul>
  
      <h3>Products</h3>
      <ul>
        <li><a class="sidebar-link" href="add_product.php" target="mainFrame">Add product</a></li>
        <li><a class="sidebar-link" href="delete_product.php" target="mainFrame">Delete product</a></li>
        <li><a class="sidebar-link" href="update_product.php" target="mainFrame">Update product</a></li>
        <li><a class="sidebar-link" href="view_product.php" target="mainFrame">Product details</a></li>
        <li><a class="sidebar-link" href="low_stock.php" target="mainFrame">Low on Stock</a></li>
      </ul>
  
      <h3>Orders</h3>
      <ul>
        <li><a class="sidebar-link" href="make_order.php" target="mainFrame">Make order</a></li>
        <li><a class="sidebar-link" href="order_details.php" target="mainFrame">Order details</a></li>
      </ul>

      <h3>Customers</h3>
      <ul>
        <li><a class="sidebar-link" href="view_customers.php" target="mainFrame">View customers</a></li>
      </ul>
    </div>
  </div>
</body>
</html>