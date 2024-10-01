<?php include'koneksi.php';?>
<?php 
$keyword= $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%keyword%'
	OR deskripsi_produk LIKE '%keyword%'");
while ($pecah=$ambil->fetch_assoc()) {
	$semuadata[]=$pecah;
}

echo "<pre>";
print_r($semuadata);
echo "</pre>";
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
	<link rel="shortcut icon" type="text/css" href="favicon.ico"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Home | Computer OnShop</title>
</head>
<body>
	<!-- NAVBAR -->
	<?php include"navbar.php";?>
	HAsil pencarian  : <?php echo $keyword; ?>
	<div class="container">
		<h1 class="center-align">Produk Terbaru</h1>
		<div class="row">
			<?php 	foreach ($semuadata as $key => $value) : ?>
				<div class="grid-example col m3 s12">
					<div class=" responisve-card card hoverable">
						<div class="card-image waves-effect waves-block waves-light">
							<center>
								<img class="responsive-img activator" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">
							</center>
							<span class="card-title">
								<strong><p><?php echo $value['nama_produk']; ?></p></strong>
							</div>
							<div class="card-content">
								<p>stok : <?php echo $value['stok_produk'] ?></p>
								<span class="harga">
									<h5>Rp.<?php echo number_format($value['harga_produk']); ?></h5>
								</span> 
								<hr>
								<div class="card-action">
									<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" 
										class="btn waves-effect waves-light left red btn-small ">Detail</a>
										<a href="beli.php?id=<?php 	echo $perproduk['id_produk']; ?>" class="btn waves-effect waves-light right btn-small">beli</a></span>
									</div>
								</div>
							</div>
						</div>
					<?php 	endforeach ?>
				</div>	
			</div>


			<script type="text/javascript" src="js/materialize.min.js"></script>
			<script>

			</script>
		</body>
		</html>