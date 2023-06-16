<?php
function login(mysqli $conn, string $username, string $password, int $is_admin): array|null
{

  $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM user where username = ? AND is_admin = ?"
  );

  mysqli_stmt_bind_param($stmt, "si", $username, $is_admin);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if (mysqli_stmt_num_rows($stmt) === 1) {
    mysqli_stmt_bind_result($stmt, $db_id, $db_username, $db_password, $db_is_admin, $db_created_at);
    mysqli_stmt_fetch($stmt);

    if (!password_verify($password, $db_password)) {
      return null;
    }

    return [
      "id" => $db_id,
      "username" => $db_username,
      "is_admin" => $db_is_admin,
      "created_at" => $db_created_at,
    ];
  } else {
    return null;
  }
}


function logout()
{
  unset($_SESSION);
  session_destroy();
}
