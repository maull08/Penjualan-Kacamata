 <?php 
//koneksi ke database
 session_start();
 include'koneksi.php';

 $id_pembelian =$_GET["id"];

 $ambil=$koneksi->query("SELECT * FROM pembayaran 
 	LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
 	WHERE pembelian.id_pembelian='$id_pembelian' ");
 $detbay = $ambil->fetch_assoc();

// echo"<pre>";
// print_r($detbay);
// echo"</pre>";
 
 if (empty($detbay)) {
 	echo "<script>alert('anda belum ada data pembayaran')</script>";
 	echo "<script>location='riwayat.php';</script>";
 	exit();
 }

//jika data pelanggan yang bayar tidak sesuai dengan yang lain
// echo "<pre>";
// print_r($_SESSION);
// echo"</pre>";
 if ($_SESSION["pelanggan"]["id_pelanggan"]!==$detbay["id_pelanggan"]) 
 {
 	echo "<script>alert('anda tidak berhak melihat pembayaran orang lain')</script>";
 	echo "<script>location='riwayat.php';</script>";
 	exit();
 }

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
 	<title>Lihat Pembayaran | Optik Empat Mata</title>
 </head>

 <body>
 	<!-- navbar -->
 	<!-- navbar -->
<?php include "navbar.php"; ?>
<div class="container">
    <center><h3>Lihat Pembayaran</h3></center><br><br>
    <table class="table centered highlight hoverable responsive-table">
        <tr>
            <th>Nama</th>
            <td style="padding-left: 20px;"><?php echo $detbay["nama"]; ?></td>
            <td rowspan="4">
                <img src="bukti_pembayaran/<?php echo $detbay["bukti"]; ?>" alt="Bukti Pembayaran" class="img-responsive" style="max-width: 300px; max-height: 300px;">
            </td>
        </tr>
        <tr>
            <th>Bank</th>
            <td style="padding-left: 20px;"><?php echo $detbay["bank"]; ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td style="padding-left: 20px;"><?php echo $detbay["tanggal"]; ?></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td style="padding-left: 20px;">Rp. <?php echo number_format($detbay["jumlah"]); ?></td>
        </tr>
    </table>
    <br><br>
    <a href="riwayat.php" class="btn-small">kembali</a>
    <br><br>
</div>
<!-- footer -->
<?php include "footer.php"; ?>
</body>
</html>

 	 	 		<a href="riwayat.php" class="btn-small">kembali</a>

 	<br><br>
 </div>
</body>
<!-- footer -->
<?php include"footer.php" ;?>
</html>