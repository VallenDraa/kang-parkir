<?php
include "../../db/koneksi.php";
include "../auth.php";
include "../info.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("File ini hanya menghandle method POST !");
}

if (
  !isset($_POST['username']) ||
  !isset($_POST['password'])
) {
  die("Data yang dibutuhkan tidak diberikan !");
}

$user_data = login($conn, $_POST['username'], $_POST['password'], isset($_POST['is-admin']) ? 1 : 0);

if (!$user_data) {
  echo infoJs("Username atau password salah !", "../../login.php");
} else {
  $_SESSION['id'] = $user_data['id'];
  $_SESSION['username'] = $user_data['username'];
  $_SESSION['is_admin'] = $user_data['is_admin'];

  echo infoJs(
    "Selamat Datang $_SESSION[username]!",
    $_SESSION['is_admin'] === 1 ? "../../admin/index.php" : "../../index.php"
  );
}
