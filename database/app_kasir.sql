-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 07:01 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detailpenjualan`
--

CREATE TABLE `tb_detailpenjualan` (
  `id_detail` int(11) NOT NULL,
  `id_penjualan` char(20) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_detailpenjualan`
--

INSERT INTO `tb_detailpenjualan` (`id_detail`, `id_penjualan`, `id_produk`, `jumlah_produk`) VALUES
(44, 'CARLIMART-001', 2, 5),
(45, 'CARLIMART-001', 17, 1),
(46, 'CARLIMART-001', 15, 3),
(47, 'CARLIMART-002', 17, 10),
(48, 'CARLIMART-002', 16, 1),
(49, 'CARLIMART-002', 14, 1),
(50, 'CARLIMART-002', 12, 2),
(51, 'CARLIMART-002', 15, 1),
(52, 'CARLIMART-003', 1, 2),
(53, 'CARLIMART-003', 2, 2),
(54, 'CARLIMART-004', 1, 4),
(55, 'CARLIMART-004', 2, 4),
(56, 'CARLIMART-005', 1, 4),
(57, 'CARLIMART-005', 2, 4),
(58, 'CARLIMART-006', 1, 5),
(59, 'CARLIMART-006', 18, 3),
(60, 'CARLIMART-006', 10, 1),
(61, 'CARLIMART-006', 17, 3),
(62, 'CARLIMART-007', 15, 2),
(63, 'CARLIMART-007', 18, 1),
(64, 'CARLIMART-007', 13, 1),
(65, 'CARLIMART-007', 20, 3),
(66, 'CARLIMART-007', 19, 1),
(67, 'CARLIMART-007', 12, 1),
(68, 'CARLIMART-008', 13, 1),
(69, 'CARLIMART-008', 18, 5),
(70, 'CARLIMART-008', 14, 1),
(71, 'CARLIMART-008', 10, 2),
(72, 'CARLIMART-009', 2, 3),
(73, 'CARLIMART-009', 15, 1),
(74, 'CARLIMART-009', 17, 4),
(75, 'CARLIMART-009', 18, 2),
(76, 'CARLIMART-009', 7, 1),
(77, 'CARLIMART-010', 1, 2),
(78, 'CARLIMART-010', 14, 3),
(79, 'CARLIMART-010', 17, 1),
(80, 'CARLIMART-010', 15, 2),
(81, 'CARLIMART-012', 16, 1),
(82, 'CARLIMART-013', 13, 2),
(83, 'CARLIMART-013', 19, 2),
(84, 'CARLIMART-013', 10, 3),
(85, 'CARLIMART-014', 24, 2),
(86, 'CARLIMART-014', 14, 1),
(87, 'CARLIMART-014', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` char(13) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `alamat`, `no_telepon`) VALUES
('PELANGGAN-001', 'Budi Santoso', 'Jl. Merdeka No. 123, Jakarta', '081234567890'),
('PELANGGAN-002', 'Siti Rahayu', 'Jl. Sudirman No. 456, Surabaya', '087654321098'),
('PELANGGAN-003', 'Slamet Susanto', 'Jl. Pahlawan No. 789, Bandung', '081112223344'),
('PELANGGAN-004', 'Dewi Permata', 'Jl. Gajah Mada No. 101, Yogyakarta', '082211122233'),
('PELANGGAN-005', 'Agus Setiawan', 'Jl. Diponegoro No. 555, Semarang', '085678901234'),
('PELANGGAN-006', 'Maya Indah', 'Jl. Hayam Wuruk No. 789, Medan', '081345678901'),
('PELANGGAN-007', 'Joko Prabowo', 'Jl. Imam Bonjol No. 321, Makassar', '087812345678'),
('PELANGGAN-008', 'Rina Wahyuni', 'Jl. Thamrin No. 987, Palembang', '081998877665'),
('PELANGGAN-009', 'Adi Nugroho', 'Jl. MH Thamrin No. 222, Balikpapan', '082211122233'),
('PELANGGAN-010', 'Nina Cahaya', 'Jl. Ahmad Yani No. 333, Samarinda', '081234567890'),
('PELANGGAN-011', 'Lionel Messi', 'desa gunung krucut', '030399020933');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` char(20) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `id_pelanggan` char(13) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `tanggal_penjualan`, `id_pelanggan`, `jumlah_produk`, `bayar`, `total_bayar`) VALUES
('CARLIMART-001', '2024-02-17', 'PELANGGAN-005', 3, 100000, 54500),
('CARLIMART-002', '2024-02-17', 'PELANGGAN-008', 5, 200000, 106000),
('CARLIMART-003', '2024-02-19', 'PELANGGAN-004', 2, 20000, 15000),
('CARLIMART-004', '2024-02-19', 'PELANGGAN-002', 2, 50000, 30000),
('CARLIMART-005', '2024-02-19', 'PELANGGAN-001', 2, 40000, 30000),
('CARLIMART-006', '2024-02-19', 'PELANGGAN-007', 4, 100000, 83000),
('CARLIMART-007', '2024-02-19', 'PELANGGAN-010', 6, 100000, 77500),
('CARLIMART-008', '2024-02-20', 'PELANGGAN-006', 4, 100000, 94000),
('CARLIMART-009', '2024-02-20', 'PELANGGAN-010', 5, 100000, 66500),
('CARLIMART-010', '2024-02-21', 'PELANGGAN-005', 4, 100000, 85000),
('CARLIMART-011', '2024-03-02', 'PELANGGAN-006', 3, 0, 0),
('CARLIMART-012', '2024-03-02', 'PELANGGAN-003', 1, 5000, 3000),
('CARLIMART-013', '2024-03-02', 'PELANGGAN-009', 3, 100000, 80000),
('CARLIMART-014', '2024-03-02', 'PELANGGAN-011', 3, 100000, 71000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama`, `jenis_kelamin`, `alamat`, `foto`, `id_user`) VALUES
(4, 'Carli Wiranata', 'Laki-laki', 'Dusun 4 Karang Anyar', 'home1.png', 6),
(5, 'Ridho aja', 'Laki-laki', 'Dusun 4 Karang Anyar', 'pexels-stefan-stefancik-91227.jpg', 7),
(8, 'William', 'Laki-laki', 'Dusun IV Karang Anyar', 'pexels-creation-hill-1681010.jpg', 10),
(9, 'Carli', 'Laki-laki', 'Dusun IV Karang Anyar Kec. Beringin', 'about1.png', 11),
(10, 'ackmal', 'Laki-laki', 'sssjjsjs', 'WIN_20231114_12_54_39_Pro.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga`, `stok`) VALUES
(1, 'Sabun Mandi Lifebuoy', 5000, 203),
(2, 'Mi Instan Indomie Goreng', 2500, 187),
(3, 'Gula Pasir Gulaku', 12000, 100),
(4, 'Kecap ABC', 8000, 90),
(5, 'Susu Ultra Milk', 12000, 60),
(6, 'Shampoo Clear', 15000, 100),
(7, 'Mie Sedaap Rasa Ayam Bawang', 3000, 119),
(8, 'Teh Botol Sosro', 6000, 90),
(9, 'Minyak Goreng Filma', 20000, 50),
(10, 'Kopi Kapal Api', 10000, 104),
(11, 'Sikat Gigi Pepsodent', 7000, 70),
(12, 'Tisu Paseo', 8000, 149),
(13, 'Pasta Gigi Formula', 9000, 61),
(14, 'Beras Rojolele', 15000, 25),
(15, 'Sarden ABC', 12000, 35),
(16, 'Pisang Ambon', 3000, 179),
(17, 'Coca-Cola', 6000, 92),
(18, 'Teh Celup Sariwangi', 10000, 79),
(19, 'Susu Dancow', 16000, 51),
(20, 'Mie Sedap Rasa Soto', 3500, 77),
(24, 'Panci', 20000, 98);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', '$2y$10$v4ZCsTUsvLy4ipiyqw4Hhu6ft6I0w0Vwtz67tazSp/Isic8IW9x.q', 1),
(6, 'petugas', '$2y$10$mr7GnioSUwAXwJ.a6M3vh.lpwJrnzJqKKHtHcIxvEAr8lNb.mbG0m', 2),
(7, 'petugas2', '$2y$10$B1m5qX4JqWuFNavT2wZyVOxQxXqz3pHXoF5OnKJaLCdcEJRhYZCj2', 2),
(10, 'petugas22', '$2y$10$D2XRn8O6PmIEwvEWwKNHqu2WfOP3rwYQzUqkPXtXMOv.mLuN9s.mi', 2),
(11, 'carli123', '$2y$10$5aGTfYn9zAv9BfxlbNqqaOyXqdrCMkyZTfyVNEHtCxA.wdJeUHjBi', 2),
(12, 'ack', '$2y$10$s60zbvI8BTT2UEmE0.NUAuK7GYhVhV8gnSnIhTlAzmNqQ72p/aapK', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detailpenjualan`
--
ALTER TABLE `tb_detailpenjualan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_detailpenjualan`
--
ALTER TABLE `tb_detailpenjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
