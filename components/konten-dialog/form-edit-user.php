 <form action="../lib/action/edit-user-admin.action.php" id="form-edit-user" method="POST" class="hidden space-y-3">
   <input type="hidden" id="id-user-edit" name="id-user" value="123123" />

   <!-- username  -->
   <div class="flex gap-2">
     <div class="relative flex items-center flex-grow pl-3 mb-2 border shadow rounded-xl shadow-slate-200 border-slate-300">
       <i class="text-slate-400 fa-solid fa-motorcycle"></i>

       <input type="text" name="username" required id="username" placeholder="username" class="w-full px-4 py-2 text-lg transition-colors bg-transparent border-l-0 rounded-md rounded-l-none outline-none text-slate-800 placeholder:text-transparent peer disabled:cursor-not-allowed disabled:opacity-20">

       <label class="absolute z-20 px-1 text-sm text-blue-500 transition-transform scale-90 -translate-x-8 -translate-y-8 bg-white rounded-full left-9 top-1/2 peer-focus:-translate-x-8 peer-focus:-translate-y-8 peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-slate-500" for="username">
         Username
       </label>
     </div>
   </div>

   <!-- tabel semi-responsive -->
   <div class="w-full h-56 overflow-auto">
     <table class="w-full table-auto overflow-clip">
       <thead class="sticky top-0">
         <tr class="[&>th]:p-2 bg-slate-200 text-slate-700">
           <th>No</th>
           <th>Plat</th>
           <th>Lokasi Parkir</th>
           <th>Tanggal Masuk</th>
         </tr>
       </thead>

       <tbody id="list-motor-user">

       </tbody>
     </table>
   </div>


   <label for="is-admin" class="flex items-center justify-center gap-2 font-medium select-none text-slate-600">
     <input type="checkbox" id="is-admin" name="is-admin" class="scale-105">
     Memiliki Akses Admin
   </label>

   <button class="w-full px-5 py-1 text-white transition-opacity duration-200 rounded-md shadow bg-gradient-to-b disabled:opacity-50 from-blue-400 to-blue-500 shadow-blue-300 hover:opacity-70 active:opacity-95 active:shadow-none" id="submit-motor-btn">
     Edit
   </button>
 </form>