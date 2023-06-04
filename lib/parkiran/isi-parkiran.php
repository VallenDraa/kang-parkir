<?php
function isiParkiran(mysqli $conn, string $token_parkiran, string $plat_motor): bool
{
  $berhasil = false;

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE tempat_parkir SET plat_motor = ? WHERE lokasi_parkir = ?"
  );

  mysqli_stmt_bind_param($stmt, "ss", $plat_motor, $token_parkiran);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $berhasil = true;
  }

  mysqli_stmt_close($stmt);

  return $berhasil;
}
