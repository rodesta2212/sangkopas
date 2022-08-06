/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: hayun
Date: 8/6/2022 16:27:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `diskon`
-- ----------------------------
DROP TABLE IF EXISTS `diskon`;
CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_diskon`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `pelanggan`
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('laki','perempuan') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `produk`
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `transaksi`
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `metode_pembayaran` enum('Tunai','Non Tunai') DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` enum('belum bayar','lunas') DEFAULT NULL,
  `id_diskon` int(11) DEFAULT NULL,
  `no_meja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `transaksi_detail`
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_detail`;
CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL DEFAULT '0',
  `id_transaksi` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('admin','kasir','pelanggan') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `diskon` VALUES ('1','Diskon Hari Kemerdekaan','2022-08-15','2022-08-20','12000','Minimal pembelian makanan dan minuman 50.000');
INSERT INTO `pelanggan` VALUES ('1','3','Ricky Rodesta','ricky@mail.com','81236721821','laki','1995-12-22'), ('2','4','Nisa Wiguna','nisa@mail.com','81293212347','perempuan','1998-10-15');
INSERT INTO `produk` VALUES ('1','Nasi Goreng','makanan','18000','nasigoreng.jpg','Nasi Goreng dengan Telur'), ('3','Ayam Kremes','makanan','15000','ayamkremes.jpg','Ayam Kremes tidak termasuk nasi'), ('4','Es Teh','minuman','5000','esteh.jpg','Es teh manis atau tawar'), ('5','Kentang Goreng','snack','10000','kentanggoreng.jpg','Kentang Goreng Renyah');
INSERT INTO `user` VALUES ('1','admin','admin','admin','Admin Sang Kopas'), ('2','kasir','kasir','kasir','Kasir Sang Kopas'), ('3','ricky','ricky','pelanggan',NULL), ('4','nisa','nisa','pelanggan',NULL);
