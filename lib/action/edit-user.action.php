<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../../lib/user/edit-user.php";
include "../../lib/user/cari-user.php";
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

if (
  !isset($_POST['username']) ||
  !isset($_POST['password-baru']) ||
  !isset($_POST['password-lama']) ||
  !isset($_POST['id-user'])
) {
  die("Data yang dibutuhkan tidak diberikan !");
}

$id = $_POST['id-user'];
$username = $_POST['username'];
$pw_lama = $_POST['password-lama'];
$pw_baru = $_POST['password-baru'];

if (editUser($conn, $id, $username, $pw_lama, $pw_baru)) {
  echo infoJs(
    "User berhasil di edit!",
    "../../pengaturan-user.php"
  );
} else {
  echo infoJs(
    "User gagal di edit!",
    "../../pengaturan-user.php"
  );
}
