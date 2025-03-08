<?php
session_start();
file_put_contents('log.txt', "Script dieksekusi\n", FILE_APPEND);

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

include "../config/connect.php";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"]) && isset($_POST['btnSubmit'])) {

    $idkategori = (isset($_POST['kategori'])) ? htmlentities(trim($_POST['kategori'])) : "";
    $namamenu = (isset($_POST['nama'])) ? htmlentities(trim($_POST['nama'])) : "";
    $deskripsi = (isset($_POST['deskripsi'])) ? htmlentities(trim($_POST['deskripsi'])) : "";
    $hpp = (isset($_POST['hpp'])) ? htmlentities(trim($_POST['hpp'])) : "";
    $harga = (isset($_POST['harga'])) ? htmlentities(trim($_POST['harga'])) : "";
    $status = (isset($_POST['status'])) ? htmlentities(trim($_POST['status'])) : "";


    // ========== proses pengelohan file img ===============================

    $targetDir = "../public/uploads/menu/";

    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    } else {
        // 
    }

    if ($_FILES["file"]["error"] !== 0) {
        echo "Terjadi error saat upload: " . $_FILES["file"]["error"];
        exit;
    }

    $fileName = basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];


    // Cek jenis file

    if (in_array($fileType, $allowTypes)) {

        $randomString = substr(md5(time() . rand()), 0, 5);
        $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $namamenu);
        $namaFileFinal = $namaFileBaru . $randomString . "." . $fileType;
        $targetFile = $targetDir . $namaFileFinal;
        $targetDb = "public/uploads/menu/" . $namaFileFinal;


        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

            if ($conn->connect_error) {
                $_SESSION['judul'] = "Gagal.";
                $_SESSION['message'] = "Koneksi database gagal: " . $conn->connect_error;
                header("Location: /webseafood/menu");
                exit();
            }

            // =========== proses simpan data ke database ===============================

            $sql = "INSERT INTO tb_menu (id_kategori, nama_menu, deskripsi, hpp, harga, status_menu, gambar_menu) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("issiiss", $idkategori, $namamenu, $deskripsi, $hpp, $harga, $status, $targetDb);
            if ($stmt->execute()) {
                $_SESSION['judul'] = "Berhasil.";
                $_SESSION['message'] = "Data kategori baru berhasil disimpan !";
            } else {
                $_SESSION['judul'] = "Gagal.";
                $_SESSION['message'] = "Data gagal disimpan! Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            $_SESSION['judul'] = "Gagal.";
            $_SESSION['message'] = "Gagal mengunggah gambar.";
        }
    } else {
        $_SESSION['judul'] = "Gagal.";
        $_SESSION['message'] = "Format file tidak didukung.";
    }
} else {
    $_SESSION['judul'] = "Gagal.";
    $_SESSION['message'] = "Tidak ada file yang diunggah. ";
}
header("Location: /webseafood/menu");
exit();
