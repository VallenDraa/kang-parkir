<?php
include "../db/koneksi.php";

include "../lib/motor/cari-motor.php";
include "../lib/user/cari-user.php";

header('Content-Type: application/json');

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
  http_response_code(405);
  $response = ['error' => 'Metode request tidak diperbolehkan !'];
  echo json_encode($response);
  exit;
}

if (!isset($_GET['plat'])) {
  http_response_code(400);
  $response = ['error' => 'Parameter tidak sesuai !'];
  echo json_encode($response);
  exit;
}

$data = cariMotor($conn, $_GET['plat'], 1, 1);
$motor = $data['motor_arr'][0] ? $data['motor_arr'][0] : null;

if (!$motor) {
  http_response_code(404);
  $response = ['error' => 'Data motor tidak ditemukan !'];
  echo json_encode($response);
  exit;
}

$pemilik = userDariUsername($conn, $motor['id_user_pemilik']);

http_response_code(200);
echo json_encode([
  "pemilik" => $pemilik['username'],
  ...$motor,
]);
