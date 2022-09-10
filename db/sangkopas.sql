-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 05:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sangkopas`
--

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `nama`, `tgl_mulai`, `tgl_selesai`, `potongan`, `keterangan`) VALUES
(1, 'Diskon Hari Kemerdekaan', '2022-08-15', '2022-08-20', 12000, 'Minimal pembelian makanan dan minuman 50.000'),
(2, 'Diskon 21 Aug', '2022-08-21', '2022-08-21', 10000, 'minimal pembelian 20000 keatas'),
(3, 'Diskon 9.9 Meriah', '2022-09-08', '2022-09-30', 15000, 'Minimal Pembelian 30000 ');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('laki','perempuan') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`, `nama`, `email`, `hp`, `jenis_kelamin`, `tgl_lahir`) VALUES
(1, 3, 'Ricky Rodesta', 'ricky@mail.com', '82240454123', 'laki', '1995-12-22'),
(2, 4, 'Nisa Wiguna', 'nisa@mail.com', '81293212347', 'perempuan', '1998-10-15'),
(3, 5, 'Anis', 'anis@mail.com', '81273612374', 'perempuan', '1997-11-18'),
(4, 6, 'Hayun', 'hayun@mail.com', '82146483679', 'perempuan', '2010-02-18'),
(5, 7, 'Hefti Febriani', 'hefti0901@gmail.com', '81221913241', 'perempuan', '1994-02-26'),
(6, 8, 'Andri Ramadan ', 'Andri_ramadhan09@yahoo.com', '81221913241', 'laki', '1999-01-09'),
(7, 8, 'Widiyani', 'widi1010@gmail.com', '87830049605', 'perempuan', '1998-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL DEFAULT 0,
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `kategori`, `harga`, `foto`, `keterangan`) VALUES
(1, 'Nasi Goreng Sangko', 'makanan', '14000', 'nasigoreng.jpg', 'Nasi Goreng + Telur Ceplok/Dadar'),
(3, 'Mie Rebus Sangko', 'makanan', '12000', 'MieRebus.jpg', 'Mie Rebus Sang Kopas + Telor Ceplok/Dadar'),
(4, 'Magelangan Sangko', 'minuman', '17000', 'Magelangan.jpg', 'Magelangan + Telor Ceplok/Dadar'),
(5, 'Mie Goreng Sangko', 'makanan', '12000', 'MieGoreng.jpg', 'Mie Goreng + Telor Ceplok/Dadar Khas Sangkopas'),
(6, 'Kopi Susu Original', 'minuman', '16000', 'kopi.jpg', 'Es Kopi + Susu '),
(7, 'Kopi Susu Gula jawa', 'minuman', '16000', 'KopiSusu.jpg', 'Kopi +Susu + Gula jawa'),
(8, 'Ice Jeruk Nipis', 'minuman', '7000', 'EsJerukPeras.jpg', 'Jeruk Peras Segar'),
(9, 'Es Teh', 'minuman', '5000', 'esteh.jpg', 'Es Teh Biasa'),
(10, 'lemon Tea', 'minuman', '8000', 'lemontea.jpg', 'Tea + Lemon'),
(11, 'Air Mineral', 'minuman', '5000', 'airmineral.jpg', 'Air Mineral Biasa/Dingin'),
(12, 'Kopi Cangkir', 'minuman', '7000', 'kopiTub.jpg', 'Kopi Cangkir Biasa'),
(13, 'Kopi Cangkir Susu Tanggung', 'minuman', '10000', 'kopi-susu.jpg', 'Kopi Tanggung + Susu'),
(14, 'Tempe Cocol Sangko', 'snack', '9000', 'CocolanTempe.jpg', 'Tempe Cocol Khas Sangko'),
(15, 'Tahu Tuna Sangko', 'snack', '10000', 'TahuTuna.jpg', 'Tahu Tuna Khas sangko'),
(16, 'Tempe Mendoan Sangko', 'snack', '9000', 'Mendo.jpg', 'Mendoan Khas Sangko'),
(17, 'Pisang Goreng Cokju', 'snack', '15000', 'piscokju.jpg', 'Pisang Goreng + Keju + Coklat'),
(18, 'Singkong Keju', 'snack', '10000', 'singkongkeju.jpg', 'Singkong Goreng + Keju'),
(19, 'Nasi Oseng Lombok Ijo', 'makanan', '12000', 'OsengTempe.jpg', 'Oseng Tempe + Nasi'),
(20, 'Wedang Uwuh', 'minuman', '8000', 'Uwuh.jpg', 'Wedang Rempah Uwuh'),
(21, 'Ice Chocolatte', 'minuman', '16000', 'KopiSusuCaramel.jpg', 'Ice Chocolatte'),
(22, 'Vietnam Drip', 'minuman', '16000', 'V60.jpg', 'Vietnam Drip + Susu '),
(23, 'Es Tape Susu ', 'minuman', '14000', 'EsSusuTape.jpg', 'Es Tape + Susu'),
(24, 'Teh Tarik', 'minuman', '10000', 'tehtarik.jpg', 'Teh Tarik Sangko'),
(25, 'Ice/Hot Susu Coklat', 'minuman', '8000', 'cocolate.jpg', 'Ice/Hot Susu Coklat'),
(26, 'Ice/Hot Susu Putih', 'minuman', '8000', 'SusuPutih.jpg', 'Ice/Hot Susu Putih');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `metode_pembayaran` enum('Tunai','Non Tunai') DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` enum('belum bayar','lunas') DEFAULT NULL,
  `id_diskon` int(11) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgl_transaksi`, `metode_pembayaran`, `total_harga`, `status`, `id_diskon`, `no_meja`) VALUES
(220909001, 6, '2022-09-09', 'Tunai', 42000, 'lunas', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL DEFAULT 0,
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_produk`, `harga`, `jumlah`, `catatan`) VALUES
(1, 220820001, 1, 18000, 4, NULL),
(2, 220820001, 3, 15000, 3, NULL),
(3, 220820001, 4, 5000, 6, NULL),
(4, 220820001, 5, 10000, 2, NULL),
(5, 220820002, 1, 18000, 2, NULL),
(6, 220820002, 3, 15000, 2, NULL),
(7, 220820002, 4, 5000, 5, NULL),
(8, 220820003, 3, 15000, 3, NULL),
(9, 220820003, 4, 5000, 5, NULL),
(10, 220820003, 5, 10000, 1, NULL),
(11, 220820004, 1, 18000, 2, NULL),
(12, 220820004, 4, 5000, 2, NULL),
(13, 220909001, 1, 14000, 1, ''),
(14, 220909001, 10, 8000, 1, ''),
(15, 220909001, 11, 5000, 1, ''),
(16, 220909001, 17, 15000, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL DEFAULT 0,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('admin','kasir','pelanggan') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `nama`) VALUES
(1, 'admin', 'admin', 'admin', 'Admin Sang Kopas'),
(2, 'kasir', 'kasir', 'kasir', 'Kasir Sang Kopas'),
(3, 'ricky', 'ricky', 'pelanggan', NULL),
(4, 'nisa', 'nisa', 'pelanggan', NULL),
(5, 'anis', 'anis', 'pelanggan', NULL),
(6, 'hayun', 'hayun', 'pelanggan', NULL),
(7, 'Hefti', '123456', 'pelanggan', NULL),
(8, 'widi', '1234567', 'pelanggan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
