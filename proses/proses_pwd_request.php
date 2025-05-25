<?php
session_start();
include "../config/connect.php";
date_default_timezone_set("Asia/Bangkok");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';


$email = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";

if (isset($_POST['submit_validate'])) {

    $query = $conn->prepare("SELECT * FROM tb_user WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expires_at = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $stmt = $conn->prepare("INSERT INTO tb_reset_pwd (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires_at);
        $stmt->execute();

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = ' kingseafood0810@gmail.com ';
            $mail->Password   = 'qezd yrhj etqn rdhj';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // pengirim
            $mail->setFrom(' kingseafood0810@gmail.com ', 'KingSeafood');
            $mail->addAddress($email);

            $link = "http://localhost/webseafood/admin/reset-pwd?token=$token&email=$email";

            // $mail->AddEmbeddedImage(__DIR__ . '/../public/assets/images/logo.png', 'logo_cid');
            $mail->Subject = '=?UTF-8?B?' . base64_encode('🔐 Reset Password Anda') . '?=';
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            $mail->Body = "
                    <div style='font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; color: #333;'>
                        
                        
                        <div style='text-align: center; margin-bottom: 20px;'>
                            <img src='https://i.imgur.com/OrVhhsa.png' alt='Logo Perusahaan' style='max-width: 150px;'>
                        </div>

                        <h2 style='color: #2c3e50;'>🔐 Permintaan Reset Password</h2>
                        
                        <p>Halo,</p>

                        <p>Kami menerima permintaan untuk mereset password akun Anda. Jika ini memang Anda, silakan klik tombol di bawah ini:</p>

                        
                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='$link' style='background-color: #8E1D22; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;'>Reset Password Sekarang</a>
                        </div>

                        <p>Atau, salin dan tempel link berikut ini ke browser Anda jika tombol tidak bisa diklik:</p>
                        <p style='word-break: break-all; background: #ecf0f1; padding: 10px; border-radius: 5px;'>$link</p>

                        <hr style='margin: 30px 0;'>

                        
                        <p style='font-size: 12px; color: #888;'>🕒 Link ini hanya berlaku selama 5 menit demi keamanan akun Anda.</p>

                        
                        <p style='margin-top: 40px;'>Salam hangat,<br><br><strong>Tim WebSeafood</strong></p>

                    </div>
                ";

            $mail->send();

            header('location: ../admin/request-notif');
            exit;
        } catch (Exception $e) {

            echo "Email gagal dikirim. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
?>
        <script>
            alert('Email tidak terdaftar. Silahkan masukkan kembali...');
            window.location = '../admin/request-reset';
        </script>
<?php

    }
}
?>