<?php
define("PERIODE_HARIAN", "Harian");
define("PERIODE_BULANAN", "Bulanan");
define("PERIODE_TAHUNAN", "Tahunan");

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

$limit = 0;
$period = "days";


function dataMotorPeriodik(mysqli $conn, $periode): array
{

  $limit = 7;
  $period = "days";
  $format_tgl = 'Y-m-d';
  $format_tgl_sql = '%Y-%m-%d';

  switch ($periode) {
    case PERIODE_HARIAN:
      $limit = 7;
      $period = "days";
      $format_tgl = 'Y-m-d';
      $format_tgl_sql = '%Y-%m-%d';
      break;

    case PERIODE_BULANAN:
      $limit = 12;
      $period = "months";
      $format_tgl = 'Y-m';
      $format_tgl_sql = '%Y-%m';
      break;

    case PERIODE_TAHUNAN:
      $limit = 5;
      $period = "years";
      $format_tgl = 'Y';
      $format_tgl_sql = '%Y';
      break;
  }

  $dateComparison = date($format_tgl, strtotime("-$limit $period"));

  $result = mysqli_query(
    $conn,
    "SELECT DATE_FORMAT(tanggal_masuk, '$format_tgl_sql') AS waktu, COUNT(*) AS jumlah_motor
     FROM histori_parkir
     WHERE tanggal_masuk >= '$dateComparison'
     GROUP BY waktu
     ORDER BY waktu LIMIT $limit
    "
  );

  $data_motor = [];

  // mengisi array data motor dengan tanggal sesuai periode
  for ($i = $limit; $i >= 1; $i--) {
    $key_tanggal = date($format_tgl, strtotime("-$i $period"));

    $data_motor[$key_tanggal] = [];
  }

  while ($row = mysqli_fetch_assoc($result)) {
    $data_motor[$row['waktu']] = $row['jumlah_motor'];
  }

  return $data_motor;
}


function cekKapasitasParkiran(mysqli $conn)
{
  $result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total_parkiran, COUNT(plat_motor) AS jml_terisi FROM tempat_parkir"
  );

  $data = mysqli_fetch_assoc($result);

  $kapasitas = [
    "total_parkiran" => $data["total_parkiran"],
    "jml_terisi" => $data['jml_terisi'],
    "persen_terisi" => ($data['jml_terisi'] / $data["total_parkiran"]) * 100
  ];

  return $kapasitas;
}
