-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: zaker_dairy
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_one` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_two` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customers_user_id_foreign` (`user_id`),
  CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_08_19_000000_create_failed_jobs_table',1),(2,'2021_04_05_024855_create_roles_table',1),(3,'2021_04_05_025012_create_users_table',1),(4,'2021_04_05_025248_create_password_resets_table',1),(5,'2021_04_05_064104_create_product_categories_table',1),(6,'2021_04_05_103101_create_products_table',1),(7,'2021_04_05_103758_create_product_images_table',1),(8,'2021_04_05_103959_create_orders_table',1),(9,'2021_04_05_104019_create_order_details_table',1),(10,'2021_04_05_104925_create_customers_table',1),(11,'2021_04_06_102648_create_wish_lists_table',1),(12,'2021_08_22_051409_create_product_seos_table',1),(13,'2021_09_05_043351_create_user_infos_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `qty` double NOT NULL DEFAULT '0',
  `unit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_order_id_foreign` (`order_id`),
  KEY `order_details_product_id_foreign` (`product_id`),
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_user` bigint unsigned DEFAULT NULL,
  `shipping_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cart_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `total` double NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','delivered','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `tran_status` enum('pending','processing','failed','canceled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `currency` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BDT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_action_user_foreign` (`action_user`),
  CONSTRAINT `orders_action_user_foreign` FOREIGN KEY (`action_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'6124e6d74979d-ANC2','Sweets','sweets',NULL,NULL,'2021-08-24 06:32:23','2021-08-24 06:32:23'),(2,'6124e6dde7c98-yhWD','Bakery','bakery',NULL,NULL,'2021-08-24 06:32:29','2021-08-24 06:32:29');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filepath` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fileext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_foreign` (`product_id`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
INSERT INTO `product_images` VALUES (33,NULL,'testing-product-2_jqP2fXVJ.jpg',NULL,NULL,'2021-11-18 13:11:58','2021-11-18 13:11:58'),(45,45,'special-roshogolla_NREEFzPZ.jpg',NULL,NULL,'2021-11-18 14:56:15','2021-11-18 14:56:15');
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_seos`
--

DROP TABLE IF EXISTS `product_seos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_seos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_seos_product_id_foreign` (`product_id`),
  CONSTRAINT `product_seos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_seos`
--

LOCK TABLES `product_seos` WRITE;
/*!40000 ALTER TABLE `product_seos` DISABLE KEYS */;
INSERT INTO `product_seos` VALUES (26,45,NULL,NULL,NULL,'2021-11-18 14:56:15','2021-11-18 14:56:15'),(27,46,NULL,NULL,NULL,'2021-11-18 15:03:26','2021-11-18 15:03:26'),(28,47,NULL,NULL,NULL,'2021-11-18 15:04:39','2021-11-18 15:04:39'),(29,48,NULL,NULL,NULL,'2021-11-18 15:05:40','2021-11-18 15:05:40'),(30,49,NULL,NULL,NULL,'2021-11-18 15:07:14','2021-11-18 15:07:14'),(31,50,NULL,NULL,NULL,'2021-11-18 15:08:01','2021-11-18 15:08:01'),(32,51,NULL,NULL,NULL,'2021-11-18 15:09:03','2021-11-18 15:09:03'),(33,52,NULL,NULL,NULL,'2021-11-18 15:09:58','2021-11-18 15:09:58'),(34,53,NULL,NULL,NULL,'2021-11-18 15:11:29','2021-11-18 15:11:29'),(35,54,NULL,NULL,NULL,'2021-11-18 15:13:05','2021-11-18 15:13:05'),(36,55,NULL,NULL,NULL,'2021-11-18 15:14:03','2021-11-18 15:14:03'),(37,56,NULL,NULL,NULL,'2021-11-18 15:15:40','2021-11-18 15:15:40'),(38,57,NULL,NULL,NULL,'2021-11-18 15:16:32','2021-11-18 15:16:32'),(39,58,NULL,NULL,NULL,'2021-11-18 15:18:26','2021-11-18 15:18:26'),(40,59,NULL,NULL,NULL,'2021-11-18 15:19:10','2021-11-18 15:19:10'),(41,60,NULL,NULL,NULL,'2021-11-18 15:19:39','2021-11-18 15:19:39'),(42,61,NULL,NULL,NULL,'2021-11-18 15:21:47','2021-11-18 15:21:47'),(43,62,NULL,NULL,NULL,'2021-11-18 15:23:42','2021-11-18 15:23:42'),(44,63,NULL,NULL,NULL,'2021-11-18 15:24:29','2021-11-18 15:24:29'),(45,64,NULL,NULL,NULL,'2021-11-18 15:25:33','2021-11-18 15:25:33'),(46,65,NULL,NULL,NULL,'2021-11-18 15:26:19','2021-11-18 15:26:19'),(47,66,NULL,NULL,NULL,'2021-11-18 15:27:17','2021-11-18 15:27:17'),(48,67,NULL,NULL,NULL,'2021-11-18 15:27:50','2021-11-18 15:27:50'),(49,68,NULL,NULL,NULL,'2021-11-18 15:28:50','2021-11-18 15:28:50'),(50,69,NULL,NULL,NULL,'2021-11-18 15:29:23','2021-11-18 15:29:23'),(51,70,NULL,NULL,NULL,'2021-11-18 15:30:27','2021-11-18 15:30:27'),(52,71,NULL,NULL,NULL,'2021-11-18 15:41:05','2021-11-18 15:41:05'),(53,72,NULL,NULL,NULL,'2021-11-18 15:42:06','2021-11-18 15:42:06'),(54,73,NULL,NULL,NULL,'2021-11-18 15:43:10','2021-11-18 15:43:10'),(55,74,NULL,NULL,NULL,'2021-11-18 15:44:10','2021-11-18 15:44:10'),(56,75,NULL,NULL,NULL,'2021-11-18 15:46:13','2021-11-18 15:46:13'),(57,76,NULL,NULL,NULL,'2021-11-18 15:48:02','2021-11-18 15:48:02'),(58,77,NULL,NULL,NULL,'2021-11-18 15:48:36','2021-11-18 15:48:36'),(59,78,NULL,NULL,NULL,'2021-11-18 15:49:12','2021-11-18 15:49:12'),(60,79,NULL,NULL,NULL,'2021-11-18 15:49:47','2021-11-18 15:49:47'),(61,80,NULL,NULL,NULL,'2021-11-18 15:50:27','2021-11-18 15:50:27'),(62,81,NULL,NULL,NULL,'2021-11-18 15:51:20','2021-11-18 15:51:20'),(63,82,NULL,NULL,NULL,'2021-11-18 15:51:46','2021-11-18 15:51:46'),(64,83,NULL,NULL,NULL,'2021-11-18 15:52:29','2021-11-18 15:52:29'),(65,84,NULL,NULL,NULL,'2021-11-18 15:53:02','2021-11-18 15:53:02'),(66,85,NULL,NULL,NULL,'2021-11-18 15:53:47','2021-11-18 15:53:47'),(67,86,NULL,NULL,NULL,'2021-11-18 15:54:23','2021-11-18 15:54:23'),(68,87,NULL,NULL,NULL,'2021-11-18 15:54:51','2021-11-18 15:54:51'),(69,88,NULL,NULL,NULL,'2021-11-18 15:55:56','2021-11-18 15:55:56'),(70,89,NULL,NULL,NULL,'2021-11-18 16:03:26','2021-11-18 16:03:26'),(71,90,NULL,NULL,NULL,'2021-11-18 16:03:48','2021-11-18 16:03:48'),(72,91,NULL,NULL,NULL,'2021-11-18 16:04:16','2021-11-18 16:04:16'),(73,92,NULL,NULL,NULL,'2021-11-18 16:04:51','2021-11-18 16:04:51'),(74,93,NULL,NULL,NULL,'2021-11-18 16:05:13','2021-11-18 16:05:13'),(75,94,NULL,NULL,NULL,'2021-11-18 16:06:51','2021-11-18 16:06:51'),(76,95,NULL,NULL,NULL,'2021-11-18 16:07:44','2021-11-18 16:07:44'),(77,96,NULL,NULL,NULL,'2021-11-18 16:10:05','2021-11-18 16:10:05'),(78,97,NULL,NULL,NULL,'2021-11-18 16:11:14','2021-11-18 16:11:14'),(79,98,NULL,NULL,NULL,'2021-11-18 16:12:11','2021-11-18 16:12:11'),(80,99,NULL,NULL,NULL,'2021-11-18 16:13:04','2021-11-18 16:13:04'),(81,100,NULL,NULL,NULL,'2021-11-18 16:13:43','2021-11-18 16:13:43'),(82,101,NULL,NULL,NULL,'2021-11-18 16:14:06','2021-11-18 16:14:06'),(83,102,NULL,NULL,NULL,'2021-11-18 16:14:52','2021-11-18 16:14:52'),(84,103,NULL,NULL,NULL,'2021-11-18 16:17:08','2021-11-18 16:17:08'),(85,104,NULL,NULL,NULL,'2021-11-18 16:17:38','2021-11-18 16:17:38'),(86,105,NULL,NULL,NULL,'2021-11-18 16:18:03','2021-11-18 16:18:03'),(87,106,NULL,NULL,NULL,'2021-11-18 16:18:28','2021-11-18 16:18:28'),(88,107,NULL,NULL,NULL,'2021-11-18 16:18:56','2021-11-18 16:18:56'),(89,108,NULL,NULL,NULL,'2021-11-18 16:20:24','2021-11-18 16:20:24'),(90,109,NULL,NULL,NULL,'2021-11-18 16:20:50','2021-11-18 16:20:50'),(91,110,NULL,NULL,NULL,'2021-11-18 16:22:54','2021-11-18 16:22:54'),(92,111,NULL,NULL,NULL,'2021-11-18 16:23:23','2021-11-18 16:23:23'),(93,112,NULL,NULL,NULL,'2021-11-18 16:23:47','2021-11-18 16:23:47'),(94,113,NULL,NULL,NULL,'2021-11-18 16:24:57','2021-11-18 16:24:57'),(95,114,NULL,NULL,NULL,'2021-11-18 16:25:34','2021-11-18 16:25:34'),(96,115,NULL,NULL,NULL,'2021-11-18 16:26:25','2021-11-18 16:26:25');
/*!40000 ALTER TABLE `product_seos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `discount_type` enum('flat','percent') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_qty` int NOT NULL DEFAULT '1',
  `unit` enum('kg','gm','ltr','ml','pcs') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kg',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail_alt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `featured` tinyint(1) DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (45,'6196698eaaf0d_mfP5','Special Roshogolla','special-roshogolla',1,400,0,'flat',1,'kg','special-roshogolla.jpg',NULL,NULL,NULL,1,'2021-11-18 14:56:15','2021-11-18 14:56:15',NULL),(46,'61966b3defad6_uLnl','Roshogolla- 12 pieces','roshogolla-12-pieces',1,350,0,'flat',1,'kg','roshogolla-12-pieces.jpg',NULL,NULL,NULL,1,'2021-11-18 15:03:26','2021-11-18 15:03:26',NULL),(47,'61966b86d5a00_fWOX','Roshmalai','roshmalai',1,600,0,'flat',1,'kg','roshmalai.jpg',NULL,NULL,NULL,1,'2021-11-18 15:04:39','2021-11-18 15:04:39',NULL),(48,'61966bc42b6ae_OFxt','Malaichap','malaichap',1,600,0,'flat',1,'kg','malaichap.jpg',NULL,'<p>bhsdafb sadf</p><p>sdf</p><p>&nbsp;asd</p><p>f</p><p>asd</p>',NULL,1,'2021-11-18 15:05:40','2021-11-18 20:50:10',NULL),(49,'61966c21ddef7_xG13','Zafran Vog - 12 pieces','zafran-vog-12-pieces',1,650,0,'flat',1,'kg','zafran-vog-12-pieces.jpg',NULL,NULL,NULL,1,'2021-11-18 15:07:14','2021-11-18 15:07:14',NULL),(50,'61966c5107cff_bR0b','Malaishor','malaishor',1,750,0,'flat',1,'kg','malaishor.jpg',NULL,NULL,NULL,1,'2021-11-18 15:08:01','2021-11-18 15:08:01',NULL),(51,'61966c8eddb6f_uPTx','Malaipesti','malaipesti',1,850,0,'flat',1,'kg','malaipesti.jpg',NULL,NULL,NULL,1,'2021-11-18 15:09:03','2021-11-18 15:09:03',NULL),(52,'61966cc65eb83_IwN2','Iranivog','iranivog',1,850,0,'flat',1,'kg','iranivog.jpg',NULL,NULL,NULL,1,'2021-11-18 15:09:58','2021-11-18 15:09:58',NULL),(53,'61966d213beb9_jsYC','Special Kacha-chana','special-kacha-chana',1,650,0,'flat',1,'kg','special-kacha-chana.jpg',NULL,NULL,NULL,1,'2021-11-18 15:11:29','2021-11-18 15:11:29',NULL),(54,'61966d81c4c82_mlQb','Gurer Chanar Shondesh','gurer-chanar-shondesh',1,650,0,'flat',750,'kg','gurer-chanar-shondesh.jpg',NULL,NULL,NULL,1,'2021-11-18 15:13:05','2021-11-18 15:13:05',NULL),(55,'61966dbb2953a_oWIx','Kacha Golla','kacha-golla',1,700,0,'flat',1,'kg','kacha-golla.jpg',NULL,NULL,NULL,1,'2021-11-18 15:14:03','2021-11-18 15:14:03',NULL),(56,'61966e1c79f50_kwZJ','Special Shondesh(Tofee)','special-shondeshtofee',1,850,0,'flat',1,'kg','special-shondeshtofee.jpg',NULL,NULL,NULL,1,'2021-11-18 15:15:40','2021-11-18 15:15:40',NULL),(57,'61966e5038185_cBzz','Pyara Shondesh','pyara-shondesh',1,850,0,'flat',1,'kg','pyara-shondesh.jpg',NULL,NULL,NULL,1,'2021-11-18 15:16:32','2021-11-18 15:16:32',NULL),(58,'61966ec1e6679_M5Cm','Fatless Tok Doi','fatless-tok-doi',1,200,0,'flat',1,'kg','fatless-tok-doi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:18:26','2021-11-18 15:18:26',NULL),(59,'61966eee5b113_WO6v','Tok Doi','tok-doi',1,300,0,'flat',1,'kg','tok-doi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:19:10','2021-11-18 15:19:10',NULL),(60,'61966f0acdd54_qyW2','Misti Doi','misti-doi',1,350,0,'flat',1,'kg','misti-doi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:19:39','2021-11-18 15:19:39',NULL),(61,'61966f8b232f2_NT4K','Mattha','mattha',1,150,0,'flat',1,'ltr','mattha.jpg',NULL,NULL,NULL,1,'2021-11-18 15:21:47','2021-11-18 15:21:47',NULL),(62,'61966ffea1bf5_SIeh','Borhani','borhani',1,200,0,'flat',1,'ltr','borhani.jpg',NULL,NULL,NULL,1,'2021-11-18 15:23:42','2021-11-18 15:23:42',NULL),(63,'6196702cb3182_icfu','Kalojam','kalojam',1,350,0,'flat',1,'kg','kalojam.jpg',NULL,NULL,NULL,1,'2021-11-18 15:24:29','2021-11-18 15:24:29',NULL),(64,'6196706d426fc_c9LO','Lalmohon','lalmohon',1,350,0,'flat',1,'kg','lalmohon.jpg',NULL,NULL,NULL,1,'2021-11-18 15:25:33','2021-11-18 15:25:33',NULL),(65,'6196709ace0d9_DRPa','Rajvog','rajvog',1,350,0,'flat',1,'kg','rajvog.jpg',NULL,NULL,NULL,1,'2021-11-18 15:26:19','2021-11-18 15:26:19',NULL),(66,'619670d51fc4c_Jsnm','Shada Chamcham','shada-chamcham',1,450,0,'flat',1,'kg','shada-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:27:17','2021-11-18 15:27:17',NULL),(67,'619670f600027_4ZX4','Lal Chamcham','lal-chamcham',1,450,0,'flat',1,'kg','lal-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:27:50','2021-11-18 15:27:50',NULL),(68,'61967131d343f_B3e6','Shada-chana Balushahi','shada-chana-balushahi',1,450,0,'flat',1,'kg','shada-chana-balushahi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:28:50','2021-11-18 15:28:50',NULL),(69,'61967153981fa_2RMZ','Lal-chana Balushahi','lal-chana-balushahi',1,450,0,'flat',1,'kg','lal-chana-balushahi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:29:23','2021-11-18 15:29:23',NULL),(70,'6196719342011_k0es','Shada Khirmalai Chamcham','shada-khirmalai-chamcham',1,500,0,'flat',1,'kg','shada-khirmalai-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:30:27','2021-11-18 15:30:27',NULL),(71,'619674110956a_0WyS','Lal Khirmalai Chamcham','lal-khirmalai-chamcham',1,500,0,'flat',1,'kg','lal-khirmalai-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:41:05','2021-11-18 15:41:05',NULL),(72,'6196744e8ad5d_b9kh','Shada Khirmalai Balushahi','shada-khirmalai-balushahi',1,500,0,'flat',1,'kg','shada-khirmalai-balushahi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:42:06','2021-11-18 15:42:06',NULL),(73,'6196748e93364_WfsR','Lal Khirmalai Balushahi','lal-khirmalai-balushahi',1,500,0,'flat',1,'kg','lal-khirmalai-balushahi.jpg',NULL,NULL,NULL,1,'2021-11-18 15:43:10','2021-11-18 15:43:10',NULL),(74,'619674ca8a8cb_eRAF','Lal Anguri Sweets','lal-anguri-sweets',1,500,0,'flat',1,'kg','lal-anguri-sweets.jpg',NULL,NULL,NULL,1,'2021-11-18 15:44:10','2021-11-18 15:44:10',NULL),(75,'61967545a687f_i3Mu','Mini Shada Chamcham','mini-shada-chamcham',1,500,0,'flat',1,'kg','mini-shada-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:46:13','2021-11-18 15:46:13',NULL),(76,'619675b2aff5d_KmdB','Mini Lal Chamcham','mini-lal-chamcham',1,500,0,'flat',1,'kg','mini-lal-chamcham.jpg',NULL,NULL,NULL,1,'2021-11-18 15:48:02','2021-11-18 15:48:02',NULL),(77,'619675d3e3cec_6lHT','Jordar Guti','jordar-guti',1,500,0,'flat',1,'kg','jordar-guti.jpg',NULL,NULL,NULL,1,'2021-11-18 15:48:36','2021-11-18 15:48:36',NULL),(78,'619675f811cfa_kE7R','Mauwa','mauwa',1,1100,0,'flat',1,'kg','mauwa.jpg',NULL,NULL,NULL,1,'2021-11-18 15:49:12','2021-11-18 15:49:12',NULL),(79,'6196761b61461_ZOTe','Malai','malai',1,1400,0,'flat',1,'kg','malai.jpg',NULL,NULL,NULL,1,'2021-11-18 15:49:47','2021-11-18 15:49:47',NULL),(80,'6196764340894_WP4w','Ghee (Cow)','ghee-cow',1,1800,0,'flat',1,'kg','ghee-cow.jpg',NULL,NULL,NULL,1,'2021-11-18 15:50:27','2021-11-18 15:50:27',NULL),(81,'6196767838003_B3A7','Ghee (Buffalo)','ghee-buffalo',1,2000,0,'flat',1,'kg','ghee-buffalo.jpg',NULL,NULL,NULL,1,'2021-11-18 15:51:20','2021-11-18 15:51:20',NULL),(82,'6196769200760_060m','Butter','butter',1,1400,0,'flat',1,'kg','butter.jpg',NULL,NULL,NULL,1,'2021-11-18 15:51:46','2021-11-18 15:51:46',NULL),(83,'619676bcdbc04_zegS','Mihidana Laddu','mihidana-laddu',1,400,0,'flat',1,'kg','mihidana-laddu.jpg',NULL,NULL,NULL,1,'2021-11-18 15:52:29','2021-11-18 15:52:29',NULL),(84,'619676de477f8_YmYa','Bundia Laddu','bundia-laddu',1,400,0,'flat',1,'kg','bundia-laddu.jpg',NULL,NULL,NULL,1,'2021-11-18 15:53:02','2021-11-18 15:53:02',NULL),(85,'6196770b0dd4a_X548','Mauwa Laddu','mauwa-laddu',1,500,0,'flat',1,'kg','mauwa-laddu.jpg',NULL,NULL,NULL,1,'2021-11-18 15:53:47','2021-11-18 15:53:47',NULL),(86,'6196772fb3f4b_r920','Khirsha','khirsha',1,1100,0,'flat',1,'kg','khirsha.jpg',NULL,NULL,NULL,1,'2021-11-18 15:54:23','2021-11-18 15:54:23',NULL),(87,'6196774b36b17_pgek','Ponir Kacha','ponir-kacha',1,900,0,'flat',1,'kg','ponir-kacha.jpg',NULL,NULL,NULL,1,'2021-11-18 15:54:51','2021-11-18 15:54:51',NULL),(88,'6196778c86fd8_fiwX','Ilish Peti Shondesh','ilish-peti-shondesh',1,850,0,'flat',1,'kg','ilish-peti-shondesh.jpg',NULL,NULL,NULL,1,'2021-11-18 15:55:56','2021-11-18 15:55:56',NULL),(89,'6196794dee7d1_b8VE','Milk Nun','milk-nun',2,60,0,'flat',3,'pcs','milk-nun.jpg',NULL,NULL,NULL,1,'2021-11-18 16:03:26','2021-11-18 16:03:26',NULL),(90,'61967963e4a2d_jeEB','Milk Bun','milk-bun',2,60,0,'flat',4,'pcs','milk-bun.jpg',NULL,NULL,NULL,1,'2021-11-18 16:03:48','2021-11-18 16:03:48',NULL),(91,'6196797fcd848_FrYg','Milk Bread','milk-bread',2,60,0,'flat',1,'pcs','milk-bread.jpg',NULL,NULL,NULL,1,'2021-11-18 16:04:16','2021-11-18 16:04:16',NULL),(92,'619679a36113b_nc6c','Butter Bun','butter-bun',2,60,0,'flat',4,'pcs','butter-bun.jpg',NULL,NULL,NULL,1,'2021-11-18 16:04:51','2021-11-18 16:04:51',NULL),(93,'619679b99b25d_J5q9','Fruit Bun','fruit-bun',2,60,0,'flat',1,'pcs','fruit-bun.jpg',NULL,NULL,NULL,1,'2021-11-18 16:05:13','2021-11-18 16:05:13',NULL),(94,'61967a1b6d41e_N1Pi','Garlic Streak','garlic-streak',2,50,0,'flat',200,'gm','garlic-streak.jpg',NULL,NULL,NULL,1,'2021-11-18 16:06:51','2021-11-18 16:06:51',NULL),(95,'61967a5049af7_Enbt','Butter Toast','butter-toast',2,100,0,'flat',400,'gm','butter-toast.jpg',NULL,NULL,NULL,1,'2021-11-18 16:07:44','2021-11-18 16:07:44',NULL),(96,'61967adda93b4_DC2x','Rakro Toast','rakro-toast',2,100,0,'flat',400,'gm','rakro-toast.jpg',NULL,NULL,NULL,1,'2021-11-18 16:10:05','2021-11-18 16:10:05',NULL),(97,'61967b225b9ee_eUZo','Misti Toast','misti-toast',2,100,0,'flat',400,'gm','misti-toast.jpg',NULL,NULL,NULL,1,'2021-11-18 16:11:14','2021-11-18 16:11:14',NULL),(98,'61967b5b10ef6_5feE','Plain Cake','plain-cake',2,150,0,'flat',400,'gm','plain-cake.jpg',NULL,NULL,NULL,1,'2021-11-18 16:12:11','2021-11-18 16:12:11',NULL),(99,'61967b908bc06_aGw9','Fruit Cake','fruit-cake',2,170,0,'flat',400,'gm','fruit-cake.jpg',NULL,NULL,NULL,1,'2021-11-18 16:13:04','2021-11-18 16:13:04',NULL),(100,'61967bb74a26f_gBnn','Dhudh Kacha Biscuit','dhudh-kacha-biscuit',2,500,0,'flat',1,'kg','dhudh-kacha-biscuit.jpg',NULL,NULL,NULL,1,'2021-11-18 16:13:43','2021-11-18 16:13:43',NULL),(101,'61967bcddeaa3_obvi','Ponir Biscuit','ponir-biscuit',2,500,0,'flat',1,'kg','ponir-biscuit.jpg',NULL,NULL,NULL,1,'2021-11-18 16:14:06','2021-11-18 16:14:06',NULL),(102,'61967bfbe7e31_JxrY','Butter Bakherikhani','butter-bakherikhani',2,500,0,'flat',1,'kg','butter-bakherikhani.jpg',NULL,NULL,NULL,1,'2021-11-18 16:14:52','2021-11-18 16:14:52',NULL),(103,'61967c8488b9a_X1ya','Sandwich Biscuit','sandwich-biscuit',2,500,0,'flat',1,'kg','sandwich-biscuit.jpg',NULL,NULL,NULL,1,'2021-11-18 16:17:08','2021-11-18 16:17:08',NULL),(104,'61967ca1c7c73_MYDM','Butter Biscuit','butter-biscuit',2,700,0,'flat',1,'kg','butter-biscuit.jpg',NULL,NULL,NULL,1,'2021-11-18 16:17:38','2021-11-18 16:17:38',NULL),(105,'61967cbb4f950_4LfL','Switch Finger','switch-finger',2,400,0,'flat',1,'kg','switch-finger.jpg',NULL,NULL,NULL,1,'2021-11-18 16:18:03','2021-11-18 16:18:03',NULL),(106,'61967cd48c8ea_5xtb','Switch Pop','switch-pop',2,400,0,'flat',1,'kg','switch-pop.jpg',NULL,NULL,NULL,1,'2021-11-18 16:18:28','2021-11-18 16:18:28',NULL),(107,'61967cf0b1db9_HxAt','Dry Cake','dry-cake',2,400,0,'flat',1,'kg','dry-cake.jpg',NULL,NULL,NULL,1,'2021-11-18 16:18:56','2021-11-18 16:18:56',NULL),(108,'61967d47d90ec_Gt1L','Chash Modhu','chash-modhu',2,300,0,'flat',500,'gm','chash-modhu.jpg',NULL,NULL,NULL,1,'2021-11-18 16:20:24','2021-11-18 16:20:24',NULL),(109,'61967d622cf40_0Osy','Chak Modhu','chak-modhu',2,600,0,'flat',500,'gm','chak-modhu.jpg',NULL,NULL,NULL,1,'2021-11-18 16:20:50','2021-11-18 16:20:50',NULL),(110,'61967dde531a6_7NJb','Polao Chal','polao-chal',2,120,0,'flat',1,'kg','polao-chal.jpg',NULL,NULL,NULL,1,'2021-11-18 16:22:54','2021-11-18 16:22:54',NULL),(111,'61967dfb3d081_Owdq','Moshur Dal','moshur-dal',2,150,0,'flat',1,'kg','moshur-dal.jpg',NULL,NULL,NULL,1,'2021-11-18 16:23:23','2021-11-18 16:23:23',NULL),(112,'61967e1311fe3_8cXV','Mug Dal','mug-dal',2,150,0,'flat',1,'kg','mug-dal.jpg',NULL,NULL,NULL,1,'2021-11-18 16:23:47','2021-11-18 16:23:47',NULL),(113,'61967e58be06f_kpwm','Milk Finger Toast','milk-finger-toast',2,100,0,'flat',400,'gm','milk-finger-toast.jpg',NULL,NULL,NULL,1,'2021-11-18 16:24:57','2021-11-18 16:24:57',NULL),(114,'61967e7e11d36_LIhq','Ghee Toast','ghee-toast',2,100,0,'flat',400,'gm','ghee-toast.jpg',NULL,NULL,NULL,1,'2021-11-18 16:25:34','2021-11-18 16:25:34',NULL),(115,'61967eb0c9a77_HJ3p','Milk Food Cake','milk-food-cake',2,100,0,'flat',400,'gm','milk-food-cake.jpg',NULL,NULL,NULL,1,'2021-11-18 16:26:25','2021-11-18 16:26:25',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_infos`
--

DROP TABLE IF EXISTS `user_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_infos_user_id_foreign` (`user_id`),
  CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_infos`
--

LOCK TABLES `user_infos` WRITE;
/*!40000 ALTER TABLE `user_infos` DISABLE KEYS */;
INSERT INTO `user_infos` VALUES (1,4,'Rajin','rajin','123456789','dhaka','2021-09-04 22:41:44','2021-09-05 22:41:07'),(2,6,'Test','User 1','0178546655','Baker street 221b','2021-11-18 16:34:19','2021-11-18 16:36:17');
/*!40000 ALTER TABLE `user_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_user` bigint unsigned DEFAULT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_suspended` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_uuid_unique` (`uuid`),
  KEY `users_action_user_foreign` (`action_user`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_action_user_foreign` FOREIGN KEY (`action_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,NULL,NULL,NULL,'Rajin','rajin123@gmail.com',NULL,'$2y$10$hFffhFJTR76ux7cw5l75gODttQSj2MJvbZokERKxggZNvsPMZMGia',NULL,'0','no',NULL,'2021-09-04 22:41:44','2021-09-04 22:41:44',NULL),(5,NULL,NULL,NULL,'Admin','admin@quadque.tech',NULL,'$2y$10$NA3ueRAvoIc04OmEGqJcbuRAh6goBnlOZuujO2qU1ksNzaCkWzbuO',NULL,'1','no',NULL,'2021-09-07 01:00:02','2021-09-07 01:00:02',NULL),(6,NULL,NULL,NULL,'Test User 1','testuser1@gmail.com',NULL,'$2y$10$EcO/24LAJJ3aVjTyniLwyuuX4k1Klb8JOEzpFDZt1TaFoV7YfMmRi',NULL,'0','no',NULL,'2021-11-18 16:34:19','2021-11-18 16:34:19',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wish_lists`
--

DROP TABLE IF EXISTS `wish_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wish_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wish_lists_user_id_foreign` (`user_id`),
  CONSTRAINT `wish_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wish_lists`
--

LOCK TABLES `wish_lists` WRITE;
/*!40000 ALTER TABLE `wish_lists` DISABLE KEYS */;
/*!40000 ALTER TABLE `wish_lists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-21 13:12:09
