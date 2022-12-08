-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 04:58 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` int(15) NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kunjungan` date DEFAULT NULL,
  `jam_kunjungan` time NOT NULL,
  `puskesmas_id` int(11) DEFAULT NULL,
  `status_bayar` enum('Bayar','BPJS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_bpjs` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_antrian` enum('Antri','Selesai','Konfirmasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nik`, `no_antrian`, `nama`, `gender`, `alamat`, `tgl_kunjungan`, `jam_kunjungan`, `puskesmas_id`, `status_bayar`, `no_bpjs`, `slug`, `image`, `keterangan`, `status_antrian`, `obat_id`, `user_id`, `created_at`, `updated_at`) VALUES
(132, 34537568, 1, 'Erik Gunawan', 'L', 'Bandung', '2022-09-20', '09:20:00', 42, '', 4647487, 'erik-gunawan', '1658603935131.PNG', NULL, 'Selesai', NULL, 1, '2022-07-23 19:18:55', '2022-07-23 19:19:08'),
(140, 3453779, 2, 'Baki', 'L', 'Bandung', '2022-09-20', '10:30:28', 42, 'Bayar', NULL, 'baki', NULL, NULL, 'Antri', NULL, 202, NULL, NULL),
(144, 3542524, 1, 'Bambang', 'L', 'Jampang Tengah', '2022-08-25', '09:00:00', 50, 'Bayar', NULL, 'bambang', NULL, NULL, 'Selesai', NULL, 195, NULL, NULL),
(147, 234234, 1, 'Geby', 'P', 'Solo', '2022-08-24', '12:56:08', 48, 'BPJS', 36346, 'geby', NULL, NULL, 'Konfirmasi', NULL, 198, NULL, NULL),
(148, 456345, 1, 'Tsunade', 'P', 'Konoha', '2022-09-21', '00:00:00', 49, 'Bayar', NULL, 'tsunade', '1663509550573.jpg', NULL, 'Antri', NULL, 191, '2022-09-18 13:59:10', '2022-09-18 13:59:10'),
(149, 454634, 3, 'Hamzah', 'L', 'Sukabumi', '2022-09-21', '00:00:00', 42, 'Bayar', NULL, 'hamzah', '1663509886987.jpg', NULL, 'Antri', NULL, 191, '2022-09-18 14:04:46', '2022-09-18 14:04:46'),
(150, 982374, 2, 'Malik', 'L', 'Sukabumi', '2022-09-23', '00:00:00', 49, 'Bayar', NULL, 'malik', '1663509929929.PNG', NULL, 'Antri', NULL, 191, '2022-09-18 14:05:29', '2022-09-18 14:05:29'),
(151, 34536, 2, 'Salwa Andini', 'P', 'Jakarta', '2022-09-22', '00:00:00', 50, 'Bayar', NULL, 'salwa-andini', '1663510136658.png', NULL, 'Antri', NULL, 191, '2022-09-18 14:08:56', '2022-09-18 14:08:56'),
(152, 9389374, 1, 'Raffi Ahmad', 'L', 'Bandung', '2022-09-20', '13:57:00', 51, 'Bayar', NULL, 'raffi-ahmad', '1663639037456.PNG', NULL, 'Konfirmasi', 21, 199, '2022-09-20 01:57:17', '2022-10-01 00:49:17'),
(153, 2147483647, 1, 'Fakhirul Akmal', 'L', 'Konoha', '2022-09-20', '14:50:00', 53, 'Bayar', NULL, 'fakhirul-akmal', '1663642286436.PNG', NULL, 'Antri', NULL, 199, '2022-09-20 02:51:26', '2022-09-20 02:51:26'),
(155, 43534, 4, 'Sugra', 'L', 'Konoha', '2022-09-21', '00:00:00', 42, 'BPJS', 32423523, 'sugra', '1663735046891.PNG', NULL, 'Antri', NULL, 199, '2022-09-21 04:37:26', '2022-09-21 04:37:26'),
(156, 2425, 1, 'Haddad Alwi', 'L', 'Bandung', '2022-09-22', '00:00:00', 53, 'Bayar', NULL, 'haddad-alwi', NULL, NULL, 'Antri', NULL, 201, NULL, NULL),
(157, 4563463, 2, 'Bagas Pragoso', 'L', 'Depok', '2022-09-22', '00:00:00', 53, 'BPJS', 345345, 'bagas-pragoso', NULL, NULL, 'Antri', NULL, 191, NULL, NULL),
(158, 342352, 5, 'Farel Hermansyah', 'L', 'Konoha', '2022-09-30', '00:00:00', 42, 'Bayar', NULL, 'farel-hermansyah', '1664503212769.jpg', NULL, 'Antri', NULL, 203, '2022-09-30 02:00:12', '2022-09-30 02:00:12'),
(159, 98324728, 1, 'Famika', 'P', 'Bandung', '2022-10-01', '00:00:00', 42, 'Bayar', NULL, 'famika', '1664508086157.PNG', NULL, 'Antri', NULL, 203, '2022-09-30 03:21:26', '2022-09-30 03:21:26'),
(160, 9283472, 6, 'Veranda', 'P', 'Makassar', '2022-09-30', '00:00:00', 42, 'Bayar', NULL, 'veranda', '1664508123565.jpg', NULL, 'Antri', NULL, 203, '2022-09-30 03:22:03', '2022-09-30 03:22:03'),
(161, 82342, 1, 'Mane', 'L', 'Sukabumi', '2022-09-30', '00:00:00', 50, 'Bayar', NULL, 'mane', '1664509347801.png', NULL, 'Antri', NULL, 203, '2022-09-30 03:42:28', '2022-09-30 03:42:28'),
(162, 982734823, 1, 'Sakura Haruno', 'L', 'Konoha', '2022-11-27', '00:00:00', 42, 'Bayar', NULL, 'sakura-haruno', '1669473794124.PNG', NULL, 'Antri', NULL, 199, '2022-11-26 14:43:14', '2022-11-26 14:43:14'),
(163, 98782423, 1, 'Muhammad Rizki', 'L', 'Lembur situ', '2022-11-27', '00:00:00', 42, 'BPJS', 2147483647, 'muhammad-rizki', '1669474098440.PNG', NULL, 'Antri', NULL, 199, '2022-11-26 14:48:18', '2022-11-26 14:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_22_014930_create_categories_table', 1),
(5, '2021_02_22_023535_add_keterangan_to_categories_table', 1),
(6, '2021_04_05_090736_penyesuaian_table_users', 1),
(8, '2022_03_10_094335_create_pegawais_table', 2),
(9, '2022_03_31_215707_create_obats_table', 3),
(10, '2022_04_04_140731_create_suplais_table', 3),
(11, '2022_04_22_103951_create_puskesmas_table', 4),
(12, '2022_04_29_162137_create_polis_table', 5),
(13, '2022_04_30_161551_create_dokters_table', 6),
(14, '2022_05_01_225311_create_jadwal_dokters_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` int(11) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puskesmas_id` bigint(20) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `npwp`, `alamat`, `gender`, `telepon`, `tgl_lahir`, `jabatan`, `bidang`, `puskesmas_id`, `avatar`, `slug`, `created_at`, `updated_at`) VALUES
(6, 'Agus Ruslandi', 4364, 'Depok', 'L', '0895748888', '1995-06-14', 'Staff Administrasi', 'Administrasi', 2, '1651349337298.PNG', 'agus-ruslandi', '2022-04-30 20:08:57', '2022-04-30 20:08:57'),
(8, 'Joko Tingkir', 99654555, 'Surabaya', 'L', '083892388', '1998-10-23', 'Staff Administrasi', 'Administrasi', 5, '1658350637541.jpg', 'joko-tingkir', '2022-07-20 20:57:17', '2022-08-27 15:25:06'),
(14, 'Budi Anduk', 23957395, 'Bandung', 'L', '08654823', '1990-10-28', 'Staff Administrasi', 'Administrasi', 5, '1661736666991.PNG', 'budi-anduk', '2022-08-29 01:31:06', '2022-08-29 01:31:06'),
(15, 'Erik Gunawan', 53463, 'Cibodas', 'L', '0895764538', '1996-06-26', 'Apoteker', 'Apoteker', 3, '1662732787538.PNG', 'erik-gunawan', '2022-09-09 14:13:07', '2022-09-09 14:13:07'),
(16, 'Ali Muhktar', 2342759, 'Bandung', '', '0846874234', '1996-01-12', 'Staff Administrasi', 'Administrasi', 22, '1662903173260.jpg', 'ali-muhktar', '2022-09-11 13:32:53', '2022-09-11 13:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokter`
--

CREATE TABLE `tbl_dokter` (
  `id` bigint(20) NOT NULL,
  `kode_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_induk` int(11) NOT NULL,
  `tmpt_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `puskesmas_id` bigint(20) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_dokter`
--

INSERT INTO `tbl_dokter` (`id`, `kode_dokter`, `nama_dokter`, `alamat`, `gender`, `no_induk`, `tmpt_lahir`, `tgl_lahir`, `puskesmas_id`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(5, 'AP-3', 'Mulyadi', 'Depok', 'L', 43253, 'Bandung', '2000-10-26', 2, 'mulyadi', '1651350711227.jpg', '2022-08-28 07:07:01', '2022-08-28 07:07:01'),
(7, 'SP-3', 'Nana Molina', 'Depok', 'P', 456584, 'Bandung', '2022-05-10', 3, 'nana-molina', '1651466474824.PNG', '2022-08-28 07:07:04', '2022-08-28 07:07:04'),
(8, 'LE-345-369', 'Layla Erika', 'Jakarta', 'P', 358077, 'Bandung', '2000-07-21', 5, 'layla-erika', '1652373112231.PNG', '2022-08-28 07:07:08', '2022-08-28 07:07:08'),
(10, 'BD-293-234', 'Budiyono', 'Bandung', 'L', 457830, 'Bandung', '1990-06-04', 5, 'budiyono', '1661746193325.jpg', '2022-08-29 04:11:24', '2022-08-29 04:11:24'),
(11, 'BD-289-333', 'Budi Darsono', 'Cibodas, Sukabumi', 'L', 346433, 'Cibodas', '1989-06-09', 22, 'budi-darsono', '1662903328941.jpg', '2022-09-11 13:35:56', '2022-09-11 13:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal_dokter`
--

CREATE TABLE `tbl_jadwal_dokter` (
  `id` bigint(20) NOT NULL,
  `dokter_id` bigint(20) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jum''at','Sabtu','Minggu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `puskesmas_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_jadwal_dokter`
--

INSERT INTO `tbl_jadwal_dokter` (`id`, `dokter_id`, `hari`, `jam_masuk`, `jam_keluar`, `puskesmas_id`, `updated_at`, `created_at`) VALUES
(14, 8, 'Kamis', '09:55:00', '15:55:00', 42, '2022-09-09 13:53:01', '2022-09-09 13:53:01'),
(15, 7, 'Selasa', '07:00:00', '13:00:00', 48, '2022-09-09 14:00:49', '2022-09-09 14:00:49'),
(16, 11, 'Kamis', '08:45:00', '14:45:00', 51, '2022-09-11 13:41:16', '2022-09-11 13:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id` int(11) NOT NULL,
  `kode_obat` varchar(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL,
  `dosis_aturan_obat` text NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `puskesmas_id` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`id`, `kode_obat`, `nama_obat`, `jenis_obat`, `stok`, `min_stok`, `dosis_aturan_obat`, `satuan`, `puskesmas_id`, `updated_at`, `created_at`) VALUES
(8, 'S-305', 'Polivanol', 'Obat Tetes Luka', 40, 11, '3 tetes 1x pemakaian', 'Botol', 12, '2022-05-25 15:08:01', '2022-04-05 04:21:27'),
(9, 'H', 'Habbatussauda', 'Herbal', 15, 4, '3 x  1 hari', 'Botol', 2, '2022-04-05 16:16:46', '2022-04-05 16:16:46'),
(13, 'H', 'Bentoman', 'Cairan Alkohol', 15, 10, 'tetes', 'Botol', 5, '2022-04-12 15:08:47', '2022-04-12 15:08:47'),
(15, 'BD-356', 'Bentoman', 'Salep', 20, 5, '2 x sehari', 'Botol', 5, '2022-08-25 16:25:43', '2022-08-25 16:25:43'),
(16, 'S-305', 'Salicyl Beta', 'Kapsul', 34, 4, '2 x sehari', 'Botol', NULL, '2022-08-25 16:31:23', '2022-08-25 16:31:23'),
(17, 'P-402-559', 'Paracetamol', 'Kapsul', 80, 10, '2 x sehari', 'Strip', 5, '2022-08-29 01:15:19', '2022-08-29 01:15:19'),
(18, 'AC-385-236', 'Actemra', 'Imunosupresan jenis antiinterleukin', 70, 5, 'resep dokter', 'Suntik', 5, '2022-08-29 01:18:38', '2022-08-29 01:18:38'),
(20, 'H-273', 'Habbatussauda', 'Herbal', 130, 5, '2 x sehari', 'Botol', 3, '2022-08-31 10:14:16', '2022-08-31 10:14:16'),
(21, 'H-340', 'Habbatussauda', 'Herbal', 125, 5, '2 x sehari', 'Botol', 22, '2022-09-11 13:46:01', '2022-09-11 13:46:01'),
(22, 'BD-426', 'Bentoman', 'Kapsul', 78, 5, '2 x sehari', 'Strip', 22, '2022-10-01 00:38:26', '2022-10-01 00:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemasukan_obat`
--

CREATE TABLE `tbl_pemasukan_obat` (
  `id` int(11) NOT NULL,
  `no_trans` varchar(11) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `puskesmas_id` bigint(20) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pemasukan_obat`
--

INSERT INTO `tbl_pemasukan_obat` (`id`, `no_trans`, `supplier_id`, `obat_id`, `harga`, `jumlah`, `puskesmas_id`, `updated_at`, `created_at`) VALUES
(5, 'D-3526-3235', 1, 8, 2000, 60, 2, '2022-04-05 23:46:29', '2022-04-05 23:46:29'),
(8, 'B-234-332', 1, 8, 10000, 90, 12, '2022-05-25 22:10:39', '2022-04-12 21:49:07'),
(14, 'H-356-235', 2, 20, 10000, 50, 3, '2022-08-31 17:24:11', '2022-08-31 17:24:11'),
(15, 'H-556-296', 2, 20, 10000, 20, 3, '2022-08-31 17:26:36', '2022-08-31 17:26:36'),
(16, 'H-356-265', 8, 21, 14000, 50, 22, '2022-09-11 21:28:11', '2022-09-11 21:28:11'),
(17, 'H-356-557', 8, 21, 5000, 20, 22, '2022-09-11 21:55:04', '2022-09-11 21:55:04');

--
-- Triggers `tbl_pemasukan_obat`
--
DELIMITER $$
CREATE TRIGGER `after_pemasukan_insert` AFTER INSERT ON `tbl_pemasukan_obat` FOR EACH ROW update tbl_obat set stok = stok + new.jumlah
where id = new.obat_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_poli`
--

CREATE TABLE `tbl_poli` (
  `id` int(11) NOT NULL,
  `kode_poli` varchar(11) NOT NULL,
  `nama_poli` varchar(30) NOT NULL,
  `ruang_poli` varchar(30) NOT NULL,
  `puskesmas_id` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_poli`
--

INSERT INTO `tbl_poli` (`id`, `kode_poli`, `nama_poli`, `ruang_poli`, `puskesmas_id`, `updated_at`, `created_at`) VALUES
(4, 'PL-02', 'Poli Lansia', 'Poli Lansia', 2, '2022-08-23 03:17:39', '2022-08-23 03:17:39'),
(5, 'PU-05', 'Poli Umum', 'Ruang Umum', 5, '2022-08-23 03:47:32', '2022-08-23 03:47:32'),
(6, 'PU-03', 'Poli Umum', 'Ruang Umum', 3, '2022-08-24 03:26:32', '2022-08-24 03:26:32'),
(7, 'PG-03', 'Poli Gigi', 'Ruang Melati Indah', 3, '2022-08-24 10:31:17', '2022-08-24 10:31:17'),
(9, 'PG-05', 'Poli Gigi', 'Ruang Mawar', 5, '2022-08-24 14:10:12', '2022-08-24 14:10:12'),
(10, 'PB-05', 'Poli Balita', 'Ruang Balita', 5, '2022-08-24 14:11:58', '2022-08-24 14:11:58'),
(11, 'PU-06', 'Poli Umum', 'Ruang Umum', 22, '2022-09-11 13:37:13', '2022-09-11 13:37:13'),
(12, 'PG-06', 'Poli Gigi', 'Ruang Mawar', 22, '2022-09-11 14:01:05', '2022-09-11 14:01:05'),
(13, 'PL-06', 'Poli Lansia', 'Ruang Melati', 22, '2022-09-11 14:56:58', '2022-09-11 14:56:58'),
(15, 'PK-06', 'Poli KIA', 'Ruang KIA', 22, '2022-09-11 15:01:25', '2022-09-11 15:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_puskesmas`
--

CREATE TABLE `tbl_puskesmas` (
  `id` bigint(20) NOT NULL,
  `kode_puskesmas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `batas_pasien` int(4) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_puskesmas`
--

INSERT INTO `tbl_puskesmas` (`id`, `kode_puskesmas`, `nama`, `alamat`, `batas_pasien`, `admin_id`, `updated_at`, `created_at`) VALUES
(2, 'LS-359-359', 'Puskesmas Lembur Situ', 'Jl.Pelabuhan II', 30, NULL, '2022-09-22 03:12:13', '2022-09-22 03:12:13'),
(3, 'SKB-469-038', 'Puskesmas Sukabumi', 'Jl.RA.Kosasih', 40, 191, '2022-09-22 03:12:16', '2022-09-22 03:12:16'),
(5, 'PR-456', 'Puskesmas Pelabuhan Ratu', 'Pelabuhan Ratu', 50, 197, '2022-09-22 03:12:21', '2022-09-22 03:12:21'),
(12, 'JP-993', 'Puskesmas Jampang Kulon', 'Sukabumi, Jampang Kulon', 30, NULL, '2022-09-22 03:12:24', '2022-09-22 03:12:24'),
(22, 'CB-234-204', 'Puskesmas Cibodas', 'Cibodas', 50, 199, '2022-09-22 03:12:07', '2022-09-22 03:12:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_puskesmas_item`
--

CREATE TABLE `tbl_puskesmas_item` (
  `id` int(11) NOT NULL,
  `puskesmas_id` bigint(20) NOT NULL,
  `poli_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_puskesmas_item`
--

INSERT INTO `tbl_puskesmas_item` (`id`, `puskesmas_id`, `poli_id`, `updated_at`, `created_at`) VALUES
(42, 5, 5, '2022-08-23 03:48:02', '2022-08-23 03:48:02'),
(48, 3, 6, '2022-08-24 03:28:05', '2022-08-24 03:28:05'),
(49, 5, 9, '2022-08-24 14:10:36', '2022-08-24 14:10:36'),
(50, 5, 10, '2022-08-24 14:16:00', '2022-08-24 14:16:00'),
(51, 22, 11, '2022-09-11 13:38:34', '2022-09-11 13:38:34'),
(53, 22, 15, '2022-09-11 15:02:32', '2022-09-11 15:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplai`
--

CREATE TABLE `tbl_suplai` (
  `id` bigint(20) NOT NULL,
  `kode_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `puskesmas_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_suplai`
--

INSERT INTO `tbl_suplai` (`id`, `kode_supplier`, `nama_supplier`, `perusahaan`, `puskesmas_id`, `created_at`, `updated_at`) VALUES
(1, 'B-180-234', 'Novita Sari Cantika', 'Kimia Farma Inc', 2, NULL, '2022-04-05 10:59:14'),
(2, 'B-35434-2342', 'Agus Sumanto', 'IU Farma', 3, NULL, NULL),
(4, 'D-345-185', 'Rusmanto', 'Nurul Farma', 5, '2022-04-05 16:17:17', '2022-04-05 16:17:17'),
(7, 'R-285-392', 'Rianti Putri', 'Sehat Fama Inc', 12, '2022-08-31 09:31:25', '2022-08-31 09:40:15'),
(8, 'N-394', 'Natali', 'Kimia Farma', 22, '2022-09-11 13:47:26', '2022-09-11 13:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `roles`, `address`, `phone`, `gender`, `avatar`, `status`) VALUES
(1, 'Administratror', 'admin.puskesmas@gmail.com', NULL, '$2y$10$FCU5OWPYDvIYDxG/xm8MdefqeDwMUWCkqXfpe9Cdf.GJdbN6q76z6', NULL, '2022-03-12 08:11:20', '2022-08-05 13:26:17', 'admin', '[\"ADMIN\"]', 'Bandung', '082384625', 'L', '1649782964279.PNG', 'ACTIVE'),
(191, 'Usro', 'usro@gmail.com', NULL, '$2y$10$pekiHG3vCNH9xMK5z2Fb0usBdutM86ZyQIFRK8o4qSGz43N98z4bi', NULL, '2022-05-17 15:25:23', '2022-07-31 13:53:23', 'usro', '[\"STAFF\"]', NULL, NULL, 'L', NULL, 'ACTIVE'),
(195, 'Siti Maisaroh', 'maisaroh@gmail.com', NULL, '$2y$10$hNeWqFAcLmczn6JL3vTUteDb7oAulNKI2ABUWwVUM/5Io9r9ksH76', NULL, '2022-08-03 11:35:06', '2022-08-03 11:35:06', 'maisaroh', '[\"USER\"]', NULL, NULL, 'L', NULL, 'ACTIVE'),
(196, 'Rima Menari', 'rima@gmail.com', NULL, '$2y$10$aKXIdLqslNJ2etYg4xzhuutL.x3RDmud.oG46zumdjgvCViwXSgvm', NULL, '2022-08-03 11:38:14', '2022-08-03 11:38:14', 'rima', '[\"ADMIN\"]', NULL, NULL, 'L', NULL, 'ACTIVE'),
(197, 'Windy Utami Larasati', 'windy@gmail.com', NULL, '$2y$10$/ALF3cNByJ0NqJ52mL2FcuPR3w5CT.slgVxR6q8HeA8Q8XNSz3Om.', NULL, '2022-08-03 11:42:11', '2022-08-03 11:47:49', 'windy', '[\"STAFF\"]', NULL, NULL, 'P', NULL, 'ACTIVE'),
(198, 'Unyil Sarunyil', 'unyil@gmail.com', NULL, '$2y$10$ZYbilimT9PKndefuCbniBe0NCO31zYVfAWGmC6PGlTgoJJGx.iaWm', NULL, '2022-08-03 11:44:02', '2022-08-03 11:44:02', 'unyil', '[\"USER\"]', 'Sukabumi', '082384762', 'L', '', 'ACTIVE'),
(199, 'Ucup Sarucup', 'ucup@gmail.com', NULL, '$2y$10$0e8QvncbgBvazQHnWuaGAOkqKPa4atToME6DXWc6rY8ZmGWnpC2d6', NULL, '2022-08-03 11:45:41', '2022-08-03 11:45:41', 'ucup', '[\"STAFF\"]', 'Bandung', '083746583', 'L', '', 'ACTIVE'),
(200, 'Melati Sekar Wangi', 'melati@gmail.com', NULL, '$2y$10$E2wta1AMkFWqfQGi6T0l2uddowwQlKyBwO8vnX6Is2z1HUY8jGtSK', NULL, '2022-08-03 11:52:49', '2022-08-03 11:53:11', 'melati', '[\"STAFF\"]', NULL, NULL, 'P', NULL, 'ACTIVE'),
(201, 'Ismail', 'mail@gmail.com', NULL, '$2y$10$IEU6WudNxpbWOL1wHgfiB.dllkl9CbpgCeTvIJhae85efarY5lZ6q', NULL, '2022-08-03 14:26:37', '2022-08-03 14:26:37', 'mail', '[\"USER\"]', NULL, NULL, 'L', NULL, 'ACTIVE'),
(202, 'Tiara Sulistiyo', 'tiara@gmail.com', NULL, '$2y$10$mtX7.oYDr.S9d8F31sSKye0Qwr5wwaBHYVAa1TlhtpEGrfJ2kXxPO', NULL, '2022-08-06 14:12:16', '2022-08-06 14:12:16', 'tiara', '[\"USER\"]', NULL, NULL, 'P', NULL, 'ACTIVE'),
(203, 'Farel Hermansyah', 'farel@gmail.com', NULL, '$2y$10$a2AXa03wln/gRPdueAtYUO9cY7pTGYIvw72nObXMYtwmZoW4Q4LpG', NULL, '2022-08-06 18:35:41', '2022-08-06 18:35:41', 'farel', '[\"USER\"]', NULL, NULL, 'L', NULL, 'ACTIVE'),
(204, 'Maesaroh', 'maesaroh@gmail.com', NULL, '$2y$10$PbqtpqPxZeqExxLExOZ50OYLOtVDlKAnxprdAkDmTOY6UTSalzfiW', NULL, '2022-09-11 13:28:08', '2022-09-11 13:28:08', 'saroh', '[\"USER\"]', 'Tegal', '0863423542', 'P', '', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `puskesmas_id` (`puskesmas_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puskesmas_id` (`puskesmas_id`);

--
-- Indexes for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `puskesmas_id` (`puskesmas_id`);

--
-- Indexes for table `tbl_jadwal_dokter`
--
ALTER TABLE `tbl_jadwal_dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_dokter` (`dokter_id`),
  ADD KEY `puskesmas_id` (`puskesmas_id`);

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `tbl_obat_ibfk_1` (`puskesmas_id`);

--
-- Indexes for table `tbl_pemasukan_obat`
--
ALTER TABLE `tbl_pemasukan_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `obat_id` (`obat_id`),
  ADD KEY `puskesmas_id` (`puskesmas_id`);

--
-- Indexes for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_poli_ibfk_1` (`puskesmas_id`);

--
-- Indexes for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`) USING BTREE;

--
-- Indexes for table `tbl_puskesmas_item`
--
ALTER TABLE `tbl_puskesmas_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poli_id` (`poli_id`),
  ADD KEY `tbl_puskesmas_item_ibfk_2` (`puskesmas_id`);

--
-- Indexes for table `tbl_suplai`
--
ALTER TABLE `tbl_suplai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_suplai_ibfk_1` (`puskesmas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_jadwal_dokter`
--
ALTER TABLE `tbl_jadwal_dokter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_pemasukan_obat`
--
ALTER TABLE `tbl_pemasukan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_puskesmas_item`
--
ALTER TABLE `tbl_puskesmas_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_suplai`
--
ALTER TABLE `tbl_suplai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_ibfk_3` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_ibfk_4` FOREIGN KEY (`obat_id`) REFERENCES `tbl_obat` (`id`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_dokter`
--
ALTER TABLE `tbl_dokter`
  ADD CONSTRAINT `tbl_dokter_ibfk_1` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`);

--
-- Constraints for table `tbl_jadwal_dokter`
--
ALTER TABLE `tbl_jadwal_dokter`
  ADD CONSTRAINT `tbl_jadwal_dokter_ibfk_1` FOREIGN KEY (`dokter_id`) REFERENCES `tbl_dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_jadwal_dokter_ibfk_2` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD CONSTRAINT `tbl_obat_ibfk_1` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pemasukan_obat`
--
ALTER TABLE `tbl_pemasukan_obat`
  ADD CONSTRAINT `tbl_pemasukan_obat_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_suplai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pemasukan_obat_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `tbl_obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pemasukan_obat_ibfk_3` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_poli`
--
ALTER TABLE `tbl_poli`
  ADD CONSTRAINT `tbl_poli_ibfk_1` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_puskesmas`
--
ALTER TABLE `tbl_puskesmas`
  ADD CONSTRAINT `tbl_puskesmas_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_puskesmas_item`
--
ALTER TABLE `tbl_puskesmas_item`
  ADD CONSTRAINT `tbl_puskesmas_item_ibfk_1` FOREIGN KEY (`poli_id`) REFERENCES `tbl_poli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_puskesmas_item_ibfk_2` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_suplai`
--
ALTER TABLE `tbl_suplai`
  ADD CONSTRAINT `tbl_suplai_ibfk_1` FOREIGN KEY (`puskesmas_id`) REFERENCES `tbl_puskesmas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
