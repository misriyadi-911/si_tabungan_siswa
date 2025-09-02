-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 02:48 AM
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
-- Database: `db_tabungan_si`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `alamat_admin` varchar(500) NOT NULL,
  `nohp_admin` varchar(15) NOT NULL,
  `foto_admin` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat_admin`, `nohp_admin`, `foto_admin`) VALUES
(25, 'Hanif Abdurrahim', 'Kaduara Timur', '082333383380', 'Screenshot 2025-08-05 232756.png-1754550383.png');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(1, 'Kelas I'),
(2, 'Kelas II'),
(3, 'Kelas III'),
(4, 'Kelas IV'),
(5, 'Kelas V'),
(6, 'Kelas VI'),
(7, 'Umum');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2025_08_06_003758_create_pinjaman_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `status_notifikasi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_orangtua` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_orangtua` varchar(100) NOT NULL,
  `alamat_orangtua` varchar(500) NOT NULL,
  `nohp_orangtua` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_orangtua`, `id_siswa`, `nama_orangtua`, `alamat_orangtua`, `nohp_orangtua`) VALUES
(48, 48, 'Muzak', 'Kaduara Timur', '081111111111'),
(55, 55, 'A', 'Kaduara Timur', '081111111111'),
(47, 47, 'Ahmad', 'Kaduara Timur', '087777777777'),
(51, 51, 'Amin', 'Rombasan', '081111111111'),
(49, 49, 'Izzed', 'Kaduara Timur', '081111111111'),
(52, 52, 'Khafi', 'Kaduara Timur', '081111111111'),
(53, 53, 'Roz', 'Kaduara Timur', '081111111111'),
(54, 54, 'Arul', 'Kaduara Timur', '081222333555'),
(44, 44, 'Masyhud', 'Rombasan', '08276543112'),
(50, 50, 'Ar', 'Kertagena Laok', '081222333444');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tapel` int(11) NOT NULL,
  `tgl_pinjam` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nominal_pinjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_orangtua` int(11) NOT NULL,
  `nis` varchar(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `alamat_siswa` varchar(500) NOT NULL,
  `nohp_siswa` varchar(15) NOT NULL,
  `jenis_kelamin_siswa` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `foto_siswa` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_orangtua`, `nis`, `nama_siswa`, `alamat_siswa`, `nohp_siswa`, `jenis_kelamin_siswa`, `id_kelas`, `no_rekening`, `foto_siswa`) VALUES
(47, 47, '2019', 'Abdullah Kavin Maulana', 'Kaduara Timur', '087777777777', 'Laki-laki', 1, '20190047', '1753932442857.jpg-1756065854.jpg'),
(48, 48, '2021', 'Ahmad Raja Alfin Muzakki', 'Kaduara Timur', '081111111111', 'Laki-laki', 1, '20210048', '1753932442857.jpg-1756066067.jpg'),
(55, 55, '2024', 'AA', 'Kaduara Timur', 'ABCABCABCC', 'Laki-laki', 1, '20240055', 'Bootstrap_logo.svg.png-1756096771.png'),
(51, 51, '1958', 'Abdullah Amin', 'Rombasan', '081111111111', 'Laki-laki', 3, '19580051', 'php.png-1756086773.png'),
(52, 52, '1933', 'Abd. Khafi Ramadhan', 'Kaduara Timur', '081111111111', 'Laki-laki', 4, '19330052', 'Laravel.svg.png-1756086843.png'),
(53, 53, '1905', 'Abd. Rozaq', 'Kaduara Timur', '081111111111', 'Laki-laki', 5, '19050053', 'Laravel.svg.png-1756086937.png'),
(54, 54, '1863', 'Adli Arifin Nasrullah', 'Kaduara Timur', '081111111111', 'Laki-laki', 6, '18630054', 'Laravel.svg.png-1756087024.png'),
(44, 44, '789', 'IGHFIRLI', 'rombasan', '08276543112', 'Laki-laki', 7, '7890044', 'MI Al-Ghazali.png-1754557898.png'),
(49, 49, '2023', 'Akhdan Rifqo Addian Izzed', 'Kaduara Timur', '081111111111', 'Laki-laki', 1, '20230049', '1753932442857.jpg-1756066189.jpg'),
(50, 50, '1998', 'Abdullah Arkan Kamal Mubarok', 'Kertagena Laok', '081222333444', 'Laki-laki', 2, '19980050', 'Laravel.svg.png-1756086681.png');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id_tapel` bigint(20) UNSIGNED NOT NULL,
  `tapel` varchar(50) NOT NULL,
  `status_tapel` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id_tapel`, `tapel`, `status_tapel`) VALUES
