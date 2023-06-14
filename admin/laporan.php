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
include "../components/admin/data-motor-ekstra.php";
include "../lib/chart-data.php";

include "../lib/parkiran/cari-parkiran.php";

$data_tambahan = dataTambahanMotor($conn);
$kapasitas_parkiran = cekKapasitasParkiran($conn);
$parkiran = ambilSemuaParkiran($conn);

$periode_data = isset($_GET["periode-data"]) ? $_GET["periode-data"] : PERIODE_HARIAN;
$data_motor_per_periode = dataMotorPeriodik($conn, $periode_data);
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

  <div id="content" class="transition-all duration-300 ease-out">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-200">
      <div class="flex flex-wrap items-center justify-between gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300">
          <i class="text-slate-500 fa-solid fa-bars"></i>
        </button>

        <?= Button("PDF Laporan", "blue", "primary", "button", "print-laporan-btn")  ?>
      </div>
    </header>

    <main class="px-6 mx-auto mt-4">
      <h1 class="mb-6 text-4xl font-bold capitalize">Data Terkini Dari Kang Parkir</h1>

      <section class="grid grid-cols-8 gap-4">
        <!-- data ekstra -->
        <div class="flex flex-col row-start-1 gap-4 md:flex-row 2xl:flex-col col-span-full 2xl:col-span-2">
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
        <div class="relative row-start-3 p-6 shadow rounded-xl bg-slate-50 shadow-slate-200 col-span-full md:col-span-3 2xl:col-span-2 md:row-start-2 2xl:row-start-1">
          <h3 class="mb-4 text-2xl font-medium">Kapasitas Parkiran (%)</h3>
          <canvas id="kapasitas-parkiran"></canvas>
          <span class="block mt-3 text-center text-slate-500">
            Terisi <?= $kapasitas_parkiran['jml_terisi'] ?> / <?= $kapasitas_parkiran['total_parkiran'] ?>
          </span>
        </div>


        <!-- grafik batang motor per hari / bulan / tahun -->
        <div class="relative row-start-2 p-6 shadow rounded-xl bg-slate-50 shadow-slate-200 col-span-full md:col-span-5 2xl:col-span-4 md:row-start-2 2xl:row-start-1">
          <div class="flex justify-between">
            <h3 class="mb-4 text-2xl font-medium">Data Motor <?= $periode_data ?></h3>

            <select id="pilihan-periode-motor" class="bg-transparent rounded-xl disabled:cursor-not-allowed">
              <option id="opsi-periode" <?= $periode_data === PERIODE_HARIAN ? "selected" : "" ?> value="<?= PERIODE_HARIAN ?>"><?= PERIODE_HARIAN ?></option>
              <option id="opsi-periode" <?= $periode_data === PERIODE_BULANAN ? "selected" : "" ?> value="<?= PERIODE_BULANAN ?>"><?= PERIODE_BULANAN ?></option>
              <option id="opsi-periode" <?= $periode_data === PERIODE_TAHUNAN ? "selected" : "" ?> value="<?= PERIODE_TAHUNAN ?>"><?= PERIODE_TAHUNAN ?></option>
            </select>
          </div>

          <canvas id="data-motor-perhari"></canvas>
        </div>
      </section>

      <section class="px-6 mt-12">
        <?php include "../components/peta-parkiran.php" ?>
      </section>
    </main>

  </div>

</body>

</html>