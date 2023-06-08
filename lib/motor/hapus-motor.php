<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../parkiran/hapus-parkiran.php";
include "../histori-parkiran/tambah-histori-parkiran.php";

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if ($_SESSION['is_admin'] !== '1') {
  die("Anda bukan admin !");
}

if (!isset($_POST['plat-motor']) && !isset($_POST['token-parkiran'])) {
  die("Plat motor dan token parkiran tidak diberikan !");
}

$plat_motor = $_POST['plat-motor'];
$token_parkiran = $_POST['token-parkiran'];

// Jika lolos cek diatas maka motor bisa ditambahkan
$stmt_tambah_motor = mysqli_prepare(
  $conn,
  "DELETE FROM motor WHERE plat = ?"
);

mysqli_stmt_bind_param($stmt_tambah_motor, "s", $plat_motor);
mysqli_stmt_execute($stmt_tambah_motor);

if (
  mysqli_stmt_affected_rows($stmt_tambah_motor) > 0 &&
  kosongkanParkiran($conn, $token_parkiran) &&
  tambahHistoriParkiran($conn, $token_parkiran, $plat_motor, false)
) {
  echo infoJs("Motor dengan plat $plat_motor berhasil keluar !", '../../admin/index.php');
} else {
  echo infoJs("Motor dengan plat $plat_motor gagal keluar. Coba lagi nanti !", '../../admin/index.php');
}

mysqli_stmt_close($stmt_tambah_motor);
mysqli_close($conn);
