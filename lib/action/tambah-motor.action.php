<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../motor/cari-motor.php";
include "../motor/tambah-motor.php";
include "../parkiran/cari-parkiran.php";
include "../parkiran/tambah-parkiran.php";
include "../user/tambah-user.php";
include "../user/cari-user.php";
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

if (
  !isset($_POST['plat-motor']) ||
  !isset($_POST['token-parkiran'])
) {
  die("Tidak semua data post diberikan !");
}

$plat_motor = $_POST['plat-motor'];
$token_parkiran = $_POST['token-parkiran'];

$motor_untuk_user_baru = isset($_POST['plat-user-baru']) ? $_POST['plat-user-baru'] : 0;
$motor_untuk_user_lama = isset($_POST['plat-user-lama']) ? $_POST['plat-user-lama'] : null;

if (
  cekMotorSudahAda($conn, $plat_motor) ||
  // harus di cek pada user, karena nama default user adalah platnya
  cekUsernameSudahAda($conn, $plat_motor)
) {
  echo infoJs(
    "Motor dengan plat $plat_motor sudah ada atau user dengan username yang sama telah ada. Silahkan gunakan plat lain !",
    '../../admin/index.php'
  );
}

if (cekParkiranTerisi($conn, $token_parkiran)) {
  echo infoJs(
    "Lokasi parkir $token_parkiran sudah terisi, Silahkan pilih lokasi lain !",
    '../../admin/index.php'
  );
}

// cek masukan untuk user baru atau lama
$id_target_user =
  $motor_untuk_user_baru || !$motor_untuk_user_lama
  ? tambahUser($conn, $plat_motor)
  : userDariUsername($conn, $motor_untuk_user_lama)['id'];

// Jika lolos pengecekan lakukan tiga hal dibawah
if (
  tambahMotor($conn, $plat_motor, $token_parkiran, $id_target_user) &&
  isiParkiran($conn, $token_parkiran, $plat_motor) &&
  tambahHistoriMasukParkiran($conn, [[
    "lokasi_parkir" => $token_parkiran,
    "plat_motor" => $plat_motor
  ]])
) {
  echo infoJs(
    "Motor dengan plat $plat_motor ditambahkan dan diparkir di $token_parkiran !",
    '../../admin/index.php'
  );
} else {
  // jika tidak berhasil menambah motor untuk user baru
  // maka langsung hapus user baru, karena user baru
  // dibuat sebelum plat baru itu sendiri dibuat.
  hapusUser($conn, $id_target_user);
  hapusMotor($conn, $plat_motor);
  kosongkanParkiran($conn, $token_parkiran);

  echo infoJs(
    "Motor dengan plat $plat_motor gagal ditambahkan. Coba lagi nanti !",
    '../../admin/index.php'
  );
}

mysqli_stmt_close($stmt_tambah_motor);
mysqli_close($conn);
