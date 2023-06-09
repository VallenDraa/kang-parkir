<?php
function editUser(
  mysqli $conn,
  string $id,
  string $username,
  string $pw_lama,
  string $pw_baru
) {
  $pw_sama = $pw_lama === $pw_baru;
  $berhasil = false;

  if (!$pw_sama) {
    // verifikasi password lama
    $stmt_cek_pw = mysqli_prepare(
      $conn,
      "SELECT password FROM user WHERE id = ?"
    );

    mysqli_stmt_bind_param($stmt_cek_pw, "s", $id);
    mysqli_stmt_execute($stmt_cek_pw);

    mysqli_stmt_bind_result($stmt_cek_pw, $pw_dari_db);
    mysqli_stmt_fetch($stmt_cek_pw);

    mysqli_stmt_close($stmt_cek_pw);

    // jika password lama tidak sama dengan password 
    // dari database maka gagalkan operasi
    if (!password_verify($pw_lama, $pw_dari_db)) {
      return $berhasil;
    }
  }

  $encrypted_pw = password_hash($pw_baru, PASSWORD_BCRYPT, ["cost" => 12]);

  $stmt = mysqli_prepare(
    $conn,
    "UPDATE user SET username = ?, password = ? WHERE id = ?"
  );

  mysqli_stmt_bind_param($stmt, "sss", $username, $encrypted_pw, $id);
  mysqli_stmt_execute($stmt);

  $berhasil = mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}


function editUserOlehAdmin(
  mysqli $conn,
  string $id,
  string $username,
  bool $is_admin
) {
  $stmt = mysqli_prepare(
    $conn,
    "UPDATE user SET username = ?, is_admin = ? WHERE id = ?"
  );

  mysqli_stmt_bind_param($stmt, "sds", $username, $is_admin, $id);
  mysqli_stmt_execute($stmt);

  $berhasil = mysqli_stmt_affected_rows($stmt) > 0;

  mysqli_stmt_close($stmt);

  return $berhasil;
}
