<?php
// session_start();
if (!empty($_SESSION['username_kingseafood'])) {
    header('location: ../admin/home');
    exit;
}

include "config/connect.php";
date_default_timezone_set("Asia/Bangkok");

$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

$query = "SELECT * FROM tb_reset_pwd WHERE token = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $expires_at = $data['expires_at'];
    $email = $data['email'];

    if (time() > strtotime($expires_at)) {

?>
        <script>
            alert('Token tidak ditemukan / sudah kadaluarsa.\nSilahkan ulangi proses anda...');
            window.location = '../admin/login';
        </script>
<?php
        // $message = urlencode('Token telah kadaluarsa. Silahkan Ulangi Kembali');
        // header("Location: login.php?message=$message");
        exit;
    }
}

?>

<?php include './partials/admin/start.php' ?>

<body class="flex items-center justify-center w-screen h-screen bg-[url(../images/kings.png)] font-fredoka backdrop-blur-lg">
    <div class="bg-white/15 rounded-lg shadow-lg p-5 items-center justify-center">
        <div class="">

            <h1 class="text-4xl text-white">Reset password anda</h1>

            <form action="../proses/proses_pwd_reset.php" method="post">

                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

                <!-- input password -->
                <div class="w-full justify-center flex items-center mt-8 flex-col space-y-5" data-hs-toggle-password-group="">
                    <div class="relative w-80  ">
                        <label for="hs-toggle-password-multi-toggle-np" class="block text-sm mb-2 text-white">Password baru</label>
                        <div class="relative">
                            <input id="hs-toggle-password-multi-toggle-np" name="password" type="password" class="py-2.5 sm:py-3 text-white ps-4 pe-10 block placeholder-white w-full bg-transparent border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan password baru anda..." maxlength="15" minlength="8" required>
                            <button type="button" data-hs-toggle-password='{ "target": ["#hs-toggle-password-multi-toggle-np"] }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-white rounded-e-md focus:outline-hidden focus:text-primary-500">
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
                    <div class="relative w-80 ">
                        <label for="hs-toggle-password-multi-toggle" class="block text-sm mb-2 text-white">Konfirmasi password baru</label>
                        <div class="relative">
                            <input id="hs-toggle-password-multi-toggle" type="password" class="py-2.5 sm:py-3 text-white ps-4 bg-transparent placeholder-white pe-10 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-primary-500 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="Masukkan ulang password baru" maxlength="15" minlength="8" required>
                            <button type="button" data-hs-toggle-password='{ "target": ["#hs-toggle-password-multi-toggle" ] }' class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-white rounded-e-md focus:outline-hidden focus:text-primary-500">
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
                </div>

                <!-- button -->
                <div class="flex items-center justify-between mt-7">
                    <a href="login" class="inline-flex items-center justify-center py-3 text-sm font-medium text-white border border-white rounded-lg w-full pr-4 mx-8 bg-white/15 gap-x-2 hover:bg-white/75 hover:text-gray-500 focus:outline-none focus:bg-slate-900 disabled:opacity-50 disabled:pointer-events-none transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Batalkan
                    </a>
                    <button id="btn-reset" name="submit_validate" type="submit" class="inline-flex items-center justify-center py-3 text-sm font-medium text-white border-2 border-white rounded-lg w-full mx-8 bg-white/35 gap-x-2 hover:bg-primary-300 focus:outline-none focus:bg-primary-300/55 disabled:opacity-50 disabled:pointer-events-none">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        const inputPwd = document.getElementById('hs-toggle-password-multi-toggle-np');
        const inputPwdConfir = document.getElementById('hs-toggle-password-multi-toggle');

        document.getElementById('btn-reset').addEventListener('click', function(event) {
            let dataPwd = inputPwd.value;
            let dataConfir = inputPwdConfir.value;

            if ((dataConfir !== dataPwd)) {
                event.preventDefault();
                alert('Data password baru tidak sama dengan data konfirmasi password');
            }

        });

        // 
    </script>

</body>

<?php include './partials/admin/end.php' ?>