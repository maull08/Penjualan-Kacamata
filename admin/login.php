<?php 
session_start();
$koneksi = new mysqli("localhost", "root", "", "penjualan");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin : Empat Mata</title>
  <!-- BOOTSTRAP STYLES-->
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <!-- CUSTOM CSS FOR BACKGROUND IMAGE -->
  <style>
    body {
      background-image: url('assets/img/uhu.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
    .panel-default {
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12">
        <h4>
          <img src="assets/img/yu.jpeg" alt="Logo" style="height: 180px; vertical-align: middle;">
        </h4>
        (Login with your access to admin Optik Empat Mata)
      </div>
    </div>
    <div class="row ">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Enter Details To Login</strong>  
          </div>
          <div class="panel-body">
            <form role="form" method="post">
              <br />
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                <input type="text" class="form-control" name="user" placeholder="admin" />
              </div>
              <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="pass" placeholder="password" />
              </div>
              <div class="form-group">
                <label class="checkbox-inline">
                  <input type="checkbox" /> Remember me
                </label>
                <span class="pull-right">
                  <a href="#">Forget password ?</a> 
                </span>
              </div>

              <button class="btn btn-primary" name="login">Login</button>
              <hr />
              <!-- Not register ? <a href="register.php" >click here </a>  -->
            </form>
            <?php 
            if (isset($_POST['login'])) {
              $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]' AND password='$_POST[pass]'");
              $yangcocok = $ambil->num_rows;
              if ($yangcocok == 1) {
                $_SESSION['admin'] = $ambil->fetch_assoc();
                echo "<div class='alert alert-info'>login sukses</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php'>";
              } else {
                echo "<div class='alert alert-danger'>login gagal</div>";
                echo "<meta http-equiv='refresh' content='1;url=login.php'>";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS - AT THE BOTTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
</body>
</html>
