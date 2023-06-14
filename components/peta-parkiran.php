<h2 class="mb-6 text-4xl font-bold text-center capitalize">Peta Parkiran</h2>

<div id="peta-parkiran" class="flex flex-col items-center justify-center w-full p-4 overflow-x-auto shadow rounded-xl md:flex-row shadow-slate-200 bg-slate-100">

  <div class="flex flex-row gap-4 md:flex-col">
    <?php for ($i = 1; $i <= 5; $i++) : ?>
      <span class="<?= $i === 1 ? "mt-0 md:mt-12 ml-7 md:ml-0" : "" ?> w-10 h-8 text-lg font-bold text-center">
        <?= $i ?>
      </span>
    <?php endfor ?>
  </div>

  <?php foreach ($parkiran as $grup => $slot_arr) : ?>
    <div class="flex flex-row gap-4 border-slate-300 md:flex-col even:pb-2 md:even:pb-0 even:pr-0 md:even:pr-2 odd:pt-2 md:odd:pt-0 odd:pl-0 md:odd:pl-2 even:border-b md:even:border-b-0 even:border-r-0 md:even:border-r even:mt-10 md:even:mt-0 even:ml-0 even:md:ml-10">
      <span id="grup-parkiran" class="self-center w-3 text-lg font-bold"><?= $grup ?></span>
      <?php foreach ($slot_arr as $slot) : ?>
        <div id="slot-parkiran" data-plat-motor="<?= $slot['plat_motor'] ?>" data-no-token="<?= $slot['lokasi_parkir'] ?>" class="<?= !$slot['plat_motor'] ? "bg-slate-300 shadow-slate-400" : "bg-red-400 shadow-red-500" ?> h-8 w-10 rounded-md">
        </div>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>
</div>