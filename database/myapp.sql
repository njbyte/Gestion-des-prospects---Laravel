-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 juil. 2024 à 08:34
-- Version du serveur : 8.3.0
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject_id` bigint UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `causer_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `from` json DEFAULT NULL,
  `to` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `from`, `to`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(78, '1', 'Prospect Update', 'App\\Models\\Pros', NULL, 36, 'App\\Models\\User', 3, '{\"to\": 1, \"from\": 0}', NULL, NULL, NULL, '2024-07-09 08:47:51', '2024-07-09 08:47:51'),
(79, '1', 'Prospect Update', 'App\\Models\\Pros', NULL, 32, 'App\\Models\\User', 3, '{\"to\": 1, \"from\": 0}', NULL, NULL, NULL, '2024-07-09 08:48:10', '2024-07-09 08:48:10'),
(80, '0', 'User Update', 'App\\Models\\User', NULL, 3, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"qualif@qualif.com\"}, \"old\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"zakaria@qualif.com\"}}', NULL, NULL, NULL, '2024-07-13 08:35:07', '2024-07-13 08:35:07'),
(77, '0', 'User Update', 'App\\Models\\User', NULL, 3, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"zakaria@qualif.com\"}, \"old\": {\"name\": \"NAJMI Saifeddine\", \"role\": 2, \"email\": \"zakaria@qualif.com\"}}', NULL, NULL, NULL, '2024-07-09 08:46:35', '2024-07-09 08:46:35'),
(76, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 42, 'App\\Models\\User', 2, '{\"to\": 3, \"from\": 1}', NULL, NULL, NULL, '2024-07-09 08:45:52', '2024-07-09 08:45:52'),
(75, '0', 'User Update', 'App\\Models\\User', NULL, 3, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"NAJMI Saifeddine\", \"role\": 2, \"email\": \"zakaria@qualif.com\"}, \"old\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"qualif@qualif.com\"}}', NULL, NULL, NULL, '2024-07-09 08:38:54', '2024-07-09 08:38:54'),
(74, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 44, 'App\\Models\\User', 1, '{\"to\": 3, \"from\": 1}', NULL, NULL, NULL, '2024-07-09 08:38:21', '2024-07-09 08:38:21'),
(73, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 42, 'App\\Models\\User', 1, '{\"to\": 1, \"from\": 4}', NULL, NULL, NULL, '2024-07-08 10:02:52', '2024-07-08 10:02:52'),
(54, 'default', 'Prospect Update', 'App\\Models\\Pros', NULL, 1, 'App\\Models\\User', 1, '{\"to\": 2, \"from\": 1}', NULL, NULL, NULL, '2024-07-07 10:34:06', '2024-07-07 10:34:06'),
(55, 'default', 'User Update', 'App\\Models\\User', NULL, 3, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"NAJMI Saifeddine\", \"role\": 2, \"email\": \"qualif@qualif.com\"}, \"old\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"qualif@qualif.com\"}}', NULL, NULL, NULL, '2024-07-07 10:34:14', '2024-07-07 10:34:14'),
(56, 'default', 'Prospect Update', 'App\\Models\\Pros', NULL, 2, 'App\\Models\\User', 1, '{\"to\": 0, \"from\": 2}', NULL, NULL, NULL, '2024-07-07 10:43:46', '2024-07-07 10:43:46'),
(57, 'default', 'User Update', 'App\\Models\\User', NULL, 3, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"NAJMI Saifeddine\", \"role\": 1, \"email\": \"qualif@qualif.com\"}, \"old\": {\"name\": \"NAJMI Saifeddine\", \"role\": 2, \"email\": \"qualif@qualif.com\"}}', NULL, NULL, NULL, '2024-07-07 10:53:08', '2024-07-07 10:53:08'),
(58, 'default', 'Prospect Update', 'App\\Models\\Pros', NULL, 2, 'App\\Models\\User', 1, '{\"to\": 3, \"from\": 0, \"log_name\": 0}', NULL, NULL, NULL, '2024-07-07 10:59:29', '2024-07-07 10:59:29'),
(59, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 1, 'App\\Models\\User', 1, '{\"to\": 0, \"from\": 0}', NULL, NULL, NULL, '2024-07-07 11:02:27', '2024-07-07 11:02:27'),
(60, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 3, 'App\\Models\\User', 2, '{\"to\": 4, \"from\": 4}', NULL, NULL, NULL, '2024-07-07 11:08:00', '2024-07-07 11:08:00'),
(61, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 1, 'App\\Models\\User', 1, '{\"to\": 1, \"from\": 0}', NULL, NULL, NULL, '2024-07-07 11:09:13', '2024-07-07 11:09:13'),
(62, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 1, 'App\\Models\\User', 2, '{\"to\": 3, \"from\": 1}', NULL, NULL, NULL, '2024-07-07 11:09:39', '2024-07-07 11:09:39'),
(63, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 19, 'App\\Models\\User', 2, '{\"to\": 4, \"from\": 1}', NULL, NULL, NULL, '2024-07-07 11:09:49', '2024-07-07 11:09:49'),
(64, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 2, 'App\\Models\\User', 1, '{\"to\": 1, \"from\": 3}', NULL, NULL, NULL, '2024-07-07 11:10:09', '2024-07-07 11:10:09'),
(65, '0', 'Prospect Update', 'App\\Models\\Pros', NULL, 3, 'App\\Models\\User', 1, '{\"to\": 1, \"from\": 4}', NULL, NULL, NULL, '2024-07-07 11:10:13', '2024-07-07 11:10:13'),
(66, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 20, 'App\\Models\\User', 2, '{\"to\": 4, \"from\": 1}', NULL, NULL, NULL, '2024-07-07 11:10:20', '2024-07-07 11:10:20'),
(67, '2', 'Prospect Update', 'App\\Models\\Pros', NULL, 3, 'App\\Models\\User', 2, '{\"to\": 3, \"from\": 1}', NULL, NULL, NULL, '2024-07-07 11:10:32', '2024-07-07 11:10:32'),
(68, '1', 'Prospect Update', 'App\\Models\\Pros', NULL, 7, 'App\\Models\\User', 3, '{\"to\": 2, \"from\": 2}', NULL, NULL, NULL, '2024-07-07 11:11:43', '2024-07-07 11:11:43'),
(69, '1', 'Prospect Update', 'App\\Models\\Pros', NULL, 16, 'App\\Models\\User', 3, '{\"to\": 2, \"from\": 0}', NULL, NULL, NULL, '2024-07-07 11:11:52', '2024-07-07 11:11:52'),
(70, '0', 'User Update', 'App\\Models\\User', NULL, 7, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"qsdqsdqdqd\", \"role\": 1, \"email\": \"saifeddine.najmi@uit.ac.mas\"}, \"old\": {\"name\": \"qsdqsdqdqd\", \"role\": 2, \"email\": \"saifeddine.najmi@uit.ac.mas\"}}', NULL, NULL, NULL, '2024-07-07 11:12:25', '2024-07-07 11:12:25'),
(71, '0', 'User Update', 'App\\Models\\User', NULL, 14, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"Saifeddine\", \"role\": 2, \"email\": \"Saifeddine.najmi@hotmail.com\"}, \"old\": {\"name\": \"Saifeddine\", \"role\": 0, \"email\": \"Saifeddine.najmi@hotmail.com\"}}', NULL, NULL, NULL, '2024-07-08 09:34:52', '2024-07-08 09:34:52'),
(72, '0', 'User Update', 'App\\Models\\User', NULL, 14, 'App\\Models\\User', 1, '{\"new\": {\"name\": \"Saifeddine\", \"role\": 1, \"email\": \"Saifeddine.najmi@hotmail.com\"}, \"old\": {\"name\": \"Saifeddine\", \"role\": 2, \"email\": \"Saifeddine.najmi@hotmail.com\"}}', NULL, NULL, NULL, '2024-07-08 10:02:46', '2024-07-08 10:02:46');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('comm@comm.comss|127.0.0.1:timer', 'i:1720175470;', 1720175470),
('comm@comm.comss|127.0.0.1', 'i:2;', 1720175470),
('saifeddine.najmi@hotmail.com|127.0.0.1:timer', 'i:1720346665;', 1720346665),
('saifeddine.najmi@hotmail.com|127.0.0.1', 'i:1;', 1720346665),
('quali@quali.com|127.0.0.1:timer', 'i:1720354312;', 1720354312),
('quali@quali.com|127.0.0.1', 'i:2;', 1720354312);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb3_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '0001_01_01_000000_create_users_table', 1),
(9, '0001_01_01_000001_create_cache_table', 1),
(10, '0001_01_01_000002_create_jobs_table', 1),
(11, '2024_07_06_103509_create_activity_log_table', 2),
(12, '2024_07_06_103510_add_event_column_to_activity_log_table', 3),
(13, '2024_07_06_103511_add_batch_uuid_column_to_activity_log_table', 4),
(14, '2024_07_07_100932_add_from_and_to_to_activity_log_table', 5);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('saifeddine.najmi@gmail.com', '$2y$12$t6mhDBNXxTt7xnzK9luf1eoJ4ktwx.5KqFtMIAcCSjUD47O5l4eSC', '2024-07-09 08:35:23');

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

DROP TABLE IF EXISTS `prospects`;
CREATE TABLE IF NOT EXISTS `prospects` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prospects_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `prospects`
--

INSERT INTO `prospects` (`id`, `name`, `email`, `status`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(44, 'Quincy Taylor', 'quincy@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-09 08:38:21'),
(43, 'Paul Scott', 'paul@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(42, 'Olivia Roberts', 'olivia@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-09 08:45:52'),
(41, 'Nathan Quinn', 'nathan@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(40, 'Mona Perry', 'mona@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(39, 'Leo Owens', 'leo@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(38, 'Karen Nelson', 'karen@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(37, 'Jack Miller', 'jack@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(36, 'Isabel Lee', 'isabel@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-09 08:47:51'),
(35, 'Henry King', 'henry@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(34, 'Grace Johnson', 'grace@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(33, 'Frank Harris', 'frank@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(32, 'Eva Green', 'eva@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-09 08:48:10'),
(31, 'David Evans', 'david@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(30, 'Charlie Davis', 'charlie@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(29, 'Bob Brown', 'bob@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(26, 'John Doe', 'john@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(27, 'Jane Smith', 'jane@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(28, 'Alice Johnson', 'alice@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(45, 'Rachel White', 'rachel@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(46, 'Samuel Black', 'samuel@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(47, 'Tina Brown', 'tina@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(48, 'Uma Green', 'uma@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(49, 'Victor Blue', 'victor@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(50, 'Wendy Grey', 'wendy@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(51, 'Xander Harris', 'xander@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(52, 'Yasmine Gold', 'yasmine@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(53, 'Zach White', 'zach@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(54, 'Adam Smith', 'adam@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(55, 'Bella Green', 'bella@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(56, 'Calvin Brown', 'calvin@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(57, 'Diana White', 'diana@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(58, 'Ethan Blue', 'ethan@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(59, 'Fiona Grey', 'fiona@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(60, 'George Harris', 'george@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(61, 'Hannah Gold', 'hannah@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(62, 'Ian Black', 'ian@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(63, 'Julia Brown', 'julia@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(64, 'Kyle Green', 'kyle@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(65, 'Laura White', 'laura@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(66, 'Mason Blue', 'mason@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(67, 'Nina Grey', 'nina@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(68, 'Owen Harris', 'owen@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(69, 'Paula Gold', 'paula@example.com', '0', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(70, 'Quinn Black', 'quinn@example.com', '3', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(71, 'Rita Brown', 'rita@example.com', '2', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(72, 'Steve Green', 'steve@example.com', '4', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05'),
(73, 'Tara White', 'tara@example.com', '1', NULL, NULL, '2024-07-07 11:25:05', '2024-07-07 11:25:05');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb3_unicode_ci,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8tpclDV2EJePs5qJj3X1FOyHBIazuT4L7FeY1lsD', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0w0dTA5RHdqRjZmZkVuY2lIUzZvTEoxdHp2c1RpWVE5R25aa1RqMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jc3MvaW1hZ2VzL2h0bWxfdGFibGUuanBnIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1720956134),
('9gooi9MjB92Zo81IOXaf6xurCfwWq2tMcdaKI28L', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYWpsUlFqUkJnVzVxMVVCR3Z5VW9GaGY4MFJqY2k5MGxPTzg1azNWNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1721032440),
('yywqc6dPb8FzVCzOFxRHrrEWfknu63J891KsjdX0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieVdlc0VSSWxQcUxvSkhjdEVoSFh5QVdnamZTZjBoMm9aOXI1NXlmbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9Db21tZXJjaWFsL1ZpZXdQcm9zcGVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1720863542),
('96YVIVPL7bjEYehkaKqrUqR9eoEZLcEeoVt0OZ4m', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVEFwYkoxS0VMb1JHTWdMYXgxS1cwam9ZMzVYRUJxMDdGSzZ4bEVUQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbWFnZXMvaHRtbF90YWJsZS5qcGciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1720523638);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NAJMI Saifeddine', 'admin@admin.com', 0, NULL, '$2y$12$vAVEEpz5G2UbpASLFgH7QOhxHV5NjXIMKgPzujRNS.JDYV.qPUeuy', 'DA3X5L4sUD254su4CTBKaMWLq6bjNzm9EYaHXaQAUMGqsnpe8rVQdVtgzNtj', '2024-06-25 15:56:33', '2024-07-05 16:14:47'),
(2, 'NAJMI Saifeddine', 'comm@comm.com', 2, NULL, '$2y$12$s3BYdlmkEVd5d.xrCvqlqeoHRT6IqO7CRXNge3sMXvnKlPCL9rB2e', NULL, '2024-06-30 07:33:00', '2024-07-07 10:06:20'),
(3, 'NAJMI Saifeddine', 'qualif@qualif.com', 1, NULL, '$2y$12$8y0AZtKrvzbBPWRBHY382ef6spu2qrAtNvsfOQqzJQxjv9eqVr1l2', NULL, '2024-06-30 07:33:19', '2024-07-13 08:35:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
