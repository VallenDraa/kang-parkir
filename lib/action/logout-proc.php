<?php
include "../auth.php";
include "../info.php";

logout();

echo infoJs("Anda berhasil keluar !", "../../login.php");
