<?php
function tambahMotor(
  mysqli $conn,
  string $plat_motor,
  string $token_parkiran,
  string $id_target_user
): bool {
  $stmt_tambah_motor = mysqli_prepare(
    $conn,
    "INSERT INTO motor (plat, lokasi_parkir, id_user_pemilik) VALUES (?, ?, ?)"
  );

  mysqli_stmt_bind_param(
    $stmt_tambah_motor,
    "sss",
    $plat_motor,
    $token_parkiran,
    $id_target_user
  );

  mysqli_stmt_execute($stmt_tambah_motor);

  $berhasil = mysqli_stmt_affected_rows($stmt_tambah_motor) > 0;

  return $berhasil;
}
