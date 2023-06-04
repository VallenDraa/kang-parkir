<?php
session_start();
if (isset($_SESSION['username']))
?>

Selamat Datang
<?php echo '<strong>' . $_SESSION['username'] . '</strong>'; ?> <a href="?module-logout#pos">Keluar</a>