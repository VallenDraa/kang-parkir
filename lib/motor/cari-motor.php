<?php
function cariMotor(mysqli $conn, string $keyword, int $halaman_aktif, int $jml_per_halaman)
{
  // setting halaman dan query
  $stmt_jml_motor = mysqli_query($conn, "SELECT plat FROM motor WHERE plat LIKE '%$keyword%'");
  $jml_motor = mysqli_num_rows($stmt_jml_motor);
  $total_halaman = ceil($jml_motor / $jml_per_halaman) > 0 ? ceil($jml_motor / $jml_per_halaman) : 1;

  $halaman_aktif_sql = ($halaman_aktif - 1) * $jml_per_halaman;
  $keyword_sql = "%$keyword%";

  $stmt = mysqli_prepare(
    $conn,
    "SELECT plat, lokasi_parkir, tanggal_masuk, id_user_pemilik
     FROM motor
     WHERE plat LIKE ? OR lokasi_parkir LIKE ?
     ORDER BY tanggal_masuk DESC
     LIMIT ?, ?
    "
  );

  mysqli_stmt_bind_param($stmt, "ssdd", $keyword_sql, $keyword_sql, $halaman_aktif_sql, $jml_per_halaman);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result(
    $stmt,
    $plat,
    $lokasi_parkir,
    $tanggal_masuk,
    $id_user_pemilik,
  );

  // Rangkai data
  $data = [
    'motor_arr' => [],
    "total_halaman" => $total_halaman,
    'halaman_aktif' => $halaman_aktif >= $total_halaman ? $halaman_aktif : $total_halaman,
    'halaman_sebelumnya' => $halaman_aktif - 1 !== 0  ? $halaman_aktif - 1 : null,
    'halaman_berikutnya' =>  $halaman_aktif + 1 <= $total_halaman  ? $halaman_aktif + 1 : null
  ];

  while (mysqli_stmt_fetch($stmt)) {
    $motor = [
      'plat' => $plat,
      'lokasi_parkir' => $lokasi_parkir,
      'tanggal_masuk' => $tanggal_masuk,
      'id_user_pemilik' => $id_user_pemilik,
    ];

    array_push($data['motor_arr'], $motor);
  }

  return $data;
}

function motorDariPlat(mysqli $conn, string $plat_arg)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM motor WHERE plat = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $plat_arg);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $plat, $lokasi_parkir, $tanggal_masuk, $id_user_pemilik);

  mysqli_stmt_close($stmt);

  return [
    "plat" => $plat,
    "lokasi_parkir" => $lokasi_parkir,
    "tanggal_masuk" => $tanggal_masuk,
    "id_user_pemilik" => $id_user_pemilik,
  ];
}


function cekMotorSudahAda(mysqli $conn, string $plat)
{
  $motor_sudah_ada =  motorDariPlat($conn, $plat)['plat'] !== null;

  return $motor_sudah_ada;
}

function cariMotorDariUserId(mysqli $conn, int $id_user_pemilik)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT plat, lokasi_parkir, tanggal_masuk FROM motor where id_user_pemilik = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $id_user_pemilik);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $plat, $lokasi_parkir, $tanggal_masuk);
  $hasil_cari_motor = [];

  while (mysqli_stmt_fetch($stmt)) {
    $motor = [
      'plat' => $plat,
      'lokasi_parkir' => $lokasi_parkir,
      'tanggal_masuk' => $tanggal_masuk,
    ];

    array_push($hasil_cari_motor, $motor);
  }

  mysqli_stmt_close($stmt);

  return $hasil_cari_motor;
}
