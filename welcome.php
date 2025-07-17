<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>مرحبًا بك</title>
</head>
<body>
  <h2>مرحبًا، <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
  <p>تم تسجيل الدخول بنجاح.</p>
  <a href="logout.php">تسجيل الخروج</a>
</body>
</html>
