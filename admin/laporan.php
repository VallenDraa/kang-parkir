<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include "../lib/admin/akses-admin.php";

if (!aksesAdmin()) {
  header("Location: ../login.php");
}

include "../db/koneksi.php";
include "../config.php";

include "../components/button.php";
include "../components/admin/data-motor-ekstra.php";
include "../lib/chart-data.php";

include "../lib/parkiran/cari-parkiran.php";
include "../lib/histori-parkiran/cari-histori-parkiran.php";

// data tambahan
$data_tambahan = dataTambahanMotor($conn);
$kapasitas_parkiran = cekKapasitasParkiran($conn);
$parkiran = ambilSemuaParkiran($conn);

// data motor
$periode_data = isset($_GET["periode-data"]) ? $_GET["periode-data"] : PERIODE_HARIAN;
$data_motor_per_periode = dataMotorPeriodik($conn, $periode_data);


// data histori parkiran
$halaman_aktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
[
  'histori_arr' => $histori_arr,
  "total_halaman" => $total_halaman,
  "halaman_sebelumnya" => $halaman_sebelumnya,
  "halaman_berikutnya" => $halaman_berikutnya
] = cariHistoriParkiran($conn, $keyword, $halaman_aktif, JUMLAH_PER_HALAMAN);
?>

<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden scroll-smooth">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script defer>
    window.periodeValid = ['<?= PERIODE_HARIAN ?>', '<?= PERIODE_BULANAN ?>', '<?= PERIODE_TAHUNAN ?>'];
    window.kapasitasParkiran = JSON.parse('<?= json_encode($kapasitas_parkiran) ?>');
    window.dataMotorPerPeriode = JSON.parse('<?= json_encode($data_motor_per_periode) ?>');
    window.periodeDataAktif = '<?= $periode_data ?>';
  </script>
  <script src="../public/js/page-js/admin/laporan/admin-laporan.js" defer type="module"></script>
  <title>Laporan Data Parkiran</title>
</head>

