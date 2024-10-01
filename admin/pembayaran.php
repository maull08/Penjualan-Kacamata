<h2><center>DATA PEMBAYARAN</center></h2> <br>
<?php 
// mendapatkan id_pemebelian dari url
$id_pembelian = $_GET['id'];

// mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran 
	JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian
	WHERE pembayaran.id_pembelian='$id_pembelian'");
$detail= $ambil->fetch_assoc();

?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Nama</th>
				<td> <?php echo $detail['nama'] ;?> </td>
			</tr>
			<tr>
				<th>Bank</th>
				<td> <?php echo $detail['bank']; ?> </td>
			</tr>
			<tr>
				<th>Jumlah</th>
				<td>Rp.<?php echo number_format($detail['jumlah']); ?> </td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td> <?php echo date("d F Y",strtotime($detail['tanggal'])) ; ?> </td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<img src="../bukti_pembayaran/<?php echo $detail['bukti']  ?>" class="img-responsive">
		
	</div>
</div>


			<a href="index.php?halaman=pembelian" class="btn btn-danger">KEMBALI</a>
</form>

<?php 
if (isset($_POST["proses"])) 
{
	$resi  =$_POST['resi'];
	$status =$_POST['status'];
	$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi', status_pembelian='$status' WHERE id_pembelian='$id_pembelian' ");

	echo "<script>alert('data pembelian terupdate);</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
}

?>