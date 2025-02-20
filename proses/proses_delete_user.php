<?php
include "../config/connect.php";
$id = (isset($_POST['iduser'])) ? htmlentities($_POST['iduser']) : "";

if (isset($_POST['delete_data'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Data Berhasil Di Hapus");
    window.location="/webseafood/user"</script>
    </script>';
    } else {
        $message = '<script>alert("Data Gagal Di Hapus")</script>';
    }
}
echo $message;
