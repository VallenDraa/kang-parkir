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

if (!aksesUser($conn)) {
  die("Anda belum login !");
}

if (
  !isset($_POST['username']) ||
  !isset($_POST['password-lama']) ||
  !isset($_POST['id-user'])
) {
  die("Data yang dibutuhkan tidak diberikan !");
}


$id = $_POST['id-user'];
$username = $_POST['username'];
$pw_lama = $_POST['password-lama'];
$pw_baru =
  isset($_POST['password-baru']) && $_POST['password-baru'] !== ""
  ? $_POST['password-baru']
  : null;


if ($target_user = userDariId($conn, $id)) {
  if (
    $target_user['username'] !== $username &&
    cekUsernameSudahAda($conn, $username)
  ) {
    echo infoJs(
      "Username yang baru sudah digunakan user lain !",
      "../../pengaturan-user.php"
    );
  }
}


if (editUser($conn, $id, $username, $pw_lama, $pw_baru)) {
  // jika berhasil di edit update session
  $_SESSION['username'] = $username;

  echo infoJs(
    "User berhasil di edit !",
    "../../pengaturan-user.php"
  );
} else {
  echo infoJs(
    "User gagal di edit !",
    "../../pengaturan-user.php"
  );
}
