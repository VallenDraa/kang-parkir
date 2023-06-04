<?php
include "../db/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login1 = mysqli_query($conn, "SELECT username FROM user where `username` = '$username'");
$login2 = mysqli_query($conn, "SELECT password FROM user where `password` = '$password'");
$rowcount = mysqli_num_rows($login);

if (mysqli_num_rows($login1) == 0) {
    if (mysqli_num_rows($login2) == 0) {
        $edit = "UPDATE user SET username='$_POST[username]', password='$_POST[password]' where id='$_POST[id]'";
        if (!mysqli_query($conn, $edit))
            die(mysqli_error($conn));
        echo "<script>alert('Selamat, data telah di update');window.location.href='../user.php';</script>";

        mysqli_close($conn);
    } else {
        echo "<script>alert('Password yang dimasukan sudah terpakai');window.history.back();</script>";
    };
} else {
    echo "<script>alert('Username yang dimasukan sudah terpakai');window.history.back();</script>";
};

// window . location . href = 'ganti.php';