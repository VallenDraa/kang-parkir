<?php
function aksesAdmin(): bool
{
  $punyak_akses = false;

  if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    return $punyak_akses;
  }

  $punyak_akses = true;
  return $punyak_akses;
}


function aksesUser(): bool
{
  $punyak_akses = false;

  if (!isset($_SESSION['username'])) {
    return $punyak_akses;
  }

  $punyak_akses = true;
  return $punyak_akses;
}
