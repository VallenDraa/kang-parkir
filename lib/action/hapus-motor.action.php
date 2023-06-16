<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../motor/hapus-motor.php";
include "../user/cari-user.php";
include "../parkiran/hapus-parkiran.php";
include "../histori-parkiran/tambah-histori-parkiran.php";
include "../hak-akses.php";

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if (!aksesAdmin($conn)) {
  die("Anda bukan admin !");
}

if (!isset($_POST['plat-motor']) || !isset($_POST['token-parkiran'])) {
  die("Data yang dibutuhkan tidak diberikan !");
}

$plat_motor = $_POST['plat-motor'];
$token_parkiran = $_POST['token-parkiran'];

// Jika lolos cek diatas maka motor bisa ditambahkan
if (
  hapusMotor($conn, $plat_motor) &&
  kosongkanParkiran($conn, $token_parkiran) &&
  tambahHistoriKeluarParkiran($conn, [$token_parkiran])
) {
  echo infoJs("Motor dengan plat $plat_motor berhasil keluar !", '../../admin/index.php');
} else {
  echo infoJs("Motor dengan plat $plat_motor gagal keluar. Coba lagi nanti !", '../../admin/index.php');
}
