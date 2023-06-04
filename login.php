<html lang="en">
<head>
    Halaman Login
</head>

<body>
<form action="register.php" method="post">
    <tr>
    <form action="?module=loginproc#pos" method="post">
			USERNAME
				<input type="text" name="username" size="17" />

			PASSWORD
				<input type="password" name="password" size="17"/>
	</form>
	</tr>

    <tr>
        <label for="isAdmin">
            <input type="checkbox" id="isAdmin" name="checklist[]" value="isAdmin"> Admin
        </label>
    </tr>

    <tr><input type="submit" value="Login" size="16"/></tr>
</form>
</body>

</html>