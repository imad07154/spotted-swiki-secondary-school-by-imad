<?php
require 'db.php'; // تأكد أن لديك ملف db.php فيه الاتصال بقاعدة البيانات

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>عرض الأفكار</title>
  <style>
    body { font-family: Arial; direction: rtl; background: #f5f5f5; padding: 20px; }
    .post { background: white; padding: 10px; margin-bottom: 15px; border-radius: 8px; }
    .post img { max-width: 300px; display: block; margin-top: 10px; }
  </style>
</head>
<body>
  <h2>📚 جميع الأفكار المنشورة</h2>
  <?php while ($row = $stmt->fetch()): ?>
    <div class="post">
      <p><?= htmlspecialchars($row['idea']) ?></p>
      <?php if (!empty($row['image_path'])): ?>
        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="صورة">
      <?php endif; ?>
      <small>🕓 <?= $row['created_at'] ?></small>
    </div>
  <?php endwhile; ?>
</body>
</html>
