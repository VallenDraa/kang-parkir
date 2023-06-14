<?php
$currentURL = $_SERVER['REQUEST_URI'];
?>

<!-- backdrop -->
<div id="sidebar-backdrop">
</div>

<aside id="sidebar" class="flex flex-col px-4 py-3 -translate-x-full transition-transform duration-300 ease-out shadow shadow-slate-200 w-full md:w-96 h-screen bg-slate-50 z-[15000] left-0">
  <!-- sidebar control -->
  <div class="flex items-center justify-between pb-2 border-b border-slate-300">
    <span class="pl-3 font-medium uppercase">Parkiran Dua</span>

    <div class="flex items-center gap-1">
      <button id="theme-btn" class="w-10 h-10 text-xl text-yellow-500 transition-colors duration-200 rounded-xl hover:bg-yellow-300/50 active:bg-yellow-300/60">
        <i class="fa-solid fa-lightbulb"></i>

        <!-- dark mode icon -->
        <!-- <i class="fa-regular fa-lightbulb"></i> -->
      </button>

      <button id="close-sidebar-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 rounded-xl hover:bg-red-200 active:bg-red-300">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>

  <!-- profile admin -->
  <div class="flex items-center gap-3 px-3 my-5">
    <!-- profile picture -->
    <div class="w-12 h-12 bg-blue-100 rounded-full"></div>

    <!-- nama -->
    <div class="flex flex-col">
      <span class="text-sm font-medium text-slate-400">Selamat Datang, </span>
      <span class="text-lg font-bold text-slate-900">Ujang Sumedang</span>
    </div>
  </div>

  <!-- konten sidebar -->
  <nav class="flex-grow space-y-1">
    <a href="index.php" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-xl cursor-pointer hover:bg-slate-200 <?= strpos($currentURL, "laporan") === false ? 'shadow bg-gradient-to-b from-blue-400 to-blue-500 shadow-blue-300 text-white' : "" ?>">
      <i class="<?= strpos($currentURL, "laporan") === false ? 'text-white' : 'text-slate-400' ?> fa-solid fa-house-user"></i>
      <span>Utama</span>
    </a>
    <a href="laporan.php" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-xl cursor-pointer hover:bg-slate-200 <?= strpos($currentURL, "laporan") !== false ? 'shadow bg-gradient-to-b from-blue-400 to-blue-500 shadow-blue-300 text-white' : "" ?>">
      <i class="<?= strpos($currentURL, "laporan") !== false ? 'text-white' : 'text-slate-400' ?> fa-solid fa-chart-line"></i>
      <span>Laporan</span>
    </a>

    <button class="flex items-center w-full gap-3 px-3 py-2 text-red-500 transition-colors duration-200 rounded-xl cursor-pointer hover:bg-red-200">
      <i class="fa-solid fa-arrow-right-from-bracket"></i>
      <span>Keluar</span>
    </button>
  </nav>


  <span class="block mt-auto text-xs text-center text-slate-500">&copy;<?= date("Y") ?> | Kang Parkir Ltd.</span>

</aside>