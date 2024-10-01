<?php 
session_start();
include 'koneksi.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Pastikan path ini benar
require 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Forgot Password | Optik Empat Mata</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel hoverable" style="margin:150px 275px 0px 275px; padding-bottom: 50px;">
                    <h3><center>Forgot Password</center></h3>
                    <form method="post">
                        <div class="input-field">
                            <input id="email" type="email" class="validate" name="email" required autocomplete="off">
                            <label for="email">Enter your email</label>
                        </div>
                        <button class="btn" type="submit" name="send_otp">Send OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['send_otp'])) {
        $email = $_POST['email'];
        // Cek apakah email ada di database
        $query = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
        if ($query->num_rows > 0) {
            $otp = rand(100000, 999999); // Generate 6-digit OTP
            $_SESSION['otp'] = $otp;
            $_SESSION['email_otp'] = $email;

            // Pengiriman email dengan PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Konfigurasi server SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'mauludianto44@gmail.com'; // Ganti dengan email Anda
                $mail->Password   = 'sknypbxxzaabiqet';    // Ganti dengan App Password Gmail
                $mail->SMTPSecure = 'tls';                 // Aktifkan enkripsi TLS
                $mail->Port       = 587;

                // Pengaturan pengirim dan penerima
                $mail->setFrom('your-email@gmail.com', 'Optik Empat Mata');
                $mail->addAddress($email);    // Penerima email

                // Konten email
                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "Your OTP code is: $otp";

                // Kirim email
                $mail->send();
                echo "<script>alert('OTP has been sent to your email');</script>";
                echo "<script>location='verify_otp.php';</script>";
            } catch (Exception $e) {
                echo "Pesan tidak bisa dikirim. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>alert('Email not registered');</script>";
        }
    }
    ?>
</body>
</html>
