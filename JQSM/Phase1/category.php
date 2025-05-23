<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="categories.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <br><br>
    <?php
      $category_id = intval($_GET['id']);

      $stmt = $conn->prepare("SELECT * FROM categories WHERE category_id = ?");
      $stmt->bind_param("i", $category_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
          echo "<div class='heading'>{$row['category_name']}</div><br>";
          echo "{$row['description']}<br><br>";
      } else {
          echo "<div class='heading'>Category not found</div><br>";
      }

      $stmt->close();
  ?>
  </div>
  <br>
  <?php
    if (isset($_GET['id'])) {
      $category_id = intval($_GET['id']);

      $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
      $stmt->bind_param("i", $category_id);
      $stmt->execute();
      $result = $stmt->get_result();

      echo "<div class='grid-row'>";
      while ($row = $result->fetch_assoc()) {
          echo "<div class='grid-item'>";
          echo "<a href='product.php?id={$row['product_id']}'>";
          echo "<img src='/JQSM/Assets/productassets/{$row['image']}' alt='{$row['product_name']}'>";
          echo "<div>{$row['product_name']}<br>\${$row['selling_price']}</div>";
          echo "</a>";
          echo "</div>";
      }
      echo "</div>";

      $stmt->close();
    } else {
        echo "No category selected.";
    }
  ?>
  <br><br>
  <a href="categories.php">
    <div class="button">Return to Categories</div>
  </a>
  <br><br><br>
  </body>
</html>
