<?php
session_start();

include "../lib/admin/akses-admin.php";

if (!aksesAdmin()) {
  header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include "../components/head-tags.php";
  ?>
  <title>Laporan Data Parkiran</title>
</head>

<body>
  <?php include "../components/admin/navbar-admin.php" ?>

</body>

</html>