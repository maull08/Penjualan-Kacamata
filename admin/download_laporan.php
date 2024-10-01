<?php
include '../koneksi.php'; // Sesuaikan dengan path koneksi database Anda
require_once '../vendor/autoload.php'; // Sesuaikan dengan path autoload Composer Anda

$semuadata = array();
$bulan = isset($_GET["bulan"]) ? $_GET["bulan"] : '';
$tahun = isset($_GET["tahun"]) ? $_GET["tahun"] : '';
$status = isset($_GET["status"]) ? $_GET["status"] : '';

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

$query = "
    SELECT pm.*, pl.nama_pelanggan, pr.nama_produk
    FROM pembelian pm 
    LEFT JOIN pelanggan pl ON pm.id_pelanggan = pl.id_pelanggan 
    LEFT JOIN pembelian_produk pp ON pm.id_pembelian = pp.id_pembelian 
    LEFT JOIN produk pr ON pp.id_produk = pr.id_produk 
    WHERE pm.status_pembelian='$status'";

if ($tahun) {
    if ($bulan) {
        $tanggal_mulai = "$tahun-$bulan-01";
        $tanggal_selesai = date("Y-m-t", strtotime($tanggal_mulai));
        $query .= " AND pm.tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
    } else {
        // Jika bulan tidak dipilih (Semua Bulan), hanya mempertimbangkan tahun yang dipilih
        $query .= " AND YEAR(pm.tanggal_pembelian) = '$tahun'";
    }
}

$ambil = $koneksi->query($query);
while ($pecah = $ambil->fetch_assoc()) {
    if (!empty($pecah["nama_pelanggan"]) && !empty($pecah["nama_produk"]) && !empty($pecah["tanggal_pembelian"]) && !empty($pecah["status_pembelian"]) && !empty($pecah["total_pembelian"])) {
        $semuadata[] = $pecah;
    }
}

// Generate PDF using mPDF library
$mpdf = new \Mpdf\Mpdf();

$isi = "<h2 style='text-align: center;'>LAPORAN PENJUALAN</h2>";
$isi .= "<h2 style='text-align: center;'>";

if ($bulan && $tahun) {
    $isi .= "BULAN " . $nama_bulan[$bulan] . " TAHUN " . $tahun;
} elseif ($tahun) {
    $isi .= "TAHUN " . $tahun;
} else {
    $isi .= "KESELURUHAN";
}

$isi .= "</h3>";

$isi .= "<table border='1' style='width:100%; border-collapse: collapse;'>";
$isi .= "<thead>
    <tr>
        <th style='padding: 8px;'>NO</th>
        <th style='padding: 8px;'>PELANGGAN</th>
        <th style='padding: 8px;'>PRODUK</th>
        <th style='padding: 8px;'>TANGGAL</th>
        <th style='padding: 8px;'>STATUS</th>
        <th style='padding: 8px;'>JUMLAH</th>
    </tr>
</thead>
<tbody>";

$total = 0;
foreach ($semuadata as $key => $value) {
    $total += $value["total_pembelian"];
    $nomor = $key + 1;
    $isi .= "<tr>";
    $isi .= "<td style='padding: 8px; text-align: center;'>" . $nomor . "</td>";
    $isi .= "<td style='padding: 8px; text-align: center;'>" . $value["nama_pelanggan"] . "</td>";
    $isi .= "<td style='padding: 8px; text-align: center;'>" . $value["nama_produk"] . "</td>";
    $isi .= "<td style='padding: 8px; text-align: center;'>" . date("d F Y", strtotime($value["tanggal_pembelian"])) . "</td>";
    $isi .= "<td style='padding: 8px; text-align: center;'>" . $value["status_pembelian"] . "</td>";
    $isi .= "<td style='padding: 8px; text-align: center;'>Rp. " . number_format($value["total_pembelian"]) . "</td>";
    $isi .= "</tr>";
}

$isi .= "</tbody>";
$isi .= "<tfoot>";
$isi .= "<tr>";
$isi .= "<td colspan='5' style='padding: 8px; text-align: center;'><strong>TOTAL</strong></td>";
$isi .= "<td style='padding: 8px; text-align: center;'><strong>Rp. " . number_format($total) . "</strong></td>";
$isi .= "</tr>";
$isi .= "</tfoot>";
$isi .= "</table>";

$mpdf->WriteHTML($isi);

// Output a PDF file to download
$mpdf->Output("laporan_penjualan.pdf", "D");
?>
