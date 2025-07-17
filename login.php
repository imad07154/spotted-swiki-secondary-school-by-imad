<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // تحقق من المستخدم
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['is_verified']) {
            $_SESSION['user_name'] = $user['name'];
            header("Location: welcome.php");
            exit();
        } else {
            echo "يرجى تفعيل بريدك الإلكتروني أولاً.";
        }
    } else {
        echo "بيانات الدخول غير صحيحة.";
    }
}
?>
