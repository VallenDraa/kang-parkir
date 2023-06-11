<?php
function cariHistoriParkiran(mysqli $conn, string $keyword, int $halaman_aktif, int $jml_per_halaman)
{
  // setting halaman dan query
  $stmt_jml_histori = mysqli_query($conn, "SELECT id FROM histori_parkir WHERE plat_motor LIKE '%$keyword%'");
  $jml_histori = mysqli_num_rows($stmt_jml_histori);
  $total_halaman = ceil($jml_histori / $jml_per_halaman) > 0 ? ceil($jml_histori / $jml_per_halaman) : 1;

  $halaman_aktif_sql = ($halaman_aktif - 1) * $jml_per_halaman;
  $keyword_sql = "%$keyword%";

  $stmt = mysqli_prepare(
    $conn,
    "SELECT * 
     FROM histori_parkir 
     WHERE plat_motor LIKE ? OR lokasi_parkir LIKE ? 
     LIMIT ?, ?
    "
  );

  mysqli_stmt_bind_param($stmt, "ssdd", $keyword_sql, $keyword_sql, $halaman_aktif_sql, $jml_per_halaman);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result(
    $stmt,
    $id,
    $lokasi_parkir,
    $plat_motor,
    $tanggal_masuk,
    $tanggal_keluar,
  );

  // Rangkai data
  $data = [
    'histori_arr' => [],
    "total_halaman" => $total_halaman,
    'halaman_aktif' => $halaman_aktif >= $total_halaman ? $halaman_aktif : $total_halaman,
    'halaman_sebelumnya' => $halaman_aktif - 1 !== 0  ? $halaman_aktif - 1 : null,
    'halaman_berikutnya' =>  $halaman_aktif + 1 <= $total_halaman  ? $halaman_aktif + 1 : null
  ];

  while (mysqli_stmt_fetch($stmt)) {
    $histori = [
      'id' => $id,
      'plat_motor' => $plat_motor,
      'lokasi_parkir' => $lokasi_parkir,
      'tanggal_masuk' => $tanggal_masuk,
      'tanggal_keluar' => $tanggal_keluar,
    ];

    array_push($data['histori_arr'], $histori);
  }

  return $data;
}
