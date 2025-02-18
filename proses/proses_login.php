<?php
session_start();
include "connect.php";
$username = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";


if (isset($_POST['submit_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        $_SESSION['username_kingseafood'] = $hasil['username'];
        $_SESSION['level_kingseafood'] = $hasil['level'];
        $_SESSION['id'] = $hasil['id'];
        echo "Email yang dimasukkan: " . $_POST['email'];
        header('location: /webseafood/main');
        exit;
    } else {


?>
        <script>
            alert('username atau password yang anda masukkan salah');
            window.location = '/webseafood/login'
        </script>
<?php

    }
}
?>