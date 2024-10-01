<?php 
$datakategori = array();

// Ambil data kategori dari database
$ambil = $koneksi->query("SELECT * FROM kategori");
while($tiap = $ambil->fetch_assoc())
{
	$datakategori[] = $tiap;
}
?>

<h2><center>Tambah Produk</center></h2>
<br>	
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama" required>
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga" required>
	</div>
	<div class="form-group">
		<label>Berat (Gr)</label>
		<input type="number" class="form-control" name="berat" required>
	</div>
	<div class="form-group">
		<label>Stok Produk</label>
		<input type="number" class="form-control" name="stok_produk" required>
	</div>
	<div class="form-group">
		<label>Foto</label>
		<div class="letak-input" style="margin-bottom: 10px;">
			<input type="file" class="form-control" name="foto[]" required>
		</div>
	</div>
	<div class="form-group">
		<label>Deskripsi Produk</label>
		<textarea class="form-control" name="deskripsi" rows="8" required></textarea>
	</div>
	<br>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>

<?php 
	if (isset($_POST['save'])) 
	{
		$namanamafoto = $_FILES['foto']['name'];
		$lokasilokasifoto = $_FILES['foto']['tmp_name'];

		// Pindahkan foto ke folder foto_produk
		move_uploaded_file($lokasilokasifoto[0], "../foto_produk/".$namanamafoto[0]);

		// Menyimpan data produk ke dalam database
		$koneksi->query("INSERT INTO produk 
			(nama_produk, harga_produk, berat_produk, foto_produk, stok_produk, deskripsi_produk, id_kategori) 
			VALUES('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$namanamafoto[0]', '$_POST[stok_produk]', '$_POST[deskripsi]', '$_POST[id_kategori]')");

		// Mendapatkan ID produk yang baru saja ditambahkan
		$id_produk_barusan = $koneksi->insert_id;

		// Menyimpan semua foto produk jika lebih dari satu
		foreach ($namanamafoto as $key => $tiap_nama) 
		{
			$tiap_lokasi = $lokasilokasifoto[$key];
			move_uploaded_file($tiap_lokasi, "../foto_produk/".$tiap_nama);
		}

		echo "<div class='alert alert-info'>Data tersimpan</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>
