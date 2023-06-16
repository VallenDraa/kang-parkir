<?php
function editUser(
  mysqli $conn,
  string $id,
  string $username,
  string $pw_lama,
  string $pw_baru
): bool {
  $berhasil = false;

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
  int $is_admin
) {
  $berhasil = false;

  // untuk mengecek apakah data yang baru 
  // dan yang lama sama
  $stmt_cek_data = mysqli_prepare(
    $conn,
    "SELECT username, is_admin FROM user WHERE id = ?"
  );

  mysqli_stmt_bind_param($stmt_cek_data, "s", $id);
  mysqli_stmt_execute($stmt_cek_data);
  mysqli_stmt_bind_result($stmt_cek_data,  $cek_username, $cek_is_admin);
  mysqli_stmt_fetch($stmt_cek_data);
  mysqli_stmt_close($stmt_cek_data);

  $data_sama = $cek_username === $username && $cek_is_admin === $is_admin;

  if ($data_sama) {
    $berhasil = true;

    return $berhasil;
  }

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
