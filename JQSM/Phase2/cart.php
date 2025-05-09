<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

$total = 0;
?>
<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="cart.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body><br><br>
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
              $tax_rate = 0.08875;
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
            </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="3"><strong>Total Items: <?= $item_count ?></strong></td>
              <td><strong>$<?= number_format($total, 2) ?></strong></td>
            </tr>
            <?php
              $tax = $total * $tax_rate;
              $grand_total = $total + $tax;
            ?>
            <tr>
              <td colspan="3">Tax (8.875%):</td>
              <td>$<?= number_format($tax, 2) ?></td>
            </tr>
            <tr>
              <td colspan="3"><strong>Grand Total:</strong></td>
              <td><strong>$<?= number_format($grand_total, 2) ?></strong></td>
            </tr>
           </table>
        </div>
      <?php endif; ?>
      <div class="cartbuttons">
        <form action="clear_cart.php" method="post">
          <button class="button">Reset Cart</button>
        </form>

        <a href="#">
          <button class="button">Continue to Payment</button>
        </a>
      </div>
    </div>
  </body>
</html>
