<html lang="en">

<head>
    <?php
    include "./components/head-tags.php";
    ?>
    <title>Halaman Login</title>
</head>

<body class="h-full">
    <div class="container flex justify-center items-center mx-auto h-full">
        <form action="?php=loginproc#pos" method="post" class="bg-blue-600 text-gray-200 w-fit gap-3 p-10 rounded-lg">
            <h2 class="text-center mb-3">Login Untuk Masuk</h2>

            <div class="flex flex-col items-center">
                <div>
                    <label for="username" class="block mb-1">
                        USERNAME
                    </label>
                    <i class="fa-solid fa-user"></i>
                    <input id="username" type="text" name="username" placeholder="USERNAME" required class="border border-gray-200 py-1 pr-4 pl-10 bg-blue-600 rounded-lg" />
                </div>

                <div class="mb-3">
                    <label for="password" class="block mb-1">
                        PASSWORD
                    </label>
                    <i class="fa-solid fa-key"></i>
                    <input id="password" type="password" name="pass" placeholder="PASSWORD" required class="border border-gray-200 py-1 pr-4 pl-10 bg-blue-600 rounded-lg" />
                </div>

                <div>
                    <input type="checkbox" name="check" id="check"> Login as Admin
                </div>

                <button class="border w-full border-gray-200 py-1 bg-white text-blue-600 rounded-lg">Login</button>
            </div>
        </form>
    </div>
</body>

</html>