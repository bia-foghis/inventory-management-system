USE Inventory;
SELECT ProductID, ProductName, QuantityInStock, Price, SupplierID FROM products ORDER BY QuantityInStock DESC;

SELECT customers.CustomerID, customers.CompanyName, orders.OrderNumber FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID GROUP BY customers.CustomerID;

SELECT customers.CustomerID, customers.CompanyName, orders.OrderNumber FROM customers
LEFT JOIN orders ON customers.CustomerID = orders.CustomerID WHERE orders.CustomerID IS NULL;

SELECT orders.OrderNumber, products.ProductID, products.ProductName, products.Price, orders.Quantity, orders.CustomerID
FROM orders INNER JOIN products ON orders.ProductId = products.ProductID WHERE orders.OrderNumber = '1';

UPDATE products SET ProductName = 'APPLE iPhone 14 PRO', QuantityInStock = '27', Price = '5700', SupplierID = '1' WHERE ProductID = '1';

INSERT INTO products (ProductName, QuantityInStock, Price, SupplierID) VALUES ('Philips Prestige', '33', '350', '6');

DELETE FROM products WHERE ProductID = '8';