<?php
function ambilSemuaMotor(mysqli $conn)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT plat, lokasi_parkir, tanggal_masuk FROM motor"
  );

  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $plat, $lokasi_parkir, $tanggal_masuk);
  $semua_motor = [];

  while (mysqli_stmt_fetch($stmt)) {
    $motor = [
      'plat' => $plat,
      'lokasi_parkir' => $lokasi_parkir,
      'tanggal_masuk' => $tanggal_masuk
    ];

    array_push($semua_motor, $motor);
  }

  mysqli_stmt_close($stmt);

  return $semua_motor;
}

function cekMotorSudahAda(mysqli $conn, string $plat)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM motor WHERE plat = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $plat);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  $motor_sudah_ada =  mysqli_stmt_num_rows($stmt) > 0;
  mysqli_stmt_close($stmt);

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
