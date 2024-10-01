<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['email_otp'])) {
    echo "<script>alert('Access denied');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Reset Password | Optik Empat Mata</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel hoverable" style="margin:150px 275px 0px 275px; padding-bottom: 50px;">
                    <h3><center>Reset Password</center></h3>
                    <form method="post">
                        <div class="input-field">
                            <input id="password" type="password" class="validate" name="password" placeholder="New Password" required autocomplete="off">

                        </div>
                        <button class="btn" type="submit" name="reset_password">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['reset_password'])) {
        $new_password = $_POST['password'];
        $email = $_SESSION['email_otp'];
        // Update password di database
        $koneksi->query("UPDATE pelanggan SET password_pelanggan='$new_password' WHERE email_pelanggan='$email'");
        echo "<script>alert('Password has been reset successfully');</script>";
        echo "<script>location='login.php';</script>";
        session_unset(); // Hapus session OTP
        session_destroy();
    }
    ?>
</body>
</html>
