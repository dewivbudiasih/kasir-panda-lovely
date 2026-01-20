-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2026 at 02:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandalovely_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_kategori` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'skincare', '2026-01-13 21:38:10', '2026-01-13 21:38:10'),
(2, 'bodycare', '2026-01-13 21:38:16', '2026-01-13 21:38:16'),
(3, 'haircare', '2026-01-14 03:43:34', '2026-01-14 03:43:34'),
(4, 'aksesoris', '2026-01-15 20:47:18', '2026-01-15 20:47:18'),
(5, 'makeup', '2026-01-15 22:19:47', '2026-01-15 22:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '0001_01_01_000000_create_users_table', 1),
(14, '0001_01_01_000001_create_cache_table', 1),
(15, '0001_01_01_000002_create_jobs_table', 1),
(16, '2026_01_01_000000_create_categories_table', 1),
(17, '2026_01_07_092427_create_penjualan_table', 1),
(18, '2026_01_07_092428_create_produks_table', 2),
(19, '2026_01_08_095702_create_transactions_table', 2),
(20, '2026_01_08_124115_add_role_to_users_table', 2),
(21, '2026_01_10_040113_add_kategori_id_to_produk_table', 2),
(22, '2026_01_13_014238_create_pengaturan_table', 2),
(23, '2026_01_13_020324_create_transaction_details_table', 2),
(24, '2026_01_14_041724_add_payment_method_to_transactions_table', 2),
(25, '2026_01_14_064743_add_description_to_products_table', 3),
(26, '2026_01_14_102257_add_status_and_total_price_to_transactions', 3),
(27, '2026_01_19_080004_add_deleted_at_to_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Panda Lovely',
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_toko`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Panda Lovely', '088230261995', 'jln.pahlawan no 23 mojokertoo', '2026-01-14 03:00:56', '2026-01-19 11:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kasir` bigint UNSIGNED NOT NULL,
  `total_bayar` decimal(15,2) NOT NULL,
  `uang_diterima` decimal(15,2) NOT NULL,
  `kembalian` decimal(15,2) NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint UNSIGNED NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `stock` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `category_id`, `price`, `stock`, `created_at`, `updated_at`, `keterangan`, `deleted_at`) VALUES
(1, '008', 'serum Acne', NULL, 1, 54000.00, 41, '2026-01-13 21:47:13', '2026-01-19 11:58:23', 'untuk kulit berjerawat', NULL),
(2, '009', 'moisturizer', NULL, 1, 39000.00, 58, '2026-01-13 21:47:27', '2026-01-19 12:36:08', 'G2glow Untuk kulit sensitif', NULL),
(3, '007', 'scrub', NULL, 2, 55000.00, 87, '2026-01-13 23:06:19', '2026-01-19 04:27:57', 'Scrub dari Scarlet untuk membersihkan sel kulit mati', NULL),
(4, '005', 'bedak pupur', NULL, 2, 45000.00, 84, '2026-01-14 00:04:43', '2026-01-19 04:23:14', 'Viva', '2026-01-19 04:23:14'),
(8, '003', 'lipstik', NULL, 1, 45000.00, 50, '2026-01-15 22:19:33', '2026-01-19 04:23:03', 'lipstik sed09 dari OMG', NULL),
(9, 'A98', 'bando', NULL, 4, 12000.00, 34, '2026-01-16 14:13:20', '2026-01-19 11:58:23', 'bando bintangg', NULL),
(10, '001', 'chusion', NULL, 5, 97000.00, 45, '2026-01-19 01:09:51', '2026-01-19 12:37:07', 'chusion dari skintifik shed petal 03', NULL),
(11, 'A45', 'bedak padat', NULL, 5, 25000.00, 78, '2026-01-19 04:21:36', '2026-01-19 04:21:36', 'bedak padat dari Viva cocok untuk kulis berminyak', NULL),
(12, 'A89', 'Eyeliner', NULL, 5, 36000.00, 43, '2026-01-19 04:22:40', '2026-01-19 12:37:07', 'eyeliner dari brasov anti air', NULL),
(13, 'A56', 'Hair Serum', NULL, 3, 89000.00, 100, '2026-01-19 04:25:21', '2026-01-19 04:25:21', 'Untuk rambut rontok dan bercabang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LUNAS',
  `user_id` bigint UNSIGNED NOT NULL,
  `invoice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tunai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `status`, `user_id`, `invoice_code`, `total_price`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 'LUNAS', 2, 'TRX-1768366082988', 132000, 'tunai', '2026-01-13 21:48:02', '2026-01-13 21:48:02'),
