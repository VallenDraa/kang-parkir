<tr class="flex justify-between">
  <div>
    <span><?= $user['username']; ?></span>
    <span><?= $user['created_at']; ?></span>
  </div>

  <form action="../lib/action/hapus-user.action.php" id="hapus-user-form" method="POST">
    <input type="hidden" name="id-user" value="<?= $user['id']; ?>" />

    <!-- tombol user -->
    <div class="flex items-center gap-2">
      <button id="edit-user-btn" type="button" data-id-user="<?= $user['id']; ?>" class="p-2 text-2xl text-blue-500 dark:text-blue-400 transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300 dark:hover:bg-slate-600 dark:active:bg-slate-700">
        <i class="drop-shadow fa-regular fa-pen-to-square"></i>
      </button>

      <button id="hapus-user-btn" class="p-2 text-2xl text-red-500 transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300 dark:hover:bg-slate-600 dark:active:bg-slate-700">
        <i class="drop-shadow fa-regular fa-trash-can"></i>
      </button>
    </div>
  </form>
</tr>