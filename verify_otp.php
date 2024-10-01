<?php
session_start();
if (!isset($_SESSION['otp'])) {
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
    <title>Verify OTP | Optik Empat Mata</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card-panel hoverable" style="margin:150px 275px 0px 275px; padding-bottom: 50px;">
                    <h3><center>Verify OTP</center></h3>
                    <form method="post">
                        <div class="input-field">
                            <input id="otp" class="validate" name="otp" placeholder="New Password" required autocomplete="off">
                        </div>
                        <button class="btn" type="submit" name="verify_otp">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['verify_otp'])) {
        $otp_input = $_POST['otp'];
        if ($otp_input == $_SESSION['otp']) {
            echo "<script>alert('OTP verified. Please reset your password');</script>";
            echo "<script>location='reset_password.php';</script>";
        } else {
            echo "<script>alert('Invalid OTP');</script>";
        }
    }
    ?>
</body>
</html>
