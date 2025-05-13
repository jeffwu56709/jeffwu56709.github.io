<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
  header("Location: cart.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$cart = $_SESSION['cart'];
$tax_rate = 0.08875;
$collectionfee = 0;
$total = 0;

foreach ($cart as $item) {
  $total += $item['price'] * $item['quantity'];
  $collectionfee += $item['quantity'] * 0.1;
}

$tax = $total * $tax_rate;
$grand_total = $total + $tax + $collectionfee;

$stmt = $conn->prepare("
  INSERT INTO orders (user_id, order_date, total_amount, tax, collection_fee)
  VALUES (?, NOW(), ?, ?, ?)
");
$stmt->bind_param("iddd", $user_id, $grand_total, $tax, $collectionfee);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

$item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

foreach ($cart as $product_id => $item) {
  $quantity = $item['quantity'];
  $price = $item['price'];

  $item_stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
  $item_stmt->execute();
}

$item_stmt->close();
unset($_SESSION['cart']);
header("Location: receipt.php?order_id=" . $order_id);
exit;
?>