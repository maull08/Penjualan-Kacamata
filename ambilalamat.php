<?php
session_start();
include "koneksi.php"; // Pastikan ini mengarah ke file koneksi database yang benar

$jenis_alamat = $_POST['jenis_alamat'];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// Ambil alamat dari database berdasarkan jenis alamat
if ($jenis_alamat == 'rumah') {
    $query = $koneksi->query("SELECT alamat_rumah FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
} elseif ($jenis_alamat == 'kantor') {
    $query = $koneksi->query("SELECT alamat_kantor FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
}

$result = $query->fetch_assoc();
echo $result['alamat_rumah'] ?? $result['alamat_kantor'];
?>
