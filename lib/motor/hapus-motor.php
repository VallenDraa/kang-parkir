<?php
function hapusMotor(mysqli $conn, string $plat_motor): bool
{
  $stmt = mysqli_prepare(
    $conn,
    "DELETE FROM motor WHERE plat = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $plat_motor);
  mysqli_stmt_execute($stmt);

  $berhasil =  mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}

function hapusBanyakMotor(mysqli $conn, array $plat_motor)
{
  $placeholders = implode(',', array_fill(0, count($plat_motor), '?'));

  $stmt = mysqli_prepare(
    $conn,
    "DELETE FROM motor WHERE plat IN ($placeholders)"
  );

  $tipe_data_token = str_repeat('s', count($plat_motor));
  mysqli_stmt_bind_param($stmt, $tipe_data_token, ...$plat_motor);
  mysqli_stmt_execute($stmt);

  $berhasil =  mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}
