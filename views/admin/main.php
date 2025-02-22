<?php
//session_start();
if (empty($_SESSION['username_kingseafood'])) {
    header('location:login');
}

include "config/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_kingseafood]'");
$hasil = mysqli_fetch_array($query);


?>

<?php include './partials/admin/start.php' ?>

<body class="w-screen h-screen overflow-auto font-fredoka scrollbar-hide">

    <?php if ((isset($_SESSION['judul'])) && ($_SESSION['judul'] == 'Berhasil.')) : ?>
        <div id="alert-success" class="fixed opacity-0 hidden w-1/3 h-28 z-[9999] shadow-lg p-4 transform top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-opacity duration-300 border-t-4 border-teal-500 rounded-lg bg-teal-800/50 backdrop-blur-sm" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
            <div class="flex">
                <div class="shrink-0">

                    <span class="inline-flex items-center justify-center text-teal-800 bg-teal-200 border-4 border-teal-100 rounded-full opacity-100 size-8">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </span>

                </div>
                <div class="ms-3">
                    <h3 id="hs-bordered-success-style-label" class="text-2xl font-semibold text-white">
                        <?php echo $_SESSION['judul'] ?>
                    </h3>
                    <p class="text-lg text-white ">
                        <?php echo $_SESSION['message'] ?>
                    </p>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                transisi("alert-success");
            });
        </script>
        <?php unset($_SESSION['judul']);
        unset($_SESSION['message']); ?>
    <?php elseif ((isset($_SESSION['judul'])) && ($_SESSION['judul'] == 'Gagal.')) : ?>

        <div id="alert-failed" class="fixed opacity-0 hidden w-1/3 h-28 z-[9999] transform top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-opacity duration-300 before:p-4 shadow-lg border-red-500 bg-red-800/50 border-s-4 backdrop-blur-sm" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
            <div class="flex">
                <div class="ml-2 shrink-0">
                    <!-- Icon -->
                    <span class="inline-flex items-center justify-center text-red-800 bg-red-200 border-4 border-red-100 rounded-full size-8">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </span>
                    <!-- End Icon -->
                </div>
                <div class="ms-3">
                    <h3 id="hs-bordered-red-style-label" class="text-2xl font-semibold text-white">
                        <?php echo $_SESSION['judul'] ?>
                    </h3>
                    <p class="text-lg text-white">
                        <?php echo $_SESSION['message'] ?>
                    </p>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                transisi("alert-failed");
            });
        </script>
    <?php unset($_SESSION['judul']);
        unset($_SESSION['message']);
    endif; ?>

    <div class="flex w-screen min-h-screen " x-data="{ open: true }">
        <!-- sidebar -->
        <?php include './partials/admin/sidebar.php' ?>


        <!-- dashboard -->
        <div class="flex flex-col flex-1 h-full min-h-screen transition-all duration-300 bg-primary-150"
            :class="open ? 'ml-56' : 'ml-0 '">

            <!-- header -->
            <?php include './partials/admin/header.php' ?>

            <!-- main content-->
            <main class="flex-1 w-full h-full p-8 overflow-auto scrollbar-hide">
                <?php include $page; ?>
            </main>

            <!-- footer -->
            <?php include './partials/admin/footer.php' ?>

        </div>

    </div>

    <script>
        function transisi(alertType) {
            const alertBox = document.getElementById(alertType);
            if (!alertBox) return;

            alertBox.classList.remove("hidden");
            setTimeout(() => {
                alertBox.classList.add("opacity-100");
                alertBox.classList.remove("opacity-0");
            }, 100);


            setTimeout(() => {
                alertBox.classList.remove("opacity-100");
                alertBox.classList.add("opacity-0");


                setTimeout(() => alertBox.classList.add("hidden"), 500);
            }, 5000);
        }
    </script>


    <?php include './partials/admin/end.php' ?>