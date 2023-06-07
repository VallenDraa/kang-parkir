<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../motor/cek-motor.php";
include "../parkiran/cek-parkiran.php";
include "../parkiran/isi-parkiran.php";
include "../user/tambah-user.php";

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if ($_SESSION['isAdmin'] !== '1') {
  die("Anda bukan admin !");
}

if (
  !isset($_POST['plat-motor']) &&
  !isset($_POST['token-parkiran']) &&
  !isset($_POST['plat-user-baru'])
) {
  die("Tidak semua data post diberikan !");
}

$plat_motor = $_POST['plat-motor'];
$token_parkiran = $_POST['token-parkiran'];
$motor_untuk_user_baru = $_POST['plat-user-baru'] ? $_POST['plat-user-baru'] : 0;

if (cekMotorSudahAda($conn, $plat_motor)) {
  echo infoJs("Motor dengan plat $plat_motor sudah ada. Silahkan gunakan plat lain !", '../../admin/index.php');
}

if (cekParkiranTerisi($conn, $token_parkiran)) {
  echo infoJs("Lokasi parkir $token_parkiran sudah terisi, Silahkan pilih lokasi lain !", '../../admin/index.php');
}

$id_target_user = "";

// cek masukan untuk user baru atau lama
if ($motor_untuk_user_baru) {
  $id_target_user = tambahUser($conn, $plat_motor);
} else {
  // $id_target_user = tambahUser($conn, $plat_motor);
}


// Jika lolos cek diatas maka motor bisa ditambahkan
$stmt_tambah_motor = mysqli_prepare(
  $conn,
  "INSERT INTO motor (plat, lokasi_parkir, id_user_pemilik) VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param(
  $stmt_tambah_motor,
  "sss",
  $plat_motor,
  $token_parkiran,
  $id_target_user
);
mysqli_stmt_execute($stmt_tambah_motor);

if (
  mysqli_stmt_affected_rows($stmt_tambah_motor) > 0 &&
  isiParkiran($conn, $token_parkiran, $plat_motor)
) {

  echo infoJs("Motor dengan plat $plat_motor ditambahkan dan diparkir di $token_parkiran !", '../../admin/index.php');
} else {
  echo infoJs("Motor dengan plat $plat_motor gagal ditambahkan. Coba lagi nanti !", '../../admin/index.php');
}

mysqli_stmt_close($stmt_tambah_motor);
mysqli_close($conn);
