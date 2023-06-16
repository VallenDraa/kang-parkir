<?php
function aksesAdmin(mysqli $conn): bool
{
  $punya_akses = false;

  if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    return $punya_akses;
  }

  // cek apakah akun admin masih ada
  $punya_akses = cekUsernameSudahAda($conn, $_SESSION['username']);
  return $punya_akses;
}

function aksesUser(mysqli $conn): bool
{
  $punya_akses = false;

  if (!isset($_SESSION['username'])) {
    return $punya_akses;
  }

  // cek apakah akun user masih ada
  $punya_akses = cekUsernameSudahAda($conn, $_SESSION['username']);
  return $punya_akses;
}
