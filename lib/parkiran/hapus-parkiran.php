<?php
function kosongkanParkiran(mysqli $conn, string $token_parkiran): bool
{
  $berhasil = false;
  $plat_kosong = null;

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE tempat_parkir SET plat_motor = ? WHERE lokasi_parkir = ?"
  );

  mysqli_stmt_bind_param($stmt, "ss", $plat_kosong, $token_parkiran);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $berhasil = true;
  }

  mysqli_stmt_close($stmt);

  return $berhasil;
}
