<?php
session_start();
include "../db/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];
$isAdmin = isset($_POST['checklist']) ? $_POST['checklist'] : 0;

$login = mysqli_query($conn, "SELECT * FROM user where username = '$username' AND password = '$password' AND isAdmin = $isAdmin ");
$data = mysqli_fetch_array($login);

if (mysqli_affected_rows($conn) == 1) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['isAdmin'] = $data['isAdmin'];
    $_SESSION['id'] = $data['id'];

    echo "<script>alert('Anda berhasil masuk');window.location.href='../session.php';</script>";
} else {
    echo "<script>alert('Anda gagal masuk');window.location.href='../login.php';</script>";
}
?>