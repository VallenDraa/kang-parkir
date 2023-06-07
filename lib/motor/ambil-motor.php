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
