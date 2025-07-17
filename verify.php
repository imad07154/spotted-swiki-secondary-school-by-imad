<?php
require 'db.php'; // วแวสีวแ ศÞวฺฯษ วแศํวไวส

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // วแศอห ฺไ ใำสฮฯใ ศ฿ๆฯ วแสอÞÞ
    $stmt = $pdo->prepare("SELECT * FROM users WHERE verification_code = ? AND is_verified = 0");
    $stmt->execute([$code]);
    $user = $stmt->fetch();

    if ($user) {
        // สอฯํห วแอวแษ ลแ์ สใ วแสอÞÞ
        $update = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
        $update->execute([$user['id']]);

        echo "<h2 style='text-align:center; color:green;'>? สใ สÝฺํแ อำวศ฿ ศไฬวอ! ํใ฿ไ฿ วแยไ สำฬํแ วแฯฮๆแ.</h2>";
        echo "<p style='text-align:center;'><a href='login.html'>วแะๅวศ ลแ์ ีÝอษ สำฬํแ วแฯฮๆแ</a></p>";
    } else {
        echo "<h2 style='text-align:center; color:red;'>? ัใา วแสอÞÞ Ûํั ีอํอ รๆ วแอำวศ ใÝฺแ ใำศÞ๐ว.</h2>";
    }
} else {
    echo "<h2 style='text-align:center; color:red;'>? แว ํๆฬฯ ัใา สอÞÞ.</h2>";
}
?>
