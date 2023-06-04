<body>
    <?php
    session_start();
    $id = $_SESSION["id"];
    ?>
    <h2>Edit Data</h2>
    <form action="handle-ganti-data-user.php" method="post">
        <table width="487" border="0">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <tr>
                <td width="150">Username</td>
                <td width="327"><input type="text" name="username" value="<?php echo $_SESSION["username"] ?>"></td>
            </tr>
            <tr>
                <td width="150">Password</td>
                <td width="327"><input type="text" name="password" value="<?php echo $_SESSION["password"] ?>"></td>
            </tr>
            <tr>
                <td height="68" align="right"><input type="reset" value="reset"></td>
                <td><input type="submit" value="submit"></td>
            </tr>
        </table>
    </form>
</body>