<?php
    session_start();
    include 'connect.php';
    if (!isset($_SESSION['user_id'])) {
      header("Location: login.php?login=required");
      exit;
    }
    $product_id = $_POST['product_id'];
    $requested_qty = intval($_POST['quantity']);

    $stmt = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $available_stock = $product['stock_quantity'];

    $existing_qty = isset($_SESSION['cart'][$product_id]) ? $_SESSION['cart'][$product_id]['quantity'] : 0;
    $new_total_qty = $existing_qty + $requested_qty;

    if ($new_total_qty > $available_stock) {
    header("Location: product.php?id=$product_id&error=overstock");
    exit;
}

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
