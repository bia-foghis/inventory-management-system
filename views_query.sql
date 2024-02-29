USE Inventory;
CREATE VIEW order_summary AS SELECT OrderID, COUNT(ProductID) AS TotalProducts, SUM(Quantity) AS TotalQuantity
FROM orders GROUP BY OrderNumber;

CREATE VIEW orders_by_employee AS SELECT *
FROM orders ORDER BY EmployeeID, OrderNumber;

CREATE VIEW product_prices AS SELECT ProductID, ProductName, Price
FROM products;

CREATE VIEW low_stock_products AS SELECT *
FROM products WHERE QuantityInStock < 50;