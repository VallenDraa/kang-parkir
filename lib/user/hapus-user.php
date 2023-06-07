<?php
function hapusUser(mysqli $conn, string $id): int|string|null
{
  $berhasil = false;

  $stmt = mysqli_prepare(
    $conn,
    "DELETE FROM user WHERE id = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    $berhasil = true;
    return $berhasil;
  }

  return $berhasil;
}
