<?php 	
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- My Css -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Login | Optik Empat Mata</title>
	<body>
		<!--Navbar-->
		<?php include"navbar.php" ?>
		<br>	
		<div class="container">	
			<div class="row">
				<div class="col s12">
					<div class="card-panel hoverable" style="margin:150px 275px 0px 275px; padding-bottom: 50px;">
						<span class="card-title"><h3><center>LOGIN</center></h3></span>
						<span class="white-text">
							<form method="post">
								<div class="input-field">
									<i class="material-icons prefix">email</i>
									<input id="icon_email" type="email" class="validate" name="email" required autocomplete="off">
									<label for="icon_email">Email</label>
								</div>
								<div class="input-field">
									<i class="material-icons prefix">lock</i>
									<input id="icon_lock" type="password" required class="validate" name="password">
									<label for="icon_lock">Password</label>
								</div>	
								<div class="row">
								<div class="col s6">
									<button class="btn" name="login">Login</button>
								</div>
								<div class="col s6 right-align">
									<a href="forgot_password.php" class="btn-flat">Forgot Password?</a>
								</div>
							</div>
								</div>
								</div>
								</div>
							</form>
						</span>
					</div>
				</div>
			</div>
		</div>

		<?php 	
		// jika ada tombol login (tombol login ditekan)
		if (isset ($_POST["login"]))
		{
			$email = $_POST["email"];
			$password = $_POST["password"];
			// lakukan query ngecek akun di tabel pelanggan di database
			$ambil = $koneksi-> query("SELECT * FROM pelanggan 
				WHERE email_pelanggan='$email' 
				AND password_pelanggan='$password' ");

			// hitung akun yang cocok
			$akunyangcocok = $ambil->num_rows;

			// jika ada 1 akun yang cocok, maka diloginkan
			if ($akunyangcocok == 1)
			{
				// anda sudah login
				// mendapatkan akun dalam array
				$akun = $ambil->fetch_assoc();
				// simpan di session pelanggan
				$_SESSION['pelanggan'] = $akun;
				echo "<script>alert('Anda berhasil login');</script>";
				
				// jika sudah belanja
				if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]) ) 
				{
					echo "<script>location='checkout.php';</script>";
				}
				else {
					echo "<script>location='index.php';</script>";
				}
			}
			else
			{
				// jika gagal login
				echo "<script>alert('Gagal login, periksa akun Anda');</script>";
				echo "<script>location='login.php';</script>";
			}
		}
		?>

	</body>
</html>
