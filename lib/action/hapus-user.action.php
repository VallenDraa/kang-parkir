<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../user/hapus-user.php";
include "../motor/hapus-motor.php";
include "../motor/cari-motor.php";
include "../parkiran/hapus-parkiran.php";
include "../histori-parkiran/tambah-histori-parkiran.php";
include "../hak-akses.php";

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if (!aksesAdmin()) {
  die("Anda bukan admin !");
}

if (!isset($_POST['id-user'])) {
  die("Data yang dibutuhkan tidak diberikan !");
}

// Jika lolos cek diatas maka user bisa dihapus beserta 
// data-data milik dia yang lain
$id_user = $_POST['id-user'];
$motor_milik_user = cariMotorDariUserId($conn, $id_user);

$plat = array_map(fn ($m) => $m['plat'], $motor_milik_user);
$token_parkir_arr = array_map(fn ($m) => $m['lokasi_parkir'], $motor_milik_user);

if (
  hapusUser($conn, $id_user) &&
  hapusBanyakMotor($conn, $plat) &&
  kosongkanBanyakParkiran($conn, $token_parkir_arr) &&
  tambahHistoriKeluarParkiran($conn, $token_parkir_arr)
) {
  echo infoJs("User berhasil dihapus !", '../../admin/index.php?tab=user');
} else {
  echo infoJs("User gagal dihapus. Coba lagi nanti !", '../../admin/index.php?tab=user');
}
