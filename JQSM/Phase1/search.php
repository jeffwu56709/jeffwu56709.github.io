<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="products.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
      <body><br><br>
        <?php
        $products = [];

        if (isset($_GET['search'])) {
            $search_query = trim($_GET['search']);

            $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE CONCAT('%', ?, '%')");
            $stmt->bind_param("s", $search_query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row;
                }
            }
        } else {
            $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        ?>
        <div class="product-grid">
        <?php
        if (count($products) === 0) {
            echo "<p>No products found.</p>";
        } else {
            $count = $result->num_rows;
            echo "<h2>$count result" . ($count === 1 ? '' : 's') . " for \"" . htmlspecialchars($search_query) . "\"</h2>";
            echo "<div class='grid-row'>";
            foreach ($products as $product) {
                echo "<a href='product.php?id={$product['product_id']}'>";
                    echo "<div class='grid-item'>";
                    echo "<img src='/JQSM/Assets/productassets/{$product['image']}' alt='{$product['product_name']}'>";
                    echo "<h3>" . htmlspecialchars($product['product_name']) . "</h3>";
                    echo "<p>Price: $" . $product['selling_price'] . "</p>";
                    echo "</div>";
                echo "</a>";
            }
            echo "</div>";
        }
        ?>
    </body>
</html>
