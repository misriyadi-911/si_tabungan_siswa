-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql110.byetcluster.com
-- Generation Time: Jul 13, 2021 at 10:41 AM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_28912785_db_tabungan_si`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama_admin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_admin` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_admin` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_admin` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat_admin`, `nohp_admin`, `foto_admin`) VALUES
(6, 'Ulum', 'Sumenep', '65464546467', 'IMG_20190406_101455_HDR.jpg-1623072922.jpg'),
(16, 'Habibi', 'Sumenep', '087654321123', 'misri.jpg-1624481894.jpg'),
(19, 'bambang', 'Rombasan', '08975432452', 'user.png'),
(18, 'Ulum', 'Sumenep', '081326945879', 'user.png'),
(20, 'Rofiq', 'Rombasan', '0823456852', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `Kelas`
--

CREATE TABLE `Kelas` (
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Kelas`
--

INSERT INTO `Kelas` (`id_kelas`, `kelas`) VALUES
(1, 'X'),
(2, 'XI'),
(3, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `status_notifikasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_siswa`, `id_transaksi`, `status_notifikasi`) VALUES
(9, 33, 89, 'belum terbaca');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_orangtua` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama_orangtua` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_orangtua` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_orangtua` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_orangtua`, `id_siswa`, `nama_orangtua`, `alamat_orangtua`, `nohp_orangtua`) VALUES
(33, 33, 'Hadirurrohman', 'Kaduara Timur', '082331063741'),
(34, 34, 'Karimon', 'Rombasan', '085234886667'),
(36, 36, 'Hidayat', 'Rombasan', '089517668450'),
(31, 31, 'Busri', 'Kaduara Timur', '082301679422'),
(32, 32, 'Sudi Ahmad', 'Kaduara Timur', '087771614887');

-- --------------------------------------------------------

--
-- Table structure for table `Siswa`
--

CREATE TABLE `Siswa` (
  `id_siswa` bigint(20) UNSIGNED NOT NULL,
  `id_orangtua` int(11) NOT NULL,
  `nis` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_siswa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_siswa` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp_siswa` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin_siswa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `no_rekening` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_siswa` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Siswa`
--

INSERT INTO `Siswa` (`id_siswa`, `id_orangtua`, `nis`, `nama_siswa`, `alamat_siswa`, `nohp_siswa`, `jenis_kelamin_siswa`, `id_kelas`, `no_rekening`, `foto_siswa`) VALUES
(31, 31, '240', 'Abd. Rohman', 'Kaduara Barat', '087875404492', 'Laki-laki', 2, '2400001', 'user.png'),
(32, 32, '258', 'Dimas Sugiyanto', 'Kaduara Timur', '087771614887', 'Laki-laki', 1, '2580032', 'user.png'),
(33, 33, '288', 'Hasbi Kiromi', 'Kaduara Timur', '089517668450', 'Laki-laki', 1, '2880033', 'user.png'),
(34, 34, '295', 'Nazilatul Mubarokah', 'Rombasan', '081937307587', 'Perempuan', 1, '2950034', 'user.png'),
(36, 36, '301', 'Rudiyatno', 'Rombasan', '08976298765', 'Laki-laki', 1, '3010035', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_pelajaran`
--

