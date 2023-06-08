<?php
function ambilSemuaUsername(mysqli $conn)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT username FROM user"
  );

  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $username);
  $semua_username = [];

  while (mysqli_stmt_fetch($stmt)) {
    array_push($semua_username, $username);
  }

  mysqli_stmt_close($stmt);

  return $semua_username;
}

function ambilSemuaDataUser(mysqli $conn)
{
  $result = mysqli_query(
    $conn,
    "SELECT * FROM user"
  );

  $semua_user = [];

  while ($baris = mysqli_fetch_assoc($result)) {
    $id = $baris['id'];
    $username = $baris['username'];
    $is_admin = $baris['is_admin'];
    $created_at = $baris['created_at'];

    $user = [
      'id' => $id,
      'username' => $username,
      'is_admin' => $is_admin,
      'created_at' => $created_at,
    ];

    array_push($semua_user, $user);
  }

  mysqli_free_result($result);

  return $semua_user;
}

function idDariUsername(mysqli $conn, string $username): string | null
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT id FROM user WHERE username = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $id);

  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  return $id;
}


function cekUsernameSudahAda(mysqli $conn, string $username): bool
{
  $sudah_ada = !!idDariUsername($conn, $username);

  return $sudah_ada;
}
