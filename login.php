<html lang="en">
<head>
    Halaman Login
</head>

<body>
<form action="lib/loginproc.php" method="post">
    <tr>
			USERNAME
				<input type="text" name="username" size="17" />

			PASSWORD
				<input type="password" name="password" size="17"/>
	</tr>

    <tr>
        <label for="id">
            <input type="checkbox" id="isAdmin" name="checklist" value="isAdmin"> Admin
        </label>
    </tr>

    <tr>
        <input type="submit" value="Login" size="16"/>
    </tr>
</form>
</body>

</html>