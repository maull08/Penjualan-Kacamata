<?php 
//koneksi ke database
session_start();
include 'koneksi.php';

if(empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang']))
{
	echo "<script>alert('keranjang kosong, silahkan anda belanja terlebih dahulu');</script>";
	echo "<script>location='index.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Keranjang Belanja | Optik Empat Mata</title>
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
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>

	<!-- BODY -->
	<section class="konten">
		<div class="container">
			<h1 align="center">KERANJANG BELANJA</h1>
			<table class="table centered highlight hoverable">		
				<thead>
					<tr>
						<th>NO</th>
						<th>PRODUK</th>
						<th>HARGA</th>
						<th>JUMLAH</th>
						<th>SUBHARGA</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>	
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<!-- menampilkan produk berdasarkan id_produk -->
						<?php
						$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk';");
						$pecah = $ambil->fetch_assoc();
						$subharga =$pecah['harga_produk']*$jumlah;
						?>
						<tr>
							<td><?php echo 	$nomor; ?></td>
							<td><?php echo $pecah['nama_produk']; ?></td>
							<td>Rp.<?php echo 	number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo 	$jumlah; ?></td>
							<td>Rp.<?php echo 	number_format($subharga) ;?></td>
							<td><a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger xs">hapus</a></td>
						</tr>
						<?php $nomor++; ?>
					<?php 	endforeach ?>
				</tbody>
			</table>
			<br>
			<a href="index.php" class="waves-effect waves-light btn " style="margin-right: 10px;">Lanjutkan Belanja</a>
			<a href="checkout.php" class="waves-effect waves-light btn">Checkout</a>
		</div>
		<br><br><br><br><br>
		
	</section>
	<!-- footer -->
	<?php include"footer.php" ;?>
</body>
</html>