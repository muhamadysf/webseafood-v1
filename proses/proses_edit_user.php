<?php
include "../config/connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$name = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$username = (isset($_POST['email'])) ? htmlentities($_POST['email']) : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";
$password = md5('password');

if (isset($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "UPDATE tb_user SET nama='$name', username='$username', level='$level', nohp='$nohp', alamat='$alamat' WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Data Berhasil Di Edit");
    window.location="/webseafood/user"</script>
    </script>';
    } else {
        $message = '<script>alert("Data Gagal Di Edit")</script>';
    }
}
echo $message;
