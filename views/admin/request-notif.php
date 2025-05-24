<?php
// session_start();
if (!empty($_SESSION['username_kingseafood'])) {
    header('location: ../admin/home');
}
?>

<?php include './partials/admin/start.php' ?>

<body class="flex items-center justify-center w-screen h-screen bg-[url(../images/kings.png)] font-fredoka backdrop-blur-lg">
    <div class="bg-white/15 rounded-lg shadow-lg p-5 items-center justify-center">
        <div class="flex flex-col items-center">

            <div class="flex items-center justify-center mt-5">
                <img src="../public/assets/images/cek-email.png" alt="cek-email" class="w-48 h-auto mb-4">
            </div>

            <h1 class="text-4xl text-white text-center">Silahkan cek email anda !</h1>

            <p class="text-white mb-3 font-extralight text-sm mt-2 text-center">Kami telah mengirimkan instruksi pemulihan <br> melalui email Anda.</p>

            <div class="max-w-xs w-full mt-7">
                <a href="https://mail.google.com/" target="_blank" rel="noopener noreferrer" class="inline-flex w-full items-center justify-center gap-2 bg-white/50 border border-gray-300 hover:bg-gray-100 text-gray-800 font-medium py-2 px-4 rounded-lg text-sm transition duration-200">
                    <img src="https://www.gstatic.com/images/branding/product/1x/gmail_2020q4_48dp.png" alt="Gmail Icon" class="w-5 h-5">
                    Buka Gmail
                </a>

                <div class="py-3 flex items-center text-xs text-white uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6">Atau</div>

                <a href="login" class="inline-flex items-center gap-2 text-sm w-full justify-center font-medium text-white bg-gray-700 hover:bg-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>




</body>

<?php include './partials/admin/end.php' ?>