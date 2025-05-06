<?php
session_start();
?>
<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="indivproduct.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
    <body><br><br>
        <?php
        if (isset($_GET['id'])) {
            $product_id = intval($_GET['id']);

            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($product = $result->fetch_assoc()) {
                echo "<div class='product-page'>";
                  echo "<div class='product-top'>";
                    echo "<div class='product-image'>";
                      echo "<img src='/JQSM/Assets/productassets/{$product['image']}' alt='{$product['product_name']}'>";
                    echo "</div>";

                    echo "<div class='product-details'>";
                      echo "<h1>{$product['product_name']}</h1>";
                      echo "<div class='product-info'>";
                        echo "<div><strong>Category:</strong> {$product['category_name']}</div>";
                        echo "<div><strong>Price:</strong> \${$product['selling_price']}</div>";
                        echo "<div><strong>Stock:</strong> {$product['stock_quantity']} ";
                        //echo $product['stock_quantity'] > 0 ? "AVAILABLE" : "OUT OF STOCK"; not sure if i like this
                        echo "</div>";
                      echo "</div>";

                      echo "<div class='cart-controls'>";
                        echo "<form action='add_to_cart.php' method='POST'>";
                          echo "<input type='hidden' name='product_id' value='{$product['product_id']}'>";
                          echo "<input type='hidden' name='product_name' value=\"{$product['product_name']}\">";
                          echo "<input type='hidden' name='product_price' value=\"{$product['selling_price']}\">";
                          echo "<input type='hidden' name='product_image' value=\"{$product['image']}\">";

                          echo "<label>Quantity: ";
                            echo "<input type='number' name='quantity' value='1' min='1'>";
                          echo "</label>";
                          echo "<button class='button' type='submit'>Add to Cart</button>";
                        echo "</form>";
                      echo "</div>";
                    echo "</div>";
                  echo "</div>";

                  echo "<div class='product-description'>";
                    echo "<p>{$product['description']}</p>";
                  echo "</div>";
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
