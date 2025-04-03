<!-- Content -->
<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    // 
    $page = "./views/customer/home.php";
    include "./views/customer/main.php";
    // -
} else if (isset($_GET['x']) && $_GET['x'] == 'detail') {
    // 
    $page = "./views/customer/detail.php";
    include "./views/customer/main.php";
    // 
} else if (isset($_GET['x']) && $_GET['x'] == 'orders') {
    // 
    if (isset($_SESSION['keranjang'])) {
        // 
        $page = "./views/customer/orders.php";
        include "./views/customer/main.php";
        // 
    } else {
        //
        $page = "./views/customer/home.php";
        include "./views/customer/main.php";
        // 
    }
    // 
} else if (isset($_GET['x']) && $_GET['x'] == 'cart') {
    // if (isset($_SESSION['keranjang'])) {
    // 
    $page = "./views/customer/cart.php";
    include "./views/customer/main.php";
    // 
    // } else {
    // 
    // $page = "./views/customer/home.php";
    // include "./views/customer/main.php";
    // 
    // }
} else if (isset($_GET['x']) && $_GET['x'] == 'checkout') {
    // 
    $page = "./views/customer/checkout.php";
    include "./views/customer/main.php";
    // 
} else {

    $page = "./views/customer/home.php";
    include "./views/customer/main.php";
}
?>
<!-- End Content -->