<?php
include "./lib/auth.php";
session_start();
logout();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "./components/head-tags.php"; ?>
  <title>Login</title>
</head>

<body class="h-screen bg-[url('public/img/parkiran.jpg')] bg-cover relative backdrop-blur-sm">
  <div class="absolute inset-0 bg-black/60"></div>

  <div class="flex items-center justify-center h-full mx-auto">
    <form action="./lib/action/login-proc.action.php" method="post" class="relative z-10 flex flex-col items-center justify-center w-screen h-screen gap-3 p-8 rounded-md shadow-2xl text-slate-200 bg-black/50 sm:w-fit sm:h-fit">
      <div class="flex flex-col items-center justify-center gap-2">
        <i class="text-4xl fa-solid fa-circle-user"></i>
        <h2 class="mb-3 text-3xl font-medium text-center">Login</h2>
      </div>

      <div class="flex flex-col items-center w-fit">
        <div class="relative flex items-center pl-3 mb-3 border rounded-md border-slate-200">
          <i class="fa-solid fa-user"></i>

          <input type="text" id="username" name="username" placeholder="Username" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-200 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

          <label class="absolute z-20 px-1 text-sm transition-transform scale-90 -translate-x-8 -translate-y-8 rounded-full text-slate-200 left-9 top-1/2 backdrop-blur-sm peer-focus:-translate-x-8 peer-focus:-translate-y-8 bg-black/10 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-200" for="username">
            <span>Username</span>
          </label>
        </div>

        <div class="relative flex items-center pl-3 mb-2 border rounded-md border-slate-200">
          <i class="fa-solid fa-key"></i>

          <input type="password" id="password" name="password" placeholder="Password" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-200 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

          <label class="absolute px-1 text-sm transition-transform scale-90 -translate-x-8 -translate-y-8 rounded-full text-slate-200 left-9 top-1/2 backdrop-blur-sm bg-black/10 peer-focus:-translate-x-8 peer-focus:-translate-y-8 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-200" for="password">
            <span>Password</span>
          </label>
        </div>

        <div class="flex items-center gap-2 my-2 mb-2">
          <input type="checkbox" name="is-admin" id="is-admin">
          <label for="is-admin">
            Login As Admin
          </label>
        </div>

        <button class="w-full py-1 text-blue-500 transition-colors duration-200 bg-white border rounded-md active:bg-slate-300 border-slate-200 drop-shadow-lg hover:bg-slate-200 hover:text-blue-700">Login</button>
      </div>
    </form>
  </div>
</body>

</html>