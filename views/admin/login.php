<?php
// session_start();
if (!empty($_SESSION['username_kingseafood'])) {
    header('location:home');
}
?>

<?php include './partials/admin/start.php' ?>

<body class="flex items-center justify-center w-screen h-screen bg-[url(../../assets/images/kings.png)] font-fredoka backdrop-blur-lg">

    <div class="flex w-3/5 rounded-lg shadow-xl bg-white/70">
        <div class="flex flex-col items-center justify-center w-1/2 px-2 py-8 rounded-tl-lg rounded-bl-lg bg-red-950">
            <img src="./assets/images/logo.png" alt="logo" class="w-48 h-auto mb-4">

        </div>

        <div class="flex flex-col justify-center w-1/2 p-8">
            <div class="w-full mb-8 text-center text-primary-600">
                <h1 class="text-3xl font-bold ">Selamat Datang !</h1>
                <p class="text-sm ">Silahkan Login untuk mengakses panel admin.</p>


            </div>

            <div class="">
                <form class="" action="./proses/proses_login.php" method="post" novalidate>
                    <div class="w-full mb-4 space-y-3">
                        <div class="relative">
                            <input name="email" type="email" class="block w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-lg peer ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan email anda..." required>
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <svg class="text-gray-500 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        </div>

                        <div class="relative">
                            <input name="password" id="hs-toggle-password" type="password" class="block w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-lg peer ps-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan password anda..." required>
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <svg class="text-gray-500 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                                    <circle cx="16.5" cy="7.5" r=".5"></circle>
                                </svg>
                            </div>
                            <button type="button" data-hs-toggle-password='{
                            "target": "#hs-toggle-password"
                                    }' class="absolute inset-y-0 z-20 flex items-center px-3 text-gray-400 cursor-pointer end-0 rounded-e-md focus:outline-none focus:text-blue-600">
                                <svg class="shrink-0 size-3.5" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                    <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                    <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                    <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex">
                            <input name="remember" type="checkbox" class="shrink-0 mt-0.5 ml-8 border-gray-200 border-2 bg-transparent rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" id="hs-default-checkbox">
                            <label for="hs-default-checkbox" class="text-sm text-gray-700 ms-2">Tetap login</label>
                        </div>
                        <button name="submit_validate" type="submit" class="inline-flex items-center justify-center py-3 text-sm font-medium text-white border border-transparent rounded-lg w-44 bg-primary-500 gap-x-2 hover:bg-primary-600 focus:outline-none focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <hr class="w-full h-[2px] bg-primary-600 border-primary-600 rounded-xl my-4">
            <a href="" class="inline-flex justify-center text-primary-500 hover:text-primary-300">Lupa Password ?</a>
        </div>

    </div>



</body>

<?php include './partials/admin/end.php' ?>