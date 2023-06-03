<?php
$tab_aktif = "user";

if (isset($_GET['tab'])) {
  if ($_GET['tab'] === "user" || $_GET['tab'] === "motor") {
    $tab_aktif = $_GET['tab'];
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../components/head-tags.php"; ?>
  <title>Halaman Utama Admin</title>
</head>

<body>
  <?php include "../components/navbar-admin.php" ?>

  <div class="container mx-auto mt-12">
    <header>
      <a href="?tab=user" class="<?= $tab_aktif === "user" ? "text-blue-500" : "" ?>">User</a>
      <a href="?tab=motor" class="<?= $tab_aktif === "motor" ? "text-blue-500" : "" ?>">Motor</a>
    </header>
    <main></main>
    <footer></footer>
  </div>
</body>

</html>