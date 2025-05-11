<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<?php
$product = null;
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="indivproduct.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <br><br>
  <?php if ($product): ?>
    <div class="product-page">
      <?php if (isset($_GET['error']) && $_GET['error'] == 'overstock'): ?>
        <div class="alert error">You can't add more than the available stock.</div>
      <?php endif; ?>
      <div class="product-top">
        <div class="product-image">
          <img src="/JQSM/Assets/productassets/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
        </div>
        <div class="product-details">
          <h1><?= htmlspecialchars($product['product_name']) ?></h1>
          <div class="product-info">
            <div><strong>Category:</strong> <?= htmlspecialchars($product['category_name']) ?></div>
            <div><strong>Price:</strong> $<?= number_format($product['selling_price'], 2) ?></div>
            <div><strong>Stock:</strong> <?= $product['stock_quantity'] ?></div>
          </div>
          <div class="cart-controls">
            <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
              <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
              <input type="hidden" name="product_price" value="<?= $product['selling_price'] ?>">
              <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']) ?>">
              <label>Quantity:
                <input type="number" name="quantity" value="1" min="1" max= <?= $product['stock_quantity'] ?>>
              </label>
              <button class="button" type="submit">Add to Cart</button>
            </form>
          </div>
        </div>
      </div>
      <div class="product-description">
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      </div>
    </div>
  <?php elseif (isset($_GET['id'])): ?>
    <p>Product not found.</p>
  <?php else: ?>
    <p>No product ID provided.</p>
  <?php endif; ?>
</body>
</html>
