-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2022 at 05:04 PM
-- Server version: 5.7.33
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pajak_air`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_pesans`
--

CREATE TABLE `history_pesans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `template_pesan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_pesans`
--

INSERT INTO `history_pesans` (`id`, `pelanggan_id`, `template_pesan_id`, `created_at`, `updated_at`) VALUES
(12, 14, 1, '2021-12-20 19:48:51', '2021-12-20 19:48:51'),
(14, 14, 1, '2021-12-20 19:50:36', '2021-12-20 19:50:36'),
(15, 16, 1, '2021-12-20 19:57:51', '2021-12-20 19:57:51'),
(16, 14, 1, '2021-12-20 19:58:09', '2021-12-20 19:58:09'),
(17, 14, 1, '2021-12-21 08:29:53', '2021-12-21 08:29:53'),
(23, 14, 1, '2021-12-27 23:41:39', '2021-12-27 23:41:39'),
(28, 14, 1, '2021-12-27 23:47:39', '2021-12-27 23:47:39'),
(29, 14, 1, '2021-12-28 19:44:28', '2021-12-28 19:44:28'),
(30, 14, 1, '2021-12-28 19:47:51', '2021-12-28 19:47:51'),
(31, 14, 1, '2021-12-29 21:34:39', '2021-12-29 21:34:39'),
(32, 14, 1, '2021-12-29 21:34:57', '2021-12-29 21:34:57'),
(33, 14, 1, '2021-12-29 21:40:16', '2021-12-29 21:40:16'),
(36, 14, 1, '2021-12-30 22:06:35', '2021-12-30 22:06:35'),
(37, 14, 2, '2021-12-30 22:14:09', '2021-12-30 22:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_industris`
--

CREATE TABLE `kategori_industris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_industri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_industris`
--

