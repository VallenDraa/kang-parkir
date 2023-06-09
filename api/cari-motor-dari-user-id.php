<?php
include "../db/koneksi.php";
include "../lib/motor/cari-motor.php";

header('Content-Type: application/json');

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  $response = ['error' => 'Metode request tidak diperbolehkan !'];
  echo json_encode($response);
  exit;
}

$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

if (
  !isset($data['id-user']) ||
  gettype($data['id-user']) !== "integer"
) {
  http_response_code(400);
  $response = ['error' => 'Parameter tidak sesuai !'];
  echo json_encode($response);
  exit;
}

$motor_arr = cariMotorDariUserId($conn, $data['id-user']);
http_response_code(200);
echo json_encode($motor_arr);
