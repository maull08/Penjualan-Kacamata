<section id="highlights" class="highlights scrollspy">
    <div class="container">
        <h1 class="center-align">PRODUK TERBARU</h1>

        <!-- Tombol Sorting -->
        <div class="row">
            <div class="col s12 center-align"> <!-- Menggunakan kelas center-align -->
                <a href="?sort=asc" class="btn waves-effect waves-light">Harga Termurah</a>
                <a href="?sort=desc" class="btn waves-effect waves-light">Harga Termahal</a>
            </div>
        </div>

        <div class="row">
            <?php 
            // Ambil parameter sorting dari URL
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

            // Query untuk mengurutkan produk berdasarkan harga
            $query = 'SELECT * FROM produk';
            if ($sort == 'asc') {
                $query .= ' ORDER BY harga_produk ASC';
            } elseif ($sort == 'desc') {
                $query .= ' ORDER BY harga_produk DESC';
            }

            // Eksekusi query
            $ambil = $koneksi->query($query);

            // Tampilkan produk
            while ($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col m3 s12">
                    <div class="responisve-card card hoverable">
                        <div class="card-image waves-effect waves-block waves-light">
                            <center>
                                <img class="responsive-img activator" src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" style="height: 250px; width: 250px;" id="gambarr">
                            </center>
                        </div>
                        <div class="card-content">
                            <strong><p><?php echo $perproduk['nama_produk']; ?></p></strong>
                            <?php if ($perproduk['stok_produk'] == 0) { ?>
                                <p class="red-text">Produk telah habis</p>
                            <?php } else { ?>
                                <p>Stok: <?php echo $perproduk['stok_produk'] ?></p>
                            <?php } ?>
                            <span class="harga">
                                <h5>Rp.<?php echo number_format($perproduk['harga_produk']); ?></h5>
                            </span>
                            <hr>
                            <div class="card-action">
                                <div class="row">
                                    <style>
                                        .btn-detail {
                                            margin-right: 10px; /* Atur jarak antara tombol Detail dan tombol Beli */
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col s6">
                                            <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn waves-effect waves-light red btn-small btn-detail">Detail</a>
                                        </div>
                                        <div class="col s6">
                                            <?php if ($perproduk['stok_produk'] > 0) { ?>
                                                <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn waves-effect waves-light btn-small">Beli</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
