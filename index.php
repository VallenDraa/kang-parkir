<P><a href="login.php" class="selected"></a></P>

<?php 
	if (isset($_GET["module"])) {
 		$Nama_file = $_GET["module"];
 		include "$Nama_file.php";
	}else
        include "login.php";
?>
