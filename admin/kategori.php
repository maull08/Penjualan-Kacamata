<h2><center>DATA KATEGORI</center></h2>
<br>
<?php 
$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$semuadata[] = $tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo"</pre>";

 ?>
<table class='table table-bordered' align="center">
	 <thead>
		<tr>
			<th><center>NO</center></th>
			<th><center>KATEGORI</center></th>
<!-- 			<th><center>Aksi</center></th> -->
		</tr>
	</thead>
	<tbody align="center">
		<?php foreach ($semuadata as $key => $value):?>
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"] ?></td>
<!-- 			<td>
				<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger">hapus</a>
				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">ubah</a>
			</td> -->
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<!-- <a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a> -->