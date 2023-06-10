<?php
include "../lib/user/cari-user.php";
include "../db/koneksi.php";
include "../config.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "GET") {
  http_response_code(405);
  $response = ['error' => 'Metode request tidak diperbolehkan !'];
  echo json_encode($response);
  exit;
}

if (
  !isset($_GET['keyword']) ||
  !isset($_GET['halaman-aktif'])
) {
  http_response_code(400);
  $response = ['error' => 'Parameter tidak sesuai !'];
  echo json_encode($response);
}

$halaman_aktif = intval($_GET['halaman-aktif']) ? intval($_GET['halaman-aktif']) : 1;
$data = cariUser($conn, $_GET['keyword'], $halaman_aktif, JUMLAH_PER_HALAMAN);
echo json_encode($data);
