<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="categories.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body style="background-color:darkslategrey;">
    <br><br>
    <?php
      $category_id = intval($_GET['id']);

      $stmt = $conn->prepare("SELECT * FROM categories_1 WHERE category_id = ?");
      $stmt->bind_param("i", $category_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($row = $result->fetch_assoc()) {
          echo "<div class='firstline'>{$row['category_name']}</div><br>";  // or category_name if that’s your column
      } else {
          echo "<div class='firstline'>Category not found</div><br>";
      }

      $stmt->close();
  ?>
  <div class ="sortselect">
     <select name="sorter" id="sorter">
     <option hidden value="sort">Sort</option>
     <option value="a-z">A-Z</option>
     <option value="z-a">Z-A</option>
    <option value="new">New</option>
  </select>
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
          echo "<img src='/JQSM/Assets/{$row['image']}' alt='{$row['product_name']}'>";
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
