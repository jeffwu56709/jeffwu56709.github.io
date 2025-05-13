<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'customercheck.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="inventory.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <br><br>
  <div class ="heading">ORDER HISTORY</div><br>
  </div>
  <br>
    <?php
      $account_type = $_SESSION['account_type'];
      $user_id = $_SESSION['user_id'];

      if ($account_type === 'customer') {
        $sql = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
      } else {
        $sql = "SELECT * FROM orders ORDER BY order_date DESC";
      }
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()):
      ?>
        <div class="product-row">
          <div class="product-info">
            <div><strong>Order Date:</strong> <?= $row['order_date'] ?></div>
            <div><strong>Order ID:</strong> <?= $row['order_id'] ?></div>
            <div><strong>User ID:</strong> <?= $row['user_id'] ?></div>
            <div><strong>Total:</strong> $<?= $row['total_amount'] ?></div>
            <div><strong>Status:</strong> <?= $row['status'] ?></div>
            <a class="button" href="receipt.php?order_id=<?= $row['order_id'] ?>">See More</a>
          </div>
        </div>
      <?php endwhile; ?>
  <br><br><br>
  </body>
</html>