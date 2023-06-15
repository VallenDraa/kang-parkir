 <form action="../lib/action/edit-user-admin.action.php" id="form-edit-user" method="POST" class="hidden space-y-3">
   <input type="hidden" id="id-user-edit" name="id-user" value="123123" />

   <div class="flex flex-col gap-1 ">
     <label for="username">Username</label>
     <input required="true" type="text" id="username" name="username" />
   </div>

   <div class="flex flex-col items-start gap-1">
     <label for="is-admin">Admin status</label>
     <input type="checkbox" id="is-admin" name="is-admin" />
   </div>


   <div class="flex flex-col gap-1">
     <span>Motor milik user</span>
     <ul id="list-motor-user" class="flex flex-col gap-1">
     </ul>
   </div>

   <?= Button("Edit", "blue", "primary", "submit", "submit-motor-btn") ?>
 </form>