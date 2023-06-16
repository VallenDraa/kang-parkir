<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "./lib/hak-akses.php";

if (!aksesUser()) {
  header("Location: ./login.php");
}


include "config.php";
include "db/koneksi.php";
include "lib/motor/cari-motor.php";
include "components/button.php";

$halaman_aktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
$halaman_sebelumnya = 1;
$halaman_berikutnya = 1;
$total_halaman = 1;
$_SESSION["userid"] = 43;
$motor_arr = cariMotorDariUserId($conn, $_SESSION["userid"]);
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./public/js/page-js/user/index/user-index.js" defer type="module"></script>
  <title>Halaman User</title>
  <?php
  include "components/head-tags.php";
  ?>
</head>

<body>
  <?php include "components/user-sidebar.php"; ?>
  <div id="content">
    <header class="sticky top-0 z-[10000] py-2 bg-slate-50/50 backdrop-blur-lg shadow shadow-slate-300">
      <div class="flex flex-wrap items-center justify-between gap-2 px-6 mx-auto md:gap-0">
        <!-- hamburger menu -->
        <div class="basis-1/3">
          <button id="hamburger-menu-btn" type="button" class="w-10 h-10 text-2xl transition-colors duration-200 rounded-lg hover:bg-slate-200 active:bg-slate-300">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
      </div>
    </header>

    <main class="px-6 mt-8">
      <h1 class="mb-6 text-4xl font-bold text-center capitalize">Edit data user</h1>

      <form action="?php=loginproc#pos" method="post" class="relative z-10 p-10 mx-auto text-black bg-transparent w-fit">
        <div class="flex flex-col items-center gap-6 ">
          <div class="relative flex items-center pl-3 mb-3 border border-black rounded-lg">
            <i class="fa-solid fa-user"></i>

            <input type="text" id="username" placeholder="Username" class="w-full px-10 py-1 pl-4 text-lg text-black transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="px-1 -translate-x-1 scale-90 transition-all absolute left-9 top-1/2 -translate-y-9 text-sm text-black backdrop-blur-3xl z-20 peer-focus:-translate-x-8 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-black" for="username"><span>Username</span></label>
          </div>

          <div class="relative flex items-center pl-3 mb-2 border border-black rounded-lg">
            <i class="fa-solid fa-key"></i>

            <input type="password" id="pass" placeholder="Password" class="w-full px-10 py-1 pl-4 text-lg text-black transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="px-1 -translate-x-1 scale-90 transition-all absolute left-9 top-1/2 -translate-y-9 text-sm text-black  bg-transparent backdrop-blur-3xl peer-focus:-translate-x-8 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-black" for="pass"><span>Password</span></label>
          </div>

          <div class="relative flex items-center pl-3 mb-2 border border-black rounded-lg">
            <i class="fa-solid fa-key"></i>

            <input type="password lama" id="pass-lama" placeholder="Password lama" class="w-full px-10 py-1 pl-4 text-lg text-black transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

            <label class="px-1 -translate-x-1 scale-90 transition-all absolute left-9 top-1/2 -translate-y-9 text-sm text-black  bg-transparent backdrop-blur-3xl peer-focus:-translate-x-8 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-black" for="pass-lama"><span>Password Lama</span></label>
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