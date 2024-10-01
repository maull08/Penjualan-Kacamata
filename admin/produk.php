<style>
      .table > tbody > tr > td {
     vertical-align: middle;
     text-align: center;
}
  </style>
<h2><center>DATA PRODUK</center></h2>
<br>
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">TAMBAH DATA</a><br><br>
<table class='table table-bordered ' align="center">
	<thead>
		<tr>
			<th><center>NO</center></th>
			<th><center>NAMA</center></th>
			<th><center>HARGA</center></th>
			<th><center>BERAT</center></th>
			<th><center>FOTO</center></th>
			<th><center>STOK PRODUK</center></th>
			<th><center>AKSI</center></th> 
		</tr>
	</thead>
	<tbody align="center">
		<?php $nomor=1; ?>
		<?php  $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;
		$limit = 5;
		$limitStart = ($page - 1) * $limit;
		$SqlQuery=$koneksi->query("SELECT * FROM produk 
			LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
			ORDER BY id_produk
			LIMIT ".$limitStart.",".$limit);
		$nomor = $limitStart + 1;
		
		while($row = mysqli_fetch_array($SqlQuery)){   
			?>
			<tr>
				<td><?php echo $nomor ; ?></td>
				<td><?php echo $row['nama_produk'] ;?></td>
				<td>Rp.<?php echo number_format($row['harga_produk']) ; ?></td>
				<td><?php echo $row['berat_produk'] ; ?></td>
				<td><img src="../foto_produk/<?php echo $row['foto_produk'] ;?>" width="100"></td>
				<td><?php echo $row['stok_produk']; ?></td>
				<td>
					<a href="index.php?halaman=detailproduk&id=<?php echo $row['id_produk']; ?>" class="btn btn-info">DETAIL</a>
						<a href="index.php?halaman=ubahproduk&id=<?php echo $row['id_produk']; ?>" class="btn btn-warning">UBAH</a>
					<a href="index.php?halaman=hapusproduk&id=<?php echo $row['id_produk']; ?>" class="btn btn-danger">HAPUS</a>					
				</td>
			</tr>
			<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
<br>
<div align="right">
	<ul class="pagination">
		<?php
    // Jika page = 1, maka LinkPrev disable
		if($page == 1){ 
			?>        

			<!-- link Previous Page disable --> 
			<li class="disabled"><a href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
			<?php
		} else{ 
			$LinkPrev = ($page > 1)? $page - 1 : 1; 
			?>

			<!-- link Previous Page --> 
			<li class="active"><a href="index.php?halaman=produk&page=<?php echo $LinkPrev ; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
		<?php }  ?>

		<?php
		$SqlQuery = mysqli_query($koneksi, "SELECT * FROM produk 
			LEFT JOIN kategori ON produk.id_kategori=kategori.id_kategori 
			ORDER BY id_produk");        

      //Hitung semua jumlah data yang berada pada tabel Sisawa
		$JumlahData = mysqli_num_rows($SqlQuery);

      // Hitung jumlah halaman yang tersedia
		$jumlahPage = ceil($JumlahData / $limit); 

      // Jumlah link number 
		$jumlahNumber = 1; 

      // Untuk awal link number
		$startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 

      // Untuk akhir link number
		$endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 

		for($i = $startNumber; $i <= $endNumber; $i++){
			$linkActive = ($page == $i)? '<li class="active">' : '';
			?>
			<li  class="waves-effect"><?php echo $linkActive; ?><a href="index.php?halaman=produk&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
		?>

		<!-- link Next Page -->
		<?php       
		if($page == $jumlahPage){ 
			?>
			<li class="active"><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			<?php
		}
		else{
			$linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
			?>
			<li><a href="index.php?halaman=produk&page=<?php echo $linkNext; ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			<?php
		}
		?>
	</ul>

</div>
