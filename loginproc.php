<?php
session_start();
include "./db/koneksi.php";

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];

$user = mysqli_query($conn, "SELECT * FROM register where `username` = '$username' AND `password` = '$password'");
$rowcount = mysqli_num_rows($user);
$data = mysqli_fetch_array($user);

if (mysqli_num_rows($user) == 1) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['isAdmin'] = $data['isAdmin'];

    echo "<script>alert('Anda berhasil masuk');window.location.href='?module=indexuser#pos';</script>";
} else {
    echo "<script>alert('Anda gagal masuk');window.location.href='index.php';</script>";
}
?>