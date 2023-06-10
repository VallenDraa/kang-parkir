<?php
$currentURL = $_SERVER['REQUEST_URI'];
?>

<!-- backdrop -->
<div id="sidebar-backdrop">
</div>

<aside id="sidebar" class="flex flex-col px-4 py-3 -translate-x-full">
  <!-- sidebar control -->
  <div class="flex items-center justify-between pb-2 border-b border-gray-300">
    <span class="pl-3 font-medium uppercase">Kang Parkir</span>

    <div class="flex items-center gap-1">
      <button id="theme-btn" class="w-10 h-10 text-xl text-yellow-500 transition-colors duration-200 rounded-lg hover:bg-yellow-300/50 active:bg-yellow-300/60">
        <i class="fa-solid fa-lightbulb"></i>

        <!-- dark mode icon -->
        <!-- <i class="fa-regular fa-lightbulb"></i> -->
      </button>

      <button id="close-sidebar-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 rounded-lg hover:bg-red-200 active:bg-red-300">
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
      <span class="text-sm font-medium text-gray-400">Selamat Datang, </span>
      <span class="text-lg font-bold text-gray-900">UJANG</span>
    </div>
  </div>

  <!-- konten sidebar -->
  <nav class="flex-grow space-y-1">
    <a class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-gray-200 <?= strpos($currentURL, "index") !== false ? 'shadow bg-gradient-to-b from-blue-400 to-blue-500 shadow-blue-300 text-white' : "" ?>">
      <i class="<?= strpos($currentURL, "index") !== false ? 'text-white' : 'text-gray-400' ?> fa-solid fa-house-user"></i>
      <span>Utama</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-gray-200 <?= strpos($currentURL, "laporan") !== false ? 'shadow bg-gradient-to-b from-blue-400 to-blue-500 shadow-blue-300 text-white' : "" ?>">
      <i class="<?= strpos($currentURL, "laporan") !== false ? 'text-white' : 'text-gray-400' ?> fa-solid fa-chart-line"></i>
      <span>Laporan</span>
    </a>
    <a class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-gray-200">
      <i class="text-gray-400 fa-solid fa-file-pdf"></i>
      <span>Download PDF</span>
    </a>
  </nav>


  <span class="block mt-auto text-xs text-center text-gray-500">&copy;<?= date("Y") ?> | Kang Parkir Ltd.</span>

</aside>