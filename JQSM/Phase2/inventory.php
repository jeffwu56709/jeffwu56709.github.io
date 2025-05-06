<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="inventory.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
  <br><br>
  <div class ="heading">INVENTORY</div><br>
  <div class ="sortselect">
     <select name="sorter" id="sorter">
     <option hidden value="sort">Sort</option>
     <option value="a-z">A-Z</option>
     <option value="z-a">Z-A</option>
    <option value="new">New</option>
  </select>
  </div>
  <br>
    <?php if (isset($_GET['updated'])): ?>
      <div class="alert success">
        Product updated successfully!
      </div>
    <?php endif; ?>
    <?php
      $sql = "SELECT * FROM products";
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()):
      ?>
        <div class="product-row">
          <div class="product-image">
            <a href="product.php?id=<?= ($row['product_id']) ?>">
               <img src="/JQSM/Assets/productassets/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
            </a>
          </div>
          <div class="product-info">
            <div><strong>Name:</strong> <?= htmlspecialchars($row['product_name']) ?></div>
            <div><strong>Category:</strong> <?= htmlspecialchars($row['category_name']) ?></div>
            <div><strong>ID:</strong> <?= $row['product_id'] ?></div>
            <div><strong>Created:</strong> <?= $row['created_at'] ?></div>
            <div><strong>Updated:</strong> <?= $row['updated_at'] ?></div>
            <div><strong>Stock:</strong> <?= $row['stock_quantity'] ?></div>
            <div><strong>Buy Price:</strong> $<?= number_format($row['buying_price'], 2) ?></div>
            <div><strong>Sell Price:</strong> $<?= number_format($row['selling_price'], 2) ?></div>
            <a class="button" href="product_edit.php?id=<?= $row['product_id'] ?>">Edit</a>
          </div>
        </div>
      <?php endwhile; ?>
  <br><br>
  <div class="pagination">
      <a href="#">&laquo;</a>
      <a class="active" href="#">1</a>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">4</a>
      <a href="#">5</a>
      <a href="#">6</a>
      <a href="#">&raquo;</a>
  </div>
  <br><br><br>
  </body>
</html>