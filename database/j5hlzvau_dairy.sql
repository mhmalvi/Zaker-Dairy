-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2021 at 01:42 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `j5hlzvau_dairy`
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
  `address_two` text COLLATE utf8mb4_unicode_ci,
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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `shipping_details` text COLLATE utf8mb4_unicode_ci,
  `cart_details` text COLLATE utf8mb4_unicode_ci,
  `total` double NOT NULL DEFAULT '0',
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
  `qty` double NOT NULL DEFAULT '0',
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
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_type` enum('flat','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_qty` int(11) NOT NULL DEFAULT '1',
  `unit` enum('kg','gm','ltr','ml','pcs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kg',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `featured` tinyint(1) DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uuid`, `name`, `slug`, `category_id`, `price`, `discount`, `discount_type`, `unit_qty`, `unit`, `thumbnail`, `thumbnail_alt`, `description`, `featured`, `publish`, `created_at`, `updated_at`, `deleted_at`) VALUES
(45, '6196698eaaf0d_mfP5', 'Special Roshogolla', 'special-roshogolla', 1, 400, 0, 'flat', 1, 'kg', 'special-roshogolla.jpg', NULL, NULL, 1, 1, '2021-11-18 14:56:15', '2021-11-18 14:56:15', NULL),
(46, '61966b3defad6_uLnl', 'Roshogolla- 12 pieces', 'roshogolla-12-pieces', 1, 350, 0, 'flat', 1, 'kg', 'roshogolla-12-pieces.jpg', NULL, NULL, 1, 1, '2021-11-18 15:03:26', '2021-11-18 15:03:26', NULL),
(47, '61966b86d5a00_fWOX', 'Roshmalai', 'roshmalai', 1, 600, 0, 'flat', 1, 'kg', 'roshmalai.jpg', NULL, NULL, 1, 1, '2021-11-18 15:04:39', '2021-11-18 15:04:39', NULL),
(48, '61966bc42b6ae_OFxt', 'Malaichap', 'malaichap', 1, 600, 0, 'flat', 1, 'kg', 'malaichap.jpg', NULL, NULL, 1, 1, '2021-11-18 15:05:40', '2021-12-02 00:34:09', NULL),
(49, '61966c21ddef7_xG13', 'Zafran Vog - 12 pieces', 'zafran-vog-12-pieces', 1, 650, 0, 'flat', 1, 'kg', 'zafran-vog-12-pieces.jpg', NULL, NULL, 1, 1, '2021-11-18 15:07:14', '2021-11-18 15:07:14', NULL),
(50, '61966c5107cff_bR0b', 'Malaishor', 'malaishor', 1, 750, 0, 'flat', 1, 'kg', 'malaishor.jpg', NULL, NULL, 1, 1, '2021-11-18 15:08:01', '2021-11-18 15:08:01', NULL),
(51, '61966c8eddb6f_uPTx', 'Malaipesti', 'malaipesti', 1, 850, 0, 'flat', 1, 'kg', 'malaipesti.jpg', NULL, NULL, 1, 1, '2021-11-18 15:09:03', '2021-11-18 15:09:03', NULL),
(52, '61966cc65eb83_IwN2', 'Iranivog', 'iranivog', 1, 850, 0, 'flat', 1, 'kg', 'iranivog.jpg', NULL, NULL, 1, 1, '2021-11-18 15:09:58', '2021-11-18 15:09:58', NULL),
(53, '61966d213beb9_jsYC', 'Special Kacha-chana', 'special-kacha-chana', 1, 650, 0, 'flat', 1, 'kg', 'special-kacha-chana.jpg', NULL, NULL, 1, 1, '2021-11-18 15:11:29', '2021-11-18 15:11:29', NULL),
(54, '61966d81c4c82_mlQb', 'Gurer Chanar Shondesh', 'gurer-chanar-shondesh', 1, 650, 0, 'flat', 750, 'kg', 'gurer-chanar-shondesh.jpg', NULL, NULL, 1, 1, '2021-11-18 15:13:05', '2021-11-18 15:13:05', NULL),
(55, '61966dbb2953a_oWIx', 'Kacha Golla', 'kacha-golla', 1, 700, 0, 'flat', 1, 'kg', 'kacha-golla.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:14:03', '2021-11-18 15:14:03', NULL),
(56, '61966e1c79f50_kwZJ', 'Special Shondesh(Tofee)', 'special-shondeshtofee', 1, 850, 0, 'flat', 1, 'kg', 'special-shondeshtofee.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:15:40', '2021-11-18 15:15:40', NULL),
(57, '61966e5038185_cBzz', 'Pyara Shondesh', 'pyara-shondesh', 1, 850, 0, 'flat', 1, 'kg', 'pyara-shondesh.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:16:32', '2021-11-18 15:16:32', NULL),
(58, '61966ec1e6679_M5Cm', 'Fatless Tok Doi', 'fatless-tok-doi', 1, 200, 0, 'flat', 1, 'kg', 'fatless-tok-doi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:18:26', '2021-11-18 15:18:26', NULL),
(59, '61966eee5b113_WO6v', 'Tok Doi', 'tok-doi', 1, 300, 0, 'flat', 1, 'kg', 'tok-doi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:19:10', '2021-11-18 15:19:10', NULL),
(60, '61966f0acdd54_qyW2', 'Misti Doi', 'misti-doi', 1, 350, 0, 'flat', 1, 'kg', 'misti-doi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:19:39', '2021-11-18 15:19:39', NULL),
(61, '61966f8b232f2_NT4K', 'Mattha', 'mattha', 1, 150, 0, 'flat', 1, 'ltr', 'mattha.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:21:47', '2021-11-18 15:21:47', NULL),
(62, '61966ffea1bf5_SIeh', 'Borhani', 'borhani', 1, 200, 0, 'flat', 1, 'ltr', 'borhani.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:23:42', '2021-11-18 15:23:42', NULL),
(63, '6196702cb3182_icfu', 'Kalojam', 'kalojam', 1, 350, 0, 'flat', 1, 'kg', 'kalojam.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:24:29', '2021-11-18 15:24:29', NULL),
(64, '6196706d426fc_c9LO', 'Lalmohon', 'lalmohon', 1, 350, 0, 'flat', 1, 'kg', 'lalmohon.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:25:33', '2021-11-18 15:25:33', NULL),
(65, '6196709ace0d9_DRPa', 'Rajvog', 'rajvog', 1, 350, 0, 'flat', 1, 'kg', 'rajvog.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:26:19', '2021-11-18 15:26:19', NULL),
(66, '619670d51fc4c_Jsnm', 'Shada Chamcham', 'shada-chamcham', 1, 450, 0, 'flat', 1, 'kg', 'shada-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:27:17', '2021-11-18 15:27:17', NULL),
(67, '619670f600027_4ZX4', 'Lal Chamcham', 'lal-chamcham', 1, 450, 0, 'flat', 1, 'kg', 'lal-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:27:50', '2021-11-18 15:27:50', NULL),
(68, '61967131d343f_B3e6', 'Shada-chana Balushahi', 'shada-chana-balushahi', 1, 450, 0, 'flat', 1, 'kg', 'shada-chana-balushahi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:28:50', '2021-11-18 15:28:50', NULL),
(69, '61967153981fa_2RMZ', 'Lal-chana Balushahi', 'lal-chana-balushahi', 1, 450, 0, 'flat', 1, 'kg', 'lal-chana-balushahi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:29:23', '2021-11-18 15:29:23', NULL),
(70, '6196719342011_k0es', 'Shada Khirmalai Chamcham', 'shada-khirmalai-chamcham', 1, 500, 0, 'flat', 1, 'kg', 'shada-khirmalai-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:30:27', '2021-11-18 15:30:27', NULL),
(71, '619674110956a_0WyS', 'Lal Khirmalai Chamcham', 'lal-khirmalai-chamcham', 1, 500, 0, 'flat', 1, 'kg', 'lal-khirmalai-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:41:05', '2021-11-18 15:41:05', NULL),
(72, '6196744e8ad5d_b9kh', 'Shada Khirmalai Balushahi', 'shada-khirmalai-balushahi', 1, 500, 0, 'flat', 1, 'kg', 'shada-khirmalai-balushahi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:42:06', '2021-11-18 15:42:06', NULL),
(73, '6196748e93364_WfsR', 'Lal Khirmalai Balushahi', 'lal-khirmalai-balushahi', 1, 500, 0, 'flat', 1, 'kg', 'lal-khirmalai-balushahi.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:43:10', '2021-11-18 15:43:10', NULL),
(74, '619674ca8a8cb_eRAF', 'Lal Anguri Sweets', 'lal-anguri-sweets', 1, 500, 0, 'flat', 1, 'kg', 'lal-anguri-sweets.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:44:10', '2021-11-18 15:44:10', NULL),
(75, '61967545a687f_i3Mu', 'Mini Shada Chamcham', 'mini-shada-chamcham', 1, 500, 0, 'flat', 1, 'kg', 'mini-shada-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:46:13', '2021-11-18 15:46:13', NULL),
(76, '619675b2aff5d_KmdB', 'Mini Lal Chamcham', 'mini-lal-chamcham', 1, 500, 0, 'flat', 1, 'kg', 'mini-lal-chamcham.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:48:02', '2021-11-18 15:48:02', NULL),
(77, '619675d3e3cec_6lHT', 'Jordar Guti', 'jordar-guti', 1, 500, 0, 'flat', 1, 'kg', 'jordar-guti.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:48:36', '2021-11-18 15:48:36', NULL),
(78, '619675f811cfa_kE7R', 'Mauwa', 'mauwa', 1, 1100, 0, 'flat', 1, 'kg', 'mauwa.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:49:12', '2021-11-18 15:49:12', NULL),
(79, '6196761b61461_ZOTe', 'Malai', 'malai', 1, 1400, 0, 'flat', 1, 'kg', 'malai.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:49:47', '2021-11-18 15:49:47', NULL),
(80, '6196764340894_WP4w', 'Ghee (Cow)', 'ghee-cow', 1, 1800, 0, 'flat', 1, 'kg', 'ghee-cow.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:50:27', '2021-12-02 00:02:50', NULL),
(81, '6196767838003_B3A7', 'Ghee (Buffalo)', 'ghee-buffalo', 1, 2000, 0, 'flat', 1, 'kg', 'ghee-buffalo.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:51:20', '2021-11-18 15:51:20', NULL),
(82, '6196769200760_060m', 'Butter', 'butter', 1, 1400, 0, 'flat', 1, 'kg', 'butter.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:51:46', '2021-11-18 15:51:46', NULL),
(83, '619676bcdbc04_zegS', 'Mihidana Laddu', 'mihidana-laddu', 1, 400, 0, 'flat', 1, 'kg', 'mihidana-laddu.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:52:29', '2021-11-18 15:52:29', NULL),
(84, '619676de477f8_YmYa', 'Bundia Laddu', 'bundia-laddu', 1, 400, 0, 'flat', 1, 'kg', 'bundia-laddu.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:53:02', '2021-11-18 15:53:02', NULL),
(85, '6196770b0dd4a_X548', 'Mauwa Laddu', 'mauwa-laddu', 1, 500, 0, 'flat', 1, 'kg', 'mauwa-laddu.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:53:47', '2021-11-18 15:53:47', NULL),
(86, '6196772fb3f4b_r920', 'Khirsha', 'khirsha', 1, 1100, 0, 'flat', 1, 'kg', 'khirsha.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:54:23', '2021-11-18 15:54:23', NULL),
(87, '6196774b36b17_pgek', 'Ponir Kacha', 'ponir-kacha', 1, 900, 0, 'flat', 1, 'kg', 'ponir-kacha.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:54:51', '2021-11-18 15:54:51', NULL),
(88, '6196778c86fd8_fiwX', 'Ilish Peti Shondesh', 'ilish-peti-shondesh', 1, 850, 0, 'flat', 1, 'kg', 'ilish-peti-shondesh.jpg', NULL, NULL, NULL, 1, '2021-11-18 15:55:56', '2021-11-18 15:55:56', NULL),
(89, '6196794dee7d1_b8VE', 'Milk Nun', 'milk-nun', 2, 60, 0, 'flat', 3, 'pcs', 'milk-nun.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:03:26', '2021-11-18 16:03:26', NULL),
(90, '61967963e4a2d_jeEB', 'Milk Bun', 'milk-bun', 2, 60, 0, 'flat', 4, 'pcs', 'milk-bun.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:03:48', '2021-11-18 16:03:48', NULL),
(91, '6196797fcd848_FrYg', 'Milk Bread', 'milk-bread', 2, 60, 0, 'flat', 1, 'pcs', 'milk-bread.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:04:16', '2021-11-18 16:04:16', NULL),
(92, '619679a36113b_nc6c', 'Butter Bun', 'butter-bun', 2, 60, 0, 'flat', 4, 'pcs', 'butter-bun.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:04:51', '2021-11-18 16:04:51', NULL),
(93, '619679b99b25d_J5q9', 'Fruit Bun', 'fruit-bun', 2, 60, 0, 'flat', 1, 'pcs', 'fruit-bun.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:05:13', '2021-11-18 16:05:13', NULL),
(94, '61967a1b6d41e_N1Pi', 'Garlic Streak', 'garlic-streak', 2, 50, 0, 'flat', 200, 'gm', 'garlic-streak.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:06:51', '2021-11-18 16:06:51', NULL),
(95, '61967a5049af7_Enbt', 'Butter Toast', 'butter-toast', 2, 100, 0, 'flat', 400, 'gm', 'butter-toast.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:07:44', '2021-11-18 16:07:44', NULL),
(96, '61967adda93b4_DC2x', 'Rakro Toast', 'rakro-toast', 2, 100, 0, 'flat', 400, 'gm', 'rakro-toast.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:10:05', '2021-11-18 16:10:05', NULL),
(97, '61967b225b9ee_eUZo', 'Misti Toast', 'misti-toast', 2, 100, 0, 'flat', 400, 'gm', 'misti-toast.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:11:14', '2021-11-18 16:11:14', NULL),
(98, '61967b5b10ef6_5feE', 'Plain Cake', 'plain-cake', 2, 150, 0, 'flat', 400, 'gm', 'plain-cake.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:12:11', '2021-11-18 16:12:11', NULL),
(99, '61967b908bc06_aGw9', 'Fruit Cake', 'fruit-cake', 2, 170, 0, 'flat', 400, 'gm', 'fruit-cake.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:13:04', '2021-11-18 16:13:04', NULL),
(100, '61967bb74a26f_gBnn', 'Dhudh Kacha Biscuit', 'dhudh-kacha-biscuit', 2, 500, 0, 'flat', 1, 'kg', 'dhudh-kacha-biscuit.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:13:43', '2021-11-18 16:13:43', NULL),
(101, '61967bcddeaa3_obvi', 'Ponir Biscuit', 'ponir-biscuit', 2, 500, 0, 'flat', 1, 'kg', 'ponir-biscuit.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:14:06', '2021-11-18 16:14:06', NULL),
(102, '61967bfbe7e31_JxrY', 'Butter Bakherikhani', 'butter-bakherikhani', 2, 500, 0, 'flat', 1, 'kg', 'butter-bakherikhani.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:14:52', '2021-11-18 16:14:52', NULL),
(103, '61967c8488b9a_X1ya', 'Sandwich Biscuit', 'sandwich-biscuit', 2, 500, 0, 'flat', 1, 'kg', 'sandwich-biscuit.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:17:08', '2021-11-18 16:17:08', NULL),
(104, '61967ca1c7c73_MYDM', 'Butter Biscuit', 'butter-biscuit', 2, 700, 0, 'flat', 1, 'kg', 'butter-biscuit.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:17:38', '2021-11-18 16:17:38', NULL),
(105, '61967cbb4f950_4LfL', 'Switch Finger', 'switch-finger', 2, 400, 0, 'flat', 1, 'kg', 'switch-finger.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:18:03', '2021-11-18 16:18:03', NULL),
(106, '61967cd48c8ea_5xtb', 'Switch Pop', 'switch-pop', 2, 400, 0, 'flat', 1, 'kg', 'switch-pop.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:18:28', '2021-11-18 16:18:28', NULL),
(107, '61967cf0b1db9_HxAt', 'Dry Cake', 'dry-cake', 2, 400, 0, 'flat', 1, 'kg', 'dry-cake.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:18:56', '2021-11-18 16:18:56', NULL),
(108, '61967d47d90ec_Gt1L', 'Chash Modhu', 'chash-modhu', 2, 300, 0, 'flat', 500, 'gm', 'chash-modhu.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:20:24', '2021-11-18 16:20:24', NULL),
(109, '61967d622cf40_0Osy', 'Chak Modhu', 'chak-modhu', 2, 600, 0, 'flat', 500, 'gm', 'chak-modhu.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:20:50', '2021-11-18 16:20:50', NULL),
(110, '61967dde531a6_7NJb', 'Polao Chal', 'polao-chal', 2, 120, 0, 'flat', 1, 'kg', 'polao-chal.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:22:54', '2021-11-18 16:22:54', NULL),
(111, '61967dfb3d081_Owdq', 'Moshur Dal', 'moshur-dal', 2, 150, 0, 'flat', 1, 'kg', 'moshur-dal.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:23:23', '2021-11-18 16:23:23', NULL),
(112, '61967e1311fe3_8cXV', 'Mug Dal', 'mug-dal', 2, 150, 0, 'flat', 1, 'kg', 'mug-dal.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:23:47', '2021-11-18 16:23:47', NULL),
(113, '61967e58be06f_kpwm', 'Milk Finger Toast', 'milk-finger-toast', 2, 100, 0, 'flat', 400, 'gm', 'milk-finger-toast.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:24:57', '2021-11-18 16:24:57', NULL),
(114, '61967e7e11d36_LIhq', 'Ghee Toast', 'ghee-toast', 2, 100, 0, 'flat', 400, 'gm', 'ghee-toast.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:25:34', '2021-11-18 16:25:34', NULL),
(115, '61967eb0c9a77_HJ3p', 'Milk Food Cake', 'milk-food-cake', 2, 100, 0, 'flat', 400, 'gm', 'milk-food-cake.jpg', NULL, NULL, NULL, 1, '2021-11-18 16:26:25', '2021-11-18 16:26:25', NULL),
(116, '61a85f9ae67ac_d43a', 'test', 'test', 1, 12, 0, 'flat', 1, 'kg', 'test.jpg', NULL, NULL, NULL, 1, '2021-12-01 23:54:35', '2021-12-01 23:54:48', '2021-12-01 23:54:48'),
(117, '61a86809580d5_mXkt', 'Baby Sweets', 'baby-sweets', 1, 500, 0, 'flat', 1, 'kg', 'baby-sweets.jpg', NULL, NULL, NULL, 1, '2021-12-02 00:30:33', '2021-12-02 00:30:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
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
  `filepath` text COLLATE utf8mb4_unicode_ci,
  `fileext` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `filename`, `filepath`, `fileext`, `created_at`, `updated_at`) VALUES
(33, NULL, 'testing-product-2_jqP2fXVJ.jpg', NULL, NULL, '2021-11-18 13:11:58', '2021-11-18 13:11:58'),
(45, 45, 'special-roshogolla_NREEFzPZ.jpg', NULL, NULL, '2021-11-18 14:56:15', '2021-11-18 14:56:15'),
(46, 80, 'ghee-cow_Tb9sdmSh.jpg', NULL, NULL, '2021-12-01 23:55:56', '2021-12-01 23:55:56'),
(47, 80, 'ghee-cow_LAS7FWJi.jpg', NULL, NULL, '2021-12-01 23:55:56', '2021-12-01 23:55:56'),
(48, 81, 'ghee-buffalo_Tp8mYAkn.jpg', NULL, NULL, '2021-12-01 23:56:19', '2021-12-01 23:56:19'),
(49, 81, 'ghee-buffalo_AQy5HaZJ.jpg', NULL, NULL, '2021-12-01 23:56:19', '2021-12-01 23:56:19'),
(50, 114, 'ghee-toast_7o5nOuec.jpg', NULL, NULL, '2021-12-02 00:12:29', '2021-12-02 00:12:29'),
(51, 114, 'ghee-toast_EMSGyS6Q.jpg', NULL, NULL, '2021-12-02 00:12:29', '2021-12-02 00:12:29'),
(52, 60, 'misti-doi_I2VkahbR.jpg', NULL, NULL, '2021-12-02 00:16:56', '2021-12-02 00:16:56'),
(53, 60, 'misti-doi_RjsR8uRG.jpg', NULL, NULL, '2021-12-02 00:16:56', '2021-12-02 00:16:56'),
(54, 46, 'roshogolla-12-pieces_fOiDxkPp.jpg', NULL, NULL, '2021-12-02 00:19:11', '2021-12-02 00:19:11'),
(55, 46, 'roshogolla-12-pieces_Ibw84wqI.jpg', NULL, NULL, '2021-12-02 00:19:11', '2021-12-02 00:19:11'),
(56, 65, 'rajvog_1z0bP3AQ.jpg', NULL, NULL, '2021-12-02 00:20:00', '2021-12-02 00:20:00'),
(57, 65, 'rajvog_rA64FMTK.jpg', NULL, NULL, '2021-12-02 00:20:00', '2021-12-02 00:20:00'),
(58, 63, 'kalojam_H1V8myIG.jpg', NULL, NULL, '2021-12-02 00:21:18', '2021-12-02 00:21:18'),
(59, 63, 'kalojam_RuqWWjKB.jpg', NULL, NULL, '2021-12-02 00:21:18', '2021-12-02 00:21:18'),
(60, 64, 'lalmohon_nbZvVBXM.jpg', NULL, NULL, '2021-12-02 00:22:48', '2021-12-02 00:22:48'),
(61, 64, 'lalmohon_YgtFffUP.jpg', NULL, NULL, '2021-12-02 00:22:48', '2021-12-02 00:22:48'),
(62, 67, 'lal-chamcham_eLkb0hUF.jpg', NULL, NULL, '2021-12-02 00:23:54', '2021-12-02 00:23:54'),
(63, 67, 'lal-chamcham_PCDdtteu.jpg', NULL, NULL, '2021-12-02 00:23:54', '2021-12-02 00:23:54'),
(64, 68, 'shada-chana-balushahi_6n4iJNel.jpg', NULL, NULL, '2021-12-02 00:25:25', '2021-12-02 00:25:25'),
(65, 68, 'shada-chana-balushahi_NoGcnmJp.jpg', NULL, NULL, '2021-12-02 00:25:26', '2021-12-02 00:25:26'),
(66, 69, 'lal-chana-balushahi_a3EllE7f.jpg', NULL, NULL, '2021-12-02 00:25:59', '2021-12-02 00:25:59'),
(67, 69, 'lal-chana-balushahi_IK861vGk.jpg', NULL, NULL, '2021-12-02 00:25:59', '2021-12-02 00:25:59'),
(68, 117, 'baby-sweets_L3czYiWJ.jpg', NULL, NULL, '2021-12-02 00:30:33', '2021-12-02 00:30:33'),
(69, 117, 'baby-sweets_wq35FCcj.jpg', NULL, NULL, '2021-12-02 00:30:33', '2021-12-02 00:30:33'),
(70, 75, 'mini-shada-chamcham_g3Vcv1EB.jpg', NULL, NULL, '2021-12-02 00:32:08', '2021-12-02 00:32:08'),
(71, 75, 'mini-shada-chamcham_qf8usgFL.jpg', NULL, NULL, '2021-12-02 00:32:08', '2021-12-02 00:32:08'),
(72, 76, 'mini-lal-chamcham_7kAE38M0.jpg', NULL, NULL, '2021-12-02 00:32:31', '2021-12-02 00:32:31'),
(73, 76, 'mini-lal-chamcham_ZxCV9GRg.jpg', NULL, NULL, '2021-12-02 00:32:31', '2021-12-02 00:32:31'),
(74, 48, 'malaichap_T2MFQ70L.jpg', NULL, NULL, '2021-12-02 00:34:09', '2021-12-02 00:34:09'),
(75, 48, 'malaichap_VDKQYIGf.jpg', NULL, NULL, '2021-12-02 00:34:09', '2021-12-02 00:34:09'),
(76, 49, 'zafran-vog-12-pieces_aOk6zVmx.jpg', NULL, NULL, '2021-12-02 00:35:16', '2021-12-02 00:35:16'),
(77, 49, 'zafran-vog-12-pieces_qJYuPIX7.jpg', NULL, NULL, '2021-12-02 00:35:16', '2021-12-02 00:35:16'),
(78, 50, 'malaishor_pseOosuH.jpg', NULL, NULL, '2021-12-02 00:36:36', '2021-12-02 00:36:36'),
(79, 50, 'malaishor_cefKuUME.jpg', NULL, NULL, '2021-12-02 00:36:36', '2021-12-02 00:36:36'),
(80, 53, 'special-kacha-chana_82HHdaRO.jpg', NULL, NULL, '2021-12-02 00:37:17', '2021-12-02 00:37:17'),
(81, 53, 'special-kacha-chana_iqO8gUIZ.jpg', NULL, NULL, '2021-12-02 00:37:17', '2021-12-02 00:37:17'),
(82, 56, 'special-shondeshtofee_e46s3lmQ.jpg', NULL, NULL, '2021-12-02 00:38:48', '2021-12-02 00:38:48'),
(83, 56, 'special-shondeshtofee_v6gghYIg.jpg', NULL, NULL, '2021-12-02 00:38:48', '2021-12-02 00:38:48'),
(84, 57, 'pyara-shondesh_bwEGVXCJ.jpg', NULL, NULL, '2021-12-02 00:40:08', '2021-12-02 00:40:08'),
(85, 57, 'pyara-shondesh_YeEtcIZK.jpg', NULL, NULL, '2021-12-02 00:40:08', '2021-12-02 00:40:08'),
(86, 88, 'ilish-peti-shondesh_3tSQMPtU.jpg', NULL, NULL, '2021-12-02 00:40:37', '2021-12-02 00:40:37'),
(87, 88, 'ilish-peti-shondesh_GeuFFzXG.jpg', NULL, NULL, '2021-12-02 00:40:37', '2021-12-02 00:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `product_seos`
--

CREATE TABLE `product_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_seos`
--

INSERT INTO `product_seos` (`id`, `product_id`, `keywords`, `tags`, `descriptions`, `created_at`, `updated_at`) VALUES
(26, 45, NULL, NULL, NULL, '2021-11-18 14:56:15', '2021-11-18 14:56:15'),
(27, 46, NULL, NULL, NULL, '2021-11-18 15:03:26', '2021-11-18 15:03:26'),
(28, 47, NULL, NULL, NULL, '2021-11-18 15:04:39', '2021-11-18 15:04:39'),
(29, 48, NULL, NULL, NULL, '2021-11-18 15:05:40', '2021-11-18 15:05:40'),
(30, 49, NULL, NULL, NULL, '2021-11-18 15:07:14', '2021-11-18 15:07:14'),
(31, 50, NULL, NULL, NULL, '2021-11-18 15:08:01', '2021-11-18 15:08:01'),
(32, 51, NULL, NULL, NULL, '2021-11-18 15:09:03', '2021-11-18 15:09:03'),
(33, 52, NULL, NULL, NULL, '2021-11-18 15:09:58', '2021-11-18 15:09:58'),
(34, 53, NULL, NULL, NULL, '2021-11-18 15:11:29', '2021-11-18 15:11:29'),
(35, 54, NULL, NULL, NULL, '2021-11-18 15:13:05', '2021-11-18 15:13:05'),
(36, 55, NULL, NULL, NULL, '2021-11-18 15:14:03', '2021-11-18 15:14:03'),
(37, 56, NULL, NULL, NULL, '2021-11-18 15:15:40', '2021-11-18 15:15:40'),
(38, 57, NULL, NULL, NULL, '2021-11-18 15:16:32', '2021-11-18 15:16:32'),
(39, 58, NULL, NULL, NULL, '2021-11-18 15:18:26', '2021-11-18 15:18:26'),
(40, 59, NULL, NULL, NULL, '2021-11-18 15:19:10', '2021-11-18 15:19:10'),
(41, 60, NULL, NULL, NULL, '2021-11-18 15:19:39', '2021-11-18 15:19:39'),
(42, 61, NULL, NULL, NULL, '2021-11-18 15:21:47', '2021-11-18 15:21:47'),
(43, 62, NULL, NULL, NULL, '2021-11-18 15:23:42', '2021-11-18 15:23:42'),
(44, 63, NULL, NULL, NULL, '2021-11-18 15:24:29', '2021-11-18 15:24:29'),
(45, 64, NULL, NULL, NULL, '2021-11-18 15:25:33', '2021-11-18 15:25:33'),
(46, 65, NULL, NULL, NULL, '2021-11-18 15:26:19', '2021-11-18 15:26:19'),
(47, 66, NULL, NULL, NULL, '2021-11-18 15:27:17', '2021-11-18 15:27:17'),
(48, 67, NULL, NULL, NULL, '2021-11-18 15:27:50', '2021-11-18 15:27:50'),
(49, 68, NULL, NULL, NULL, '2021-11-18 15:28:50', '2021-11-18 15:28:50'),
(50, 69, NULL, NULL, NULL, '2021-11-18 15:29:23', '2021-11-18 15:29:23'),
(51, 70, NULL, NULL, NULL, '2021-11-18 15:30:27', '2021-11-18 15:30:27'),
(52, 71, NULL, NULL, NULL, '2021-11-18 15:41:05', '2021-11-18 15:41:05'),
(53, 72, NULL, NULL, NULL, '2021-11-18 15:42:06', '2021-11-18 15:42:06'),
(54, 73, NULL, NULL, NULL, '2021-11-18 15:43:10', '2021-11-18 15:43:10'),
(55, 74, NULL, NULL, NULL, '2021-11-18 15:44:10', '2021-11-18 15:44:10'),
(56, 75, NULL, NULL, NULL, '2021-11-18 15:46:13', '2021-11-18 15:46:13'),
(57, 76, NULL, NULL, NULL, '2021-11-18 15:48:02', '2021-11-18 15:48:02'),
(58, 77, NULL, NULL, NULL, '2021-11-18 15:48:36', '2021-11-18 15:48:36'),
(59, 78, NULL, NULL, NULL, '2021-11-18 15:49:12', '2021-11-18 15:49:12'),
(60, 79, NULL, NULL, NULL, '2021-11-18 15:49:47', '2021-11-18 15:49:47'),
(61, 80, NULL, NULL, NULL, '2021-11-18 15:50:27', '2021-11-18 15:50:27'),
(62, 81, NULL, NULL, NULL, '2021-11-18 15:51:20', '2021-11-18 15:51:20'),
(63, 82, NULL, NULL, NULL, '2021-11-18 15:51:46', '2021-11-18 15:51:46'),
(64, 83, NULL, NULL, NULL, '2021-11-18 15:52:29', '2021-11-18 15:52:29'),
(65, 84, NULL, NULL, NULL, '2021-11-18 15:53:02', '2021-11-18 15:53:02'),
(66, 85, NULL, NULL, NULL, '2021-11-18 15:53:47', '2021-11-18 15:53:47'),
(67, 86, NULL, NULL, NULL, '2021-11-18 15:54:23', '2021-11-18 15:54:23'),
(68, 87, NULL, NULL, NULL, '2021-11-18 15:54:51', '2021-11-18 15:54:51'),
(69, 88, NULL, NULL, NULL, '2021-11-18 15:55:56', '2021-11-18 15:55:56'),
(70, 89, NULL, NULL, NULL, '2021-11-18 16:03:26', '2021-11-18 16:03:26'),
(71, 90, NULL, NULL, NULL, '2021-11-18 16:03:48', '2021-11-18 16:03:48'),
(72, 91, NULL, NULL, NULL, '2021-11-18 16:04:16', '2021-11-18 16:04:16'),
(73, 92, NULL, NULL, NULL, '2021-11-18 16:04:51', '2021-11-18 16:04:51'),
(74, 93, NULL, NULL, NULL, '2021-11-18 16:05:13', '2021-11-18 16:05:13'),
(75, 94, NULL, NULL, NULL, '2021-11-18 16:06:51', '2021-11-18 16:06:51'),
(76, 95, NULL, NULL, NULL, '2021-11-18 16:07:44', '2021-11-18 16:07:44'),
(77, 96, NULL, NULL, NULL, '2021-11-18 16:10:05', '2021-11-18 16:10:05'),
(78, 97, NULL, NULL, NULL, '2021-11-18 16:11:14', '2021-11-18 16:11:14'),
(79, 98, NULL, NULL, NULL, '2021-11-18 16:12:11', '2021-11-18 16:12:11'),
(80, 99, NULL, NULL, NULL, '2021-11-18 16:13:04', '2021-11-18 16:13:04'),
(81, 100, NULL, NULL, NULL, '2021-11-18 16:13:43', '2021-11-18 16:13:43'),
(82, 101, NULL, NULL, NULL, '2021-11-18 16:14:06', '2021-11-18 16:14:06'),
(83, 102, NULL, NULL, NULL, '2021-11-18 16:14:52', '2021-11-18 16:14:52'),
(84, 103, NULL, NULL, NULL, '2021-11-18 16:17:08', '2021-11-18 16:17:08'),
(85, 104, NULL, NULL, NULL, '2021-11-18 16:17:38', '2021-11-18 16:17:38'),
(86, 105, NULL, NULL, NULL, '2021-11-18 16:18:03', '2021-11-18 16:18:03'),
(87, 106, NULL, NULL, NULL, '2021-11-18 16:18:28', '2021-11-18 16:18:28'),
(88, 107, NULL, NULL, NULL, '2021-11-18 16:18:56', '2021-11-18 16:18:56'),
(89, 108, NULL, NULL, NULL, '2021-11-18 16:20:24', '2021-11-18 16:20:24'),
(90, 109, NULL, NULL, NULL, '2021-11-18 16:20:50', '2021-11-18 16:20:50'),
(91, 110, NULL, NULL, NULL, '2021-11-18 16:22:54', '2021-11-18 16:22:54'),
(92, 111, NULL, NULL, NULL, '2021-11-18 16:23:23', '2021-11-18 16:23:23'),
(93, 112, NULL, NULL, NULL, '2021-11-18 16:23:47', '2021-11-18 16:23:47'),
(94, 113, NULL, NULL, NULL, '2021-11-18 16:24:57', '2021-11-18 16:24:57'),
(95, 114, NULL, NULL, NULL, '2021-11-18 16:25:34', '2021-11-18 16:25:34'),
(96, 115, NULL, NULL, NULL, '2021-11-18 16:26:25', '2021-11-18 16:26:25'),
(97, 116, NULL, NULL, NULL, '2021-12-01 23:54:35', '2021-12-01 23:54:35'),
(98, 117, NULL, NULL, NULL, '2021-12-02 00:30:33', '2021-12-02 00:30:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(5, NULL, NULL, NULL, 'Admin', 'admin@quadque.tech', NULL, '$2y$10$NA3ueRAvoIc04OmEGqJcbuRAh6goBnlOZuujO2qU1ksNzaCkWzbuO', NULL, '1', 'no', NULL, '2021-09-07 01:00:02', '2021-09-07 01:00:02', NULL),
(6, NULL, NULL, NULL, 'Test User 1', 'testuser1@gmail.com', NULL, '$2y$10$EcO/24LAJJ3aVjTyniLwyuuX4k1Klb8JOEzpFDZt1TaFoV7YfMmRi', NULL, '0', 'no', NULL, '2021-11-18 16:34:19', '2021-11-18 16:34:19', NULL),
(7, NULL, NULL, NULL, 'test user', 'test@gmail.com', NULL, '$2y$10$RjgajgnHzLRe5mq4IyhYwO/a0lcbUplkpBF3JzTZGXhg9fUPLotSW', NULL, '0', 'no', NULL, '2021-12-28 13:29:12', '2021-12-28 13:29:12', NULL);

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
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `first_name`, `last_name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 4, 'Rajin', 'rajin', '123456789', 'dhaka', '2021-09-04 22:41:44', '2021-09-05 22:41:07'),
(2, 6, 'Test', 'User 1', '0178546655', 'Baker street 221b', '2021-11-18 16:34:19', '2021-11-18 16:36:17');

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
  ADD KEY `password_resets_email_index` (`email`(191));

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `product_seos`
--
ALTER TABLE `product_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
