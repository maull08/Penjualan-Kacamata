<?php 
//koneksi ke database
session_start();
include"koneksi.php";

//jika tidak ada session pelanggan (belom login) maka dilarikan ke login.php
if (!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])) 
{
	echo "<script>alert('anda belom login');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
if (!isset($_SESSION['keranjang']) OR empty($_SESSION['keranjang'])) 
{
	echo "<script>alert('anda belum berbelanja');</script>";
	echo "<script>location='index.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHECKOUT</title>
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
	<script src="assets/js/jquery-1.10.2.js"></script>
</head>
<body>
	<!--Navbar-->
	<?php include"navbar.php" ?>

	<!-- TABEL KERANJANG -->
	<section class="konten">
		<div class="container">
			<h1 align="center">CHECKOUT</h1>
			<table class="table highlight centered hoverable">		
				<thead>
					<tr>
						<th>NO</th>
						<th>PRODUK</th>
						<th>HARGA</th>
						<th>JUMLAH</th>
						<th>SUB HARGA</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor=1; ?>
					<?php $totalberat =0; ?>
					<?php $totalbelanja = 0; ?>	
					<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
						<!-- menampilkan produk berdasarkan id_produk -->
						<?php
						$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
						$pecah = $ambil->fetch_assoc();
						$subharga =$pecah["harga_produk"]*$jumlah;
						// subharga diperoleh dari berat produk x jumlah
						$subberat = $pecah["berat_produk"]*$jumlah;
						//total berat

						$totalberat+=$subberat;

						// echo "<pre>";
						// print_r($pecah);
						// echo "</pre>";
						?>
						<tr>
							<td><?php echo 	$nomor; ?></td>
							<td><?php echo $pecah['nama_produk']; ?></td>
							<td>Rp.<?php echo 	number_format($pecah["harga_produk"]); ?></td>
							<td><?php echo 	$jumlah; ?></td>
							<td>Rp.<?php echo 	number_format($subharga) ;?></td>
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja+=$subharga; ?>
					<?php 	endforeach ?>				
					<tr>
						<td colspan="4"><strong>Total Belanja</strong></td>
						<td><strong>Rp.<?php 	echo number_format($totalbelanja) ?></strong></td>
					</tr>
				</tbody>
			</table>
			<br>

			<!-- Profile Keranjang -->
			<div class="row">
				<form method="post">
					<div class="row">
						<div class="input-field col s4">
							<i class="material-icons prefix">account_circle</i>
							<input type="text" readonly value="<?php echo $_SESSION['pelanggan']
							['nama_pelanggan'] ?>">
						</div>
						<div class="input-field col s4">
							<i class="material-icons prefix">local_phone</i>
							<input type="text" readonly value="<?php echo $_SESSION['pelanggan']
							['telepon_pelanggan'] ?>">		
						</div>
							<!-- Opsi Pilihan Alamat -->
					<div class="input-field col s12">
						<label>Pilih Alamat Pengiriman</label><br>
						<p>
							<label>
								<input type="radio" name="tipe_alamat" value="rumah" checked />
								<span>Rumah</span>
							</label>
						</p>
						<p>
							<label>
								<input type="radio" name="tipe_alamat" value="kantor" />
								<span>Kantor</span>
							</label>
						</p>
					</div>
						<div class="input-field col s12">
							<label>Alamat Lengkap Pengiriman</label>
							<textarea name="alamat_pengiriman" id="" required cols="30" rows="10" class="materialize-textarea" placeholder="Masukkan Alamat Pengiriman"></textarea><br><br>
						</div>
	
							<div class="col s12 m3">
								<label>Pilih Provinsi</label>
								<select class="browser-default" name="nama_provinsi" required >
								</select>
							</div>
							<div class="col s12 m3">
								<label>Pilih Distrik</label>
								<select class="browser-default" name="nama_distrik" required >
								</select>
							</div>
							<div class="col s12 m3">
								<label>Pilih Ekspedisi</label>
								<select class="browser-default" name="nama_ekspedisi" required >
								</select>
							</div>
							<div class="col s12 m3">
								<label>Pilih paket</label>
								<select class="browser-default" name="nama_paket" required >
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col s8 m1">
								<input readonly type="text" placeholder="berat" name="total_berat" value="<?php echo $totalberat; ?>">
							</div>
							<div class="col s12 m2">
								<input readonly type="text" placeholder="Nama provinsi" name="provinsi">
							</div>
							<div class="col s12 m3">
								<input readonly  type="text" placeholder="Nama distrik" name="distrik">
							</div>
							<div class="col s12 m3">
								<input readonly type="text" placeholder="Ekspedisi" name="ekspedisi">
							</div>
							<div class="col s12 m3">
								<input readonly type="text" placeholder="Kode paket" name="paket">
								<input readonly type="text" placeholder="Harga Ongkir" name="ongkir">
								<input readonly type="text" placeholder="Lama Pengiriman" name="estimasi">
							</div>
						</div>
						<div class="row">
							<div class="col s12 m3">
								<button class="btn btn-primary" name="checkout">Checkout</button>
							</div>
						</div>		
					</form>
					
					<?php 	
if (isset($_POST["checkout"])) {
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $tanggal_pembelian = date('Y-m-d');
    $alamat_pengiriman = $_POST['alamat_pengiriman'];
    $tipe_alamat = $_POST['tipe_alamat'];  // Simpan tipe alamat dari form (rumah atau kantor)
    $totalberat = $_POST["totalberat"];
    $provinsi = $_POST["provinsi"];
    $distrik = $_POST["distrik"];
    $tipe = $_POST["tipe"];
    $kodepos = $_POST["kodepos"];
    $ekspedisi = $_POST["ekspedisi"];
    $paket = $_POST["paket"];
    $ongkir = $_POST["ongkir"];
    $estimasi = $_POST["estimasi"];

    $total_pembelian = $totalbelanja + $ongkir; 

    // Menyimpan data ke tabel pembelian, termasuk tipe alamat
    $koneksi->query("INSERT INTO pembelian (
        id_pelanggan, tanggal_pembelian, total_pembelian, alamat_pengiriman, tipe_alamat, totalberat, provinsi, distrik, tipe, kodepos, ekspedisi, paket, ongkir, estimasi)
        VALUES ('$id_pelanggan', '$tanggal_pembelian', '$total_pembelian', '$alamat_pengiriman', '$tipe_alamat', '$totalberat', '$provinsi', '$distrik', '$tipe', '$kodepos', '$ekspedisi', '$paket', '$ongkir', '$estimasi')");

    // Mendapatkan id_pembelian barusan
    $id_pembelian_barusan = $koneksi->insert_id;

    // Menyimpan data ke tabel pembelian_produk
    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $perproduk = $ambil->fetch_assoc();
        $nama = $perproduk['nama_produk'];
        $harga = $perproduk['harga_produk'];
        $berat = $perproduk['berat_produk'];
        $subberat = $perproduk['berat_produk'] * $jumlah;
        $subharga = $perproduk['harga_produk'] * $jumlah;

        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah)
            VALUES ('$id_pembelian_barusan', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah')");
    }

    // Mengosongkan keranjang belanja
    unset($_SESSION["keranjang"]);

    // Mengalihkan ke halaman nota
    echo "<script>alert('Pembelian sukses');</script>";
    echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
}

					?>
				</div>
			</section>

			<?php include"footer.php"; ?>


<!-- 			<pre><?php print_r($_SESSION['pelanggan']); ?></pre>
	<pre><?php 	print_r($_SESSION['keranjang']) ?></pre> -->
	
	
	<script>

		  //  API RAJA ONGKIR
		  $(document).ready(function(){
		  	$.ajax({
		  		type:'post',
		  		url:'dataprovinsi.php',
		  		success:function(hasil_provinsi)
		  		{
		  			$("select[name=nama_provinsi]").html(hasil_provinsi);
		  		}
		  	});

		  	$("select[name=nama_provinsi]").on("change",function(){
        	// ambil id_provinsi yang dipilih (dari attribut pribadi/bid'ah)
        	var id_provinsi_terpilih = $("option:selected",this).attr("id_provinsi");
        	$.ajax({
        		type:'post',
        		url:'datadistrik.php',
        		data: 'id_provinsi='+id_provinsi_terpilih,
        		success:function(hasil_distrik)
        		{
        			$("select[name=nama_distrik]").html(hasil_distrik);
        		}
        	});
        });
		  	$.ajax({
		  		type:'post',
		  		url:'dataekspedisi.php',
		  		success:function(hasil_ekspedisi)
		  		{
		  			$("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
		  		}
		  	});

		  	$("select[name=nama_ekspedisi]").on("change",function(){
				//mendapatkan data ongkos kirim

				// mendapatkan ekspedisi yang dipilih
				var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
				//mendapatkan id_distrik yang dipilih pengguna
				var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");
				//mendapatkan total_berat dari inputan
				var total_berat = $("input[name=total_berat]").val();
				$.ajax({
					type:'post',
					url:'datapaket.php',
					data:'ekspedisi='+ekspedisi_terpilih+'&distrik='+distrik_terpilih+'&berat='+total_berat,
					success:function(hasil_paket)
					{
						// console.log(hasil_paket);
						$("select[name=nama_paket]").html(hasil_paket);

						// letakkan nama ekspedisi terpilih diinput ekspedisi
						$("input[name=ekspedisi]").val(ekspedisi_terpilih);

					}

				}) 
			});
		  	$("select[name=nama_distrik]").on("change",function(){
		  		var prov = $("option:selected",this).attr("nama_provinsi");
		  		var dist = $("option:selected",this).attr("nama_distrik");
		  		var tipe = $("option:selected",this).attr("tipe_distrik");
		  		var kodepos = $("option:selected",this).attr("kodepos");

		  		$("input[name=provinsi]").val(prov);
		  		$("input[name=distrik]").val(dist);
		  		$("input[name=tipe]").val(tipe);
		  		$("input[name=kodepos]").val(kodepos);

		  	});
		  	$("select[name=nama_paket]").on("change",function(){
		  		var paket = $("option:selected",this).attr("paket");
		  		var ongkir = $("option:selected",this).attr("ongkir");
		  		var etd = $("option:selected",this).attr("etd");
		  		$("input[name=paket]").val(paket);
		  		$("input[name=ongkir]").val(ongkir);
		  		$("input[name=estimasi]").val(etd);

		  	})

		  });
		  document.addEventListener('DOMContentLoaded', function() {
		  	var elems = document.querySelectorAll('select');
		  	var instances = M.FormSelect.init(elems, options);
		  });

  // Or with jQuery

  $(document).ready(function(){
  	$('select').formSelect();
  });
</script>
</body>
</html>