<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "../lib/admin/akses-admin.php";
include "../config.php";

if (!aksesAdmin()) {
  header("Location: ../index.php");
}

include "../db/koneksi.php";
include "../components/button.php";

include "../lib/user/tambah-user.php";
include "../lib/parkiran/cari-parkiran.php";
include "../lib/motor/cari-motor.php";
include "../lib/user/cari-user.php";

$TAB_USER = 'user';
$TAB_MOTOR = 'motor';

$tab_aktif = $TAB_MOTOR;
$halaman_aktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";


if (isset($_GET['tab'])) {
  if ($_GET['tab'] === $TAB_USER || $_GET['tab'] === $TAB_MOTOR) {
    $tab_aktif = $_GET['tab'];
  }
}

$semua_username = ambilSemuaUsername($conn);
$parkiran_kosong = cariParkiranKosong($conn);

if ($tab_aktif === $TAB_MOTOR) {
  [
    'motors' => $motor_arr,
    "total_halaman" => $total_halaman,
    "halaman_sebelumnya" => $halaman_sebelumnya,
    "halaman_berikutnya" => $halaman_berikutnya
  ] = cariMotor($conn, $keyword, $halaman_aktif, JUMLAH_PER_HALAMAN);
} else {
  [
    "users" => $user_arr,
    "total_halaman" => $total_halaman,
    "halaman_sebelumnya" => $halaman_sebelumnya,
    "halaman_berikutnya" => $halaman_berikutnya
  ] = cariUser($conn, $keyword, $halaman_aktif, JUMLAH_PER_HALAMAN);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script defer>
    window.users = JSON.parse('<?= json_encode(isset($user_arr) ? $user_arr : []) ?>');
    window.tabAktif = "<?= $tab_aktif ?>";
    window.tabelMaksHalaman = <?= $total_halaman ?>;
  </script>
  <script src="../public/js/page-js/admin/admin-index.js" defer type="module"></script>
  <title>Halaman Utama Admin</title>
</head>

<body class="bg-gray-50">
  <div id="content" class="transition-transform duration-200">
    <header class="sticky top-0 z-[10000] py-2 bg-gray-50/50 backdrop-blur-lg">
      <div class="flex flex-wrap items-center justify-between max-w-screen-xl gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <div class="basis-1/3">
          <button id="hamburger-menu-btn" type="button" class="px-3 py-2 text-2xl transition-colors duration-200 rounded-lg hover:bg-gray-200 active:bg-gray-300">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>

        <!-- tab halaman admin -->
        <nav class="flex justify-end gap-4 text-lg md:justify-center basis-1/3">
          <a href="?tab=user" class="<?= $tab_aktif === $TAB_USER ? "text-blue-500" : "" ?>">User</a>
          <a href="?tab=motor" class="<?= $tab_aktif === $TAB_MOTOR ? "text-blue-500" : "" ?>">Motor</a>
        </nav>

        <!-- tambah motor -->
        <div class="flex justify-end md:basis-1/3 basis-full [&>button]:w-full md:[&>button]:w-fit">
          <?= Button("Tambah Motor", "blue", "primary", "button", "tambah-motor-btn")  ?>
        </div>
      </div>
    </header>

    <main class="max-w-screen-xl px-6 mx-auto mt-4">
      <h1 class="mb-6 text-3xl font-bold capitalize">Tabel <?= $tab_aktif === $TAB_MOTOR ? $TAB_MOTOR : $TAB_USER ?></h1>

      <!-- search bar -->
      <form method="GET" class="relative flex items-center mb-3 border border-gray-400 rounded-lg shadow">
        <input type="hidden" value="<?= $halaman_aktif ?>" name="halaman">
        <input type="hidden" value="<?= $tab_aktif ?>" name="tab">

        <input type="search" name="keyword" id="search-data-tabel" placeholder="Cari" class="w-full px-4 py-2 transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

        <label class="px-1 -translate-x-2 scale-90 transition-all absolute left-4 top-1/2 -translate-y-[35px] text-sm text-blue-500 peer-placeholder-shown:text-gray-500 bg-gray-50 peer-focus:-translate-x-2 peer-focus:-translate-y-[35px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100" for="search-data-tabel">
          Cari <?= $tab_aktif ?>
        </label>

        <button id="hamburger-menu-btn" class="px-3 py-2 text-xl text-blue-500 transition-colors duration-200 rounded-r-lg hover:bg-gray-200 active:bg-gray-300">
          <i class="fa-solid fa-search"></i>
        </button>

      </form>

      <!-- table list user atau motor -->
      <div class="mt-2 rounded-lg shadow shadow-gray-300 overflow-clip">
        <!-- tabel semi-responsive -->
        <div class="w-full overflow-auto">
          <table id="tabel-user-motor" class="w-full table-auto overflow-clip">
            <thead>
              <tr class="[&>th]:p-2 bg-gray-200 text-gray-700">
                <th>No</th>
                <?php if ($tab_aktif === $TAB_MOTOR) : ?>
                  <th>Plat</th>
                  <th>Pemilik</th>
                  <th>Tanggal Masuk</th>
                  <th>Action</th>
                <?php else : ?>
                  <th>Username</th>
                  <th>Jumlah Motor</th>
                  <th>Action</th>
                <?php endif ?>
              </tr>
            </thead>

            <?php if ($tab_aktif === $TAB_MOTOR) : ?>
              <tbody>
                <!-- isi list motor -->
                <?php for ($i = 0; $i < count($motor_arr); $i++) : ?>
                  <tr class="[&>td]:p-2 text-center even:bg-gray-100">
                    <td><?= $i + (($halaman_aktif - 1) * JUMLAH_PER_HALAMAN) + 1 ?></td>
                    <td><?= $motor_arr[$i]['plat']; ?></td>
                    <td><?= $motor_arr[$i]['lokasi_parkir']; ?></td>
                    <td><?= $motor_arr[$i]['tanggal_masuk']; ?></td>

                    <td>
                      <form action="../lib/action/hapus-motor.action.php" id="hapus-motor-form" method="POST">
                        <input type="hidden" name="plat-motor" value="<?= $motor_arr[$i]['plat']; ?>" />
                        <input type="hidden" name="token-parkiran" value="<?= $motor_arr[$i]['lokasi_parkir']; ?>" />

                        <div class="flex items-center justify-center gap-2">
                          <button id="info-motor-btn" type="button" class="px-3 py-2 text-2xl text-blue-500 transition-colors duration-200 rounded-lg hover:bg-gray-200 active:bg-gray-300">
                            <i class="drop-shadow fa-solid fa-circle-info"></i>
                          </button>
                          <button id="hapus-motor-btn" class="px-3 py-2 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
                            <i class="drop-shadow fa-regular fa-trash-can"></i>
                          </button>
                        </div>
                      </form>
                    </td>
                  </tr>
                <?php endfor ?>
              <?php else : ?>
                <!-- isi list user-->
                <?php for ($i = 0; $i < count($user_arr); $i++) : ?>
                  <tr class="[&>td]:p-2 text-center even:bg-gray-100">
                    <td><?= $i + (($halaman_aktif - 1) * JUMLAH_PER_HALAMAN) + 1 ?></td>
                    <td><?= $user_arr[$i]['username']; ?></td>
                    <td><?= $user_arr[$i]['jumlah_motor']; ?></td>
                    <td>
                      <form action="../lib/action/hapus-user.action.php" id="hapus-user-form" method="POST">
                        <input type="hidden" name="id-user" value="<?= $user_arr[$i]['id']; ?>" />

                        <!-- tombol user -->
                        <div class="flex items-center justify-center gap-2">
                          <button id="edit-user-btn" type="button" data-id-user="<?= $user_arr[$i]['id']; ?>" class="px-3 py-2 text-2xl text-blue-500 transition-colors duration-200 rounded-lg hover:bg-gray-200 active:bg-gray-300">
                            <i class="drop-shadow fa-regular fa-pen-to-square"></i>
                          </button>

                          <button id="hapus-user-btn" class="px-3 py-2 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
                            <i class="drop-shadow fa-regular fa-trash-can"></i>
                          </button>
                        </div>
                      </form>
                    </td>
                  </tr>
                <?php endfor ?>
              <?php endif ?>
              </tbody>
          </table>

        </div>

        <!-- kontrol dari tabel -->
        <div class="flex items-center justify-center w-full gap-2 px-4 py-0.5 bg-gray-200">
          <?php
          $link_hal_sebelum = $halaman_sebelumnya  !== null ? "?tab=$tab_aktif&halaman=$halaman_sebelumnya" : "#";
          ?>
          <a href='<?= $link_hal_sebelum ?>' id="halaman-sebelumnya-btn" class="px-3 py-2 text-xl text-blue-500 transition-colors duration-200 rounded-lg disabled:text-gray-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-gray-300 active:bg-gray-400">
            <i class="fa-solid fa-left-long"></i>
          </a>

          <span id="indikator-halaman">
            <input class="w-auto pl-2 rounded-lg shadow" type="number" min="1" max="<?= $total_halaman ?>" id="input-halaman" value="<?= $halaman_aktif ?>">
            / <?= $total_halaman ?>
          </span>

          <?php
          $link_hal_berikut = $halaman_berikutnya  !== null ? "?tab=$tab_aktif&halaman=$halaman_berikutnya" : "#";
          ?>

          <a href="<?= $link_hal_berikut ?>" id="halaman-berikutnya-btn" class="px-3 py-2 text-xl text-blue-500 transition-colors duration-200 rounded-lg disabled:text-gray-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-gray-300 active:bg-gray-400">
            <i class="fa-solid fa-right-long"></i>
          </a>
        </div>
      </div>

    </main>
    <footer></footer>
  </div>

  <dialog id="action-dialog">
    <div>
      <span id="dialog-title">Tambah Motor</span>
      <button id="close-action-dialog-btn">
        <i class="drop-shadow fa fa-window-close" aria-hidden='true'></i>
      </button>
    </div>

    <?php include "../components/admin/form-tambah-motor.php" ?>
    <?php include "../components/admin/form-edit-user.php" ?>
  </dialog>
</body>

</html>: