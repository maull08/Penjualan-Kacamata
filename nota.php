<?php 
session_start();
include "koneksi.php";

//jika tidak ada session pelanggan (belum login) maka dilarikan ke login.php
if (!isset($_SESSION['pelanggan'])) 
{
    echo "<script>alert('Anda belum login');</script>";
    echo "<script>location='login.php';</script>";
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
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Nota Pembelian</title>
</head>
<body>
    <!--Navbar-->
    <?php include "navbar.php" ?>

    <section class="konten">
        <div class="container">

            <!-- nota disini copas saja dari nota yang ada di admin -->
            <h2 align="center"><strong>NOTA PEMBELIAN</strong></h2>
            <?php 
            $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
                ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                WHERE pembelian.id_pembelian='$_GET[id]'");
            $detail = $ambil->fetch_assoc(); 
            ?>
            <!-- <pre><?php print_r($detail); ?></pre> -->
            
            <!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota yang lain -->
            <?php 
            // pelanggan yang beli harus pelanggan yang login 

            // mendapatkan id_pelanggan yang dibeli
            $idpelangganyangbeli = $detail["id_pelanggan"];

            //mendapatkan id_pelanggan yang login
            $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

            if ($idpelangganyangbeli !== $idpelangganyanglogin)
            {
                echo "<script>alert('Jangan nakal');</script>";
                echo "<script>location='riwayat.php';</script>";
                exit();
            }

            ?>
            <div class="row">
                <div class="col s12">
                    <div class="card-panel red hoverable">
                        <span class="white-text">
                            <div class="row">
                                <div class="col s4">
                                    <h5><strong>Pembelian</strong></h5>
                                    <strong>No. Pembelian :</strong> <?php echo $detail['id_pembelian']; ?><br>
                                    <strong>Tanggal :</strong> <?php echo date("d F Y", strtotime($detail['tanggal_pembelian'])); ?><br>
                                    <strong>Total : Rp.</strong> <?php echo number_format($detail['total_pembelian']) ;?><br>    
                                </div>
                                <div class="col s4">
                                    <h5><strong>Pelanggan</strong></h5>
                                    <strong>Nama Pelanggan :</strong> <?php echo $detail['nama_pelanggan']; ?><br>
                                    <strong>No. Telp :</strong> <?php echo $detail['telepon_pelanggan']; ?><br>
                                    <strong>Email :</strong> <?php echo $detail['email_pelanggan'] ;?><br>    
                                </div>
                                <div class="col s4">
                                    <h5><strong>Pengiriman</strong></h5>
                                    <strong>Alamat :</strong> <?php echo $detail['tipe']; ?> <?php echo $detail['distrik']; ?> <?php echo $detail['provinsi']; ?><br>
                                    <strong>Ekspedisi :</strong> <?php echo $detail['ekspedisi']; ?> <?php echo $detail['paket']; ?> <?php echo $detail['estimasi']; ?><br>
                                    <strong>Tipe Alamat Pengiriman :</strong> <?php echo $detail['tipe_alamat']; ?><br> <!-- Menampilkan tipe alamat yang dipilih (rumah/kantor) -->
                                    <strong>Alamat :</strong> <?php echo $detail['alamat_pengiriman']; ?><br>
                                </div>

                            </div>
                        </span>
                    </div>
                </div>
            </div>

            <table class="table centered highlight hoverable">
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA PRODUK</th>
            <th>HARGA</th>
            <th>JUMLAH</th>
            <th>BERAT PRODUK</th>
            <th>SUBTOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE id_pembelian='$_GET[id]'");
        
        $nomor = 1; // Inisialisasi nomor pembelian
        $total_berat = 0; // Inisialisasi total berat
        ?>
        <?php while ($pecah = $ambil->fetch_assoc()) { ?>
            <tr>    
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['nama']; ?></td>
                <td>Rp.<?php echo number_format($pecah['harga']); ?></td> 
                <td><?php echo $pecah['jumlah']; ?></td>
                <td><?php echo $pecah['berat_produk']; ?> gram</td> <!-- Menampilkan berat produk -->
                <td>Rp.<?php echo number_format($pecah['subharga']); ?></td>
            </tr>
            <?php 
            $nomor++; // Inkrementasi nomor pembelian
            $total_berat += $pecah['berat_produk'] * $pecah['jumlah']; // Menghitung total berat produk
            ?>
        <?php } ?>
    </tbody>
</table>
            <div class="card hoverable blue lighten-2">    
                <div class="row">
                    <div class="col-md-7">
                        <div class="alert alert-info">
                            <span class="white-text"> 
                                <h5>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?>
                                <br><strong>BANK MANDIRI 137-099103-823871 <?php echo $detail['nama_pelanggan'] ; ?></strong>
                            </h5>    
                        </span>    
                    </div>    
                </div>    
            </div>
        </div>    
        <a href="riwayat.php" class="waves-effect waves-light  btn right"><i class="material-icons left">archive</i>Riwayat Belanja</a>
        <br><br><br>
    </div>      
</section>

<?php include "footer.php" ?>
</body>
</html>
