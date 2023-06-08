<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "../lib/admin/akses-admin.php";

if (!aksesAdmin()) {
  header("Location: ../index.php");
}

include "../db/koneksi.php";
include "../components/button.php";
include "../components/dialog.php";

include "../lib/user/tambah-user.php";
include "../lib/parkiran/cari-parkiran.php";
include "../lib/motor/cari-motor.php";
include "../lib/user/cari-user.php";


$TAB_USER = 'user';
$TAB_MOTOR = 'motor';

$tab_aktif = $TAB_MOTOR;

if (isset($_GET['tab'])) {
  if ($_GET['tab'] === $TAB_USER || $_GET['tab'] === $TAB_MOTOR) {
    $tab_aktif = $_GET['tab'];
  }
}

$semua_username = ambilSemuaUsername($conn);
$parkiran_kosong = cariParkiranKosong($conn);

if ($tab_aktif === $TAB_MOTOR) {
  $semua_motor = ambilSemuaMotor($conn);
} else {
  $semua_user = ambilSemuaDataUser($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script src="../public/js/page-js/admin/admin-index.js" defer type="module"></script>
  <title>Halaman Utama Admin</title>
</head>

<body>
  <?php include "../components/admin/navbar-admin.php" ?>

  <div class="container px-4 mx-auto mt-12">
    <header>
      <a href="?tab=user" class="<?= $tab_aktif === $TAB_USER ? "text-blue-500" : "" ?>">User</a>
      <a href="?tab=motor" class="<?= $tab_aktif === $TAB_MOTOR ? "text-blue-500" : "" ?>">Motor</a>
    </header>
    <main class="mt-10">
      <div class="flex flex-wrap justify-between gap-4">
        <h1 class="text-4xl font-bold capitalize">Tabel <?= $tab_aktif === $TAB_MOTOR ? $TAB_MOTOR : $TAB_USER ?></h1>

        <!-- admin actions -->
        <?= Button("Tambah Motor", "blue", "primary", "tambah-motor-btn")  ?>
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
                  <?= Button("Hapus", "red", "secondary") ?>
                </form>
              </li>
            <?php endforeach ?>
          <?php else : ?>
            <span>Tidak ada list motor</span>
          <?php endif ?>

        <?php else : ?>
          <?php foreach ($semua_user as $user) : ?>
            <li class="flex justify-between">
              <div>
                <span><?= $user['username']; ?></span>
                <span><?= $user['created_at']; ?></span>
              </div>

              <form id="user-edit-form" method="POST">
                <input type="hidden" name="plat-motor" value="<?= $user['id']; ?>" />
                <?= Button("Edit", "blue", "secondary") ?>
              </form>
            </li>
          <?php endforeach ?>
        <?php endif ?>
      </ul>

    </main>
    <footer></footer>
  </div>

  <dialog id="action-dialog" class='m-0 max-w-[100vw] max-h-screen md:m-auto w-screen h-screen md:rounded-lg shadow-sm md:w-[650px] md:h-max md:backdrop:backdrop-blur-sm'>
    <div>
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

      <label for="plat-user-baru" class="select-none">
        Plat untuk user baru
        <input type="checkbox" id="plat-user-baru" name="plat-user-baru">
      </label>

      <select name="plat-user-lama" class="disabled:cursor-not-allowed" <?= count($semua_username) === 0 ? "disabled" : "" ?>>
        <?php foreach ($semua_username as $username) : ?>
          <option id="opsi-user" value="<?= $username ?>"><?= $username ?></option>
        <?php endforeach ?>
      </select>

      <?= Button("Tambah", "blue", "primary", "submit-motor-btn") ?>
    </form>
  </dialog>
</body>

</html>: