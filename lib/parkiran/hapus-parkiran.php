<?php
function kosongkanParkiran(mysqli $conn, string $token_parkiran): bool
{
  $plat_kosong = null;

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE tempat_parkir SET plat_motor = ? WHERE lokasi_parkir = ?"
  );

  mysqli_stmt_bind_param($stmt, "ss", $plat_kosong, $token_parkiran);
  mysqli_stmt_execute($stmt);

  $berhasil = mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}

function kosongkanBanyakParkiran(mysqli $conn, array $token_parkiran): bool
{
  $plat_kosong = null;

  $placeholders = implode(',', array_fill(0, count($token_parkiran), '?'));

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE tempat_parkir SET plat_motor = ? WHERE lokasi_parkir IN ($placeholders)"
  );

  $tipe_data_token = str_repeat('s', count($token_parkiran));
  mysqli_stmt_bind_param($stmt, "s$tipe_data_token", $plat_kosong, ...$token_parkiran);
  mysqli_stmt_execute($stmt);

  $berhasil = mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}
