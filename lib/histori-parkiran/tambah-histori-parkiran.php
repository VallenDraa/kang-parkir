<?php
function tambahHistoriParkiran(mysqli $conn, string $lokasi_parkir, string $plat_motor, bool $masuk)
{
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
    return true;
  }

  return false;
}
