<html lang="en">

<head>
    <?php
    include "./components/head-tags.php";
    ?>
    <title>Halaman Login</title>
</head>

<body class="h-full bg-[url('public/img/parkiran.jpg')] bg-cover relative backdrop-blur-sm">
    <div class="absolute inset-0 bg-black/50"></div>

    <div class="container flex justify-center items-center mx-auto h-full">

        <form action="?php=loginproc#pos" method="post" class="z-10 relative bg-transparent backdrop-blur-sm text-gray-200 w-fit gap-3 p-10 rounded-lg shadow-2xl shadow-gray-700/60 ">
            <div class="flex justify-center items-center"><i class="fa-solid fa-circle-user fa-3x"></i></div>
            <h2 class="text-center m-5 font-medium text-3xl">Login</h2>

            <div class="flex flex-col items-center ">
                <div class="flex items-center relative border border-gray-200 pl-3 rounded-lg mb-3">
                    <i class="fa-solid fa-user"></i>

                    <input type="text" id="username" placeholder="Username" class="transition-colors placeholder:text-transparent peer py-1 w-full rounded-md px-10 pl-4 text-lg text-gray-200   outline-none bg-transparent disabled:cursor-not-allowed disabled:opacity-20 border-l-0 rounded-l-none">

                    <label class="px-1 -translate-x-1 scale-90 transition-all absolute left-9 top-1/2 -translate-y-9 text-sm text-gray-200 backdrop-blur-3xl z-20 peer-focus:-translate-x-8 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-200" for=" username"><span>Username</span></label>
                </div>

                <div class="flex items-center relative border border-gray-200 pl-3 rounded-lg mb-2">
                    <i class="fa-solid fa-key"></i>

                    <input type="password" id="pass" placeholder="Password" class="transition-colors placeholder:text-transparent peer py-1 w-full rounded-md px-10 pl-4 text-lg text-gray-200   outline-none bg-transparent disabled:cursor-not-allowed disabled:opacity-20 border-l-0 rounded-l-none">

                    <label class="px-1 -translate-x-1 scale-90 transition-all absolute left-9 top-1/2 -translate-y-9 text-sm text-gray-200  bg-transparent backdrop-blur-3xl peer-focus:-translate-x-8 peer-focus:-translate-y-[30px] peer-focus:scale-90 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:translate-x-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:text-gray-200" for=" pass"><span>Password</span></label>
                </div>

                <div class="mb-2">
                    <input type="checkbox" name="check" id="check"> Login as Admin
                </div>

                <button class="border w-full border-gray-200 py-1 bg-white text-blue-500 rounded-lg drop-shadow-lg hover:bg-slate-200 hover:text-blue-700">Login</button>
            </div>
        </form>
    </div>
</body>

</html>

<!-- focus:border-transparent -->