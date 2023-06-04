<?php
include "db/koneksi.php";
include "components/head-tags.php";
$hasil = mysqli_query($conn, "SELECT * FROM user");
$buff = mysqli_fetch_assoc($hasil);

session_start();
$_SESSION["id"] = $buff["id"];
$_SESSION["username"] = $buff["username"];
$_SESSION["password"] = $buff["password"];

$id = $_SESSION["id"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>HALAMAN USER</h1>
    </BR>
    <div class="flex font-sans text-xl">
        <div>
            <input type="hidden" name="id">
            <h2>Username</h2>
            <h2>Password</h2>
        </div>
        <div class="pl-3">
            <input type="hidden" value="<?php echo $id ?>">
            <h2>: <?php echo $_SESSION["username"] ?></h2>
            <h2>: <?php echo $_SESSION["password"] ?></h2>
        </div>
    </div>
    </br>
    <div class="pl-3">
        <button class="rounded-none h-5 w-20 bg-slate-500 "><a href="lib/ganti.php?id=<?php echo $_SESSION["id"] ?>">Ganti</a></button>
    </div>
</body>

</html>