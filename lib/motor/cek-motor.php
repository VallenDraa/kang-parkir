<?php
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