CREATE TABLE `tahun_pelajaran` (
  `id_tapel` bigint(20) UNSIGNED NOT NULL,
  `tapel` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_tapel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun_pelajaran`
--

INSERT INTO `tahun_pelajaran` (`id_tapel`, `tapel`, `status_tapel`) VALUES
(1, '2020/2021', 'Tidak Aktif'),
(2, '2021/2022', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_tapel` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal_debit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal_kredit` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_siswa`, `id_tapel`, `tgl_transaksi`, `nominal_debit`, `nominal_kredit`, `keterangan`) VALUES
(95, 32, 2, '2021-07-04', '10000', '0', ''),
(89, 33, 2, '2021-07-05', '0', '20000', 'Denda'),
(97, 34, 2, '2021-07-04', '15000', '0', ''),
(98, 36, 2, '2021-07-04', '25000', '0', ''),
(70, 31, 2, '2021-07-01', '35000', '0', ''),
(71, 32, 2, '2021-06-28', '20000', '0', ''),
(72, 33, 2, '2021-06-28', '25000', '0', ''),
(67, 32, 2, '2021-07-01', '35000', '0', ''),
(68, 33, 2, '2021-07-01', '20000', '0', ''),
(69, 34, 2, '2021-07-01', '30000', '0', ''),
(78, 31, 2, '2021-06-27', '30000', '0', ''),
(77, 34, 2, '2021-06-27', '15000', '0', ''),
(76, 33, 2, '2021-06-27', '40000', '0', ''),
(75, 32, 2, '2021-06-27', '25000', '0', ''),
(63, 32, 2, '2021-06-30', '25000', '0', ''),
(64, 33, 2, '2021-06-30', '50000', '0', ''),
(65, 34, 2, '2021-06-30', '30000', '0', ''),
(66, 31, 2, '2021-06-30', '20000', '0', ''),
(61, 34, 2, '2021-06-29', '40000', '0', ''),
(62, 31, 2, '2021-06-29', '25000', '0', ''),
(96, 33, 2, '2021-07-04', '20000', '0', ''),
(74, 31, 2, '2021-06-28', '10000', '0', ''),
(60, 33, 2, '2021-06-29', '50000', '0', ''),
(99, 31, 2, '2021-07-04', '30000', '0', ''),
(73, 34, 2, '2021-06-28', '30000', '0', ''),
(59, 32, 2, '2021-06-29', '30000', '0', ''),
(84, 32, 2, '2021-07-05', '10000', '0', ''),
(85, 33, 2, '2021-07-05', '20000', '0', ''),
(86, 34, 2, '2021-07-05', '20000', '0', ''),
(88, 31, 2, '2021-07-05', '15000', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `id_user`, `level`, `username`, `password`) VALUES
(1, 6, 'admin', 'admin', '$2y$10$QATv.APhi11ltWSPLvffgOHaTUl69fxS7qEpzBo.1ExVw4XJfScym'),
(79, 36, 'orang tua', 'walirudi', '$2y$10$fTMxvIgXI.aca3E3uZTyjeoww2pqME2qUXxsN2XCx/.Fw4C13x5wm'),
(73, 34, 'siswa', 'sila', '$2y$10$m7WD924krKabF3FRv7uteu1O3ZLpGRbW8sHEu7ZKWs24HMdzaeNYy'),
(74, 34, 'orang tua', 'walisila', '$2y$10$7gdM1T9YbcFVDEhyVJ40D.0u/wjnQk6JXxvbujfqjNE7PRv5LOTZG'),
(67, 31, 'siswa', 'rohman', '$2y$10$jReFnUDlfnjqiAm/06VfuuDgKu443stT8vj3uBnEI8JnMMkfuFmEy'),
(68, 31, 'orang tua', 'walirohman', '$2y$10$6DQ9FuhQljRtvOXsHRbIHeLbNGRLAL8XDIwWMfPlQrFLtXT4DxQV.'),
(69, 32, 'siswa', 'dimas', '$2y$10$2MvF4uevWXwB.kLNGFvglO1WPOoo6eBpihbQZbaqYEbHBoRcrMPMe'),
(70, 32, 'orang tua', 'walidimas', '$2y$10$GLR2vgPbJoHuYd1hadBOcOqzY1gHsje/GXt1aamd9Cfjk7PKD2.Sm'),
(71, 33, 'siswa', 'hasbi', '$2y$10$78WYIMNVlVR5e/c0JCSmh.DsyEGpb/vu3cUJe5PW58ob3G9HYq6rq'),
(72, 33, 'orang tua', 'walihasbi', '$2y$10$o.9aAY3pwZsQWIK9LbGmd.sZX9NIXciLE2P2Srxuap/2RluLRqDv6'),
(52, 16, 'admin', 'habibi', '$2y$10$FC5/GZW28z/7gv9C5fHvm./RLLcGkWP7kARTJEUvVlSgYhvAfHX6e'),
(60, 18, 'admin', 'ulum', '$2y$10$WA2EBIGepJOKeyxNUZdunetGaIXqfdhLoKHRb9iPeAP8h8i82JzZa'),
(78, 36, 'siswa', 'rudi', '$2y$10$tgm9sbQ0lAJNhrY7xTERO.00R8kO8OlyedaAt8PCdGvFz5Gx6MxWm'),
(77, 19, 'admin', 'bambang', '$2y$10$qh7giRmkr6591H8mrppfBOWLk3hSADZOH8LZQji3vS/2GDAXB7Eaq'),
(80, 20, 'admin', 'rofiq', '$2y$10$U4afvoWD110JzojMZBcym.4jX7IBSsqdzzmM8Mpx0OEne3/jU05WC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `Kelas`
--
ALTER TABLE `Kelas`
  ADD PRIMARY KEY (`id_kelas`);

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
-- Indexes for table `Siswa`
--
ALTER TABLE `Siswa`
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
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Kelas`
--
ALTER TABLE `Kelas`
  MODIFY `id_kelas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_orangtua` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Siswa`
--
ALTER TABLE `Siswa`
  MODIFY `id_siswa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tahun_pelajaran`
--
ALTER TABLE `tahun_pelajaran`
  MODIFY `id_tapel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
