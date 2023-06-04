<?php
function cariParkiranKosong(mysqli $conn)
{
  $token_parkiran_kosong = [];

  $data = mysqli_query($conn, "SELECT * FROM tempat_parkir WHERE plat_motor IS NULL");

  while ($hasil_fetch = mysqli_fetch_assoc($data)) {
    array_push($token_parkiran_kosong, $hasil_fetch['lokasi_parkir']);
  }

  return $token_parkiran_kosong;
}