(2, 'LUNAS', 2, 'TRX-1768366097587', 132000, 'tunai', '2026-01-13 21:48:17', '2026-01-13 21:48:17'),
(3, 'LUNAS', 2, 'TRX-1768366113556', 240000, 'tunai', '2026-01-13 21:48:33', '2026-01-13 21:48:33'),
(4, 'LUNAS', 2, 'TRX-1768366635946', 54000, 'tunai', '2026-01-13 21:57:15', '2026-01-13 21:57:15'),
(5, 'LUNAS', 2, 'TRX-1768366760923', 39000, 'tunai', '2026-01-13 21:59:20', '2026-01-13 21:59:20'),
(6, 'LUNAS', 2, 'TRX-1768367804704', 54000, 'tunai', '2026-01-13 22:16:44', '2026-01-13 22:16:44'),
(7, 'LUNAS', 2, 'TRX-1768370242305', 54000, 'tunai', '2026-01-13 22:57:22', '2026-01-13 22:57:22'),
(8, 'LUNAS', 2, 'TRX-1768372483367', 275000, 'tunai', '2026-01-13 23:34:43', '2026-01-13 23:34:43'),
(9, 'LUNAS', 2, 'TRX-1768443233606', 45000, 'tunai', '2026-01-14 19:13:53', '2026-01-14 19:13:53'),
(10, 'LUNAS', 2, 'TRX-1768444156104', 94000, 'tunai', '2026-01-14 19:29:16', '2026-01-14 19:29:16'),
(11, 'LUNAS', 2, 'TRX-1768537446738', 39000, 'tunai', '2026-01-15 21:24:06', '2026-01-15 21:24:06'),
(12, 'LUNAS', 2, 'TRX-1768540143348', 139000, 'tunai', '2026-01-15 22:09:03', '2026-01-15 22:09:03'),
(13, 'LUNAS', 2, 'TRX-1768567276361', 39000, 'tunai', '2026-01-16 05:41:16', '2026-01-16 05:41:16'),
(14, 'LUNAS', 2, 'TRX-1768567651438', 100000, 'tunai', '2026-01-16 12:47:31', '2026-01-16 12:47:31'),
(15, 'LUNAS', 2, 'TRX-1768783709437', 100000, 'tunai', '2026-01-19 00:48:29', '2026-01-19 00:48:29'),
(16, 'LUNAS', 2, 'TRX-1768783738618', 155000, 'tunai', '2026-01-19 00:48:58', '2026-01-19 00:48:58'),
(17, 'LUNAS', 3, 'TRX-1768786814892', 136000, 'tunai', '2026-01-19 01:40:14', '2026-01-19 01:40:14'),
(18, 'LUNAS', 3, 'TRX-1768787274289', 97000, 'tunai', '2026-01-19 01:47:54', '2026-01-19 01:47:54'),
(19, 'LUNAS', 3, 'TRX-1768792107577', 78000, 'tunai', '2026-01-19 03:08:27', '2026-01-19 03:08:27'),
(20, 'LUNAS', 3, 'TRX-1768792892666', 191000, 'tunai', '2026-01-19 03:21:32', '2026-01-19 03:21:32'),
(21, 'LUNAS', 3, 'TRX-1768796381723', 94000, 'tunai', '2026-01-19 04:19:41', '2026-01-19 04:19:41'),
(22, 'LUNAS', 3, 'TRX-1768823903337', 66000, 'tunai', '2026-01-19 11:58:23', '2026-01-19 11:58:23'),
(23, 'LUNAS', 3, 'TRX-1768823930186', 36000, 'tunai', '2026-01-19 11:58:50', '2026-01-19 11:58:50'),
(24, 'LUNAS', 2, 'TRX-1768826168745', 136000, 'tunai', '2026-01-19 12:36:08', '2026-01-19 12:36:08'),
(25, 'LUNAS', 2, 'TRX-1768826227908', 133000, 'tunai', '2026-01-19 12:37:07', '2026-01-19 12:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 54000, 54000, '2026-01-13 21:48:02', '2026-01-13 21:48:02'),
(2, 1, 2, 2, 39000, 78000, '2026-01-13 21:48:02', '2026-01-13 21:48:02'),
(3, 2, 1, 1, 54000, 54000, '2026-01-13 21:48:17', '2026-01-13 21:48:17'),
(4, 2, 2, 2, 39000, 78000, '2026-01-13 21:48:17', '2026-01-13 21:48:17'),
(5, 3, 1, 3, 54000, 162000, '2026-01-13 21:48:33', '2026-01-13 21:48:33'),
(6, 3, 2, 2, 39000, 78000, '2026-01-13 21:48:34', '2026-01-13 21:48:34'),
(7, 4, 1, 1, 54000, 54000, '2026-01-13 21:57:15', '2026-01-13 21:57:15'),
(8, 5, 2, 1, 39000, 39000, '2026-01-13 21:59:20', '2026-01-13 21:59:20'),
(9, 6, 1, 1, 54000, 54000, '2026-01-13 22:16:44', '2026-01-13 22:16:44'),
(10, 7, 1, 1, 54000, 54000, '2026-01-13 22:57:22', '2026-01-13 22:57:22'),
(11, 8, 3, 5, 55000, 275000, '2026-01-13 23:34:43', '2026-01-13 23:34:43'),
(12, 9, 4, 1, 45000, 45000, '2026-01-14 19:13:53', '2026-01-14 19:13:53'),
(13, 10, 2, 1, 39000, 39000, '2026-01-14 19:29:16', '2026-01-14 19:29:16'),
(14, 10, 3, 1, 55000, 55000, '2026-01-14 19:29:16', '2026-01-14 19:29:16'),
(15, 11, 2, 1, 39000, 39000, '2026-01-15 21:24:06', '2026-01-15 21:24:06'),
(16, 12, 2, 1, 39000, 39000, '2026-01-15 22:09:03', '2026-01-15 22:09:03'),
(17, 12, 3, 1, 55000, 55000, '2026-01-15 22:09:03', '2026-01-15 22:09:03'),
(18, 12, 4, 1, 45000, 45000, '2026-01-15 22:09:03', '2026-01-15 22:09:03'),
(19, 13, 2, 1, 39000, 39000, '2026-01-16 05:41:16', '2026-01-16 05:41:16'),
(20, 14, 3, 1, 55000, 55000, '2026-01-16 12:47:31', '2026-01-16 12:47:31'),
(21, 14, 4, 1, 45000, 45000, '2026-01-16 12:47:31', '2026-01-16 12:47:31'),
(22, 15, 4, 1, 45000, 45000, '2026-01-19 00:48:29', '2026-01-19 00:48:29'),
(23, 15, 3, 1, 55000, 55000, '2026-01-19 00:48:30', '2026-01-19 00:48:30'),
(24, 16, 4, 1, 45000, 45000, '2026-01-19 00:48:58', '2026-01-19 00:48:58'),
(25, 16, 3, 2, 55000, 110000, '2026-01-19 00:48:58', '2026-01-19 00:48:58'),
(26, 17, 2, 1, 39000, 39000, '2026-01-19 01:40:14', '2026-01-19 01:40:14'),
(27, 17, 10, 1, 97000, 97000, '2026-01-19 01:40:14', '2026-01-19 01:40:14'),
(28, 18, 10, 1, 97000, 97000, '2026-01-19 01:47:54', '2026-01-19 01:47:54'),
(29, 19, 2, 2, 39000, 78000, '2026-01-19 03:08:27', '2026-01-19 03:08:27'),
(30, 20, 10, 1, 97000, 97000, '2026-01-19 03:21:32', '2026-01-19 03:21:32'),
(31, 20, 2, 1, 39000, 39000, '2026-01-19 03:21:32', '2026-01-19 03:21:32'),
(32, 20, 3, 1, 55000, 55000, '2026-01-19 03:21:32', '2026-01-19 03:21:32'),
(33, 21, 2, 1, 39000, 39000, '2026-01-19 04:19:41', '2026-01-19 04:19:41'),
(34, 21, 3, 1, 55000, 55000, '2026-01-19 04:19:41', '2026-01-19 04:19:41'),
(35, 22, 1, 1, 54000, 54000, '2026-01-19 11:58:23', '2026-01-19 11:58:23'),
(36, 22, 9, 1, 12000, 12000, '2026-01-19 11:58:23', '2026-01-19 11:58:23'),
(37, 23, 12, 1, 36000, 36000, '2026-01-19 11:58:50', '2026-01-19 11:58:50'),
(38, 24, 2, 1, 39000, 39000, '2026-01-19 12:36:08', '2026-01-19 12:36:08'),
(39, 24, 10, 1, 97000, 97000, '2026-01-19 12:36:08', '2026-01-19 12:36:08'),
(40, 25, 10, 1, 97000, 97000, '2026-01-19 12:37:07', '2026-01-19 12:37:07'),
(41, 25, 12, 1, 36000, 36000, '2026-01-19 12:37:07', '2026-01-19 12:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('ADMIN','KASIR') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KASIR',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Panda', 'admin@panda.com', NULL, '$2y$12$h/grpY5EB3hsmo2dzmbg8.DN36/W0F42daMRMm/6EnVmqHCwelnzK', 'ADMIN', NULL, '2026-01-13 21:31:10', '2026-01-13 21:31:10'),
(2, 'Kasir Jolir', 'kasir@panda.com', NULL, '$2y$12$d6A.Q2GvzTWepd2k6semNOd1B/P0zBRnei7Iz04jKnzbVcxxCZn22', 'KASIR', NULL, '2026-01-13 21:31:11', '2026-01-19 04:29:54'),
(3, 'dewi', 'dewi@panda.com', NULL, '$2y$12$4ViY9j40Q/EWdAAZqP/tLeis36rOZZdRh1zU2bZ0K0O69ZFBtYc1C', 'ADMIN', NULL, '2026-01-15 21:13:00', '2026-01-19 12:35:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id_kasir_foreign` (`id_kasir`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_kategori` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_id_kasir_foreign` FOREIGN KEY (`id_kasir`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
