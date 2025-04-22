<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Database</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Product Database</h1>
    <table>
        <?php
        $result = $conn->query("SELECT * FROM product");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['product_id']}</td><td>{$row['product_name']}</td><td>{$row['description']}</td><td>{$row['buying_price']}</td><td>{$row['selling_price']}</td>
                          <td>{$row['stock_quantity']}</td><td>{$row['category_id']}</td><td>{$row['created_at']}</td><td>{$row['updated_at']}</td><td>{$row['image']}</td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
