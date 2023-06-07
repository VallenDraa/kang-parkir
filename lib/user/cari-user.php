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
    "SELECT u.id, u.username, u.isAdmin, m.plat, m.lokasi_parkir, m.tanggal_masuk FROM user u
    LEFT JOIN motor m ON u.id = m.id_user_pemilik"
  );

  if ($result) {
    $semua_user = [];
    $current_user = null;

    while ($baris = mysqli_fetch_assoc($result)) {
      $id = $baris['id'];
      $username = $baris['username'];
      $isAdmin = $baris['isAdmin'];
      $plat = $baris['plat'];
      $lokasi = $baris['lokasi_parkir'];
      $tanggal_masuk = $baris['tanggal_masuk'];

      if (!$current_user || $current_user['id'] !== $id) {
        $current_user = [
          'id' => $id,
          'username' => $username,
          'isAdmin' => $isAdmin,
          'motor' => [],
        ];

        $semua_user[] = $current_user;
      }

      if ($plat) {
        $current_user['motor'][] = [
          'plat' => $plat,
          'lokasi' => $lokasi,
          'tanggal_masuk' => $tanggal_masuk
        ];
      }
    }

    mysqli_free_result($result);
    return $semua_user;
  } else {
    echo "Error executing the query: " . mysqli_error($conn);
  }

  return [];
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
