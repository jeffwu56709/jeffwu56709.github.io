<?php
session_start();
include 'connect.php';
include 'navbar.php';
include 'customercheck.php';

if (!isset($_GET['order_id']) || !isset($_SESSION['user_id'])) {
  echo "Invalid access.";
  exit;
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];
$account_type = $_SESSION['account_type'];

if ($account_type === 'admin' || $account_type === 'employee') {
  $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
  $stmt->bind_param("i", $order_id);
} else {
  $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
  $stmt->bind_param("ii", $order_id, $user_id);
}
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();
$stmt->close();

if (!$order) {
  echo "Order not found.";
  exit;
}

$item_stmt = $conn->prepare("
  SELECT oi.quantity, oi.price, p.product_name
  FROM order_items oi
  JOIN products p ON oi.product_id = p.product_id
  WHERE oi.order_id = ?
");
$item_stmt->bind_param("i", $order_id);
$item_stmt->execute();
$items = $item_stmt->get_result();
$item_stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Receipt</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="receipt.css">
</head>
<body>
  <div class="receipt">
    <?php if (isset($_GET['status']) && $_GET['status'] === 'updated'): ?>
      <div class="alert success">Order status updated successfully.</div>
    <?php endif; ?>
    <div class="heading">Order Receipt</div>
    <p><strong>Order ID:</strong> <?= $order['order_id'] ?></p>
    <p><strong>Date:</strong> <?= $order['order_date'] ?></p>
    <p><strong>Status:</strong> <?= $order['status'] ?></p>
    <table>
      <tr>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
      </tr>
      <?php while ($row = $items->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['product_name']) ?></td>
          <td><?= $row['quantity'] ?></td>
          <td>$<?= number_format($row['price'], 2) ?></td>
          <td>$<?= number_format($row['price'] * $row['quantity'], 2) ?></td>
        </tr>
      <?php endwhile; ?>
      <tr>
        <td colspan="3">Item Collection Fee:</td>
        <td>$<?= number_format($order['collection_fee'], 2) ?></td>
      </tr>
      <tr>
        <td colspan="3">Tax (8.875%):</td>
        <td>$<?= number_format($order['tax'], 2) ?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>Grand Total:</strong></td>
        <td><strong>$<?= number_format($order['total_amount'], 2) ?></strong></td>
      </tr>
    </table>
    <?php if (in_array($_SESSION['account_type'], ['admin', 'employee'])): ?>
      <form action="orderstatusupdate.php" method="POST" style="margin-top: 1em;">
        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
        
        <strong><label for="status">Update Status:</label></strong>
        <select name="status" id="status">
          <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
          <option value="In Progress" <?= $order['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="Ready" <?= $order['status'] === 'Ready' ? 'selected' : '' ?>>Ready</option>
          <option value="Complete" <?= $order['status'] === 'Complete' ? 'selected' : '' ?>>Complete</option>
          <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select>
        
        <br><br><button type="submit" class="button">Save Changes</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>