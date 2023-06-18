<?php
$currentURL = $_SERVER['REQUEST_URI'];


function activeMenu(bool $kondisi)
{
  return $kondisi ? 'shadow bg-gradient-to-b from-blue-400 to-blue-500 shadow-blue-300 text-white' : "dark:text-slate-300";
}

function activeIcon(bool $kondisi)
{
  return $kondisi ? 'text-white' : 'text-slate-500';
}
?>

<aside id="sidebar" class="flex flex-col pb-2 print:hidden fixed shadow shadow-slate-300 dark:shadow-slate-800 w-full md:w-80 h-screen bg-slate-50 dark:bg-slate-900 z-[15000] left-0">
  <!-- sidebar control -->
  <div class="flex items-center justify-between px-4 py-2 border-b border-slate-300 dark:border-slate-600">
    <span class="pl-3 font-medium uppercase dark:text-slate-100">Kang Parkir</span>

    <div class="flex items-center gap-1">
      <button id="tema-btn" class="w-10 h-10 text-xl text-yellow-500 transition-colors duration-200 dark:text-slate-500 rounded-xl hover:bg-yellow-300/50 active:bg-yellow-300/60 dark:hover:bg-slate-700 dark:active:bg-slate-800">
        <i id="icon-tema" class="fa-solid fa-lightbulb"></i>
      </button>

      <button id="close-sidebar-btn" class="w-10 h-10 text-2xl text-red-500 transition-colors duration-200 md:hidden rounded-xl hover:bg-red-200 active:bg-red-300">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
  </div>

  <!-- profile admin -->
  <div class="flex items-center gap-3 my-5 px-7">
    <!-- profile picture -->
    <i class="text-5xl fa-solid fa-circle-user text-slate-300"></i>

    <!-- nama -->
    <div class="flex flex-col">
      <span class="text-sm font-medium text-slate-500">Selamat Datang, </span>
      <span class="text-lg font-bold text-slate-900 dark:text-slate-100"><?= $_SESSION['username'] ?></span>
    </div>
  </div>

  <!-- konten sidebar -->
  <nav class="flex-grow px-4 space-y-1">
    <details <?= isset($tab_aktif) ? "open" : "" ?>>
      <summary class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-800 dark:text-slate-300">
        <i class="w-4 text-slate-500 fa-solid fa-house-user"></i>
        <span>Utama</span>
      </summary>

      <div class="pl-1.5 ml-2.5 border-l border-slate-300 dark:border-slate-700">
        <a href="index.php?tab=<?= TAB_USER ?>" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-800 <?= activeMenu(isset($tab_aktif) && $tab_aktif === TAB_USER) ?>">
          <i class="<?= activeIcon(isset($tab_aktif) && $tab_aktif === TAB_USER) ?> w-4 fa-solid fa-user"></i>
          <span>User</span>
        </a>
        <a href="index.php?tab=<?= TAB_ADMIN ?>" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-800 <?= activeMenu(isset($tab_aktif) && $tab_aktif === TAB_ADMIN) ?>">
          <i class="<?= activeIcon(isset($tab_aktif) && $tab_aktif === TAB_ADMIN) ?> w-4 fa-solid fa-key"></i>
          <span>Admin</span>
        </a>
        <a href="index.php?tab=<?= TAB_MOTOR ?>" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-800 <?= activeMenu(isset($tab_aktif) && $tab_aktif === TAB_MOTOR) ?>">
          <i class="<?= activeIcon(isset($tab_aktif) && $tab_aktif === TAB_MOTOR) ?> w-4 fa-solid fa-motorcycle"></i>
          <span>Motor</span>
        </a>
      </div>
    </details>

    <a href="laporan.php" class="flex items-center gap-3 px-3 py-2 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-800 <?= activeMenu(strpos($currentURL, "laporan") !== false) ?>">
      <i class="<?= activeIcon(strpos($currentURL, "laporan") !== false) ?> w-4 fa-solid fa-chart-line"></i>
      <span>Laporan</span>
    </a>

    <form action="../lib/action/logout-proc.action.php" method="GET">
      <button class="flex items-center w-full gap-3 px-3 py-2 text-red-500 transition-colors duration-200 rounded-lg cursor-pointer hover:bg-red-200">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Keluar</span>
      </button>
    </form>
  </nav>


  <span class="block mt-auto text-xs text-center text-slate-500">&copy;<?= date("Y") ?> | Kang Parkir Ltd.</span>

</aside>