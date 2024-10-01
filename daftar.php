<?php 
//koneksi ke database
session_start();
$koneksi = new mysqli('localhost','root','','penjualan');
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
	<title>Home | Optik Empat Mata</title>
</head>
<!-- NAVBAR -->
<?php include"navbar.php"; ?>

<div class="container">
	<center id='login'><h2> REGISTER AKUN BARU</h2></center>

	<div class="row">
		<form method="post"	>
			<div class="row">
				<div class="input-field">
					<i class="material-icons prefix">account_circle</i>
					<input id="icon_prefix" type="text" required class="validate" name="nama" autocomplete="off">
					<label for="icon_prefix">Username</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">email</i>
					<input id="icon_email" type="email" required class="validate" name="email" autocomplete="off">
					<label for="icon_email">E-mail</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">lock</i>
					<input id="icon_lock" type="password" required class="validate" name="password">
					<label for="icon_lock">Password</label>
				</div>
				<div class="input-field">
					<i class="material-icons prefix">book</i>
					<textarea id="textarea1" class="materialize-textarea" name="alamat"></textarea>
					<label for="textarea1">Alamat</label>
				</div>	
				<div class="input-field">
					<i class="material-icons prefix">phone</i>
					<input id="icon_telephone" type="number" required class="validate" name="telepon">
					<label for="icon_telephone">Telephone</label>
				</div>
					<button  class="btn waves-effect waves-light right" type="submit" name="daftar">Daftar
						<i class="material-icons right">send</i>
					</button>
			</div>
		</form>
		<?php 
			// jika ada tombol daftar(ditekan tombol daftar)
		if (isset($_POST["daftar"])) 
		{
			//mengambil isian nama, email, password, alamat telpon
			$nama = $_POST["nama"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$alamat = $_POST["alamat"];
			$telepon = $_POST["telepon"];

			// cek apakah email sudah digunakan
			$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
			$yangcocok =$ambil->num_rows;
			if ($yangcocok==1)
			{
				echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
				echo "<script>location='daftar.php';</script>";
			}
			else 
			{
			// query insert ke tabel pelanggan 
				$koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,alamat_pelanggan,telepon_pelanggan)
					VALUES('$email','$password','$nama','$alamat','$telepon');");

				echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
				echo "<script>location='login.php';</script>";
			}

		}

		?>
	</div>
