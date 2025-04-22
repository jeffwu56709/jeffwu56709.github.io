<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="products.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body style="background-color:darkslategrey;">
  <div id="wrapper">
      <div class="menu">
        <img src="Assets/jefflogo.png" alt="Logo" class="logo">
        <a class ="qsm">Quick Stop Mart</a>    
        <a href="index.html" class ="link"><img src="Assets/home.png" alt="Home" width="50px" height="50px"></a>
        <a href="categories.html" class ="link"><img src="Assets/category.png" alt="Categories" width="50px" height="50px"></a>
        <form>
            <input type="text" placeholder="Search Products.." class="searchbar" id="search" name="search">
            <button type="submit" style="font-size:14px" class ="button"><img src="Assets/search.png" alt="Search" width="25px" height="25px"></button>
        </form>
        <a href="contact.html" class ="link"><img src="Assets/contact.png" alt="Contact Us" width="50px" height="50px"></a>
        <a href="login.html" class ="link"><img src="Assets/login.png" alt="Log In" width="50px" height="50px"></a>
      </div>
    </div><br><br>
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
      $sql = "SELECT * FROM product";
      $result = $conn->query($sql);
      echo "<div class='grid-row'>";
      while ($row = $result->fetch_assoc()) {
        echo "<div class='grid-item'>";
        echo "<img src='Assets/Placeholders/pc_fruits.jpg' alt='Category1'>";
        echo "<div class='grid-category1-name'>{$row['product_name']}</div>";
        echo "<div class='grid-category1-price'>$" . number_format($row['selling_price'], 2) . "</div>";
        echo "</div>";
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
