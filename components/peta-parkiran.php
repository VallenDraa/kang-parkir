<?php
$index = 0;

$gap_row = false;
?>

<h2 class="mb-6 text-4xl font-bold text-center capitalize">Peta Parkiran</h2>

<div id="peta-parkiran" class="flex flex-col items-center justify-center w-full gap-4 p-4 overflow-x-auto rounded-lg shadow md:flex-row shadow-slate-300 bg-slate-100">

  <div class="flex flex-row gap-4 md:flex-col">
    <?php for ($i = 1; $i <= 5; $i++) : ?>
      <span class="<?= $i === 1 ? "mt-0 md:mt-12 ml-7 md:ml-0" : "" ?> w-10 h-8 text-lg font-bold text-center">
        <?= $i ?>
      </span>
    <?php endfor ?>
  </div>

  <?php foreach ($parkiran as $grup => $slot_arr) :
    $gap_row = $index > 1 && $index % 3 === 0;
    $index += 1;
  ?>
    <div class="flex flex-row md:flex-col gap-4 <?= $gap_row ? "mt-5 md:mt-0 ml-0 md:ml-5" : "" ?>">
      <span id="grup-parkiran" class="self-center w-3 text-lg font-bold"><?= $grup ?></span>
      <?php foreach ($slot_arr as $slot) : ?>
        <div id="slot-parkiran" data-plat-motor="<?= $slot['plat_motor'] ?>" data-no-token="<?= $slot['lokasi_parkir'] ?>" class="<?= !$slot['plat_motor'] ? "bg-slate-300 shadow-slate-400" : "bg-red-400 shadow-red-500" ?> h-8 w-10 rounded-md">
        </div>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>
</div>