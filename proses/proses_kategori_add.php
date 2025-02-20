<?php
// session_start();
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
    $targetFilePath = $targetDir . $fileName;

    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));



    // Cek jenis file
    $allowTypes = ["jpg", "png", "jpeg", "gif", "webp"];
    if (in_array($fileType, $allowTypes)) {

        $randomString = substr(md5(time() . rand()), 0, 5); // String acak 5 karakter
        $namaFileBaru = preg_replace('/[^A-Za-z0-9_\-]/', '_', $namakategori); // Bersihkan karakter aneh
        $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); // Ambil ekstensi file
        $namaFileFinal = $namaFileBaru . $randomString . "." . $fileExtension;

        $targetFile = $targetDir . $namaFileFinal;
        $targetDb = "public/uploads/kategori/" . $namaFileFinal;


        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

            if ($conn->connect_error) {
                die("Koneksi database gagal: " . $conn->connect_error);
            }

            // =========== proses simpan data ke database ===============================

            $sql = "INSERT INTO tb_kategori (nama_kategori, logo_kategori) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            mysqli_stmt_bind_param($stmt, "ss", $namakategori, $targetDb);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo '<script>window.location = "/webseafood/category"; // Redirect setelah klik OK</script>';
            } else {
                echo "Gagal menyimpan data.";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Format file tidak didukung.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
