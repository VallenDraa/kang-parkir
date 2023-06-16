<tr class="flex justify-between">
  <div>
    <span><?= $motor['plat']; ?></span>
    <span><?= $motor['lokasi_parkir']; ?></span>
    <span><?= $motor['tanggal_masuk']; ?></span>
  </div>

  <form action="../lib/action/hapus-motor.action.php" id="hapus-motor-form" method="POST">
    <input type="hidden" name="plat-motor" value="<?= $motor['plat']; ?>" />
    <input type="hidden" name="token-parkiran" value="<?= $motor['lokasi_parkir']; ?>" />

    <!-- tombol motor -->
    <div class="flex items-center gap-2">
      <button id="info-motor-btn" type="button" class="p-2 text-2xl text-blue-500 transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300">
        <i class="drop-shadow fa-solid fa-circle-info"></i>
      </button>
      <button id="hapus-motor-btn" class="p-2 text-2xl text-red-500 transition-colors duration-200 rounded-xl hover:bg-slate-200 active:bg-slate-300">
        <i class="drop-shadow fa-regular fa-trash-can"></i>
      </button>
    </div>
  </form>
</tr>