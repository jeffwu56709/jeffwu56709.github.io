<?php include 'connect.php'; ?>
<?php include 'navbar.html'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
<br><br>
  <section class="section">Welcome to</section>
  <div class ="heading">JEFF'S QUICK STOP MART</div>
  <div class="homepage">

  <section class="section">
    <a href="login.php" class="button">Log In / Sign Up</a>
  </section>

  <hr class="divider">

  <section class="section">
    <h2>Featured Categories</h2>
    <div class="grid">
      <div class="card"><a href="category.php?id=4"><img src="Assets/categoryassets/produce.png" alt="Produce"><br>Produce</a></div>
      <div class="card"><a href="category.php?id=2"><img src="Assets/categoryassets/meat.png" alt="Meat"><br>Meat</a></div>
      <div class="card"><a href="category.php?id=3"><img src="Assets/categoryassets/seafood.png" alt="Seafood"><br>Seafood</a></div>
      <div class="card"><a href="category.php?id=11"><img src="Assets/categoryassets/beverages.png" alt="Beverages"><br>Beverages</a></div>
      <div class="card"><a href="category.php?id=1"><img src="Assets/categoryassets/dairy.png" alt="Dairy"><br>Dairy</a></div>
      <div class="card"><a href="category.php?id=6"><img src="Assets/categoryassets/bakery.png" alt="Bakery"><br>Bakery</a></div>
    </div>
    <a href="categories.php" class="button">View All Categories</a>
  </section>

  <hr class="divider">

  <section class="section">
    <h2>Featured Products</h2>
    <div class="grid">
      <div class="card"><a href="product.php?id=017"><img src="Assets/productassets/lettuce.png" alt="Lettuce"><br>Lettuce</a></div>
      <div class="card"><a href="product.php?id=009"><img src="Assets/productassets/porkchops.png" alt="Pork Chops"><br>Pork Chops</a></div>
      <div class="card"><a href="product.php?id=012"><img src="Assets/productassets/shrimp.png" alt="Shrimp"><br>Shrimp</a></div>
      <div class="card"><a href="product.php?id=042"><img src="Assets/productassets/cola2l.png" alt="Cola (2L)"><br>Cola (2L)</a></div>
      <div class="card"><a href="product.php?id=001"><img src="Assets/productassets/wholemilk.png" alt="Whole Milk"><br>Whole Milk</a></div>
      <div class="card"><a href="product.php?id=025"><img src="Assets/productassets/breadloaf.png" alt="Bread Loaf"><br>Bread Loaf</a></div>
    </div>
    <a href="products.php" class="button">View All Products</a>
  </section>
</div>
  <br><br><br>
</body>
</html>
