<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header("Location: login.php?login=required");
      exit;
    }
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => $quantity,
        'image' => $product_image
    ];
    }

    header("Location: products.php?added=1");
    exit;
?>
