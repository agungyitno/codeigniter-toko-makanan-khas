-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 05:47 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_makanankhas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `user_id`, `produk_id`, `jumlah`) VALUES
(1, 7, 5, 4),
(2, 7, 3, 3),
(3, 7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konfirmasi`
--

CREATE TABLE `tbl_konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `pesanan_id` varchar(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bukti` varchar(150) NOT NULL,
  `tanggal_konfirmasi` int(11) NOT NULL,
  `is_valid` varchar(20) NOT NULL,
  `tanggal_validasi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_konfirmasi`
--

INSERT INTO `tbl_konfirmasi` (`id_konfirmasi`, `pesanan_id`, `user_id`, `bukti`, `tanggal_konfirmasi`, `is_valid`, `tanggal_validasi`) VALUES
(4, 'ORDER0002', 11, 'img_pembayaran_ORDER0002.jpg', 1624185494, 'Valid', 1624611953),
(5, 'ORDER0003', 11, 'img_pembayaran_ORDER0003.jpg', 1624618808, 'Belum', NULL),
(6, 'ORDER0003', 11, 'img_pembayaran_ORDER0003.png', 1624619142, 'Belum', NULL),
(7, 'ORDER0002', 11, 'img_pembayaran_ORDER0002.png', 1624619200, 'Belum', NULL),
(8, 'ORDER0004', 11, 'img_pembayaran_ORDER0004.png', 1624635819, 'Valid', 1624635936);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kota` varchar(64) NOT NULL,
  `provinsi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`user_id`, `nama`, `no_telp`, `alamat`, `kode_pos`, `kota`, `provinsi`) VALUES
(3, 'Lailatul', '', '', '', '', ''),
(7, 'admin', '', '', '', '', ''),
(11, 'cintia', '089555666777', 'jombang', '64453', 'jombang', 'jawa timur'),
(13, 'Bunga Citra', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor` varchar(64) NOT NULL,
  `atas_nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `jenis`, `nama`, `nomor`, `atas_nama`) VALUES
(1, 'BANK', 'BRI', '524323423423', 'Lailia Rahma'),
(2, 'EWALLET', 'DANA', '089888777666', 'Sinta Anggraini'),
(3, 'BANK', 'BNI', '8476346346436', 'Lailia Rahma');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` varchar(12) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_pesanan` int(11) NOT NULL,
  `batas_pembayaran` int(11) NOT NULL,
  `nama_penerima` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `user_id`, `tgl_pesanan`, `batas_pembayaran`, `nama_penerima`, `alamat`, `kode_pos`, `kota`, `provinsi`, `no_telp`, `total`, `status`) VALUES
('ORDER0004', 11, 1624634218, 1624807018, 'cintia', 'jombang', '64453', 'jombang', 'jawa timur', '089555666777', 5000, 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan_detail`
--

CREATE TABLE `tbl_pesanan_detail` (
  `id_detail_pesanan` int(11) NOT NULL,
  `pesanan_id` varchar(12) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pesanan_detail`
--

INSERT INTO `tbl_pesanan_detail` (`id_detail_pesanan`, `pesanan_id`, `produk_id`, `harga`, `jumlah`, `sub_total`) VALUES
(5, 'ORDER0004', 5, 5000, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `kategori_id`, `stok`, `satuan_id`, `harga`, `gambar`, `deskripsi`) VALUES
(1, 'Onde-onde', 1, 75, 3, 1000, 'img_produk_1.jpg', '-'),
(2, 'Es Tape', 2, 46, 1, 5000, 'img_produk_2.jpg', '-'),
(3, 'Mendut', 1, 23, 1, 2500, 'img_produk_3.jpg', '-'),
(5, 'Kripik Gadung', 1, 35, 2, 5000, 'img_produk_5.jpg', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satuan`
--

CREATE TABLE `tbl_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_satuan`
--

INSERT INTO `tbl_satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Bungkus'),
(2, 'Pack'),
(3, 'Buah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_matkul` int(50) NOT NULL,
  `kode_matkul` varchar(50) NOT NULL,
  `waktu_matkul` varchar(20) NOT NULL,
  `nm_matkul` varchar(128) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_matkul`, `kode_matkul`, `waktu_matkul`, `nm_matkul`, `kelas`, `semester`) VALUES
(129, '0987654', '14.00-15.00', 'kalkulus', 'D3', '3'),
(130, '07012004', '08.30-10.00', 'Pemrograman', 'D3', '4'),
(131, '07012005', '10.00-12.00', 'Visual Basic', 'D3', '4');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'lailatul jannah', 'laelatuljannah.bim.aks@gmail.com', 'default.png', '$2y$10$cuIpaYE5N2SuAdT0d378MuMJPc.YDgHTRKUIlnsPJBPbEcw6zK/yu', 2, 1, 1577967321),
(7, 'admin', 'admin@tokomakanankhas.com', 'default.png', '$2y$10$7/9p5xo0aeosaYwXp2qMs.3IfNW8olzeTKdJIjBN4MyaWyPdnmPye', 1, 1, 1623844752),
(8, 'ayu', 'ayu@gmail.com', 'default.png', '$2y$10$.82LsPZZ9DNj9baXEDaoPeqHAeOimTgtB45R9kcTSuGrqFJxYpZIa', 1, 1, 1624011753),
(9, 'anindia rahma', 'ani@gmail.com', 'default.png', '$2y$10$xulB214CarusPMK3XvOKbudpGHw48SFci2Yt4jzEmeSBWnDWcreUW', 1, 1, 1624012668),
(10, 'bela ayu', 'bela@gmail.com', 'img_profile_9.jpg', '$2y$10$r33ytm3X.lNr9A5VdZ/iU..kZIPqfvv9xrmshAWudw12h2ZcmRYpS', 1, 1, 1624012716),
(11, 'cintia', 'cintia@gmail.com', 'img_profile_11.jpg', '$2y$10$ns88mVRsSn8RCmxdjG8FnevW1IloOPjpoFepA4Vzk6WwmyC/Y794y', 2, 1, 1624062090),
(13, 'Bunga Citra', 'bunga@gmail.com', 'default.png', '$2y$10$zTVDntpUxb0wntLcsqKmJOlAQJKxe2gV7lqXzrmC3SBkCzBD4XaSe', 2, 1, 1624192154);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 2, 4),
(6, 2, 5),
(7, 1, 4),
(8, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'home', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'keranjang', 'keranjang', 'fas fa-fw fa-cog', 1),
(3, 3, 'user', 'user', 'fa fa- fw fa-qrcode fa-3x', 1),
(4, 3, 'pesan', 'pesan', 'fa fa- fw fa-qrcode fa-3x', 1),
(5, 3, 'profile', 'profile', 'fa fa- fw fa-qrcode fa-3x', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `kategori` (`kategori_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indexes for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_matkul`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_satuan`
--
ALTER TABLE `tbl_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_matkul` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `tbl_keranjang_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `tbl_produk` (`id_produk`),
  ADD CONSTRAINT `tbl_keranjang_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD CONSTRAINT `tbl_pelanggan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  ADD CONSTRAINT `tbl_pesanan_detail_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `tbl_pesanan` (`id_pesanan`);

--
-- Constraints for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kategori` (`id_kategori`),
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `tbl_satuan` (`id_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
