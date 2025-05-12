<?php include 'connect.php'; ?>
<?php include 'navbar.php'; ?>
<?php include 'admincheck.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="form">
    <br><br>
    <div class="heading">Create New Employee Account</div><br><br>
    <form action="createuser.php" method="POST">
      <label>Username:
        <input type="text" name="username" required>
      </label>

      <label>Password:
        <input type="password" name="password" required>
      </label><br>

      <button type="submit" class="button">Create Employee</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $username = $_POST['username'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $account_type = 'employee';

      $check = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
      $check->bind_param("s", $username);
      $check->execute();
      $check_result = $check->get_result();

      if ($check_result->num_rows > 0) {
        echo "<p class='alert error'>Username already exists.</p>";
      } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, account_type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $account_type);
        if ($stmt->execute()) {
          echo "<p class='alert success'>Employee account created successfully!</p>";
        } else {
          echo "<p class='alert error'>Error creating account.</p>";
        }
        $stmt->close();
      }
      $check->close();
    }
    ?>
  </div>
</body>
</html>