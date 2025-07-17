<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_name'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idea = $_POST['idea'];
    $image = $_FILES['image'];

    $user_name = $_SESSION['user_name'];

    // جلب ID المستخدم من قاعدة البيانات
    $stmt = $pdo->prepare("SELECT id FROM users WHERE name = ?");
    $stmt->execute([$user_name]);
    $user = $stmt->fetch();
    $user_id = $user['id'];

    // حفظ الصورة
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir);
    }

    $image_name = time() . "_" . basename($image["name"]);
    $image_path = $upload_dir . $image_name;
    move_uploaded_file($image["tmp_name"], $image_path);

    // إدخال الفكرة في قاعدة البيانات
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, idea, image_path) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $idea, $image_path]);

    echo "تم نشر الفكرة بنجاح! <a href='post_idea.php'>نشر فكرة جديدة</a>";
}
?>
