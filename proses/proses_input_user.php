<?php
include "connect.php";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5($username);

if (isset($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "INSERT INTO tb_user (nama,username,level,nohp,alamat,password) values ('$name','$username','$level','$nohp','$alamat','$password')");
    if ($query) {
        $message = '<script>alert("Data Berhasil DiMasukkan");
    window.location="/webseafood/user"</script>
    </script>';
    } else {
        $message = '<script>alert("Data Gagal DiMasukkan")</script>';
    }
}
echo $message;
