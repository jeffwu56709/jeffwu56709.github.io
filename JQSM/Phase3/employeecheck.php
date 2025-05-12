<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['account_type'], ['admin', 'employee'])) {
  header("Location: login.php?error=unauthorized");
  exit;
}
?>