<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../db/koneksi.php";
include "../../lib/user/edit-user.php";

include "../info.php";

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if ($_SESSION['is_admin'] !== '1') {
  die("Anda bukan admin !");
}

if (
  !isset($_POST['username']) ||
  !isset($_POST['id-user'])
) {
  die("Body tidak sesuai !");
}

$id = $_POST['id-user'];
$username = $_POST['username'];
$is_admin = isset($_POST['is-admin']) ?  true : false;


if (editUserOlehAdmin($conn, $id, $username, $is_admin)) {
  echo infoJs(
    "User berhasil di edit!",
    '../../admin/index.php?tab=user'
  );
} else {
  echo infoJs(
    "User gagal di edit!",
    '../../admin/index.php?tab=user'
  );
}
