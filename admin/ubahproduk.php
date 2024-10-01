<h2><center>UBAH PRODUK</center></h2>

<?php 
	$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
	$pecah=$ambil->fetch_assoc();
?>

<?php 
$datakategori = array();
$ambil=$koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" name="nama" class="form-control" value="<?= $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" name="stok" class="form-control" value="<?= $pecah['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control" value="<?= $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" rows="8" required><?= $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" name="berat" class="form-control" value="<?= $pecah['berat_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?= $pecah['foto_produk'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<a href="index.php?halaman=produk" class="btn btn-danger">KEMBALI</a>
	<button class="btn btn-primary" name="ubah">UBAH</button>

	<?php 
	if (isset($_POST['ubah'])) 
	{
		$namafoto = $_FILES['foto']['name'];
		$lokasifoto = $_FILES['foto']['tmp_name'];

		// Jika foto diubah
		if (!empty($lokasifoto))
		{
			move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

			$koneksi->query("UPDATE produk SET 
				nama_produk='$_POST[nama]', 
				harga_produk='$_POST[harga]',
				berat_produk='$_POST[berat]',
				foto_produk='$namafoto', 
				deskripsi_produk='$_POST[deskripsi]',
				stok_produk='$_POST[stok]',
				id_kategori='$_POST[id_kategori]'
				WHERE id_produk='$_GET[id]'") ;
		} 
		else 
		{
			$koneksi->query("UPDATE produk SET 
				nama_produk='$_POST[nama]', 
				harga_produk='$_POST[harga]',
				berat_produk='$_POST[berat]', 
				deskripsi_produk='$_POST[deskripsi]',
				stok_produk='$_POST[stok]',
				id_kategori='$_POST[id_kategori]'
				WHERE id_produk='$_GET[id]'") ;
		}
		echo "<script>alert('Data produk telah diubah');</script>";
		echo "<script>location='index.php?halaman=produk';</script>";
	}
	?>
</form>
