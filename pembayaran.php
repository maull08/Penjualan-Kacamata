<?php 
//koneksi ke database
session_start();
include"koneksi.php";
if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan']))
{
  echo "<script>alert('silahkan login');</script>";
  echo "<script>location='login.php';</script>";
  exit();
} 
?>

<!-- mendapatkan id_pembelian dari url  -->
<?php 
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
// mendapatkan id pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli)
{
  echo "<script>alert('jangan nakal');</script>";
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
  <title>Pembayaran | Optik Empat Mata</title>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector('form');
      form.addEventListener('submit', function(event) {
        const fileInput = document.querySelector('input[type="file"]');
        if (!fileInput.value) {
          alert('Harap upload bukti pembayaran.');
          event.preventDefault();
        }
      });
    });
  </script>
</head>
<body>
  <!-- NAVBAR -->
  <?php include"navbar.php"; ?>
  <div class="container">
    <h2>Konfirmasi Pembayaran</h2>
    <p>Kirim bukti pembayaran anda disini</p>
    <div class="alert alert-info">
      Total tagihan anda <strong>Rp.<?php echo number_format($detpem['total_pembelian']) ?></strong>
    </div>
    <div class="row">
      <form method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="input-field required">
            <i class="material-icons prefix">assignment_ind</i>
            <input id="icon_prefix" type="text" required class="validate" name="nama" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
            <label for="icon_prefix">Nama Penyetor</label>
          </div>
          <div class="input-field required">
            <i class="material-icons prefix">credit_card</i>
            <input id="icon_email" type="text" required class="validate" name="bank" autocomplete="off">
            <label for="icon_email">Bank</label>
          </div>
          <div class="input-field required">
            <i class="material-icons prefix">done_all</i>
            <input id="icon_lock" type="number" required class="validate" name="jumlah" value="<?php echo $detpem['total_pembelian']; ?>" readonly>
            <label for="icon_lock">Jumlah</label>
          </div>
          <div class="file-field required input-field">
            <div class="btn">
              <span>File</span>
              <input type="file" name="bukti" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" required>
            </div>
          </div>
          <a href="riwayat.php" class="btn red">Kembali</a>
          <button class="btn waves-effect waves-light right" name="kirim">Kirim
            <i class="material-icons right">send</i>
          </button> <br> <br> <br>
        </div>
      </form>

      <?php 
      //jika ada tombol kirim
      if(isset($_POST["kirim"])) {
        // upload dulu foto bukti
        $namabukti = $_FILES["bukti"]["name"];
        $lokasibukti = $_FILES["bukti"]["tmp_name"];
        $namafiks = date("YmdHis") . $namabukti;
        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");

        // simpan pembayaran
        $koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti)
          VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

        // update data pembelian
        $koneksi->query("UPDATE pembelian SET status_pembelian='sudah kirim pembayaran' 
          WHERE id_pembelian='$idpem'");

        echo "<script>alert('terima kasih telah mengirimkan bukti pembayaran');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
      }
      ?>
    </div> 
  </div>
</body>
<!-- footer -->
<?php include "footer.php"; ?>
</html>
