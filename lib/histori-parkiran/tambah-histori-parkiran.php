<?php
function tambahHistoriParkiran(mysqli $conn, string $lokasi_parkir, string $plat_motor, bool $masuk)
{
  $berhasil = false;

  $null = null;
  $target_timestamp = $masuk ? "tanggal_keluar" : "tanggal_masuk";

  $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO histori_parkir (lokasi_parkir, plat_motor, $target_timestamp) VALUES (?, ?, ?)"
  );

  mysqli_stmt_bind_param($stmt, "sss", $lokasi_parkir, $plat_motor, $null);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    $berhasil = true;
    return $berhasil;
  }

  return $berhasil;
}

function tambahBanyakHistoriParkiran(mysqli $conn, array $motor_arr, bool $masuk)
{
  $null = null;

  $target_timestamp = $masuk ? "tanggal_keluar" : "tanggal_masuk";

  $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO histori_parkir (lokasi_parkir, plat_motor, $target_timestamp) VALUES (?, ?, ?)"
  );

  foreach ($motor_arr as $motor) {
    $lokasi_parkir = $motor['lokasi_parkir'];
    $plat_motor = $motor['plat_motor'];

    mysqli_stmt_bind_param($stmt, "sss", $lokasi_parkir, $plat_motor, $null);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) <= 0) {
      mysqli_stmt_close($stmt);
      return false;
    }
  }

  mysqli_stmt_close($stmt);
  return true;
}
