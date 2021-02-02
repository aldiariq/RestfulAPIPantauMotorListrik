-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2021 at 05:16 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apimonitoringmotorlistrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alat_wo`
--

CREATE TABLE `tbl_alat_wo` (
  `id` int(11) NOT NULL,
  `kode_alat_wo` varchar(200) NOT NULL,
  `nama_alat_wo` varchar(200) NOT NULL,
  `keterangan_alat_wo` varchar(200) NOT NULL,
  `tgl_beli_alat_wo` date NOT NULL,
  `usia_maksimum_alat_wo` int(11) NOT NULL,
  `usia_service_rekomendasi` int(11) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diupdate` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kerusakan_motor`
--

CREATE TABLE `tbl_kerusakan_motor` (
  `id` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `kode_alat_wo` varchar(200) NOT NULL,
  `kode_pemakai` varchar(200) NOT NULL,
  `material_bearing` varchar(200) NOT NULL,
  `material_kawat_kg` varchar(200) NOT NULL,
  `nomor_wo` int(11) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `dll` varchar(200) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diupdate` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konfirmasi_pendaftaran`
--

CREATE TABLE `tbl_konfirmasi_pendaftaran` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `kodeunik` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemakai`
--

CREATE TABLE `tbl_pemakai` (
  `id` int(11) NOT NULL,
  `kode_pemakai` varchar(200) NOT NULL,
  `keterangan_pemakai` varchar(200) NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diupdate` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `kodeunik` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nip` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `status` enum('ADMIN','USER') NOT NULL,
  `statusaktivasi` enum('AKTIF','TIDAKAKTIF') NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `tgl_diupdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alat_wo`
--
ALTER TABLE `tbl_alat_wo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_alat_wo` (`kode_alat_wo`);

--
-- Indexes for table `tbl_kerusakan_motor`
--
ALTER TABLE `tbl_kerusakan_motor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_alat_wo` (`kode_alat_wo`),
  ADD KEY `kode_pemakai` (`kode_pemakai`);

--
-- Indexes for table `tbl_konfirmasi_pendaftaran`
--
ALTER TABLE `tbl_konfirmasi_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_pemakai`
--
ALTER TABLE `tbl_pemakai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_pemakai` (`kode_pemakai`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_alat_wo`
--
ALTER TABLE `tbl_alat_wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kerusakan_motor`
--
ALTER TABLE `tbl_kerusakan_motor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_konfirmasi_pendaftaran`
--
ALTER TABLE `tbl_konfirmasi_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pemakai`
--
ALTER TABLE `tbl_pemakai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_alat_wo`
--
ALTER TABLE `tbl_alat_wo`
  ADD CONSTRAINT `tbl_alat_wo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kerusakan_motor`
--
ALTER TABLE `tbl_kerusakan_motor`
  ADD CONSTRAINT `tbl_kerusakan_motor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kerusakan_motor_ibfk_2` FOREIGN KEY (`kode_pemakai`) REFERENCES `tbl_pemakai` (`kode_pemakai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kerusakan_motor_ibfk_3` FOREIGN KEY (`kode_alat_wo`) REFERENCES `tbl_alat_wo` (`kode_alat_wo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_konfirmasi_pendaftaran`
--
ALTER TABLE `tbl_konfirmasi_pendaftaran`
  ADD CONSTRAINT `tbl_konfirmasi_pendaftaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pemakai`
--
ALTER TABLE `tbl_pemakai`
  ADD CONSTRAINT `tbl_pemakai_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD CONSTRAINT `tbl_reset_password_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
