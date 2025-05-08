<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
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
  <div class ="heading">CATEGORIES</div><br>
  </div>
  <br>
  <?php
      $sql = "SELECT * FROM categories";
      $result = $conn->query($sql);
      echo "<div class='grid-row'>";
      while ($row = $result->fetch_assoc()) {
        echo "<a href='category.php?id={$row['category_id']}'>";
          echo "<div class='grid-item'>";
          echo "<img src='/JQSM/Assets/categoryassets/" . $row['image'] . "' alt='" . $row['category_name'] . "'>";
          echo "<h3>{$row['category_name']}</h3>";
          echo "</div>";
        echo "</a>";
      }
      echo "</div>";
    ?>
  <br><br>
  <a href="products.php">
    <div class="button">View All Products</div>
  </a>
  <br><br><br>
  </body>
</html>
