<?php
function cariUser(mysqli $conn, string $keyword, int $halaman_aktif, int $jml_per_halaman, bool $cari_admin = false)
{
  $is_admin = $cari_admin ? 1 : 0;

  // setting halaman dan query
  $stmt_jml_user = mysqli_query($conn, "SELECT id FROM user WHERE username LIKE '%$keyword%' AND is_admin = $is_admin");
  $jml_user = mysqli_num_rows($stmt_jml_user);
  $total_halaman = ceil($jml_user / $jml_per_halaman) > 0 ? ceil($jml_user / $jml_per_halaman) : 1;

  $halaman_aktif_sql = ($halaman_aktif - 1) * $jml_per_halaman;
  $keyword_sql = "%$keyword%";

  $stmt = mysqli_prepare(
    $conn,
    "SELECT user.id, user.username, user.is_admin, user.created_at, COUNT(motor.plat) AS jumlah_motor
    FROM user LEFT JOIN motor ON user.id = motor.id_user_pemilik
    WHERE user.username LIKE ? AND is_admin = $is_admin 
    GROUP BY user.id 
    ORDER BY user.created_at DESC
    LIMIT ?, ?"
  );

  mysqli_stmt_bind_param($stmt, "sdd", $keyword_sql, $halaman_aktif_sql, $jml_per_halaman);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result(
    $stmt,
    $id,
    $username,
    $is_admin,
    $created_at,
    $jumlah_motor
  );

  // Rangkai data
  $data = [
    'user_arr' => [],
    "total_halaman" => $total_halaman,
    'halaman_aktif' => $halaman_aktif >= $total_halaman ? $halaman_aktif : $total_halaman,
    'halaman_sebelumnya' => $halaman_aktif - 1 !== 0  ? $halaman_aktif - 1 : null,
    'halaman_berikutnya' =>  $halaman_aktif + 1 <= $total_halaman  ? $halaman_aktif + 1 : null
  ];

  while (mysqli_stmt_fetch($stmt)) {
    $user = [
      'id' => $id,
      'username' => $username,
      'is_admin' => $is_admin,
      'created_at' => $created_at,
      'jumlah_motor' => $jumlah_motor,
    ];

    array_push($data['user_arr'], $user);
  }

  return $data;
}

function cariSemuaUser(mysqli $conn)
{
  $result = mysqli_query($conn, "
    SELECT user.id, user.username, user.is_admin, user.created_at, COUNT(motor.plat) AS jumlah_motor
    FROM user
    LEFT JOIN motor ON user.id = motor.id_user_pemilik
    GROUP BY user.id
  ");

  $semua_user = [];

  while ($baris = mysqli_fetch_assoc($result)) {
    $id = $baris['id'];
    $username = $baris['username'];
    $is_admin = $baris['is_admin'];
    $created_at = $baris['created_at'];
    $jumlah_motor = $baris['jumlah_motor'];

    $user = [
      'id' => $id,
      'username' => $username,
      'is_admin' => $is_admin,
      'created_at' => $created_at,
      'jumlah_motor' => $jumlah_motor,
    ];

    array_push($semua_user, $user);
  }

  mysqli_free_result($result);

  return $semua_user;
}

function ambilSemuaUsername(mysqli $conn)
{
  $semua_user = cariSemuaUser($conn);
  $semua_username = array_map(fn ($user) => [
    'id' => $user['id'],
    'username' => $user['username']
  ], $semua_user);

  return $semua_username;
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

function usernameDariId(mysqli $conn, int $id)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT username FROM user WHERE id = ?"
  );

  mysqli_stmt_bind_param($stmt, "s", $id);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $username);

  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  return $username;
}

function cekUsernameSudahAda(mysqli $conn, string $username): bool
{
  $sudah_ada = idDariUsername($conn, $username) !== null;

  return $sudah_ada;
}