(8, '2025/2026', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tapel` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal_debit` varchar(50) NOT NULL,
  `nominal_kredit` varchar(50) NOT NULL,
  `keterangan` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_siswa`, `id_tapel`, `tgl_transaksi`, `nominal_debit`, `nominal_kredit`, `keterangan`) VALUES
(62, 48, 8, '2025-08-25', '0', '0', ''),
(61, 47, 8, '2025-08-25', '0', '0', ''),
(60, 55, 8, '2025-08-25', '30000', '0', ''),
(59, 49, 8, '2025-08-25', '0', '0', ''),
(10, 44, 8, '2025-08-07', '60000', '0', ''),
(58, 48, 8, '2025-08-25', '0', '0', ''),
(55, 47, 8, '2025-08-25', '0', '150000', 'cicilan'),
(56, 55, 8, '2025-08-25', '20000', '0', ''),
(57, 47, 8, '2025-08-25', '0', '0', ''),
(53, 48, 8, '2025-08-24', '0', '0', ''),
(54, 49, 8, '2025-08-24', '0', '0', ''),
(63, 49, 8, '2025-08-25', '0', '0', ''),
(51, 49, 8, '2025-07-22', '0', '0', ''),
(52, 47, 8, '2025-08-24', '100000', '0', ''),
(49, 47, 8, '2025-08-25', '0', '0', ''),
(50, 48, 8, '2025-07-22', '0', '0', ''),
(47, 49, 8, '2025-08-25', '0', '0', ''),
(48, 47, 8, '2025-08-25', '0', '20000', 'cicilan'),
(45, 47, 8, '2025-08-25', '70000', '0', ''),
(46, 48, 8, '2025-08-25', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `level` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_user`, `level`, `username`, `password`) VALUES
(123, 55, 'orang tua', 'wali2024', '$2y$10$ShLvWjJZr7.W8C9hLVwK2.q34jIKCxCfz0OMRbcagA5Q59G/WyW4m'),
(122, 55, 'siswa', '2024', '$2y$10$wbcOwMKelEXpbHUvgaCUHuYBUdLmiwI8AbMP1CimhxQOrO5e0muki'),
(110, 49, 'siswa', '2023', '$2y$10$54yG83Ix4rYlxUXnQD3PneMtIN2X0E9wEs40qs6szMPhJUByhjpjW'),
(106, 47, 'siswa', '2019', '$2y$10$GTixrLxOPvgQm5QsIWpBmeIpBA3b1.hhmcBHvNyTHmGcJ4Hhyw3oS'),
(107, 47, 'orang tua', 'wali2019', '$2y$10$eNjpKDmRRzRGhxWpFXPpTunbJ8oqkeymd1Qg4cpmWn3RNfMYxLGai'),
(108, 48, 'siswa', '2021', '$2y$10$/yGkxhSAig37Z8LmlhoeOO4TECby8qeQ3S1AXC97Lp5M0LL3N68za'),
(109, 48, 'orang tua', 'wali2021', '$2y$10$3tN1HYGvsWyVefLQb3YaIuCrqCRQpM8vAfGBCKxifQ5oYdQuUAVaq'),
(114, 51, 'siswa', '1958', '$2y$10$5u8PZvy3Bm3srHROgJR/cO0D6YyO03yrB/j.g.JN1br4uh6WJKGM2'),
(115, 51, 'orang tua', 'wali1958', '$2y$10$SLoGasdUrNQT9iU5i4wZfOIdW5ECwMtSyXv8owpVKjff5bUMqfXW2'),
(87, 25, 'admin', 'hanif', '$2y$10$YzXnKddXUFNg7.VCy3.WB..peT5weurspp0TdIuxDX5E6cGA3Blle'),
(117, 52, 'orang tua', 'wali1933', '$2y$10$4bU1gBzXGusvj0Rv1jKT3.i/1JXFekLC0.Nb0oem08uqSDYi6Fuvq'),
(116, 52, 'siswa', '1933', '$2y$10$yzEzo6M24sVZxA48BDEtF.wUI7mqqodAtgXad5mww7a63JmrRiOi.'),
(119, 53, 'orang tua', 'wali1905', '$2y$10$QkeuPZ5ujZVsJoZzdRrNKenzWmRoN.IZxOKgDAL5zbZsFmZf5Yi0a'),
(118, 53, 'siswa', '1905', '$2y$10$2bSRcPE5cO2TS3Z1Q8doBODPgLIhOyydSiISKtDCXulEvFv8xOXZu'),
(120, 54, 'siswa', '1863', '$2y$10$6LxhwbVvgqLYaRO.ie5SvuDnL6e/fkBhMGJyRb4Fn.pOhcmrOU4F6'),
(121, 54, 'orang tua', 'wali1863', '$2y$10$VHBc7Bc5JCa.OCwSl6i6n.ZSo9akCobRSdnrvvrU6VfFTNpzX2nB2'),
(100, 44, 'siswa', 'firli', '$2y$10$G.IzGKAjCNPPsVEJ11UQZO2JFDRwZb/0A14N3iP/8uoMqAF7OyIIK'),
(101, 44, 'orang tua', 'walifirli', '$2y$10$SMEoyrkdfRFj4ugrtZn25.yqcbJPmJhF3rO7TT.5qrw47eI94L2Pa'),
(112, 50, 'siswa', '1998', '$2y$10$3uHfn0mZG9uRT9rdtxs/H.F4tNG10qeAm6QnIjc6PRt64S9SzPyQS'),
(111, 49, 'orang tua', 'wali2023', '$2y$10$S520M4T0v70RDQ9YHRWpNuqZPP61mt8vQj5DHbbBOw.9xofa3QmYG'),
(113, 50, 'orang tua', 'wali1998', '$2y$10$zKFt8f4ZfdnM/b0zxoX9HeeNzRj/IT7XL/zqRQBXU4ERwgCNbqb6O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_orangtua`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  ADD PRIMARY KEY (`id_tapel`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_orangtua` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id_tapel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
