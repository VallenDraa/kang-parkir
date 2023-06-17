<?php
function DataMotorEkstra(array | null $baris_histori_parkir, string $title, $masuk = true): string
{
  if (!$baris_histori_parkir) {
    return "
      <div class='flex flex-col flex-1'>
        <span class='font-medium text-slate-500'>$title</span>
        <span class='block mb-2 text-3xl font-bold text-blue-500'>
          Belum Ada
        </span>
        <span class='font-medium text-slate-500'>
          Lokasi Parkir: -
        </span>
      </div>
    ";
  }

  $title_masuk_atau_keluar = $masuk ? 'Tanggal Masuk' : 'Tanggal Keluar';
  $key_masuk_atau_keluar = $masuk ? 'tanggal_masuk' : 'tanggal_keluar';

  return "
    <div class='flex flex-col flex-1'>
      <span class='font-medium text-slate-500'>$title</span>
      <span class='block mb-2 text-3xl font-bold text-blue-500'>
         $baris_histori_parkir[plat_motor]
      </span>
      <span class='font-medium text-slate-500'>
        Lokasi Parkir:  $baris_histori_parkir[lokasi_parkir]
      </span>
      <span class='font-medium text-slate-500'>
        $title_masuk_atau_keluar:  $baris_histori_parkir[$key_masuk_atau_keluar]
      </span>
    </div>
  ";
}
