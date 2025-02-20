<?php
// session_start();
file_put_contents('log.txt', "Script dieksekusi\n", FILE_APPEND);

date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

include "../config/connect.php";

// ======= logic image upload ===============================

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"]) && isset($_POST['namakategori'])) {
    $targetDir = __DIR__ . "/../public/uploads/kategori/";

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
    $targetFilePath = $targetDir . $fileName;

    print_r($_FILES);
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));


    var_dump($fileType); // Debugging tipe file
    // Cek jenis file
    $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];
    if (in_array($fileType, $allowTypes)) {

        $randomString = substr(md5(time() . rand()), 0, 5); // String acak 5 karakter
        $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_POST["nama_file"]); // Bersihkan karakter aneh
        $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); // Ambil ekstensi file
        $namaFileFinal = $namaFileBaru . $randomString . "." . $fileExtension;

        $targetFile = $targetDir . $namaFileFinal;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

            if ($conn->connect_error) {
                die("Koneksi database gagal: " . $conn->connect_error);
            }

            $url = $conn->real_escape_string($targetFile);
            $sql = "INSERT INTO tb_kategori (gambar_url) VALUES ('$url')";

            if ($conn->query($sql)) {
                echo "Gambar berhasil diunggah!";
            } else {
                echo "Error: " . $conn->error;
            }

            $conn->close();

            echo "File berhasil dipindahkan ke: " . $targetFile;
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Format file tidak didukung.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
