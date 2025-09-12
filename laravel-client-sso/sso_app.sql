-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table sso_app.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.cache: ~0 rows (approximately)

-- Dumping structure for table sso_app.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.cache_locks: ~0 rows (approximately)

-- Dumping structure for table sso_app.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table sso_app.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.jobs: ~0 rows (approximately)

-- Dumping structure for table sso_app.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.job_batches: ~0 rows (approximately)

-- Dumping structure for table sso_app.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.migrations: ~3 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(4, '0001_01_01_000000_create_users_table', 1),
	(5, '0001_01_01_000001_create_cache_table', 1),
	(6, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table sso_app.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table sso_app.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.sessions: ~14 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('571XuwG3igburWsj1Q9Y8cwiTP0aMfPWzapxXHzr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieEIyRVBIMG1JMENFMGhsSEVOZ1NwdTlkRTNGQ0MxZVJJNkZSajhONyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEzOiJnaXJpb25lX3N0YXRlIjtzOjE2OiJZWWo5amNGWk5NdXVpeHlhIjtzOjEzOiJnaXJpb25lX25vbmNlIjtzOjE2OiI0YnQwbGNVb3poUlZJZ1BZIjt9', 1755571463),
	('5ltWDArKMjxRldjccaLbjF0ED576IjF0uirvkKOS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWpjQTF5NnhFaTgybzVVM21vN3FwazNIUUd0TGtIU0gzTG53NDZwUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9kYXNoYm9hcmQiO319', 1755227199),
	('AX2EBWE0A3C9TMJJnl5muWj9FNRGwCJYL9b9GtRo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSnpSaTZ6VlVTRzg5emtEZGZjVXRsMkhrdm5EMWVIRWRocnZIYnlXeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEyOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvYXV0aC9naXJpb25lL2NhbGxiYWNrP2NvZGU9V3RSTUo1YUQ2SEV0WHpHVjE4TEdGUmxUcEhCaUZaWE5uQW00U0xJRyZzdGF0ZT1FZXoxWVhyZWxNbDlmdUh4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755573755),
	('BEadbohHIfCtO7qT4DVeU3J80CQ8UFnb48EvrTOE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOU8xeEFhemdXdDgxWUtmdDVnRUxud0JiSnRTbVlaWW1ic3dUb2R6MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvZGFzaGJvYXJkIjt9czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoicVd1NUVCb2pUSkthRTRRUyI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoia2M2VTdycGg1MDcwT0l0RSI7fQ==', 1755583749),
	('Eik1WOOztt6XMlCiPznDgs0VAqvnUcdvzOsFfFgH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlp5QkF1SVZOanVwT1hrcTUwUkdtWWlPcE9lM2c2Q0U1ZDFycFZmaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEyOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvYXV0aC9naXJpb25lL2NhbGxiYWNrP2NvZGU9UGtSVk81RzJXVkxXRUxNd3R2YzNGYmlYbnJRYmFtbFF4QUNraDc0MSZzdGF0ZT1WQnQ2VXVoOTI1TWpyZVM4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1755573647),
	('EoamFhxiujtdGxCBZU0g8YrGnP1XgzMzFPWCdJjq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib1pQdEVpRjY2Y2lPQ0VVY0xUUjZzVFBMOXg1d3ZSbjVvamJWOHB6UiI7czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoidTdyZ0pzT2Vxd0ZBMEJVViI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiQVA2YWZlMHBaUmxMbG5qVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755579474),
	('eTgJ8THFjA8XuwRPdp4fKLV2E3DVBoNFFOHCNuga', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia05UbHVNZjJhQWhVdUk2ZE44QzJFSWVuUUg1dmZYcVRMcE16ZVBaUCI7czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiSWNmVU15QkhQaFA2cVhJNSI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiV0trSDVYbHNQcHNzZ3BrTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755571073),
	('FaRlR0oG22kC8UETYNGgMeuJfENwTQiATWKa2FmG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2NtUG9QZkZETWFzQjFMbFh0cU02S0tydXRBOGhTR3hqMkV0YmlyWSI7czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiRmlGbVhmTExXdUo0MnE3cCI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiMzlaSTJCTENaaExLcm1ZRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755584983),
	('IfoChbLvgVL6YCSls8So72f3mPM6LEBOdyRINliD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNTB1bDVzYmNQVm1sVWJiZlRVSFFtbWtXeGx6eXo4WVpWZklHS3FyZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjEzOiJnaXJpb25lX3N0YXRlIjtzOjE2OiIybG91czkzdlRpUjRhZnFIIjtzOjEzOiJnaXJpb25lX25vbmNlIjtzOjE2OiJYcGxkNDhHUE1LZVNrZ3pkIjt9', 1755571688),
	('nIAbHKXHhnaC3VLmgAewlsXVH475N32T41tlITtb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNWtvQWY1Y0lybDJEUFhPQVVjTUJNRE55YUZkdDZJUVpIMDJjV0JQQiI7czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiRWV6MVlYcmVsTWw5ZnVIeCI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiZ0hBdWtudGZjRkdwVFZ2RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755573703),
	('RN4IWfQrBeuqK83SIeY2TP2J4ZoG6yesFcOrPwiJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWm1oOGg3YXVJTVRsS3RTcUdCc2c1ZWxtRzFtNE42Mk9ZMU1YalZDZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvZGFzaGJvYXJkIjt9czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiUDN2TW9YM3cyV0lwNGhKSyI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiWXZlU2VjTzAyNFNJY2VMdyI7fQ==', 1755578978),
	('sivE8lnpwWuOaStN6LXpCPeTO9F8a2yUWodlT5EH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiclptMzFnaWRBdllFSEJUQVpLVFVVS3VMbkg0aHlsTldISGdvbTEyRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvZGFzaGJvYXJkIjt9czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiRVZKVWNTeEM3T0RsRVFwNiI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoibVN4enNWWngyWHVGWllIRSI7fQ==', 1755571005),
	('sRV39DSP2vo6KzqWdpGX9MzmLpSRVWh2SBr0vZbL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOE5pdG4xdHVtMHJtbWdxU2Z1SG9MbHc4QjNIVVR3bzhNODEzWnZuZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IkJlYVlhVGVMRUdveGx6cjRYaGt4Mm5GMDBURmZCWk8xZk01RjE2U0giO30=', 1755227385),
	('TfbdMLbSfYj3PzkolOGxDQsxAAWA4gDjFwxAwJKh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmJlMjk4Y0tkWDZ0Vjc0aDFwaDhPWlhLN1Z2WHIyaXVHeWlkTkZzQiI7czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiZHVkdWVmUTE5aXgxSXV6eiI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiR0U4R3hPWFdZdkJXd0R4MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1755571473),
	('XpmeFPrbl8XkMb3P7XMjBxVKgaX1tAPOWR676kf8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVnNGUG9wR3RQUXphUGZIU3Zhd2o3emxtSERrbXRoalBJWmlDRnFTNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6OTAwMC9hdXRoL2dpcmlvbmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjkwMDAvZGFzaGJvYXJkIjt9czoxMzoiZ2lyaW9uZV9zdGF0ZSI7czoxNjoiVkJ0NlV1aDkyNU1qcmVTOCI7czoxMzoiZ2lyaW9uZV9ub25jZSI7czoxNjoiSDh2TU1YZUdZTDBuMUdZaiI7fQ==', 1755573525);

-- Dumping structure for table sso_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sso_app.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2025-08-06 00:40:43', '$2y$12$zpXrspLEejdTFKEir7OLreR6IvYeMI6JMzs/Ao8XkBbEPnX9ohJ7O', NULL, NULL, NULL, 'xg5A9lw1xL', '2025-08-06 00:40:43', '2025-08-06 00:40:43'),
	(2, 'Wahyu Nur Cahyo', 'SA7EHBhjZV@example.com', NULL, '$2y$12$Dx.ad1kUAcQgsLLfoW.BoO.2lOEIDTz78gfYkARJk3sUhDnIUp/rO', 'github', '116796627', 'https://avatars.githubusercontent.com/u/116796627?v=4', NULL, '2025-08-06 01:12:38', '2025-08-06 01:12:38'),
	(3, 'Wahyu Nur Cahyo', 'quPEko7jpa@example.com', NULL, '$2y$12$xVdsGIbHdThkEWPDIezVfONuBCP2EUpwCUQ8r7W8mEASHsE4E.FKi', 'github', '116796627', 'https://avatars.githubusercontent.com/u/116796627?v=4', NULL, '2025-08-06 01:13:33', '2025-08-06 01:13:33'),
	(4, 'Wahyu Cahyo', 'whyyy241200@gmail.com', NULL, '$2y$12$hEoe8mXdrIaOyvWXJMOeiez07gcB3DAiFn9xCpDR.ZYNokTM69QMe', 'google', '116616858759760887443', 'https://lh3.googleusercontent.com/a/ACg8ocI4gta2V4SY45zvEz1-bdPLCWS8wadpxpE3oLQItqXsjzoaHg=s96-c', NULL, '2025-08-06 01:33:46', '2025-08-06 01:33:46');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
