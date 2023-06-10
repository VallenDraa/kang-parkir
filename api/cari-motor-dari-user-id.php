<?php
include "../db/koneksi.php";
include "../lib/motor/cari-motor.php";

header('Content-Type: application/json');

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
  http_response_code(405);
  $response = ['error' => 'Metode request tidak diperbolehkan !'];
  echo json_encode($response);
  exit;
}

if (!isset($_GET['id-user'])) {
  http_response_code(400);
  $response = ['error' => 'Parameter tidak sesuai !'];
  echo json_encode($response);
  exit;
}

$id_user = intval($_GET['id-user']) ? intval($_GET['id-user']) : 1;

$motor_arr = cariMotorDariUserId($conn, $id_user);
http_response_code(200);
echo json_encode($motor_arr);
