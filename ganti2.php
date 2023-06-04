<?php
include "db/koneksi.php";
$edit = "UPDATE user SET username='$_POST[username]', password='$_POST[password]' where id='$_POST[id]'";

if (!mysqli_query($conn, $edit))
    die(mysqli_error($conn));
echo "<script>alert('Selamat, data telah di update');window.location.href='user.php';</script>";

mysqli_close($conn);
