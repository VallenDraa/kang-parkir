<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "./lib/hak-akses.php";
include "lib/user/cari-user.php";

if (!aksesUser($conn)) {
  header("Location: ./login.php");
}


include "config.php";
include "db/koneksi.php";
include "lib/motor/cari-motor.php";
include "components/button.php";

$data_user = userDariId($conn, $_SESSION['id']);

?>
<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./public/js/page-js/user/index/user-index.js" defer type="module"></script>
  <?php include "components/head-tags.php"; ?>
  <title>Halaman User</title>
</head>

<body class="flex flex-col min-h-screen bg-slate-100">
  <?php include "components/user-sidebar.php"; ?>
  <div id="content" class="flex flex-col flex-grow">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-300">
      <div class="flex flex-wrap items-center justify-between gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <div class="basis-1/3">
          <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-lg hover:bg-slate-200 active:bg-slate-300">
            <i class="text-slate-400 fa-solid fa-bars"></i>
          </button>
        </div>
      </div>
    </header>

    <main class="flex flex-col items-center justify-center flex-grow h-full px-6 mt-8">
      <h1 class="mb-6 text-4xl font-bold text-center capitalize">Edit data user</h1>

      <form action="?php=loginproc#pos" method="post" class="relative z-10 p-10 mx-auto bg-transparent w-fit">
        <div class="flex flex-col items-center gap-6 ">
          <!-- username -->
          <div class="relative flex items-center pl-3 mb-3 border shadow rounded-xl shadow-slate-200 border-slate-300">
            <i class="text-slate-400 fa-solid fa-user"></i>

            <input type="text" value="<?= $data_user['username'] ?>" id="username" placeholder="Username" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 rounded-full left-9 top-1/2 backdrop-blur-sm peer-focus:-translate-x-8 peer-focus:-translate-y-8 bg-slate-100 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="username">
              Username
            </label>
          </div>

          <!-- password baru -->
          <div class="relative flex items-center pl-3 mb-3 border shadow rounded-xl shadow-slate-200 border-slate-300">
            <i class="text-slate-400 fa-solid fa-key"></i>

            <input type="password" id="password-baru" name="password-baru" placeholder="password-baru" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 rounded-full left-9 top-1/2 backdrop-blur-sm peer-focus:-translate-x-8 peer-focus:-translate-y-8 bg-slate-100 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="password-baru">
              Password Baru
            </label>
          </div>

          <!-- konfimasi password lama -->
          <div class="relative flex items-center pl-3 mb-3 border shadow rounded-xl shadow-slate-200 border-slate-300">
            <i class="text-slate-400 fa-solid fa-key"></i>

            <input type="password" id="password-lama" placeholder="password-lama" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 rounded-full left-9 top-1/2 backdrop-blur-sm peer-focus:-translate-x-8 peer-focus:-translate-y-8 bg-slate-100 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="password-lama">
              Password Lama
            </label>
          </div>

          <div class="[&>button]:w-full w-full">
            <?= Button("Ganti Data", "blue", "primary", "submit") ?>
          </div>
        </div>
      </form>
    </main>
  </div>
</body>

</html>