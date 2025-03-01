<!-- Content -->
<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "./views/admin/home.php";
    include "./views/admin/main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'poskasir') {
    $page = "./views/admin/poskasir.php";
    include "./views/admin/main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'user') {
    if ($_SESSION['level_kingseafood'] == 1) {
        $page = "./views/admin/user.php";
        include "./views/admin/main.php";
    } else {
        $page = "./views/admin/home.php";
        include "./views/admin/main.php";
    }
} else if (isset($_GET['x']) && $_GET['x'] == 'customer') {
    $page = "./views/admin/customer.php";
    include "./views/admin/main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'report') {
    if ($_SESSION['level_kingseafood'] == 1) {
        $page = "./views/admin/report.php";
        include "./views/admin/main.php";
    } else {
        $page = "./views/admin/home.php";
        include "./views/admin/main.php";
    }
} else if (isset($_GET['x']) && $_GET['x'] == 'menu') {
    $page = "./views/admin/menu.php";
    include "./views/admin/main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'category') {
    $page = "./views/admin/category.php";
    include "./views/admin/main.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "./views/admin/login.php";
} else if (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "./proses/proses_logout.php";
} else {
    $page = "./views/admin/home.php";
    include "./views/admin/main.php";
}
?>
<!-- End Content -->