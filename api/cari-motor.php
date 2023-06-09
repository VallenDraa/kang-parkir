<?php
include "../db/koneksi.php";
include "../lib/motor/cari-motor.php";

// Error checking
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  $response = ['error' => 'Metode request tidak diperbolehkan !'];
  header('Content-Type: application/json');
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
  header('Content-Type: application/json');
  echo json_encode($response);
  exit;
}

$motor_arr = cariMotorDariUserId($conn, $data['id-user']);
?>

<?php foreach ($motor_arr as $motor) : ?>
  <li class="flex gap-5">
    <span><?= $motor['plat'] ?></span>
    <span><?= $motor['lokasi_parkir'] ?></span>
    <!-- <span>${new Date() - new Date(m.tanggal_masuk)}</span> -->
  </li>
<?php endforeach  ?>