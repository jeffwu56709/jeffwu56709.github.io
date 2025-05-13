<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['account_type'], ['admin', 'employee'])) {
  header("Location: index.php?error=unauthorized");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'], $_POST['status'])) {
  $order_id = intval($_POST['order_id']);
  $status = $_POST['status'];

  $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
  $stmt->bind_param("si", $status, $order_id);

  if ($stmt->execute()) {
    if ($status === 'Complete') {
      $get_items = $conn->prepare("SELECT product_id, quantity FROM order_items WHERE order_id = ?");
      $get_items->bind_param("i", $order_id);
      $get_items->execute();
      $result = $get_items->get_result();

      while ($row = $result->fetch_assoc()) {
        $update_stock = $conn->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?");
        $update_stock->bind_param("ii", $row['quantity'], $row['product_id']);
        $update_stock->execute();
        $update_stock->close();
      }

      $get_items->close();
    }

    header("Location: receipt.php?order_id=$order_id&status=updated");
  } else {
    echo "Failed to update status.";
  }

  $stmt->close();
}