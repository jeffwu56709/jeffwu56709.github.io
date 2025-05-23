<?php
include 'connect.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
      $check->bind_param("s", $username);
      $check->execute();
      $check_result = $check->get_result();

      if ($check_result->num_rows > 0) {
        echo "<p class='alert error'>Username already exists.</p>";
      }
      else {
          $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
          $stmt->bind_param("ss", $username, $password);

          if ($stmt->execute()) {
            header("Location: login.php?signup=success");
            exit;
          }
          else {
            echo "<p class='alert error'>Error creating account.</p>";
          }
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
    <div class ="heading">SIGN UP</div><br>
    <br>

    <div class ="form">
      <form action="signup.php" method="POST">
        <label>Username:
          <input type="text" name="username" required>
        </label>
        <label>Password:
          <input type="password" name="password" required>
        </label>
        <button type="submit" class="button">Sign Up</button>
      </form>
    </div>
  </body>
</html>
