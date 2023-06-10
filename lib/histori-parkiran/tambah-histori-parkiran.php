<?php
function tambahHistoriMasukParkiran(mysqli $conn, array $motor_arr): bool
{
  $null = null;

  $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO histori_parkir (lokasi_parkir, plat_motor, tanggal_keluar) VALUES (?, ?, ?)"
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
function tambahHistoriKeluarParkiran(mysqli $conn, array $lokasi_parkir_arr): bool
{
  $stmt = mysqli_prepare(
    $conn,
    "UPDATE histori_parkir SET tanggal_keluar = ? WHERE lokasi_parkir = ?"
  );

  date_default_timezone_set('Asia/Jakarta');
  $currentTimestamp = date('Y-m-d H:i:s');

  foreach ($lokasi_parkir_arr as $lokasi) {
    mysqli_stmt_bind_param($stmt, "ss", $currentTimestamp, $lokasi);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) <= 0) {
      mysqli_stmt_close($stmt);
      return false;
    }
  }

  mysqli_stmt_close($stmt);
  return true;
}
