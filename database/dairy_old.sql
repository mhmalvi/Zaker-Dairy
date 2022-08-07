-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 10:38 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_one` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_two` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2019_08_19_000000_create_failed_jobs_table', 1),
(2, '2021_04_05_024855_create_roles_table', 1),
(3, '2021_04_05_025012_create_users_table', 1),
(4, '2021_04_05_025248_create_password_resets_table', 1),
(5, '2021_04_05_064104_create_product_categories_table', 1),
(6, '2021_04_05_103101_create_products_table', 1),
(7, '2021_04_05_103758_create_product_images_table', 1),
(8, '2021_04_05_103959_create_orders_table', 1),
(9, '2021_04_05_104019_create_order_details_table', 1),
(10, '2021_04_05_104925_create_customers_table', 1),
(11, '2021_04_06_102648_create_wish_lists_table', 1),
(12, '2021_08_22_051409_create_product_seos_table', 1),
(13, '2021_09_05_043351_create_user_infos_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_user` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','delivered','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tran_status` enum('pending','processing','failed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `discount_type` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_qty` int(11) NOT NULL DEFAULT 1,
  `unit` enum('kg','gm','ltr','ml','pcs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kg',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uuid`, `name`, `slug`, `category_id`, `price`, `discount`, `discount_type`, `unit_qty`, `unit`, `thumbnail`, `thumbnail_alt`, `description`, `featured`, `publish`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '6124ea5da1cf9_lLxH', 'Ghee - 250 gm', 'ghee-250-gm', NULL, 400, 0, 'flat', 250, 'gm', 'ghee-250-gm.jpg', NULL, NULL, 1, 1, '2021-08-24 06:47:26', '2021-08-24 06:47:26', NULL),
