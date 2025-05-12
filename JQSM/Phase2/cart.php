<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'customercheck.php'; ?>

<?php
$cart = $_SESSION['cart'] ?? [];

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="cart.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body><br><br>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
      <div class="alert error">Your cart is empty. Please add items before confirming an order.</div>
    <?php endif; ?>
    <div class="cart-wrapper">
      <div class="heading">Shopping Cart</div><br>
      <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
      <?php else: ?>
        <div class="cart-container">
          <table class='cart-table'>
            <tr>
              <th></th><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th>
            </tr>

            <?php 
            $total = 0;
            $item_count = 0;

            foreach ($_SESSION['cart'] as $id => $item):
              $subtotal = $item['price'] * $item['quantity'];
              $total += $subtotal;
              $item_count += $item['quantity'];
            ?>
            <tr>
              <td>
                <a href="product.php?id=<?= $id ?>">
                  <img src="/JQSM/Assets/productassets/<?= htmlspecialchars($item['image']) ?>" 
                       alt="<?= htmlspecialchars($item['name']) ?>" 
                       width="60" height="60" 
                       style="object-fit: cover; margin-right: 10px;">
                </a>
              </td>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td>$<?= $item['price'] ?></td>
              <td><?= $item['quantity'] ?></td>
              <td>$<?= number_format($subtotal, 2) ?></td>
              <td>
                <form action="remove_from_cart.php" method="POST" style="display:inline;">
                  <input type="hidden" name="product_id" value="<?= $id ?>">
                  <button type="submit" class="button">Remove</button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="4"><strong>Total Items: <?= $item_count ?></strong></td>
              <td><strong>$<?= number_format($total, 2) ?></strong></td>
            </tr>
           </table>
        </div>
      <?php endif; ?>
      <div class="cartbuttons">
        <form action="clear_cart.php" method="post">
          <button class="button">Reset Cart</button>
        </form>

        <a href="orderconfirm.php">
          <button class="button">Continue to Order Confirmation</button>
        </a>
      </div>
    </div>
  </body>
</html>
