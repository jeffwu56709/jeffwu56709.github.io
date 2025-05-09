<?php
include 'connect.php';
include 'navbar.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $username;
    header("Location: index.php?login=success");
    exit;
  } else {
    echo "Invalid login.";
  }
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <br><br>
    <div class ="heading">LOG IN</div><br>
    <br>
    <?php if (isset($_GET['signup']) && $_GET['signup'] == 'success'): ?>
      <div class="alert success">Signup successful! Please log in.</div>
    <?php endif; ?>
    <div class ="form">
      <form action="login.php" method="POST">
        <label>Username:
          <input type="text" name="username" required>
        </label>
        <label>Password:
          <input type="password" name="password" required>
        </label>
        <button type="submit" class="button">Log In</button>
        <a href="signup.php" class="button">Sign Up</a>
      </form>
    </div>
  </body>
</html>
