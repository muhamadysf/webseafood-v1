<?php
session_start();

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

include "../config/connect.php";


if (isset($_POST['btnSubmit'])) {

    $idmenu = $_POST['id'];
    $idkategori = (isset($_POST['kategori'])) ? htmlentities(trim($_POST['kategori'])) : "";
    $namamenu = (isset($_POST['nama'])) ? htmlentities(trim($_POST['nama'])) : "";
    $deskripsi = (isset($_POST['deskripsi'])) ? htmlentities(trim($_POST['deskripsi'])) : "";
    $hpp = (isset($_POST['hpp'])) ? htmlentities(trim($_POST['hpp'])) : "";
    $harga = (isset($_POST['harga'])) ? htmlentities(trim($_POST['harga'])) : "";
    $status = (isset($_POST['status'])) ? htmlentities(trim($_POST['status'])) : "";

    $query = mysqli_query($conn, "SELECT gambar_menu FROM tb_menu WHERE id_menu = '$idmenu'");
    $baris = mysqli_fetch_assoc($query);
    $oldimage = $baris['gambar_menu'];


    $targetDb = "";

    $targetDir = "../public/uploads/menu/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    } else {
        // 
    }

    if ($_FILES['file']['error'] == 0) {

        $fileName = basename($_FILES["file"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];

        if (in_array($fileType, $allowTypes)) {

            $randomString = substr(md5(time() . rand()), 0, 5);
            $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $namamenu);
            $namaFileFinal = $namaFileBaru . $randomString . "." . $fileType;
            $targetFile = $targetDir . $namaFileFinal;

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

                if (!empty($oldimage) && file_exists("../" . $oldimage)) {
                    unlink("../" . $oldimage);
                }

                if ($conn->connect_error) {
                    $_SESSION['judul'] = "Gagal.";
                    $_SESSION['message'] = "Koneksi database gagal: " . $conn->connect_error;
                    header("Location: /webseafood/menu");
                    exit();
                }

                $targetDb = "public/uploads/menu/" . $namaFileFinal;
            } else {
                $_SESSION['judul'] = "Gagal.";
                $_SESSION['message'] = "Gagal mengunggah gambar.";
                header("Location: /webseafood/menu");
                exit();
            }
        } else {
            $_SESSION['judul'] = "Gagal.";
            $_SESSION['message'] = "Format file tidak didukung.";
            header("Location: /webseafood/menu");
            exit();
        }
    } else {
        $targetDb = $oldimage;
    }

    $sql = "UPDATE tb_menu SET id_kategori = ?, nama_menu = ?, deskripsi = ?, hpp = ?, harga = ?, status_menu = ?, gambar_menu = ? WHERE id_menu= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issiissi", $idkategori, $namamenu, $deskripsi, $hpp, $harga, $status, $targetDb, $idmenu);

    if ($stmt->execute()) {
        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data kategori berhasil diperbarui !";
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Gagal memperbarui data: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
    header("Location: /webseafood/menu");
    exit();
}
