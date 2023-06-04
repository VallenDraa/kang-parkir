<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../db/koneksi.php";
include "../components/button.php";
include "../components/dialog.php";

include "../lib/parkiran/cari-parkiran-kosong.php";
include "../lib/motor/ambil-motor.php";

session_start();

$_SESSION['isAdmin'] = "1";

$TAB_USER = 'user';
$TAB_MOTOR = 'motor';

$tab_aktif = $TAB_MOTOR;

if (isset($_GET['tab'])) {
  if ($_GET['tab'] === $TAB_USER || $_GET['tab'] === $TAB_MOTOR) {
    $tab_aktif = $_GET['tab'];
  }
}


if ($tab_aktif === $TAB_MOTOR) {
  $parkiran_kosong = cariParkiranKosong($conn);
  $semua_motor = ambilSemuaMotor($conn);
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script src="../public/js/page-js/admin-index.js" defer type="module"></script>
  <title>Halaman Utama Admin</title>
</head>

<body>
  <?php include "../components/admin/navbar-admin.php" ?>

  <div class="container mx-auto mt-12">
    <header>
      <a href="?tab=user" class="<?= $tab_aktif === $TAB_USER ? "text-blue-500" : "" ?>">User</a>
      <a href="?tab=motor" class="<?= $tab_aktif === $TAB_MOTOR ? "text-blue-500" : "" ?>">Motor</a>
    </header>
    <main class="mt-10">
      <div class="flex justify-between">
        <h1 class="text-4xl font-bold capitalize">Tabel <?= $tab_aktif === $TAB_MOTOR ? $TAB_MOTOR : $TAB_USER ?></h1>

        <!-- admin actions -->
        <?= $tab_aktif === $TAB_MOTOR ?  Button("Tambah Motor", "green", "tambah-motor-btn") : "" ?>
      </div>

      <ul class="mt-8 space-y-4">
        <?php if ($tab_aktif === $TAB_MOTOR) : ?>

          <!-- isi list motor -->
          <?php if (count($semua_motor) > 0) : ?>
            <?php foreach ($semua_motor as $motor) : ?>
              <li class="flex justify-between">
                <div>
                  <span><?= $motor['plat']; ?></span>
                  <span><?= $motor['lokasi_parkir']; ?></span>
                  <span><?= $motor['tanggal_masuk']; ?></span>
                </div>

                <form action="../lib/motor/hapus-motor.php" id="hapus-motor-form" method="POST">
                  <input type="hidden" name="plat-motor" value="<?= $motor['plat']; ?>" />
                  <input type="hidden" name="token-parkiran" value="<?= $motor['lokasi_parkir']; ?>" />
                  <?= Button("Hapus", "red", null) ?>
                </form>
              </li>
            <?php endforeach ?>
          <?php else : ?>
            <span>Tidak ada list motor</span>
          <?php endif ?>

        <?php else : ?>
          <!-- isi list user -->
        <?php endif ?>
      </ul>

    </main>
    <footer></footer>
  </div>

  <dialog id="action-dialog" class='m-0 max-w-[100vw] max-h-[100vh] md:m-auto w-screen h-screen rounded-md shadow-sm md:w-[650px] md:h-max md:backdrop:backdrop-blur-sm'>
    <div class="bg-gray-100">
      <span>Tambah Motor</span>
      <button id="close-action-dialog-btn">
        <i class="fa fa-window-close" aria-hidden='true'></i>
      </button>
    </div>

    <form action="../lib/motor/tambah-motor.php" method="POST">
      <input required="true" type="text" name="plat-motor" placeholder="Plat Motor" />
      <select name="token-parkiran">
        <?php foreach ($parkiran_kosong as $token) : ?>
          <option value="<?= $token ?>"><?= $token ?></option>
        <?php endforeach ?>
      </select>

      <?= Button("Tambah", "green", "submit-motor-btn") ?>
    </form>
  </dialog>
</body>

</html>