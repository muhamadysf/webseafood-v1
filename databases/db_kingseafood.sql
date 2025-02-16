-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 08:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kingseafood`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pesanan`
--

CREATE TABLE `tb_detail_pesanan` (
  `id_detail` int(10) NOT NULL,
  `id_pesanan` int(5) NOT NULL,
  `id_menu` int(2) NOT NULL,
  `qty` int(2) NOT NULL,
  `sub_total` int(10) NOT NULL,
  `catatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` int(2) NOT NULL,
  `id_kategori` int(2) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `hpp` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `status_menu` enum('Tersedia','Bahan Kosong') NOT NULL DEFAULT 'Tersedia',
  `gambar_menu` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembeli`
--

CREATE TABLE `tb_pembeli` (
  `id_pembeli` int(5) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `email_pembeli` varchar(25) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(5) NOT NULL,
  `id_pembeli` int(5) NOT NULL,
  `kode_pesanan` char(10) NOT NULL,
  `jenis_pesanan` enum('Dine In','Take Away') NOT NULL,
  `no_meja` int(2) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `tanggal_pesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `catatan` varchar(100) NOT NULL,
  `metode_bayar` enum('Cash','Qris') NOT NULL,
  `status_pesanan` varchar(10) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(1) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alamat` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `level`, `nohp`, `alamat`) VALUES
(1, 'Owner', 'admin@admin.com', '4a1d16e0c51f538486b2a9b1631d510d', 1, '12345678910', 'jln.kenangan'),
(2, 'Abc1', 'abc1@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '12345678910', ''),
(3, 'Abc2', 'abc2@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, '12345678910', ''),
(4, 'Abc3', 'abc3@abc.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '12345678910', ''),
(12, 'Sarah Az-Zahra', 'sarahazahra@zahra.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '0897655', 'jalan jalan ke pasar malem'),
(16, 'amelia', 'ame0124@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '087714256988', 'London');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  MODIFY `id_detail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id_menu` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
