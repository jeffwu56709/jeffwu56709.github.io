<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="navbar.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Google Sans">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style=background-color:#fffbf4>
        <div id="wrapper">
          <div class="menu">
            <a href="index.php"><img src="Assets/navbarassets/jefflogo.png" alt="Logo" class="logo"></a>
            <a href="index.php" class ="qsm">Quick Stop Mart</a>
            <a href="categories.php" class ="link">Categories</a>
            <a href="products.php" class ="link">Products</a>
            <form action="search.php" method="get">
                <input type="text" placeholder="Search Products.." class="searchbar" id="search" name="search">
                <button type="submit" style="font-size:14px" class="searchbutton">
                <img src="Assets/navbarassets/search.png" alt="Search" width="25px" height="25px">
                </button>
            </form>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="cart.php" class ="link">Cart</a>
                <a href="logout.php" class ="link">Log Out</a>
              <?php else: ?>
                <a href="login.php" class ="link">Log In</a>
                <a href="signup.php" class ="link">Sign Up</a>
              <?php endif; ?>
          </div>
        </div>
    </body>
</html>
