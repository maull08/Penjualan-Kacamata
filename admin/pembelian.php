<h2><center>DATA PEMBELIAN</center></h2>
<br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th><center>NO</center></th>
			<th><center>NAMA PELANGGAN</center></th>
			<th><center>STATUS</center></th>
			<th><center>TOTAL</center></th>
			<th><center>AKSI</center></th>	
		</tr>
	</thead>
	<tbody align="center">

		<?php $nomor = 1; ?>
		<?php  
		$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
		$limit = 10;
		$limitStart = ($page - 1) * $limit;
		$SqlQuery = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan
			ORDER BY FIELD(status_pembelian, 'sudah kirim pembayaran') DESC, tanggal_pembelian DESC
			LIMIT $limitStart, $limit");
		$nomor = $limitStart + 1;
		while ($row = mysqli_fetch_array($SqlQuery)) {
			?>
			<tr>
				<td><?php echo $nomor; ?></td>
				<td><?php echo $row['nama_pelanggan']; ?></td>
				<td><?php echo $row['status_pembelian']; ?></td>
				<td>Rp.<?php echo number_format($row['total_pembelian']); ?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?php echo $row['id_pembelian']; ?>" class="btn btn-info">DETAIL</a>
					<?php if ($row['status_pembelian'] !== 'Belum Dibayar'): ?>
						<a href="index.php?halaman=pembayaran&id=<?php echo $row['id_pembelian']; ?>"> <button class="btn btn-warning">PEMBAYARAN</button></a>
					<?php endif ?>
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
		if ($page == 1) { 
			?>        
			<!-- link Previous Page disable --> 
			<li class="disabled"><a href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
			<?php
		} else { 
			$LinkPrev = ($page > 1) ? $page - 1 : 1; 
			?>
			<!-- link Previous Page --> 
			<li><a href="index.php?halaman=pembelian&page=<?php echo $LinkPrev; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></a></li>
		<?php }  ?>

		<?php
		$SqlQuery = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");        

		// Hitung semua jumlah data yang berada pada tabel pembelian
		$JumlahData = mysqli_num_rows($SqlQuery);

		// Hitung jumlah halaman yang tersedia
		$jumlahPage = ceil($JumlahData / $limit); 

		// Jumlah link number 
		$jumlahNumber = 1; 

		// Untuk awal link number
		$startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1; 

		// Untuk akhir link number
		$endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage; 

		for ($i = $startNumber; $i <= $endNumber; $i++) {
			$linkActive = ($page == $i) ? 'class="active"' : '';
			?>
			<li <?php echo $linkActive; ?>><a href="index.php?halaman=pembelian&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php
		}
		?>

		<!-- link Next Page -->
		<?php       
		if ($page == $jumlahPage) { 
			?>
			<li class="disabled"><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			<?php
		} else {
			$linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
			?>
			<li><a href="index.php?halaman=pembelian&page=<?php echo $linkNext; ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			<?php
		}
		?>
	</ul>
</div>
