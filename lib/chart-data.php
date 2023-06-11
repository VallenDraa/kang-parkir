<?php
function dataTambahanMotor(mysqli $conn): array
{
  // hitung jumlah motor yang pernah parkir 
  $result_total = mysqli_query($conn, "SELECT COUNT(*) as jumlah_baris_histori FROM histori_parkir");
  $baris = mysqli_fetch_assoc($result_total);
  $jumlah_baris_histori = $baris['jumlah_baris_histori'];

  // ambil data terbaru motor masuk dari histori parkir
  $result_masuk_terbaru = mysqli_query(
    $conn,
    "SELECT * FROM histori_parkir WHERE tanggal_masuk IS NOT NULL
     ORDER BY tanggal_masuk DESC 
     LIMIT 1
    "
  );
  $motor_masuk_terbaru = mysqli_fetch_assoc($result_masuk_terbaru);

  // ambil data terbaru motor keluar dari histori parkir
  $result_keluar_terbaru = mysqli_query(
    $conn,
    "SELECT * FROM histori_parkir WHERE tanggal_keluar IS NOT NULL
     ORDER BY tanggal_keluar DESC 
     LIMIT 1
    "
  );
  $motor_keluar_terbaru = mysqli_fetch_assoc($result_keluar_terbaru);


  // ambil jumlah penambahan motor hari ini
  $hari_ini = date('Y-m-d');
  $penambahan_res = mysqli_query(
    $conn,
    "SELECT COUNT(*) as penambahan FROM histori_parkir WHERE DATE(tanggal_masuk) = '$hari_ini'"
  );

  $penambahan = mysqli_fetch_assoc($penambahan_res);


  return [
    "jumlah_total" => $jumlah_baris_histori,
    "terakhir_masuk" => $motor_masuk_terbaru,
    "terakhir_keluar" => $motor_keluar_terbaru,
    "jumlah_motor_baru_hari_ini" => $penambahan['penambahan']
  ];
}

function dataMotorPeriodik(mysqli $conn, $periode): array
{
  $result = mysqli_query($conn, "SELECT * FROM histori_parkir");
  $data_motor = [];

  while ($baris = mysqli_fetch_assoc($result)) {
    $tanggal = strtotime($baris["tanggal_masuk"]);

    switch ($periode) {
      case 'hari':
        $grup = date('Y-m-d', $tanggal);
        break;
        // case 'minggu':
        //   $grup = date('Y-W', $tanggal);
        //   break;
      case 'bulan':
        $grup = date('Y-m', $tanggal);
        break;
      case 'tahun':
        $grup = date('Y', $tanggal);
        break;
      default:
        $grup = date('Y-m-d', $tanggal);
        break;
    }

    if (!isset($data_motor[$grup])) {
      $data_motor[$grup] = [];
    }

    array_push($data_motor[$grup], $baris);
  }

  return $data_motor;
}

function cekKapasitasParkiran(mysqli $conn)
{
  $result = mysqli_query(
    $conn,
    "SELECT 
    (COUNT(CASE WHEN plat_motor IS NOT NULL THEN 1 END) / COUNT(*)) * 100 AS persen_terisi 
    FROM tempat_parkir"
  );

  $data = mysqli_fetch_assoc($result);

  $persen_terisi = $data['persen_terisi'];

  return $persen_terisi;
}

function userMotorTerbanyak(mysqli $conn, int $jumlah)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT user.id, user.username, COUNT(motor.plat) AS jumlah_motor
    FROM user LEFT JOIN motor ON user.id = motor.id_user_pemilik
    GROUP BY user.id 
    ORDER BY jumlah_motor DESC
    LIMIT ?"
  );

  mysqli_stmt_bind_param($stmt, "i", $jumlah);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $id_user, $username, $total_motor);

  $hasil = [];
  while (mysqli_stmt_fetch($stmt)) {
    array_push($hasil, [
      "id_user" => $id_user,
      "username" => $username,
      "jumlah_motor" => $total_motor
    ]);
  }

  mysqli_stmt_close($stmt);

  return $hasil;
}

function motorDurasiParkirTerlama(mysqli $conn, int $jumlah)
{
  $stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM motor
    ORDER BY tanggal_masuk DESC
    LIMIT ?"
  );

  mysqli_stmt_bind_param($stmt, "i", $jumlah);

  mysqli_stmt_execute($stmt);

  mysqli_stmt_bind_result($stmt, $plat, $lokasi_parkir, $tanggal_masuk, $id_user_pemilik);

  $hasil = [];

  while (mysqli_stmt_fetch($stmt)) {
    array_push($hasil, [
      "plat" => $plat,
      "lokasi_parkir" => $lokasi_parkir,
      "tanggal_masuk" => $tanggal_masuk,
      "id_user_pemilik" => $id_user_pemilik
    ]);
  }

  mysqli_stmt_close($stmt);

  return $hasil;
}
