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

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if ($_SESSION['is_admin'] !== '1') {
  die("Anda bukan admin !");
}

if (!isset($_POST['id-user'])) {
  die("Plat motor dan token parkiran tidak diberikan !");
}

// Jika lolos cek diatas maka user bisa dihapus beserta 
// data-data milik dia yang lain
$id_user = $_POST['id-user'];
$motor_milik_user = cariMotorDariUserId($conn, $id_user);

$plat = array_map(fn ($m) => $m['plat'], $motor_milik_user);
$token_parkir_arr = array_map(fn ($m) => $m['lokasi_parkir'], $motor_milik_user);
$motor_tanpa_tgl_masuk  = array_map(
  fn ($data) => [
    'plat_motor' => $data['plat'],
    'lokasi_parkir' => $data['lokasi_parkir']
  ],
  $motor_milik_user
);

if (
  hapusUser($conn, $id_user) &&
  hapusBanyakMotor($conn, $plat) &&
  kosongkanBanyakParkiran($conn, $token_parkir_arr) &&
  tambahBanyakHistoriParkiran($conn, $motor_tanpa_tgl_masuk, false)
) {
  echo infoJs("User berhasil dihapus !", '../../admin/index.php');
} else {
  echo infoJs("User gagal dihapus. Coba lagi nanti !", '../../admin/index.php');
}
