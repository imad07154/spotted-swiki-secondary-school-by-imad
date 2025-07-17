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
  <title>نشر فكرة وصورة</title>
  <style>
    body { font-family: Arial; background-color: #f2f2f2; text-align: center; padding-top: 50px; }
    form { background: white; padding: 20px; border-radius: 10px; display: inline-block; box-shadow: 0 0 10px gray; }
    textarea, input[type="file"] { width: 300px; margin: 10px; padding: 10px; }
    button { padding: 10px 20px; }
  </style>
</head>
<body>

  <h2>مرحبًا <?php echo htmlspecialchars($_SESSION['user_name']); ?>! انشر فكرتك وصورتك</h2>

  <form action="submit_post.php" method="POST" enctype="multipart/form-data">
    <textarea name="idea" placeholder="اكتب فكرتك هنا..." required></textarea><br>
    <input type="file" name="image" accept="image/*" required><br>
    <button type="submit">نشر</button>
  </form>

  <p><a href="welcome.php">الرجوع</a></p>

</body>
</html>
