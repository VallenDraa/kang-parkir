<?php
function tambahUser(mysqli $conn, string $plat_motor): int|string|null
{
  $new_id = null;
  $is_admin = 0;

  $password = password_hash($plat_motor, PASSWORD_BCRYPT, ["cost" => 12]);

  $stmt = mysqli_prepare(
    $conn,
    "INSERT INTO user (username, password, is_admin) VALUES (?, ?, ?)"
  );

  mysqli_stmt_bind_param($stmt, "ssd", $plat_motor, $password, $is_admin);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    $new_id  = mysqli_insert_id($conn);
  }

  mysqli_stmt_close($stmt);

  return $new_id;
}
