 <form action="../lib/motor/edit-user.action.php" id="form-edit-user" method="POST" class="hidden">
   <input type="hidden" name="id-user" value="">

   <input required="true" type="text" name="username" placeholder="Plat Motor" />

   <ul id="list-motor-user" class="flex flex-col gap-4">

   </ul>

   <?= Button("Tambah", "blue", "primary", "submit", "submit-motor-btn") ?>
 </form>