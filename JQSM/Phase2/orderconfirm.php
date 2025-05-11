<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
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
    <link rel="stylesheet" href="orderconfirm.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body><br><br>
    <div class="cart-wrapper">
      <div class="heading">Order Confirmation</div><br>

      <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
      <?php else: ?>
        <div>
            <?php 
            $total = 0;
            $item_count = 0;
            $collectionfee = 0;

            foreach ($_SESSION['cart'] as $id => $item):
              $subtotal = $item['price'] * $item['quantity'];
              $total += $subtotal;
              $tax_rate = 0.08875;
              $item_count += $item['quantity'];
              $collectionfee += 0.05 + $item['quantity'] * 0.05;
            ?>
            <?php endforeach; ?>
            <div class="summary-row">
              <div><strong>Total Items: <?= $item_count ?></strong></div>
              <div><strong>$<?= number_format($total, 2) ?></strong></div>
            </div>
            <?php
              $tax = $total * $tax_rate;
              $grand_total = $total + $tax + $collectionfee;
            ?>
            <div class="summary-row">
              <div>Item Collection Fee:</div>
              <div>$<?= number_format($collectionfee, 2) ?></div>
            </div>
            <div class="summary-row">
              <div>Tax (8.875%):</div>
              <div>$<?= number_format($tax, 2) ?></div>
            </div>
            <div class="summary-row">
              <div><strong>Grand Total:</strong></div>
              <div><strong>$<?= number_format($grand_total, 2) ?></strong></div>
            </div>
        </div>
      <?php endif; ?>
      <div class="cartbuttons">
        <form action="cart.php" method="post">
          <button class="button">Back to Cart</button>
        </form>

        <a href="#">
          <button class="button">Confirm Order</button>
        </a>
      </div>
    </div>
  </body>
</html>