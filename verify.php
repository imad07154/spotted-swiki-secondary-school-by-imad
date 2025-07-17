<?php
require 'db.php'; // ������� ������ ��������

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // ����� �� ������ ���� ������
    $stmt = $pdo->prepare("SELECT * FROM users WHERE verification_code = ? AND is_verified = 0");
    $stmt->execute([$code]);
    $user = $stmt->fetch();

    if ($user) {
        // ����� ������ ��� �� ������
        $update = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
        $update->execute([$user['id']]);

        echo "<h2 style='text-align:center; color:green;'>? �� ����� ����� �����! ����� ���� ����� ������.</h2>";
        echo "<p style='text-align:center;'><a href='login.html'>������ ��� ���� ����� ������</a></p>";
    } else {
        echo "<h2 style='text-align:center; color:red;'>? ��� ������ ��� ���� �� ������ ���� ������.</h2>";
    }
} else {
    echo "<h2 style='text-align:center; color:red;'>? �� ���� ��� ����.</h2>";
}
?>
