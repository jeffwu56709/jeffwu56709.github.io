<?php
    include 'connect.php';

    $product_id = intval($_POST['product_id']);
    $name = $_POST['product_name'];
    $stock = intval($_POST['stock_quantity']);
    $buyprice = floatval($_POST['buying_price']);
    $sellprice = floatval($_POST['selling_price']);

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, stock_quantity = ?, buying_price = ?, selling_price = ? WHERE product_id = ?");
    $stmt->bind_param("siddi", $name, $stock, $buyprice, $sellprice, $product_id);

    if ($stmt->execute()) {
        header("Location: inventory.php?updated=1");
        exit;
    } else {
        echo "Error updating product.";
    }
?>