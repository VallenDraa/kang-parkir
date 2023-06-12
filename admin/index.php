<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$_SESSION['is_admin'] = "1";

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

define("TAB_USER", "user");
define("TAB_ADMIN", "admin");
define("TAB_MOTOR", "motor");

$tab_aktif = TAB_MOTOR;
$halaman_aktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";


if (isset($_GET['tab'])) {
  if (
    $_GET['tab'] === TAB_USER ||
    $_GET['tab'] === TAB_ADMIN ||
    $_GET['tab'] === TAB_MOTOR
  ) {
    $tab_aktif = $_GET['tab'];
  }
}

$semua_username = ambilSemuaUsername($conn);
$parkiran_kosong = cariParkiranKosong($conn);

if ($tab_aktif === TAB_MOTOR) {
  [
    'motor_arr' => $motor_arr,
    "total_halaman" => $total_halaman,
    "halaman_sebelumnya" => $halaman_sebelumnya,
    "halaman_berikutnya" => $halaman_berikutnya
  ] = cariMotor($conn, $keyword, $halaman_aktif, JUMLAH_PER_HALAMAN);
} else {
  [
    "user_arr" => $user_arr,
    "total_halaman" => $total_halaman,
    "halaman_sebelumnya" => $halaman_sebelumnya,
    "halaman_berikutnya" => $halaman_berikutnya
  ] = cariUser($conn, $keyword, $halaman_aktif, JUMLAH_PER_HALAMAN, $tab_aktif === TAB_ADMIN);


  $data_motor_milik_user = new stdClass();

  foreach ($user_arr as $user) {
    $data_motor_milik_user->{$user["id"]} = cariMotorDariUserId($conn, $user["id"]);
  }
}

$parkiran = ambilSemuaParkiran($conn);
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script defer>
    window.dataMotorMilikUser = JSON.parse('<?= json_encode(isset($data_motor_milik_user) ? $data_motor_milik_user : []) ?>')
    window.users = JSON.parse('<?= json_encode(isset($user_arr) ? $user_arr : []) ?>');
    window.tabAktif = "<?= $tab_aktif ?>";
    window.tabelMaksHalaman = <?= $total_halaman ?>;
  </script>
  <script src="../public/js/page-js/admin/index/admin-index.js" defer type="module"></script>
  <title>Halaman Utama Admin</title>
</head>

