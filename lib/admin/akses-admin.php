<?php
function aksesAdmin(): bool
{
  $is_permitted = false;

  if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== '1') {
    return $is_permitted;
  }

  $is_permitted = true;
  return $is_permitted;
}
