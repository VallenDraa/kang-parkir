<?php
include "../db/koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * FROM user where `username` = '$username'");
$hasil_fetch = mysqli_fetch_assoc($login);
// var_dump($_SESSION, $hasil_fetch);

if (mysqli_num_rows($login) == 0 || ($hasil_fetch['id'] == $_SESSION['id'])) {
    $edit = "UPDATE user SET username='$_POST[username]', password='$_POST[password]' where id='$_SESSION[id]'";
    if (!mysqli_query($conn, $edit))
        die(mysqli_error($conn));
    echo "<script>alert('Selamat, data telah di update');window.location.href='../user.php';</script>";
} else {
    echo "<script>alert('Username yang dimasukan sudah terpakai');window.history.back();</script>";
};

mysqli_close($conn);
// window . location . href = 'ganti.php';