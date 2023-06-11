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
include "../components/admin/data-motor-ekstra.php";
include "../lib/chart-data.php";

$data_tambahan = dataTambahanMotor($conn);
$kapasitas_parkiran = cekKapasitasParkiran($conn);
$data_motor_perhari = dataMotorPeriodik($conn, "hari");
$user_motor_terbanyak = userMotorTerbanyak($conn, 10);
$motor_durasi_parkir_terlama = motorDurasiParkirTerlama($conn, 10);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../components/head-tags.php"; ?>
  <script defer>
    window.kapasitasParkiran = <?= $kapasitas_parkiran ?>;
    window.dataMotorPerhari = JSON.parse('<?= json_encode($data_motor_perhari) ?>');
    window.userMotorTerbanyak = JSON.parse('<?= json_encode($user_motor_terbanyak) ?>');
    window.motorDurasiParkirTerlama = JSON.parse('<?= json_encode($motor_durasi_parkir_terlama) ?>');
  </script>
  <script src="../public/js/page-js/admin/laporan/admin-laporan.js" defer type="module"></script>
  <title>Laporan Data Parkiran</title>
</head>

<body class="bg-slate-100">
  <?php include "../components/admin/admin-sidebar.php"; ?>

  <div id="content" class="transition-transform duration-300 ease-out">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-300">
      <div class="flex flex-wrap items-center justify-between  gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-lg hover:bg-slate-200 active:bg-slate-300">
          <i class="text-slate-500 fa-solid fa-bars"></i>
        </button>
      </div>
    </header>

    <main class="px-6 mx-auto mt-4">
      <h1 class="mb-6 text-4xl font-bold capitalize">Laporan Dari Kang Parkir</h1>

      <div class="grid grid-cols-8 gap-4">

        <!-- data ekstra -->
        <div class="flex flex-col md:flex-row xl:flex-col gap-4 col-span-full xl:col-span-2 row-start-1">
          <!-- Total motor yang pernah parkir  -->
          <div class="bg-slate-50 flex-1 overflow-hidden relative shadow shadow-slate-300 p-6 rounded-lg flex gap-5">
            <div class="relative z-10">
              <span class="text-slate-500 font-medium">Total Parkir</span>
              <span class="block text-3xl font-bold text-blue-500 mb-2">
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

            <i class="absolute text-8xl top-1/2 -translate-y-1/2 right-5 text-slate-200 fa-solid fa-motorcycle self-start"></i>
          </div>

          <!-- Motor terakhir masuk -->
          <div class="bg-slate-50 flex-1 overflow-hidden relative shadow shadow-slate-300 p-6 rounded-lg flex gap-5">
            <div class="relative z-10">
              <?= DataMotorEkstra($data_tambahan['terakhir_masuk'], 'Terbaru Masuk') ?>
            </div>

            <i class="absolute text-8xl top-1/2 -translate-y-1/2 right-5 text-slate-200 fa-solid fa-arrow-right-to-bracket"></i>
          </div>

          <!-- Motor terakhir keluar  -->
          <div class="bg-slate-50 flex-1 overflow-hidden relative shadow shadow-slate-300 p-6 rounded-lg flex gap-5">
            <div class="relative z-10">
              <?= DataMotorEkstra($data_tambahan['terakhir_keluar'], 'Terbaru Keluar') ?>
            </div>

            <i class="absolute text-8xl top-1/2 -translate-y-1/2 right-5 text-slate-200 fa-solid fa-arrow-right-from-bracket"></i>
          </div>
        </div>


        <!-- kapasitas parkiran -->
        <div class="relative bg-slate-50 p-4 rounded-lg shadow shadow-slate-300 col-span-full md:col-span-3 xl:col-span-2 row-start-2 xl:row-start-1">
          <h3 class="text-2xl font-medium mb-4">Kapasitas Parkiran (%)</h3>
          <canvas id="kapasitas-parkiran"></canvas>
        </div>


        <!-- grafik batang motor per hari / bulan / tahun -->
        <div class="relative bg-slate-50 p-4 rounded-lg shadow shadow-slate-300 col-span-full md:col-span-5 xl:col-span-4 row-start-3 md:row-start-2 xl:row-start-1">
          <h3 class="text-2xl font-medium mb-4">Data Motor Perhari</h3>
          <canvas id="data-motor-perhari"></canvas>
        </div>


        <!-- top 10 user dengan motor terbanyak -->
        <!-- <div class="relative bg-slate-50 p-4 rounded-lg shadow shadow-slate-300 col-span-4">
          <h3 class="text-2xl font-medium mb-4">10 User Dengan Motor Terbanyak</h3>
          <canvas id="user-motor-terbanyak"></canvas>
        </div> -->

        <!-- top 10 motor dengan durasi parkir terlama -->
        <!-- <div class="relative bg-slate-50 p-4 rounded-lg shadow shadow-slate-300 col-span-4">
          <h3 class="text-2xl font-medium mb-4">10 Motor Dengan Durasi Parkir Terlama</h3>
          <canvas id="motor-durasi-parkir-terlama"></canvas>
        </div> -->
      </div>
    </main>

  </div>

</body>

</html>