 <form action="../lib/action/tambah-motor.action.php" id="form-tambah-motor" method="POST" class="hidden">
   <input required="true" type="text" name="plat-motor" placeholder="Plat Motor" />
   <select name="token-parkiran">
     <?php foreach ($parkiran_kosong as $token) : ?>
       <option value="<?= $token ?>"><?= $token ?></option>
     <?php endforeach ?>
   </select>

   <label for="plat-user-baru" class="select-none">
     Plat untuk user baru
     <input type="checkbox" id="plat-user-baru" name="plat-user-baru">
   </label>

   <select name="plat-user-lama" class="disabled:cursor-not-allowed" <?= count($semua_username) === 0 ? "disabled" : "" ?>>
     <?php foreach ($semua_username as $user) : ?>
       <option id="opsi-user" value="<?= $user['username'] ?>"><?= $user['username'] ?></option>
     <?php endforeach ?>
   </select>

   <?= Button("Tambah", "blue", "primary", "submit", "submit-motor-btn") ?>
 </form>