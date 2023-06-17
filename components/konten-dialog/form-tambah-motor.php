 <form action="../lib/action/tambah-motor.action.php" id="form-tambah-motor" method="POST" class="flex flex-col gap-3 mt-5">
   <!-- Plat motor dan lokasi parkir -->
   <div class="flex gap-2">
     <!-- Plat motor  -->
     <div class="relative flex items-center flex-grow pl-3 mb-2 border rounded-lg shadow shadow-slate-200 border-slate-300 dark:border-slate-700 dark:shadow-slate-700">
       <i class="w-5 text-slate-500 fa-solid fa-motorcycle"></i>

       <input type="text" name="plat-motor" required id="plat-motor" placeholder="plat-motor" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 dark:text-slate-200 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

       <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 bg-white rounded-full dark:text-blue-400 left-9 top-1/2 backdrop-blur-sm peer-focus:-translate-x-8 peer-focus:-translate-y-8 dark:bg-slate-900 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="plat-motor">
         Nomor Plat & Lokasi Parkir
       </label>
     </div>

     <!-- lokasi parkir -->
     <select id="token-parkiran" name="token-parkiran" class="h-full p-2 text-lg bg-transparent border rounded-lg shadow outline-none text-slate-800 dark:text-slate-200 shadow-slate-200 border-slate-300 dark:border-slate-700 dark:shadow-slate-700">
       <?php foreach ($parkiran_kosong as $token) : ?>
         <option value="<?= $token ?>" class="text-slate-800 dark:text-slate-200 dark:bg-slate-900"><?= $token ?></option>
       <?php endforeach ?>
     </select>
   </div>

   <!-- pilihan motor untuk siapa -->
   <div class="flex flex-col gap-5 mb-2">
     <div class="relative flex items-center pl-3 border rounded-lg shadow shadow-slate-200 border-slate-300 dark:border-slate-700 dark:shadow-slate-700">
       <i class="w-5 fa-solid fa-user text-slate-500"></i>

       <select id="plat-user-lama" name="plat-user-lama" class="flex-grow h-full px-2 py-3 text-lg bg-transparent outline-none peer text-slate-800 dark:text-slate-200 disabled:cursor-not-allowed" <?= count($semua_username) === 0 ? "disabled" : "" ?>>
         <?php foreach ($semua_username as $user) : ?>
           <option id="opsi-user" class="text-slate-800 dark:text-slate-200 dark:bg-slate-900" value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
         <?php endforeach ?>
       </select>

       <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 bg-white rounded-full dark:text-blue-400 peer-disabled:text-slate-400 dark:disabled:text-slate-600 left-9 top-1/2 dark:bg-slate-900" id="plat-user-lama">
         Pemilik Motor
       </label>
     </div>

     <!-- pembatas -->
     <div class="relative w-11/12 mx-auto border rounded-full border-slate-200 dark:border-slate-800">
       <span class="absolute px-2 text-sm -translate-x-1/2 -translate-y-1/2 bg-white dark:bg-slate-900 text-slate-500 left-1/2 top-1/2">Atau</span>
     </div>

     <label for="plat-user-baru" class="flex items-center self-center gap-2 text-lg font-medium select-none text-slate-500">
       <input type="checkbox" id="plat-user-baru" name="plat-user-baru" class="scale-105">
       Plat untuk user baru
     </label>
   </div>

   <div class="flex-grow">
     <button id="submit-motor-btn" class="w-full px-5 py-1 text-white transition-opacity duration-200 rounded-md shadow bg-gradient-to-b disabled:opacity-50 from-blue-400 to-blue-500 shadow-blue-300 hover:opacity-70 active:opacity-95 active:shadow-none">
       Tambah
     </button>
   </div>
 </form>