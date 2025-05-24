<?php
// session_start();
if (!empty($_SESSION['username_kingseafood'])) {
    header('location: ../admin/home');
}
?>

<?php include './partials/admin/start.php' ?>

<body class="flex items-center justify-center w-screen h-screen bg-[url(../images/kings.png)] font-fredoka backdrop-blur-lg">
    <div class="bg-white/15 rounded-lg shadow-lg p-5 items-center justify-center">
        <div class="">

            <h1 class="text-4xl text-white ">Password anda lupa ?</h1>
            <p class="text-white mb-3 font-extralight text-xs mt-2">Jangan khawatir. Kami akan mengirimkan intruksi pada email anda.</p>
            <form action="../proses/proses_pwd_request.php" method="post">
                <div class="w-full justify-center flex items-center mt-5">
                    <div class="relative w-80 mb-5 ">
                        <input name="email" type="email" class="block w-full px-4 text-white bg-transparent py-3 text-sm  border-white border rounded-lg peer ps-11 focus:border-white focus:ring-white focus:border-2 disabled:opacity-50 disabled:pointer-events-none placeholder-white " placeholder="Masukkan email anda..." required>
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <svg class="text-gray-100 shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-around gap-x-12">
                    <a href="login" class="inline-flex items-center gap-2 text-sm w-full justify-center font-medium text-white bg-white/15 hover:bg-gray-800 px-3 py-3 rounded-lg transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>

                    <button name="submit_validate" type="submit" class="inline-flex items-center justify-center py-3 text-sm font-medium text-white border-b-2 border-white rounded-lg w-full bg-white/45 gap-x-2 hover:bg-primary-600 focus:outline-none focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

<?php include './partials/admin/end.php' ?>