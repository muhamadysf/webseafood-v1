<?php
session_start();
file_put_contents('log.txt', "Script dieksekusi\n", FILE_APPEND);

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

include "../config/connect.php";



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"]) && isset($_POST['namakategori'])) {

    $namakategori = trim($_POST['namakategori']);

    // ========== proses pengelohan file img ===============================

    $targetDir = "../public/uploads/kategori/";

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
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // Ambil ekstensi file lalu kecilkan huruf
    $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];


    // Cek jenis file

    if (in_array($fileType, $allowTypes)) {

        $randomString = substr(md5(time() . rand()), 0, 5); // String acak 5 karakter
        $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $namakategori); // Bersihkan karakter aneh
        $namaFileFinal = $namaFileBaru . $randomString . "." . $fileType;
        $targetFile = $targetDir . $namaFileFinal;
        $targetDb = "public/uploads/kategori/" . $namaFileFinal;


        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

            if ($conn->connect_error) {
                $_SESSION['judul'] = "Gagal.";
                $_SESSION['message'] = "Koneksi database gagal: " . $conn->connect_error;
                header("Location: /webseafood/category");
                exit();
            }

            // =========== proses simpan data ke database ===============================

            $sql = "INSERT INTO tb_kategori (nama_kategori, logo_kategori) VALUES (?, ?)";


            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ss", $namakategori, $targetDb);
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
header("Location: /webseafood/category");
exit();