(2, '6124eaef21b76_m6yB', 'Ghee - 1 kg', 'ghee-1-kg', 1, 1600, 0, 'flat', 1, 'kg', 'ghee-1-kg.jpg', NULL, NULL, 1, 1, '2021-08-24 06:49:51', '2021-08-24 06:49:51', NULL),
(3, '6124eb39a17a8_m6ET', 'Matha - 1 ltr', 'matha-1ltr', 1, 130, 0, 'flat', 1, 'ltr', 'matha-1ltr.jpg', NULL, NULL, 1, 1, '2021-08-24 06:51:05', '2021-08-24 06:51:05', NULL),
(4, '6124eb9794a48_1UX3', 'Sorisar teel - 1 ltr', 'sorisar-teel-1-ltr', 1, 230, 0, 'flat', 1, 'ltr', 'sorisar-teel-1-ltr.jpg', NULL, NULL, 1, 1, '2021-08-24 06:52:39', '2021-08-24 06:52:39', NULL),
(5, '6124ebee37c30_Zm76', 'Misti Dodhi - 1kg', 'misti-dodhi-1kg', 1, 300, 0, 'flat', 1, 'kg', 'misti-dodhi-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 06:54:06', '2021-08-24 06:54:06', NULL),
(6, '6124ec3e5a529_9HNG', 'Rosgolla - 1kg (12 pcs)', 'rosgolla-1kg-12-pcs', 1, 300, 0, 'flat', 1, 'kg', 'rosgolla-1kg-12-pcs.jpg', NULL, NULL, 1, 1, '2021-08-24 06:55:26', '2021-08-24 06:55:26', NULL),
(7, '6124ec703ccc3_Qg5Y', 'Raajvog - 1kg', 'raajvog-1kg', 1, 300, 0, 'flat', 1, 'kg', 'raajvog-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 06:56:16', '2021-08-24 06:56:16', NULL),
(8, '6124ec9c25eb0_ZEfa', 'Kaalo Jaam - 1 kg', 'kaalo-jaam-1-kg', 1, 300, 0, 'flat', 1, 'kg', 'kaalo-jaam-1-kg.jpg', NULL, NULL, 1, 1, '2021-08-24 06:57:00', '2021-08-24 06:57:00', NULL),
(9, '6124ecc9b2a50_ssVl', 'Laal Mohon - 1kg', 'laal-mohon-1kg', 1, 300, 0, 'flat', 1, 'kg', 'laal-mohon-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 06:57:45', '2021-08-24 06:57:45', NULL),
(10, '6124ed5008b9d_QXwb', 'Laal Chaamchaam - 1kg', 'laal-chaamchaam-1kg', 1, 400, 0, 'flat', 1, 'kg', 'laal-chaamchaam-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:00:00', '2021-08-24 07:00:00', NULL),
(11, '6124ed8db4801_3Gvf', 'Shaada Chaanaa Balushai - 1kg', 'shaada-chaanaa-balushai-1kg', 1, 0, 0, 'flat', 1, 'kg', 'shaada-chaanaa-balushai-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:01:01', '2021-08-24 07:01:01', NULL),
(12, '6124edc4d9a72_N5dS', 'Laal Chaana Balushai - 1kg', 'laal-chaana-balushai-1kg', 1, 400, 0, 'flat', 1, 'kg', 'laal-chaana-balushai-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:01:57', '2021-08-24 07:01:57', NULL),
(13, '6124ee21e35c5_oYNM', 'Baby Sweets', 'baby-sweets', 1, 450, 0, 'flat', 1, 'kg', 'baby-sweets.jpg', NULL, NULL, 1, 1, '2021-08-24 07:03:30', '2021-08-24 07:03:30', NULL),
(14, '6124ee4aa195a_xJzW', 'Mini Shaada Chaamchaam', 'mini-shaada-chaamchaam', 1, 450, 0, 'flat', 1, 'kg', 'mini-shaada-chaamchaam.jpg', NULL, NULL, 1, 1, '2021-08-24 07:04:10', '2021-08-24 07:04:10', NULL),
(15, '6124ee808cb92_2QIA', 'Mini Laal Chaamchaam - 1kg', 'mini-laal-chaamchaam-1kg', 1, 450, 0, 'flat', 1, 'kg', 'mini-laal-chaamchaam-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:05:04', '2021-08-24 07:05:04', NULL),
(16, '6124eecbd894f_Hm4K', 'Maalai Chop - 1kg (16 pcs)', 'maalai-chop-1kg-16-pcs', 1, 600, 0, 'flat', 1, 'kg', 'maalai-chop-1kg-16-pcs.jpg', NULL, NULL, 1, 1, '2021-08-24 07:06:20', '2021-08-24 07:06:20', NULL),
(17, '6124ef02aaea3_FiWv', 'Zaafran Vog (12 pcs) - 1kg', 'zaafran-vog-12-pcs-1kg', 1, 600, 0, 'flat', 1, 'kg', 'zaafran-vog-12-pcs-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:07:14', '2021-08-24 07:07:14', NULL),
(18, '6124ef29e9f5c_yoHy', 'Maalai Shor - 1kg', 'maalai-shor-1kg', 1, 700, 0, 'flat', 1, 'kg', 'maalai-shor-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:07:54', '2021-08-24 07:07:54', NULL),
(19, '6124ef856276f_5siD', 'Special Kaacha Chaana - 1kg', 'special-kaacha-chaana-1kg', 1, 700, 0, 'flat', 1, 'kg', 'special-kaacha-chaana-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:09:25', '2021-08-24 07:09:25', NULL),
(20, '6124efd0dae7d_Wdwn', 'Special Sondesh - 1kg', 'special-sondesh-1kg', 1, 800, 0, 'flat', 1, 'kg', 'special-sondesh-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:10:41', '2021-08-24 07:10:41', NULL),
(21, '6124eff2d6523_YXZ2', 'Peera Sondesh - 1kg', 'peera-sondesh-1kg', 1, 800, 0, 'flat', 1, 'kg', 'peera-sondesh-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:11:15', '2021-08-24 07:11:15', NULL),
(22, '6124f01052cf4_8JD3', 'Elish Peti Sondesh - 1kg', 'elish-peti-sondesh-1kg', 1, 800, 0, 'flat', 1, 'kg', 'elish-peti-sondesh-1kg.jpg', NULL, NULL, 1, 1, '2021-08-24 07:11:44', '2021-08-24 07:11:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `uuid`, `category`, `slug`, `details`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, '6124e6d74979d-ANC2', 'Sweets', 'sweets', NULL, NULL, '2021-08-24 06:32:23', '2021-08-24 06:32:23'),
(2, '6124e6dde7c98-yhWD', 'Bakery', 'bakery', NULL, NULL, '2021-08-24 06:32:29', '2021-08-24 06:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fileext` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `filename`, `filepath`, `fileext`, `created_at`, `updated_at`) VALUES
(1, 1, 'ghee-250-gm_biK3FNke.jpg', NULL, NULL, '2021-08-24 06:47:26', '2021-08-24 06:47:26'),
(2, 2, 'ghee-1-kg_loMaxZpN.jpg', NULL, NULL, '2021-08-24 06:49:51', '2021-08-24 06:49:51'),
(3, 3, 'matha-1ltr_tEIMmt9E.jpg', NULL, NULL, '2021-08-24 06:51:06', '2021-08-24 06:51:06'),
(4, 4, 'sorisar-teel-1-ltr_WscuVdDI.jpg', NULL, NULL, '2021-08-24 06:52:40', '2021-08-24 06:52:40'),
(5, 5, 'misti-dodhi-1kg_zleZBt8A.jpg', NULL, NULL, '2021-08-24 06:54:06', '2021-08-24 06:54:06'),
(6, 6, 'rosgolla-1kg-12-pcs_VNi5vLyw.jpg', NULL, NULL, '2021-08-24 06:55:26', '2021-08-24 06:55:26'),
(7, 7, 'raajvog-1kg_PK8qoagO.jpg', NULL, NULL, '2021-08-24 06:56:16', '2021-08-24 06:56:16'),
(8, 8, 'kaalo-jaam-1-kg_iD7bfJD9.jpg', NULL, NULL, '2021-08-24 06:57:00', '2021-08-24 06:57:00'),
(9, 9, 'laal-mohon-1kg_zfN3EiEc.jpg', NULL, NULL, '2021-08-24 06:57:46', '2021-08-24 06:57:46'),
(10, 10, 'laal-chaamchaam-1kg_9lbI8kw6.jpg', NULL, NULL, '2021-08-24 07:00:00', '2021-08-24 07:00:00'),
(11, 11, 'shaada-chaanaa-balushai-1kg_vIt1UVGb.jpg', NULL, NULL, '2021-08-24 07:01:02', '2021-08-24 07:01:02'),
(12, 12, 'laal-chaana-balushai-1kg_ZyYuGjmo.jpg', NULL, NULL, '2021-08-24 07:01:57', '2021-08-24 07:01:57'),
(13, 13, 'baby-sweets_K4vuS7eb.jpg', NULL, NULL, '2021-08-24 07:03:30', '2021-08-24 07:03:30'),
(14, 14, 'mini-shaada-chaamchaam_WPlofhrX.jpg', NULL, NULL, '2021-08-24 07:04:11', '2021-08-24 07:04:11'),
(15, 15, 'mini-laal-chaamchaam-1kg_vy4xxnt5.jpg', NULL, NULL, '2021-08-24 07:05:04', '2021-08-24 07:05:04'),
(16, 16, 'maalai-chop-1kg-16-pcs_shwnhVH8.jpg', NULL, NULL, '2021-08-24 07:06:20', '2021-08-24 07:06:20'),
(17, 17, 'zaafran-vog-12-pcs-1kg_rdWY5BIE.jpg', NULL, NULL, '2021-08-24 07:07:15', '2021-08-24 07:07:15'),
(18, 18, 'maalai-shor-1kg_nap1yyW4.jpg', NULL, NULL, '2021-08-24 07:07:54', '2021-08-24 07:07:54'),
(19, 19, 'special-kaacha-chaana-1kg_bi32z4vH.jpg', NULL, NULL, '2021-08-24 07:09:25', '2021-08-24 07:09:25'),
(20, 21, 'peera-sondesh-1kg_CeIKnluQ.jpg', NULL, NULL, '2021-08-24 07:11:15', '2021-08-24 07:11:15'),
(21, 21, 'peera-sondesh-1kg_GeKdrGx5.jpg', NULL, NULL, '2021-08-24 07:11:15', '2021-08-24 07:11:15'),
(22, 22, 'elish-peti-sondesh-1kg_W0kCk7qw.jpg', NULL, NULL, '2021-08-24 07:11:44', '2021-08-24 07:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_seos`
--

CREATE TABLE `product_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_seos`
--

INSERT INTO `product_seos` (`id`, `product_id`, `keywords`, `tags`, `descriptions`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, '2021-08-24 06:47:26', '2021-08-24 06:47:26'),
(2, 2, NULL, NULL, NULL, '2021-08-24 06:49:51', '2021-08-24 06:49:51'),
(3, 3, NULL, NULL, NULL, '2021-08-24 06:51:05', '2021-08-24 06:51:05'),
(4, 4, NULL, NULL, NULL, '2021-08-24 06:52:39', '2021-08-24 06:52:39'),
(5, 5, NULL, NULL, NULL, '2021-08-24 06:54:06', '2021-08-24 06:54:06'),
(6, 6, NULL, NULL, NULL, '2021-08-24 06:55:26', '2021-08-24 06:55:26'),
(7, 7, NULL, NULL, NULL, '2021-08-24 06:56:16', '2021-08-24 06:56:16'),
(8, 8, NULL, NULL, NULL, '2021-08-24 06:57:00', '2021-08-24 06:57:00'),
(9, 9, NULL, NULL, NULL, '2021-08-24 06:57:45', '2021-08-24 06:57:45'),
(10, 10, NULL, NULL, NULL, '2021-08-24 07:00:00', '2021-08-24 07:00:00'),
(11, 11, NULL, NULL, NULL, '2021-08-24 07:01:01', '2021-08-24 07:01:01'),
(12, 12, NULL, NULL, NULL, '2021-08-24 07:01:57', '2021-08-24 07:01:57'),
(13, 13, NULL, NULL, NULL, '2021-08-24 07:03:30', '2021-08-24 07:03:30'),
(14, 14, NULL, NULL, NULL, '2021-08-24 07:04:10', '2021-08-24 07:04:10'),
(15, 15, NULL, NULL, NULL, '2021-08-24 07:05:04', '2021-08-24 07:05:04'),
(16, 16, NULL, NULL, NULL, '2021-08-24 07:06:20', '2021-08-24 07:06:20'),
(17, 17, NULL, NULL, NULL, '2021-08-24 07:07:14', '2021-08-24 07:07:14'),
(18, 18, NULL, NULL, NULL, '2021-08-24 07:07:54', '2021-08-24 07:07:54'),
(19, 19, NULL, NULL, NULL, '2021-08-24 07:09:25', '2021-08-24 07:09:25'),
(20, 20, NULL, NULL, NULL, '2021-08-24 07:10:41', '2021-08-24 07:10:41'),
(21, 21, NULL, NULL, NULL, '2021-08-24 07:11:15', '2021-08-24 07:11:15'),
(22, 22, NULL, NULL, NULL, '2021-08-24 07:11:44', '2021-08-24 07:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_user` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_suspended` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `action_user`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `is_admin`, `is_suspended`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, NULL, NULL, NULL, 'Rajin', 'rajin123@gmail.com', NULL, '$2y$10$hFffhFJTR76ux7cw5l75gODttQSj2MJvbZokERKxggZNvsPMZMGia', NULL, '0', 'no', NULL, '2021-09-04 22:41:44', '2021-09-04 22:41:44', NULL),
(5, NULL, NULL, NULL, 'Admin', 'admin@quadque.tech', NULL, '$2y$10$NA3ueRAvoIc04OmEGqJcbuRAh6goBnlOZuujO2qU1ksNzaCkWzbuO', NULL, '1', 'no', NULL, '2021-09-07 01:00:02', '2021-09-07 01:00:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 4, 'Rajin', 'rajin', '123456789', 'dhaka', '2021-09-04 22:41:44', '2021-09-05 22:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_action_user_foreign` (`action_user`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_seos`
--
ALTER TABLE `product_seos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_seos_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD KEY `users_action_user_foreign` (`action_user`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_infos_user_id_foreign` (`user_id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_lists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_seos`
--
ALTER TABLE `product_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_action_user_foreign` FOREIGN KEY (`action_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_seos`
--
ALTER TABLE `product_seos`
  ADD CONSTRAINT `product_seos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_action_user_foreign` FOREIGN KEY (`action_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD CONSTRAINT `wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
