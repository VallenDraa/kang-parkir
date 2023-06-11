<?php
function DataMotorEkstra(array | null $baris_histori_parkir, string $title, $masuk = true): string
{
  if (!$baris_histori_parkir) {
    return "
      <div class='flex flex-col flex-1'>
        <span class='text-slate-600 font-medium'>$title</span>
        <span class='block text-3xl font-bold mb-2 text-blue-500'>
          Belum Ada
        </span>
        <span class='text-slate-500 font-medium'>
          Lokasi Parkir: -
        </span>
      </div>
    ";
  }

  $title_masuk_atau_keluar = $masuk ? 'Tanggal Masuk' : 'Tanggal Keluar';
  $key_masuk_atau_keluar = $masuk ? 'tanggal_masuk' : 'tanggal_keluar';

  return "
    <div class='flex flex-col flex-1'>
      <span class='text-slate-600 font-medium'>$title</span>
      <span class='block text-3xl font-bold mb-2 text-blue-500'>
         $baris_histori_parkir[plat_motor]
      </span>
      <span class='text-slate-500 font-medium'>
        Lokasi Parkir:  $baris_histori_parkir[lokasi_parkir]
      </span>
      <span class='text-slate-500 font-medium'>
        $title_masuk_atau_keluar:  $baris_histori_parkir[$key_masuk_atau_keluar]
      </span>
    </div>
  ";
}