INSERT INTO `kategori_industris` (`id`, `nama_industri`, `created_at`, `updated_at`) VALUES
(2, 'Industri 2', '2022-05-18 21:44:19', '2022-05-18 21:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2021_11_05_080324_add_no_telepon_to_users_table', 2),
(6, '2021_11_05_083610_create_pelanggans_table', 3),
(7, '2021_11_08_024743_rename_pelanggans_column', 4),
(10, '2021_11_08_172254_create_tagihans_table', 5),
(11, '2021_11_09_053731_create_tagihan_pemasangans_table', 5),
(12, '2021_11_09_053822_create_pembayarans_table', 6),
(13, '2021_11_09_053838_create_pembayaran_pemasangans_table', 7),
(14, '2021_11_09_053856_create_template_pesans_table', 7),
(15, '2021_11_09_072009_create_profiles_table', 8),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 9),
(17, '2021_12_09_090539_create_roles_table', 10),
(20, '2021_12_10_031550_add_file_name_to_tagihans_table', 11),
(21, '2021_12_11_192726_add_tanggal_to_pembayarans_table', 12),
(22, '2021_12_13_024047_create_history_pesans_table', 13),
(25, '2021_12_13_024724_add_role_id_to_users_table', 14),
(26, '2021_12_24_070924_add_nik_to_users_table', 15),
(27, '2021_12_24_071652_add_nik_to_pelanggans_table', 16),
(28, '2021_12_28_032655_add_template_pesan_terlambat_id_to_profiles_table', 17),
(29, '2021_12_30_053751_add_template_pesan_terlambat_manager_id_to_profiles_table', 18),
(35, '2022_05_17_032707_create_kategori_industris_table', 19),
(36, '2022_05_17_032736_create_upt_daerahs_table', 19),
(37, '2022_05_17_034732_add_to_pelanggans_table', 19),
(38, '2022_05_17_035617_add_to_users_table', 19),
(39, '2022_05_18_025202_create_pelunasans_table', 19),
(40, '2022_05_18_031457_add_meter_penggunaan_awal_to_tagihans_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@admin.com', '$2y$10$9kQioauQHKxDypjBGWB7T.d.e.Vw8ns6BGurw0X1a1wkXeagh7qKC', '2021-12-08 21:41:54'),
('nabilrivaldy@gmail.com', '$2y$10$ldA0Stz.iEdy8s4Cq3crve67i4RAdSMCtwWGiBiHbFyVwuNb3y3IG', '2021-12-08 22:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upt_daerah_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_industri_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id`, `id_pelanggan`, `name`, `no_telepon`, `upt_daerah_id`, `kategori_industri_id`, `nik`, `alamat`, `created_at`, `updated_at`) VALUES
(1, '20220518030955', 'test', 'test', 0, 0, '00000', 'test', '2022-05-17 19:09:55', '2022-05-17 19:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `pelunasans`
--

CREATE TABLE `pelunasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelunasan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembayaran_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelunasans`
--

INSERT INTO `pelunasans` (`id`, `id_pelunasan`, `pembayaran_id`, `created_at`, `updated_at`) VALUES
(1, '20220524091630300', 1, '2022-05-24 01:16:30', '2022-05-24 01:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagihan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `id_pembayaran`, `tagihan_id`, `created_at`, `updated_at`, `tanggal`) VALUES
(1, '20220518083229218', 14, '2022-05-18 00:32:29', '2022-05-18 00:32:29', '2022-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_pemasangans`
--

CREATE TABLE `pembayaran_pemasangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pembayaran_pemasangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagihan_pemasangan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_pemasangans`
--

INSERT INTO `pembayaran_pemasangans` (`id`, `id_pembayaran_pemasangan`, `tagihan_pemasangan_id`, `jumlah_pembayaran`, `created_at`, `updated_at`) VALUES
(1, '20211221044446360', 1, 3300000, '2021-12-20 20:44:46', '2021-12-20 20:44:46'),
(2, '2021122105240580', 5, 1300000, '2021-12-20 21:24:05', '2021-12-20 21:24:05'),
(3, '20211221052518558', 6, 1300000, '2021-12-20 21:25:18', '2021-12-20 21:25:18'),
(4, '20211221052703513', 7, 3300000, '2021-12-20 21:27:03', '2021-12-20 21:27:03'),
(5, '20211221052712644', 6, 2000000, '2021-12-20 21:27:12', '2021-12-20 21:27:12'),
(6, '20211221080600682', 8, 1300000, '2021-12-21 00:06:00', '2021-12-21 00:06:00'),
(7, '20211221080614435', 8, 500000, '2021-12-21 00:06:14', '2021-12-21 00:06:14'),
(8, '2021122108064679', 8, 1500000, '2021-12-21 00:06:46', '2021-12-21 00:06:46'),
(9, '20211227065335456', 9, 1300000, '2021-12-26 22:53:35', '2021-12-26 22:53:35'),
(12, '20211227070430670', 9, 2000000, '2021-12-26 23:04:30', '2021-12-26 23:04:30'),
(13, '20211230083342931', 10, 3300000, '2021-12-30 00:33:42', '2021-12-30 00:33:42'),
(14, '20211230083400214', 11, 3300000, '2021-12-30 00:34:00', '2021-12-30 00:34:00'),
(15, '20220104071521657', 12, 3300000, '2022-01-03 23:15:21', '2022-01-03 23:15:21'),
(16, '20220104071527824', 13, 1300000, '2022-01-03 23:15:27', '2022-01-03 23:15:27'),
(17, '20220104071537106', 13, 2000000, '2022-01-03 23:15:37', '2022-01-03 23:15:37'),
(18, '20220104071629679', 14, 1300000, '2022-01-03 23:16:29', '2022-01-03 23:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'token', '9a617a5945b68d6fd73a80bfde81f0332cc4764c08d9fa108e9b621a4a890658', '[\"*\"]', NULL, '2021-12-08 20:15:34', '2021-12-08 20:15:34'),
(2, 'App\\Models\\User', 2, 'token', '3a4b0593281cc481847dff40848bd52cb61742c09247791cf2f19d3cffdda97c', '[\"*\"]', NULL, '2021-12-08 20:15:53', '2021-12-08 20:15:53'),
(5, 'App\\Models\\User', 2, 'token', '2112dbec75cd040ccbbf86d7564b1edce457bb7d56be71e9460c92cd6bebaecb', '[\"*\"]', '2022-01-04 00:30:45', '2021-12-08 22:48:54', '2022-01-04 00:30:45'),
(6, 'App\\Models\\User', 2, 'token', 'dbe1ee32c913f7813187b793b3c51033b7b4f95f79a7b588d56e8c8cfe4fb740', '[\"*\"]', '2022-01-02 19:17:28', '2021-12-12 08:32:02', '2022-01-02 19:17:28'),
(7, 'App\\Models\\User', 2, 'token', '08a2013055326e3d962063b7a63d5e75f42a1f5d7dc3cf7cf2b03d2075a8623f', '[\"*\"]', '2022-01-02 19:17:06', '2021-12-20 18:55:31', '2022-01-02 19:17:06'),
(8, 'App\\Models\\User', 2, 'token', 'aa18e0dc649e7ff805f5d7cbf905f3f73f4d37db9d1dc6d54dec24029b3a6329', '[\"*\"]', '2021-12-23 22:37:57', '2021-12-23 22:33:09', '2021-12-23 22:37:57'),
(9, 'App\\Models\\User', 2, 'token', '05eea39a8f4f044e8ec9e32d92e0f8fb0d330bb0cb095dedf07ddb7b78f656b3', '[\"*\"]', '2022-01-04 00:29:33', '2021-12-30 00:42:09', '2022-01-04 00:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `harga_per_kubik` int(11) NOT NULL,
  `harga_pemasangan` int(11) NOT NULL,
  `harga_pemasangan_dp` int(11) NOT NULL,
  `template_pesan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `template_pesan_terlambat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `template_pesan_terlambat_manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `alamat`, `harga_per_kubik`, `harga_pemasangan`, `harga_pemasangan_dp`, `template_pesan_id`, `template_pesan_terlambat_id`, `template_pesan_terlambat_manager_id`, `created_at`, `updated_at`) VALUES
(1, 'Jl.Poros 1 Kec.Loa Kulu Kab.Kutai Kartanegara Kaltim', 11500, 3300000, 1300000, 1, 1, 2, '2021-11-30 06:12:41', '2021-12-30 19:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-12-09 09:07:02', '2021-12-09 09:07:02'),
(2, 'Perusahaan', '2021-12-09 09:07:02', '2021-12-09 09:07:02'),
(3, 'UPT. Daerah', '2021-12-09 09:07:37', '2021-12-09 09:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `tagihans`
--

CREATE TABLE `tagihans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tagihan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `meter_penggunaan_awal` int(11) DEFAULT NULL,
  `meter_penggunaan` int(11) NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci,
  `pesan` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihans`
--

INSERT INTO `tagihans` (`id`, `id_tagihan`, `pelanggan_id`, `tanggal`, `meter_penggunaan_awal`, `meter_penggunaan`, `jumlah_pembayaran`, `file_name`, `file_path`, `pesan`, `status`, `created_at`, `updated_at`) VALUES
(13, '20220518064515704', 1, '2022-05-20', 110, 340, 2645000, NULL, NULL, NULL, NULL, '2022-05-17 22:45:15', '2022-05-17 22:45:15'),
(14, '20220518064636202', 1, '2022-05-20', NULL, 540, 6210000, NULL, NULL, NULL, NULL, '2022-05-17 22:46:36', '2022-05-17 22:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_pemasangans`
--

CREATE TABLE `tagihan_pemasangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tagihan_pemasangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `tipe_pembayaran` int(11) NOT NULL,
  `jumlah_pembayaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagihan_pemasangans`
--

INSERT INTO `tagihan_pemasangans` (`id`, `id_tagihan_pemasangan`, `pelanggan_id`, `tipe_pembayaran`, `jumlah_pembayaran`, `tanggal`, `created_at`, `updated_at`) VALUES
(6, '2021122105251876', 14, 1, 3300000, '2021-12-21', '2021-12-20 21:25:18', '2021-12-20 21:25:18'),
(7, '2021122105270359', 16, 0, 3300000, '2021-12-21', '2021-12-20 21:27:03', '2021-12-20 21:27:03'),
(8, '20211221080600327', 16, 1, 3300000, '2021-12-21', '2021-12-21 00:06:00', '2021-12-21 00:06:00'),
(9, '2021122706533578', 14, 1, 3300000, '2021-12-27', '2021-12-26 22:53:35', '2021-12-26 22:53:35'),
(10, '20211230083342275', 14, 0, 3300000, '2021-12-30', '2021-12-30 00:33:42', '2021-12-30 00:33:42'),
(11, '20211230083400824', 14, 0, 3300000, '2021-12-30', '2021-12-30 00:34:00', '2021-12-30 00:34:00'),
(12, '20220104071521507', 14, 0, 3300000, '2022-01-04', '2022-01-03 23:15:21', '2022-01-03 23:15:21'),
(13, '20220104071527241', 14, 1, 3300000, '2022-01-04', '2022-01-03 23:15:27', '2022-01-03 23:15:27'),
(14, '20220104071629158', 14, 1, 3300000, '2022-01-04', '2022-01-03 23:16:29', '2022-01-03 23:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `template_pesans`
--

CREATE TABLE `template_pesans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_pesan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template_pesans`
--

INSERT INTO `template_pesans` (`id`, `nama_pesan`, `isi_pesan`, `created_at`, `updated_at`) VALUES
(1, 'Tagihan', 'Pelanggan yth. Kami Mengingatkan bahwa \nTagihan PDAM\nNo. Pelanggan : {id_pelanggan}\nNama : {nama_pelanggan}\nAlamat : {alamat}\n\nTAGIHAN PDAM BULAN {tanggal}\n--------------------------------------------\nPenggunaan : {meter_penggunaan} m³\nTagihan : Rp. {jumlah_pembayaran}', '2021-12-13 22:56:03', '2021-12-26 21:15:35'),
(2, 'Notif Tagihan Terlambat', 'Ada Tagihan terlambat', '2021-12-29 21:30:13', '2021-12-29 21:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `upt_daerahs`
--

CREATE TABLE `upt_daerahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_daerah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upt_daerahs`
--

INSERT INTO `upt_daerahs` (`id`, `nama_daerah`, `created_at`, `updated_at`) VALUES
(4, 'Kalimantan Timur', '2022-05-19 19:57:30', '2022-05-19 19:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upt_daerah_id` bigint(20) UNSIGNED NOT NULL,
  `no_telepon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `upt_daerah_id`, `no_telepon`, `nik`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@admin.com', 0, '08080808', NULL, 1, NULL, '$2y$10$R5DOLpj84KEiPMBIj4U7tuFZdv7GgrcaRF1JZ3ngBQBfkrZu0sFJy', NULL, '2021-10-26 19:13:03', '2021-12-12 21:20:15'),
(6, 'Kasir', 'kasir@kasir.com', 0, '080808080808', NULL, 2, NULL, '$2y$10$cU1.OmojomW355cvtf.6EO4UXRMBof6AyEDRwYavSkJziMnfMHbrK', NULL, '2021-12-21 22:28:11', '2021-12-21 22:28:11'),
(9, 'Kalimantan Timur', 'kalimantantimur@email.com', 4, NULL, NULL, 3, NULL, '$2y$10$XaMI2T15YJ53Cin3TeFnNOOSTc8CM9obJv3hpM8CCe81E45MWXxEa', NULL, '2022-05-19 19:57:30', '2022-05-19 19:57:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `history_pesans`
--
ALTER TABLE `history_pesans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_industris`
--
ALTER TABLE `kategori_industris`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelunasans`
--
ALTER TABLE `pelunasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran_pemasangans`
--
ALTER TABLE `pembayaran_pemasangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihans`
--
ALTER TABLE `tagihans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagihan_pemasangans`
--
ALTER TABLE `tagihan_pemasangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_pesans`
--
ALTER TABLE `template_pesans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upt_daerahs`
--
ALTER TABLE `upt_daerahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_pesans`
--
ALTER TABLE `history_pesans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kategori_industris`
--
ALTER TABLE `kategori_industris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelunasans`
--
ALTER TABLE `pelunasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran_pemasangans`
--
ALTER TABLE `pembayaran_pemasangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tagihans`
--
ALTER TABLE `tagihans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tagihan_pemasangans`
--
ALTER TABLE `tagihan_pemasangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `template_pesans`
--
ALTER TABLE `template_pesans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upt_daerahs`
--
ALTER TABLE `upt_daerahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
