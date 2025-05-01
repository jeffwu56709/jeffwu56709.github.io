<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="categories.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <br><br>
  <div class ="heading">CATEGORIES</div><br>
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
