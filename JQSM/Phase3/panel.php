<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'employeecheck.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="panel.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<body>
<br><br>
  <div class ="heading">PANEL</div>
  <div class="homepage">
  <?php if (isset($_GET['login']) && $_GET['login'] == 'success'): ?>
    <div class="alert success">Login successful. Welcome back!</div>
  <?php endif; ?>

  <?php if (isset($_SESSION['user_id']) && $_SESSION['account_type'] === 'admin'): ?>
    <hr class="divider">
    <section class="section">
      <h2>Admin Actions</h2>
      <div class="panelgrid">
        <div class="card">
          <a href="createuser.php" class="button">Create User</a>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <hr class="divider">

  <section class="section">
    <h2>Employee Actions</h2>
    <div class="panelgrid">
      <div class="card">
        <a href="inventory.php" class="button">View Inventory</a>
        <a href="orderhistory.php" class="button">View Orders</a>
      </div>
    </div>
  </section>
</div>
  <br><br><br>
</body>
</html>
