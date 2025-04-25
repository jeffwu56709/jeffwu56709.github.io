<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="products.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body style="background-color:darkslategrey;">
  <br><br>
  <div class ="firstline">PRODUCTS</div><br>
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
      $sql = "SELECT * FROM products";
      $result = $conn->query($sql);
      echo "<div class='grid-row'>";
      while ($row = $result->fetch_assoc()) {
        echo "<a href='product.php?id={$row['product_id']}'>";
          echo "<div class='grid-item'>";
          echo "<img src='/JQSM/Assets/productassets/" . $row['image'] . "' alt='" . $row['product_name'] . "'>";
          echo "<div>{$row['product_name']}<br>";
          echo "\${$row['selling_price']}</div>";
          echo "</div>";
        echo "</a>";
      }
      echo "</div>";
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
