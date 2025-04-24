<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="indivproduct.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
    <body style="background-color:darkslategrey;"><br><br>
        <?php
        if (isset($_GET['id'])) {
            $product_id = intval($_GET['id']);

            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($product = $result->fetch_assoc()) {
                echo "<div class='product-container'>";
                echo "<div class='product-image'><img src='/JQSM/Assets/{$product['image']}' alt='{$product['product_name']}'></div>";
                echo "<div class='product-info'><p>{$product['product_name']}</p><br>";
                echo "<p>Price: \${$product['selling_price']}</p>";
                echo "<p>Stock: {$product['stock_quantity']}</p>";
                if ($product['stock_quantity'] > 0){
                    echo "<p>AVAILABLE</p>";
                }
                else{
                    echo "<p>OUT OF STOCK</p>";
                } 
                echo "<p>Category: {$product['category_name']}</p>";
                echo "<form>";
                    echo "<input type='text' placeholder='Search Products..'' class='searchbar' id='search' name='search'>";
                    echo "<button type='submit' style='font-size:14px' class ='button'><img src='Assets/search.png' alt='Search' width='25px' height='25px'></button>";
                echo "</form></div>";
                echo "<div class='product-desc'><p>{$product['description']}</p></div>";
                echo "</div>"; 

            } else {
                echo "Product not found.";
            }

            $stmt->close();
        } else {
            echo "No product ID provided.";
        }
        ?>
    </body>
</html>
