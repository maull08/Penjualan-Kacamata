<?php 
$semuadata = array();
$bulan = "";
$tahun = "";
$status = "";

$nama_bulan = array(
    "01" => "JANUARI",
    "02" => "FEBRUARI",
    "03" => "MARET",
    "04" => "APRIL",
    "05" => "MEI",
    "06" => "JUNI",
    "07" => "JULI",
    "08" => "AGUSTUS",
    "09" => "SEPTEMBER",
    "10" => "OKTOBER",
    "11" => "NOVEMBER",
    "12" => "DESEMBER"
);

if (isset($_POST["kirim"])) {
    $bulan = $_POST["bulan"];
    $tahun = $_POST["tahun"];
    $status = $_POST["status"];

    $tanggal_mulai = "$tahun-$bulan-01";
    $tanggal_selesai = date("Y-m-t", strtotime($tanggal_mulai));

    $query = "
        SELECT pm.*, pl.nama_pelanggan, pr.nama_produk 
        FROM pembelian pm 
        LEFT JOIN pelanggan pl ON pm.id_pelanggan = pl.id_pelanggan 
        LEFT JOIN pembelian_produk pp ON pm.id_pembelian = pp.id_pembelian 
        LEFT JOIN produk pr ON pp.id_produk = pr.id_produk 
        WHERE pm.status_pembelian='$status'";

    if ($bulan && $tahun) {
        $query .= " AND pm.tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
    } elseif ($tahun) {
        $query .= " AND YEAR(pm.tanggal_pembelian) = '$tahun'";
    }

    $ambil = $koneksi->query($query);
    while ($pecah = $ambil->fetch_assoc()) {
        if (!empty($pecah["nama_pelanggan"]) && !empty($pecah["nama_produk"]) && !empty($pecah["tanggal_pembelian"]) && !empty($pecah["status_pembelian"]) && !empty($pecah["total_pembelian"])) {
            $semuadata[] = $pecah;
        }
    }
}
?>
<style>
.table > thead > tr > th, 
.table > tbody > tr > td {
    vertical-align: middle;
    text-align: center;
}
<style>
.container {
    text-align: center; /* Mengatur agar konten di dalam div menjadi berada di tengah */
}
</style>

<h2><center><div class="container">
LAPORAN PENJUALAN </div></center></h2>

<h2><center><div class="container">
<?php if (isset($_POST["kirim"])): ?>
    <?php 
    if ($bulan && $tahun) {
        echo "BULAN " . $nama_bulan[$bulan] . " TAHUN " . $tahun;
    } elseif ($tahun) {
        echo "TAHUN " . $tahun;
    } else {
        echo "KESELURUHAN";
    }
    ?>
<?php endif ?></div></center></h2>



<form method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>BULAN</label>
                <select class="form-control" name="bulan">
                    <option value="">Semua Bulan</option>
                    <?php foreach ($nama_bulan as $num => $nama): ?>
                        <option value="<?php echo $num; ?>"><?php echo $nama; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>TAHUN</label>
                <input type="number" class="form-control" name="tahun" value="<?php echo date('Y'); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>STATUS</label>
                <select class="form-control" name="status">
                    <option value="">Pilih Status</option>
                    <option value="Sudah Kirim Pembayaran">Sudah Kirim Pembayaran</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-primary" name="kirim">LIHAT LAPORAN</button>
        </div>
    </div>
</form>

<br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>PELANGGAN</th>
            <th>PRODUK</th>
            <th>TANGGAL</th>
            <th>STATUS</th>
            <th>JUMLAH</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($semuadata as $key => $value): ?>
            <?php $total += $value["total_pembelian"]; ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value["nama_pelanggan"]; ?></td>
                <td><?php echo $value["nama_produk"]; ?></td>
                <td><?php echo date("d F Y", strtotime($value["tanggal_pembelian"])); ?></td>
                <td><?php echo $value["status_pembelian"]; ?></td>
                <td>Rp. <?php echo number_format($value["total_pembelian"]); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="5"><strong>TOTAL</strong></td>
            <td><strong>Rp. <?php echo number_format($total); ?></strong></td>
        </tr>
    </tbody>
</table>
<a href="download_laporan.php?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun ?>&status=<?php echo $status ?>" target="_blank">Download PDF</a>