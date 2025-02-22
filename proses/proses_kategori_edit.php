<?php
session_start();

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

include "../config/connect.php";


if (isset($_POST['btnsubmit'])) {

    $iduser = $_POST['iduser'];
    $namakategori = (isset($_POST['namakategori'])) ? htmlentities($_POST['namakategori']) : "";

    $query = mysqli_query($conn, "SELECT logo_kategori FROM tb_kategori WHERE id_kategori = '$iduser'");
    $baris = mysqli_fetch_assoc($query);
    $oldimage = $baris['logo_kategori'];


    $targetDb = "";

    $targetDir = "../public/uploads/kategori/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    } else {
        // 
    }

    if ($_FILES['file']['error'] == 0) {

        $fileName = basename($_FILES["file"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Ambil ekstensi file lalu kecilkan huruf
        $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];

        if (in_array($fileType, $allowTypes)) {  // Cek jenis file

            $randomString = substr(md5(time() . rand()), 0, 5); // String acak 5 karakter
            $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $namakategori); // Bersihkan karakter aneh
            $namaFileFinal = $namaFileBaru . $randomString . "." . $fileType; // membuat nama baru untuk file img
            $targetFile = $targetDir . $namaFileFinal;                  // lokasi fisik penyimpanan file img

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

                if (!empty($oldimage) && file_exists("../" . $oldimage)) {
                    unlink("../" . $oldimage);
                }

                if ($conn->connect_error) {
                    $_SESSION['judul'] = "Gagal.";
                    $_SESSION['message'] = "Koneksi database gagal: " . $conn->connect_error;
                    header("Location: /webseafood/category");
                    exit();
                }

                $targetDb = "public/uploads/kategori/" . $namaFileFinal;
            } else {
                $_SESSION['judul'] = "Gagal.";
                $_SESSION['message'] = "Gagal mengunggah gambar.";
                header("Location: /webseafood/category");
                exit();
            }
        } else {
            $_SESSION['judul'] = "Gagal.";
            $_SESSION['message'] = "Format file tidak didukung.";
            header("Location: /webseafood/category");
            exit();
        }
    } else {
        $targetDb = $oldimage;
    }

    $sql = "UPDATE tb_kategori SET nama_kategori= ?, logo_kategori= ? WHERE id_kategori= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $namakategori, $targetDb, $iduser);

    if ($stmt->execute()) {
        $_SESSION['judul'] = "Berhasil.";
        $_SESSION['message'] = "Data kategori berhasil diperbarui !";
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Gagal memperbarui data: " . $stmt->error;
    }


    $stmt->close();
    $conn->close();
    header("Location: /webseafood/category");
    exit();
}
