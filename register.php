<?php
// تحميل ملفات PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// بداية التجربة فقط
echo "تم استدعاء مكتبة PHPMailer بنجاح!";
?>
<?php
require 'db.php'; // ملف الاتصال بقاعدة البيانات

// تحميل ملفات PHPMailer
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // تحقق من المدخلات
    if (empty($name) || empty($email) || empty($password)) {
        echo "يرجى ملء جميع الحقول.";
        exit;
    }

    // تحقق إذا كان البريد موجود مسبقًا
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo "البريد الإلكتروني مستخدم بالفعل.";
        exit;
    }

    // توليد كود تحقق عشوائي
    $verification_code = md5(uniqid(rand(), true));

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // حفظ المستخدم في قاعدة البيانات
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, verification_code) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $hashed_password, $verification_code])) {

        // إعداد الإيميل
        $mail = new PHPMailer(true);

        try {
            // إعدادات SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@gmail.com';      // ✨ بريدك هنا
            $mail->Password = 'your_app_password';          // ✨ كلمة مرور التطبيق
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // معلومات الإيميل
            $mail->setFrom('your_email@gmail.com', 'Spot School');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'تأكيد بريدك الإلكتروني';
            $mail->Body    = "مرحبًا $name،<br><br>اضغط على الرابط التالي لتأكيد بريدك:<br>
            <a href='http://localhost/spot-secondary-school/verify.php?code=$verification_code'>تأكيد الحساب</a>";

            $mail->send();
            echo "تم تسجيلك بنجاح! يرجى التحقق من بريدك الإلكتروني.";
        } catch (Exception $e) {
            echo "فشل إرسال الإيميل: {$mail->ErrorInfo}";
        }

    } else {
        echo "حدث خطأ أثناء التسجيل.";
    }
}
?>

