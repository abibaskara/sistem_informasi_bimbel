-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2023 at 02:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi_bimbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_kelas`
--

CREATE TABLE `detail_kelas` (
  `id_detail_kelas` int NOT NULL,
  `id_kelas` int NOT NULL,
  `id_matpel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_kelas`
--

INSERT INTO `detail_kelas` (`id_detail_kelas`, `id_kelas`, `id_matpel`) VALUES
(4, 12, 1),
(5, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembayaran`
--

CREATE TABLE `detail_pembayaran` (
  `id_detail_pembayaran` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `jumlah` int NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pembayaran`
--

INSERT INTO `detail_pembayaran` (`id_detail_pembayaran`, `id_pembayaran`, `jumlah`, `bukti_bayar`, `tgl_bayar`) VALUES
(1, 4, 250000, 'Foto_Abi_Baskara_A1.jpeg', '2023-01-07'),
(2, 4, 250000, 'Foto_Abi_Baskara_A3.jpeg', '2023-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `jenjang_sekolah`
--

CREATE TABLE `jenjang_sekolah` (
  `id_jenjang_sekolah` int NOT NULL,
  `id_pendaftaran` int NOT NULL,
  `nama_sekolah` int NOT NULL,
  `tahun_lulus` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(12, 'VIII A');

-- --------------------------------------------------------

--
-- Table structure for table `matpel`
--

CREATE TABLE `matpel` (
  `id_matpel` int NOT NULL,
  `kode_matpel` varchar(255) NOT NULL,
  `matpel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matpel`
--

INSERT INTO `matpel` (`id_matpel`, `kode_matpel`, `matpel`) VALUES
(1, 'A02', 'MTK'),
(2, 'A03', 'MTK BASING');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int NOT NULL,
  `id_user` int NOT NULL,
  `id_matpel` int NOT NULL,
  `absensi` int NOT NULL,
  `tugas` int NOT NULL,
  `uts` int NOT NULL,
  `uas` int NOT NULL,
  `hasil` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_user`, `id_matpel`, `absensi`, `tugas`, `uts`, `uas`, `hasil`) VALUES
(1, 11, 1, 25, 90, 100, 80, 90);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_user` int NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `grandtotal` int NOT NULL,
  `sisa_bayar` int NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_user`, `bulan`, `grandtotal`, `sisa_bayar`, `status`) VALUES
(4, 11, 'Januari', 500000, 0, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `id_user` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_user`, `email`, `jenis_kelamin`) VALUES
(2, 15, 'abibaskara211@gmail.com', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `tarif_spp`
--

CREATE TABLE `tarif_spp` (
  `id_tarif_spp` int NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `harga` int NOT NULL,
  `keterangan` text NOT NULL,
  `id_kelas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tarif_spp`
--

INSERT INTO `tarif_spp` (`id_tarif_spp`, `bulan`, `harga`, `keterangan`, `id_kelas`) VALUES
(8, 'Januari', 500000, 'test', 5),
(9, 'Januari', 700000, 'test', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `id_matpel` int NOT NULL,
  `kelas_id` int NOT NULL,
  `nik` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pict` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `status` int NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_matpel`, `kelas_id`, `nik`, `username`, `phone`, `pict`, `role`, `status`, `password`) VALUES
(1, 0, 0, 1234, 'staff', '0', '', 1, 1, '$2y$10$OGXSK6zOcPvkf8F7P2VoJuQ9SugwKJOiZ.p/t13OMoQFoy2i1xVLa'),
(2, 0, 0, 123131, 'test', '62', 'Foto_Abi_Baskara_A1.jpeg', 1, 1, '$2y$10$7d22rB/gxY3TTfHA4Wwl2OWtoDSIGB8zpCEn2gJ4apujsczSIMzZK'),
(3, 0, 5, 12321, 'test23', '+62 214-748-364-7   ', 'Foto_Abi_Baskara_A8.jpeg', 2, 0, '$2y$10$JuISRJjOtTJZp2sDvrG.muHlkB9VZXYIZKqbOQpntyDqKpBsStLRS'),
(6, 0, 5, 123131, 'test', '+62 213-131-212-31  ', 'Foto_Abi_Baskara_A9.jpeg', 2, 0, '$2y$10$1Dcrw/ikopy.isnneTJuyO.I7Nn8j1OGVGfIaA9zZiDyH2tSKD1Y6'),
(8, 2, 0, 123131, 'Suratmin2', '+62 123-123-213-1231', 'Foto_Abi_Baskara_A11.jpeg', 3, 0, '$2y$10$jlY9e7XEjNIBL6ass2ZLWuR.fDmF9PABWKK.BcNBEtjGnEtY1ypPS'),
(9, 0, 0, 12312312, 'Ny, Hajarti2', '+62 123-123-123-1   ', 'Foto_Abi_Baskara_A12.jpeg', 4, 0, '$2y$10$O5gOgDTwp6YrlD.GZ5I2N.Y1zP7NxvENcisqC6.YVRjnsBo2dtn8W'),
(10, 0, 12, 12347, 'Bu Ariyanti2', '+62 123-123-123-21  ', 'Foto_Abi_Baskara_A13.jpeg', 5, 0, '$2y$10$u/pNazBx9wS14ujKmH24reJVn.bQIP9OnYMo1JnvNl0u.Gx4lkypm'),
(11, 0, 12, 12345, 'Abi Baskara Atthallah', '+62 822-999-151-27  ', 'Foto_Abi_Baskara_A14.jpeg', 2, 0, '$2y$10$aV/2MNvs6LFwbU9GC8uFc.uj6P6hlwAj.ItlzFxuoVb/IOLpBKj5.'),
(12, 1, 0, 12346, 'Guru Budi', '+62 822-999-151-27  ', 'Foto_Abi_Baskara_A14.jpeg', 3, 1, '$2y$10$g1yn6Tx0ZHeQ5I9MbfHz.uJNlnArGeYtld8riVzMjuEHPXm0NGoWC'),
(15, 0, 0, 0, 'abi', '', '', 2, 1, '$2y$10$k/NwUqOOMzfV1hjGkELhF.cketYMXAwjqihkePoRqdtuHgKB7ELjG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_kelas`
--
ALTER TABLE `detail_kelas`
  ADD PRIMARY KEY (`id_detail_kelas`);

--
-- Indexes for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  ADD PRIMARY KEY (`id_detail_pembayaran`);

--
-- Indexes for table `jenjang_sekolah`
--
ALTER TABLE `jenjang_sekolah`
  ADD PRIMARY KEY (`id_jenjang_sekolah`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `matpel`
--
ALTER TABLE `matpel`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `tarif_spp`
--
ALTER TABLE `tarif_spp`
  ADD PRIMARY KEY (`id_tarif_spp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_kelas`
--
ALTER TABLE `detail_kelas`
  MODIFY `id_detail_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_pembayaran`
--
ALTER TABLE `detail_pembayaran`
  MODIFY `id_detail_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenjang_sekolah`
--
ALTER TABLE `jenjang_sekolah`
  MODIFY `id_jenjang_sekolah` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `matpel`
--
ALTER TABLE `matpel`
  MODIFY `id_matpel` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tarif_spp`
--
ALTER TABLE `tarif_spp`
  MODIFY `id_tarif_spp` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
