<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <br><br>
  <div class ="heading">EDIT PRODUCT</div><br>
  </div>
  <br>
  <?php
    $product_id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
  ?>
  <h2>Edit Product: <?= htmlspecialchars($product['product_name']) ?></h2>
  <div class= "editform">
    <form action="product_update.php" method="POST">
      <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

      <label>Name:
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
      </label><br>

      <label>Stock Quantity:
        <input type="number" name="stock_quantity" value="<?= $product['stock_quantity'] ?>">
      </label><br>

      <label>Buying Price:
        <input type="text" name="buying_price" value="<?= $product['buying_price'] ?>">
      </label><br>

      <label>Selling Price:
        <input type="text" name="selling_price" value="<?= $product['selling_price'] ?>">
      </label><br>

      <button class="button" type="submit">Save Changes</button>
    </form>
  </div>
  <br><br><br>
  </body>
</html>
