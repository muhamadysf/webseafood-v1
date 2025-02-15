<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (isset($_POST['input_user_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Data Berhasil Di Hapus");
    window.location="../user"</script>
    </script>';
    } else {
        $message = '<script>alert("Data Gagal Di Hapus")</script>';
    }
}
echo $message;