<body class="bg-slate-100">
  <?php include "../components/admin/admin-sidebar.php"; ?>

  <div id="content">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-200">
      <div class="flex flex-wrap items-center justify-between gap-2 px-6 mx-auto lg:gap-0">
        <!-- hamburger menu -->
        <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300">
          <i class="text-slate-500 fa-solid fa-bars"></i>
        </button>

        <?= Button("PDF Laporan", "blue", "primary", "button", "print-laporan-btn")  ?>
      </div>
    </header>

    <main class="px-6 mx-auto mt-4 space-y-12">
      <h1 class="mb-4 text-4xl font-bold text-center capitalize">Data Terkini Dari Kang Parkir</h1>

      <!-- grafik dan laporan -->
      <section class="grid grid-cols-8 gap-4">
        <!-- data ekstra -->
        <div class="flex flex-col row-start-1 gap-4 lg:flex-row 2xl:flex-col col-span-full 2xl:col-span-2">
          <!-- Total motor yang pernah parkir  -->
          <div class="relative flex flex-1 gap-5 p-6 overflow-hidden shadow rounded-xl bg-slate-50 shadow-slate-200">
            <div class="relative z-10">
              <span class="font-medium text-slate-500">Total Parkir</span>
              <span class="block mb-2 text-3xl font-bold text-blue-500">
                <?= $data_tambahan['jumlah_total'] ?> Motor
              </span>

              <?php $penambahan = $data_tambahan['jumlah_motor_baru_hari_ini']; ?>
              <span class='<?= $penambahan > 0 ? "text-green-600" : "text-slate-500" ?> font-medium'>
                <?= $penambahan > 0
                  ? "Ada $penambahan motor baru hari ini."
                  : "Belum ada penambahan motor hari ini.";
                ?>
              </span>
            </div>

            <i class="absolute self-start -translate-y-1/2 text-8xl top-1/2 right-5 text-slate-200 fa-solid fa-motorcycle"></i>
          </div>

          <!-- Motor terakhir masuk -->
          <div class="relative flex flex-1 gap-5 p-6 overflow-hidden shadow rounded-xl bg-slate-50 shadow-slate-200">
            <div class="relative z-10">
              <?= DataMotorEkstra($data_tambahan['terakhir_masuk'], 'Terbaru Masuk') ?>
            </div>

            <i class="absolute -translate-y-1/2 text-8xl top-1/2 right-5 text-slate-200 fa-solid fa-arrow-right-to-bracket"></i>
          </div>

          <!-- Motor terakhir keluar  -->
          <div class="relative flex flex-1 gap-5 p-6 overflow-hidden shadow rounded-xl bg-slate-50 shadow-slate-200">
            <div class="relative z-10">
              <?= DataMotorEkstra($data_tambahan['terakhir_keluar'], 'Terbaru Keluar', false) ?>
            </div>

            <i class="absolute -translate-y-1/2 text-8xl top-1/2 right-5 text-slate-200 fa-solid fa-arrow-right-from-bracket"></i>
          </div>
        </div>

        <!-- kapasitas parkiran -->
        <div class="relative row-start-3 p-6 shadow rounded-xl bg-slate-50 shadow-slate-200 col-span-full lg:col-span-3 2xl:col-span-2 lg:row-start-2 2xl:row-start-1">
          <h3 class="mb-4 text-2xl font-medium">Kapasitas Parkiran (%)</h3>
          <canvas id="kapasitas-parkiran"></canvas>
          <span class="block mt-3 text-center text-slate-500">
            Terisi <?= $kapasitas_parkiran['jml_terisi'] ?> / <?= $kapasitas_parkiran['total_parkiran'] ?>
          </span>
        </div>

        <!-- grafik batang motor per hari / bulan / tahun -->
        <div class="relative flex flex-col row-start-2 p-6 shadow rounded-xl bg-slate-50 shadow-slate-200 col-span-full lg:col-span-5 2xl:col-span-4 lg:row-start-2 2xl:row-start-1">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-2xl font-medium">Data Motor <?= $periode_data ?></h3>

            <select id="pilihan-periode-motor" class="bg-transparent disabled:cursor-not-allowed">
              <option id="opsi-periode" <?= $periode_data === PERIODE_HARIAN ? "selected" : "" ?> value="<?= PERIODE_HARIAN ?>"><?= PERIODE_HARIAN ?></option>
              <option id="opsi-periode" <?= $periode_data === PERIODE_BULANAN ? "selected" : "" ?> value="<?= PERIODE_BULANAN ?>"><?= PERIODE_BULANAN ?></option>
              <option id="opsi-periode" <?= $periode_data === PERIODE_TAHUNAN ? "selected" : "" ?> value="<?= PERIODE_TAHUNAN ?>"><?= PERIODE_TAHUNAN ?></option>
            </select>
          </div>

          <canvas id="data-motor-perhari"></canvas>
        </div>
      </section>

      <!-- histori parkir -->
      <section>
        <h2 class="mb-4 text-4xl font-bold text-center capitalize">Histori Parkir</h2>

        <!-- search bar -->
        <form method="GET" class="relative flex items-center mb-3 border shadow rounded-xl shadow-slate-200 border-slate-300">
          <input type="hidden" value="<?= $halaman_aktif ?>" name="halaman">

          <input type="search" name="keyword" id="search-data-tabel" placeholder="Cari" value="<?= $keyword ?>" class="w-full px-4 py-2 transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

          <label class="absolute px-1 text-sm text-blue-500 transition-all scale-90 -translate-x-2 -translate-y-[30px] left-4 top-1/2 peer-placeholder-shown:text-slate-500 bg-slate-100 peer-focus:-translate-x-2 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100" for="search-data-tabel">
            Cari Motor
          </label>

          <button id="hamburger-menu-btn" class="w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-r-lg hover:bg-slate-200 active:bg-slate-300">
            <i class="fa-solid fa-search"></i>
          </button>
        </form>

        <!-- table list user atau motor -->
        <div class="mt-2 shadow rounded-xl shadow-slate-200 overflow-clip">
          <!-- tabel semi-responsive -->
          <div class="w-full overflow-auto">
            <table id="tabel-user-motor" class="w-full table-auto overflow-clip">
              <thead>
                <tr class="[&>th]:p-2 bg-slate-200 text-slate-700">
                  <th>No</th>
                  <th>Lokasi Parkir</th>
                  <th>Plat Motor</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                </tr>
              </thead>

              <tbody>
                <?php if (count($histori_arr) > 0) : ?>
                  <?php for ($i = 0; $i < count($histori_arr); $i++) : ?>
                    <tr class="[&>td]:p-2 text-center even:bg-slate-50">
                      <td><?= $i + (($halaman_aktif - 1) * JUMLAH_PER_HALAMAN) + 1 ?></td>
                      <td><?= $histori_arr[$i]['lokasi_parkir']; ?></td>
                      <td><?= $histori_arr[$i]['plat_motor']; ?></td>
                      <td><?= $histori_arr[$i]['tanggal_masuk']; ?></td>
                      <td><?= $histori_arr[$i]['tanggal_keluar'] ? $histori_arr[$i]['tanggal_keluar'] : "-" ?></td>
                    </tr>
                  <?php endfor ?>
                <?php else : ?>
                  <tr>
                    <td colspan="10" class="p-2 font-medium text-center text-slate-400">
                      Tabel Masih Kosong
                    </td>
                  </tr>
                <?php endif ?>
              </tbody>
            </table>
          </div>

          <!-- kontrol dari tabel -->
          <div class="flex items-center justify-center w-full gap-2 px-4 py-0.5 bg-slate-200">
            <?php
            $link_hal_sebelum = $halaman_sebelumnya  !== null ? "?&halaman=$halaman_sebelumnya" : "#";
            ?>

            <a href='<?= $link_hal_sebelum ?>' id="halaman-sebelumnya-btn" class="grid w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-xl place-content-center disabled:text-slate-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-slate-300 active:bg-slate-400">
              <i class="fa-solid fa-left-long"></i>
            </a>

            <span id="indikator-halaman">
              <input class="w-auto pl-2 shadow rounded-xl" type="number" min="1" max="<?= $total_halaman ?>" id="input-halaman" value="<?= $halaman_aktif ?>">
              / <?= $total_halaman ?>
            </span>

            <?php
            $link_hal_berikut = $halaman_berikutnya  !== null ? "?&halaman=$halaman_berikutnya" : "#";
            ?>

            <a href="<?= $link_hal_berikut ?>" id="halaman-berikutnya-btn" class="grid w-10 h-10 text-xl text-blue-500 transition-colors duration-200 rounded-xl place-content-center disabled:text-slate-400 disabled:hover:bg-transparent disabled:active:bg-transparent hover:bg-slate-300 active:bg-slate-400">
              <i class="fa-solid fa-right-long"></i>
            </a>
          </div>
        </div>
      </section>

      <!-- peta parkiran -->
      <section class="py-6">
        <?php include "../components/peta-parkiran.php" ?>
      </section>
    </main>
  </div>

  <dialog id="dialog">
    <div>
      <span id="dialog-title">Detail Motor</span>
      <button id="close-dialog-btn">
        <i class="drop-shadow fa fa-window-close" aria-hidden='true'></i>
      </button>
    </div>

    <?php include "../components/konten-dialog/detail-motor-terparkir.php" ?>
  </dialog>
</body>

</html>