<?php
//session_start();
if (empty($_SESSION['username_kingseafood'])) {
    header('location:login');
}

include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_kingseafood]'");
$hasil = mysqli_fetch_array($query);
?>

<?php include './partials/admin/start.php' ?>

<body class="font-fredoka">
    <div class="flex w-screen h-screen " x-data="{ open: true }">
        <!-- sidebar -->
        <?php include './partials/admin/sidebar.php' ?>


        <!-- dashboard -->
        <div class="flex flex-col flex-1 transition-all duration-300 bg-primary-150"
            :class="open ? 'ml-56' : 'ml-0 '">

            <!-- header -->
            <?php include './partials/admin/header.php' ?>

            <!-- main content-->
            <main class="flex-grow p-4">
                <?php include $page; ?>
            </main>

            <!-- footer -->
            <?php include './partials/admin/footer.php' ?>

        </div>

    </div>



    <?php include './partials/admin/end.php' ?>