<body class="bg-slate-100">
  <?php include "../components/admin/admin-sidebar.php"; ?>

  <div id="content" class="transition-transform duration-300 ease-out">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-300">
      <div class="flex flex-wrap items-center justify-between gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <div class="basis-1/3">
          <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-lg hover:bg-slate-200 active:bg-slate-300">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>

        <!-- tab halaman admin -->
        <nav class="flex justify-end gap-4 text-lg md:justify-center basis-1/3">
          <a href="?tab=<?= TAB_MOTOR ?>" class="<?= $tab_aktif === TAB_MOTOR ? "text-blue-500" : "" ?>">Motor</a>
          <a href="?tab=<?= TAB_USER ?>" class="<?= $tab_aktif === TAB_USER ? "text-blue-500" : "" ?>">User</a>
          <a href="?tab=<?= TAB_ADMIN ?>" class="<?= $tab_aktif === TAB_ADMIN ? "text-blue-500" : "" ?>">Admin</a>
        </nav>

        <!-- tambah motor -->
        <div class="flex justify-end md:basis-1/3 basis-full [&>button]:w-full md:[&>button]:w-fit">
          <?= Button("Tambah Motor", "blue", "primary", "button", "tambah-motor-btn")  ?>
        </div>
      </div>
    </header>

    <main class="px-6 mx-auto mt-8">
      <h1 class="mb-6 text-4xl font-bold capitalize">Tabel <?= $tab_aktif ?></h1>

      <!-- search bar -->
      <form method="GET" class="relative flex items-center mb-3 border rounded-lg shadow border-slate-400">
        <input type="hidden" value="<?= $halaman_aktif ?>" name="halaman">
        <input type="hidden" value="<?= $tab_aktif ?>" name="tab">

        <input type="search" name="keyword" id="search-data-tabel" placeholder="Cari" value="<?= $keyword ?>" class="w-full px-4 py-2 transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

        <label class="px-1 -translate-x-2 scale-90 transition-all absolute left-4 top-1/2 -translate-y-[35px] text-sm text-blue-500 peer-placeholder-shown:text-slate-500 bg-slate-100 peer-focus:-translate-x-2 peer-focus:-translate-y-[35px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100" for="search-data-tabel">
          Cari <?= $tab_aktif ?>
        </label>

        <button id="hamburger-menu-btn" class="w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-r-lg hover:bg-slate-200 active:bg-slate-300">
          <i class="fa-solid fa-search"></i>
        </button>
      </form>

      <!-- table list user atau motor -->
      <div class="mt-2 rounded-lg shadow shadow-slate-300 overflow-clip">
        <!-- tabel semi-responsive -->
        <div class="w-full overflow-auto">
          <table id="tabel-user-motor" class="w-full table-auto overflow-clip">
            <thead>
              <tr class="[&>th]:p-2 bg-slate-200 text-slate-700">
                <th>No</th>
                <?php if ($tab_aktif === TAB_MOTOR) : ?>
                  <th>Plat</th>
                  <th>Pemilik</th>
                  <th>Lokasi Parkir</th>
                  <th>Tanggal Masuk</th>
                  <th>Action</th>
                <?php else : ?>
                  <th>Username</th>
                  <th>Jumlah Motor</th>
                  <th>Action</th>
                <?php endif ?>
              </tr>
            </thead>

            <?php if ($tab_aktif === TAB_MOTOR) : ?>
              <tbody>
                <!-- isi list motor -->
                <?php for ($i = 0; $i < count($motor_arr); $i++) : ?>
                  <tr class="[&>td]:p-2 text-center even:bg-slate-100">
                    <td><?= $i + (($halaman_aktif - 1) * JUMLAH_PER_HALAMAN) + 1 ?></td>
                    <td><?= $motor_arr[$i]['plat']; ?></td>
                    <td>
                      <?php
                      $username = '';

                      foreach ($semua_username as $user) {
                        if ($user['id'] == $motor_arr[$i]['id_user_pemilik']) {
                          $username = $user['username'];
                          break;
                        }
                      }

                      echo $username;
                      ?>
                    </td>
                    <td><?= $motor_arr[$i]['lokasi_parkir']; ?></td>
                    <td><?= $motor_arr[$i]['tanggal_masuk']; ?></td>

                    <td>
                      <form action="../lib/action/hapus-motor.action.php" id="hapus-motor-form" method="POST">
                        <input type="hidden" name="plat-motor" value="<?= $motor_arr[$i]['plat']; ?>" />
                        <input type="hidden" name="token-parkiran" value="<?= $motor_arr[$i]['lokasi_parkir']; ?>" />

                        <button id="hapus-motor-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
                          <i class="drop-shadow fa-regular fa-trash-can"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endfor ?>
              <?php else : ?>
                <!-- isi list user-->
                <?php for ($i = 0; $i < count($user_arr); $i++) : ?>
                  <tr class="[&>td]:p-2 text-center even:bg-slate-100">
                    <td><?= $i + (($halaman_aktif - 1) * JUMLAH_PER_HALAMAN) + 1 ?></td>
                    <td><?= $user_arr[$i]['username']; ?></td>
                    <td><?= $user_arr[$i]['jumlah_motor']; ?></td>
                    <td>
                      <form action="../lib/action/hapus-user.action.php" id="hapus-user-form" method="POST">
                        <input type="hidden" name="id-user" value="<?= $user_arr[$i]['id']; ?>" />

                        <!-- tombol user -->
                        <div class="flex items-center justify-center gap-2">
                          <button id="edit-user-btn" type="button" data-id-user="<?= $user_arr[$i]['id']; ?>" class="w-10 h-10 text-2xl text-blue-500 transition-colors duration-200 rounded-lg hover:bg-slate-200 active:bg-slate-300">
                            <i class="drop-shadow fa-regular fa-pen-to-square"></i>
                          </button>

                          <button id="hapus-user-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
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
        <div class="flex items-center justify-center w-full gap-2 px-4 py-0.5 bg-slate-200">
          <?php
          $link_hal_sebelum = $halaman_sebelumnya  !== null ? "?tab=$tab_aktif&halaman=$halaman_sebelumnya" : "#";
          ?>
          <a href='<?= $link_hal_sebelum ?>' id="halaman-sebelumnya-btn" class="grid w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-lg place-content-center disabled:text-slate-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-slate-300 active:bg-slate-400">
            <i class="fa-solid fa-left-long"></i>
          </a>

          <span id="indikator-halaman">
            <input class="w-auto pl-2 rounded-lg shadow" type="number" min="1" max="<?= $total_halaman ?>" id="input-halaman" value="<?= $halaman_aktif ?>">
            / <?= $total_halaman ?>
          </span>

          <?php
          $link_hal_berikut = $halaman_berikutnya  !== null ? "?tab=$tab_aktif&halaman=$halaman_berikutnya" : "#";
          ?>

          <a href="<?= $link_hal_berikut ?>" id="halaman-berikutnya-btn" class="grid w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-lg place-content-center disabled:text-slate-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-slate-300 active:bg-slate-400">
            <i class="fa-solid fa-right-long"></i>
          </a>
        </div>
      </div>

    </main>

    <footer class="px-6 mt-12">
      <?php include "../components/peta-parkiran.php" ?>
    </footer>
  </div>

  <dialog id="action-dialog">
    <div>
      <span id="dialog-title">Tambah Motor</span>
      <button id="close-action-dialog-btn">
        <i class="drop-shadow fa fa-window-close" aria-hidden='true'></i>
      </button>
    </div>

    <?php include "../components/admin/form-tambah-motor.php" ?>

    <?php if ($tab_aktif !== TAB_MOTOR) include "../components/admin/form-edit-user.php" ?>
  </dialog>

</body>

</html>