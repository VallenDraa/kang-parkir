 <form action="../lib/action/tambah-motor.action.php" id="form-tambah-motor" method="POST" class="flex flex-col gap-3 mt-5">

   <!-- Plat motor dan lokasi parkir -->
   <div class="flex gap-2">
     <!-- Plat motor  -->
     <div class="relative flex items-center flex-grow pl-3 mb-2 border shadow rounded-xl shadow-slate-200 border-slate-300">
       <i class="text-slate-400 fa-solid fa-motorcycle"></i>

       <input type="text" name="plat-motor" required id="plat-motor" placeholder="plat-motor" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

       <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 bg-white rounded-full left-9 top-1/2 peer-focus:-translate-x-8 peer-focus:-translate-y-8 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="plat-motor">
         Nomor Plat
       </label>
     </div>

     <!-- lokasi parkir -->
     <select id="token-parkiran" name="token-parkiran" class="h-full px-2 py-3 text-lg bg-transparent border shadow rounded-xl text-slate-800 shadow-slate-200 border-slate-300">
       <?php foreach ($parkiran_kosong as $token) : ?>
         <option value="<?= $token ?>"><?= $token ?></option>
       <?php endforeach ?>
     </select>
   </div>

   <!-- pilihan motor untuk siapa -->
   <div class="flex flex-col gap-5 mb-2">
     <div class="relative flex items-center pl-3 border shadow rounded-xl shadow-slate-200 border-slate-300">
       <i class="fa-solid fa-user text-slate-400"></i>

       <select id="plat-user-lama" name="plat-user-lama" class="flex-grow h-full px-2 py-3 text-lg bg-transparent peer text-slate-800 disabled:cursor-not-allowed" <?= count($semua_username) === 0 ? "disabled" : "" ?>>
         <?php foreach ($semua_username as $user) : ?>
           <option id="opsi-user" value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
         <?php endforeach ?>
       </select>

       <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 bg-white rounded-full peer-disabled:text-slate-400 left-9 top-1/2" id="plat-user-lama">
         Milik User
       </label>
     </div>

     <!-- pembatas -->
     <div class="relative w-11/12 mx-auto border rounded-full border-slate-200">
       <span class="absolute px-2 text-sm -translate-x-1/2 -translate-y-1/2 bg-white text-slate-400 left-1/2 top-1/2">Atau</span>
     </div>

     <label for="plat-user-baru" class="flex items-center self-center gap-2 text-lg font-medium select-none text-slate-600">
       <input type="checkbox" id="plat-user-baru" name="plat-user-baru" class="scale-105">
       Plat untuk user baru
     </label>
   </div>

   <?= Button("Tambah", "blue", "primary", "submit", "submit-motor-btn") ?>
 </form>