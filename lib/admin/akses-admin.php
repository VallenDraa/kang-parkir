<?php
function aksesAdmin(): bool
{
  $is_permitted = false;

  if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== '1') {
    return $is_permitted;
  }

  $is_permitted = true;
  return $is_permitted;
}
