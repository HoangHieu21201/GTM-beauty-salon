-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2026 at 03:25 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gtm_beauty`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS (ifnull(`deleted_at`,_utf8mb4'0')) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `created_at`, `updated_at`, `deleted_at`, `slug`) VALUES
(1, NULL, 'Phẫu thuật thẩm mỹ', '2026-07-09 18:29:11', '2026-07-10 01:45:08', NULL, 'phau-thuat-tham-my'),
(2, 1, 'Cắt mí', '2026-07-09 18:29:12', '2026-07-10 01:45:08', NULL, 'cat-mi'),
(3, 1, 'Hút mỡ', '2026-07-09 18:29:12', '2026-07-10 01:45:08', NULL, 'hut-mo'),
(4, 1, 'Nâng mũi', '2026-07-09 18:29:12', '2026-07-10 01:45:08', NULL, 'nang-mui'),
(5, 1, 'Nâng ngực', '2026-07-09 18:29:12', '2026-07-10 01:45:08', NULL, 'nang-nguc'),
(6, 1, 'Gọt cằm', '2026-07-11 06:10:56', '2026-07-11 06:14:05', NULL, 'got-cam'),
(7, 1, 'Độn cằm', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'don-cam'),
(8, 1, 'Căng da mặt', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'cang-da-mat'),
(9, NULL, 'Chăm sóc da', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'cham-soc-da'),
(10, 9, 'Trẻ hóa da', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'tre-hoa-da'),
(11, 9, 'Trị mụn', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'tri-mun'),
(12, 9, 'Tắm trắng', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'tam-trang'),
(13, 9, 'Điều trị nám', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'dieu-tri-nam'),
(14, 9, 'Peel da', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'peel-da'),
(15, NULL, 'Răng - Hàm - Mặt', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'rang-ham-mat'),
(16, 15, 'Niềng răng', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'nieng-rang'),
(17, 15, 'Bọc răng sứ', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'boc-rang-su'),
(18, 15, 'Tẩy trắng răng', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'tay-trang-rang'),
(19, 15, 'Cấy ghép Implant', '2026-07-11 06:14:05', '2026-07-11 06:14:05', NULL, 'cay-ghep-implant'),
(20, 9, 'Test', '2026-07-11 23:43:15', '2026-07-11 23:43:15', NULL, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `salon_id` bigint DEFAULT NULL,
  `post_id` bigint DEFAULT NULL,
  `parent_id` bigint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `salon_id`, `post_id`, `parent_id`, `name`, `email`, `content`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 2, NULL, 'Thanh Hiếu', 'admin2@gmail.com', 'a', 1, '2026-07-12 19:38:12', '2026-07-12 19:38:53', NULL),
(2, 3, NULL, 2, 1, 'Hoàng Thanh Hiếu', 'admin2@gmail.com', 'a', 1, '2026-07-12 19:41:37', '2026-07-12 19:41:37', NULL),
(3, 3, NULL, 2, 2, 'Hoàng Thanh Hiếu', 'admin2@gmail.com', 'a', 1, '2026-07-12 19:51:40', '2026-07-12 19:51:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `attempts` smallint UNSIGNED NOT NULL,
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_07_11_010449_create_settings_table', 1),
(5, '2026_07_11_180033_add_slug_to_categories_table', 2),
(6, '2026_07_12_062513_add_remember_token_to_users_table', 3),
(7, '2026_07_12_071609_update_comments_table', 4),
(8, '2026_07_12_090000_create_page_visits_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `page_visits`
--

CREATE TABLE `page_visits` (
  `id` bigint UNSIGNED NOT NULL,
  `visitor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_hash` char(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GET',
  `path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_code` smallint UNSIGNED NOT NULL DEFAULT '200',
  `visited_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_visits`
--

INSERT INTO `page_visits` (`id`, `visitor_id`, `session_id`, `ip_hash`, `user_agent`, `method`, `path`, `full_url`, `route_name`, `referrer`, `status_code`, `visited_at`, `created_at`, `updated_at`) VALUES
(1, '66c1afcb-6e35-4d42-8592-1578e89ed009', 'TxDP032zGQlmmKeZyPWWldWLjfWzBLBYg9iH9cq0', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, '', 200, '2026-07-12 06:54:58', '2026-07-12 06:54:58', '2026-07-12 06:54:58'),
(2, '46afe098-0cea-4cb0-aefb-4d2210c7f0ff', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, '', 200, '2026-07-12 07:39:29', '2026-07-12 07:39:29', '2026-07-12 07:39:29'),
(3, 'e8ff7d7f-c12d-4e4f-843d-26b888967ed8', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang', 'http://127.0.0.1:8000/bang-xep-hang', 'ranking.index', 'http://127.0.0.1:8000/', 200, '2026-07-12 07:39:34', '2026-07-12 07:39:34', '2026-07-12 07:39:34'),
(4, 'e0fd6b3a-bced-4d4f-966a-4b194da88723', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'ranking.show', 'http://127.0.0.1:8000/bang-xep-hang', 200, '2026-07-12 07:39:37', '2026-07-12 07:39:37', '2026-07-12 07:39:37'),
(5, '86819e90-cab9-421d-a08e-85a08ae91c4a', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=test&type=sub', NULL, 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 200, '2026-07-12 07:40:26', '2026-07-12 07:40:26', '2026-07-12 07:40:26'),
(6, 'b76e2c48-8de5-40ab-b495-7c637fd60a17', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang', 'http://127.0.0.1:8000/bang-xep-hang?cat=test', 'ranking.index', 'http://127.0.0.1:8000/bai-viet?type=sub&cat=test', 200, '2026-07-12 07:40:51', '2026-07-12 07:40:51', '2026-07-12 07:40:51'),
(7, 'c2915a1c-474e-465f-8507-19942dd57e81', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang', 'http://127.0.0.1:8000/bang-xep-hang', 'ranking.index', 'http://127.0.0.1:8000/bang-xep-hang?cat=test', 200, '2026-07-12 07:40:59', '2026-07-12 07:40:59', '2026-07-12 07:40:59'),
(8, '4eb882b6-09e3-4a89-b04a-bd512f3b8a1a', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/bang-xep-hang?cat=test', 200, '2026-07-12 07:41:15', '2026-07-12 07:41:15', '2026-07-12 07:41:15'),
(9, '961b1a9e-2de4-41dc-ab06-0704e40e09a3', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=cat-mi&type=sub', NULL, 'http://127.0.0.1:8000/', 200, '2026-07-12 07:41:26', '2026-07-12 07:41:26', '2026-07-12 07:41:26'),
(10, '567911b7-4639-420c-a627-80e6075ae181', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=phau-thuat-tham-my&type=main', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=cat-mi', 200, '2026-07-12 07:41:28', '2026-07-12 07:41:28', '2026-07-12 07:41:28'),
(11, '45751670-f301-4ce8-969b-9bdad3be726d', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=test&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=main&cat=phau-thuat-tham-my', 200, '2026-07-12 07:46:24', '2026-07-12 07:46:24', '2026-07-12 07:46:24'),
(12, '974c3b16-07c5-44cb-b359-ef8a6296d198', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=cat-mi&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=test', 200, '2026-07-12 07:46:28', '2026-07-12 07:46:28', '2026-07-12 07:46:28'),
(13, '57235adf-47a9-4421-a2f9-306453eac2c5', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=tay-trang-rang&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=cat-mi', 200, '2026-07-12 07:46:36', '2026-07-12 07:46:36', '2026-07-12 07:46:36'),
(14, 'f54c1dcd-caf3-45ed-8638-cc180f18eaae', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=peel-da&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=tay-trang-rang', 200, '2026-07-12 07:46:41', '2026-07-12 07:46:41', '2026-07-12 07:46:41'),
(15, '2fcfb996-89ab-4169-b4cf-b07d0403051b', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=cat-mi&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=peel-da', 200, '2026-07-12 07:46:43', '2026-07-12 07:46:43', '2026-07-12 07:46:43'),
(16, '384b7dae-d589-4830-85f7-867b10034e5b', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=cat-mi&type=sub', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=peel-da', 200, '2026-07-12 07:50:05', '2026-07-12 07:50:05', '2026-07-12 07:50:05'),
(17, '408d3464-552b-4aa9-980a-e7dcfd88e909', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=phau-thuat-tham-my&type=main', NULL, 'http://127.0.0.1:8000/bai-viet?type=sub&cat=cat-mi', 200, '2026-07-12 07:50:10', '2026-07-12 07:50:10', '2026-07-12 07:50:10'),
(18, '122d5f9f-9c96-421c-8fbf-7dfe918f4c27', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'ranking.show', 'http://127.0.0.1:8000/bai-viet?type=main&cat=phau-thuat-tham-my', 200, '2026-07-12 07:50:18', '2026-07-12 07:50:18', '2026-07-12 07:50:18'),
(19, '9db727fd-1fb3-4274-961f-aac171b313a9', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 'ranking.show', 'http://127.0.0.1:8000/bai-viet?type=main&cat=phau-thuat-tham-my', 200, '2026-07-12 08:05:07', '2026-07-12 08:05:07', '2026-07-12 08:05:07'),
(20, '8feea08b-faa7-4969-8506-1181cb81ce09', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet', 'http://127.0.0.1:8000/bai-viet?cat=phau-thuat-tham-my&type=main', NULL, 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/vien-tham-my-seoul-beauty', 200, '2026-07-12 08:06:48', '2026-07-12 08:06:48', '2026-07-12 08:06:48'),
(21, '0a159935-0da7-4220-8c7a-0e79cf38fac5', 'ZkyKaZtvY3nz0A5EigPLggYLAvqnOQelDcR6Q8bd', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/bai-viet?type=main&cat=phau-thuat-tham-my', 200, '2026-07-12 08:06:53', '2026-07-12 08:06:53', '2026-07-12 08:06:53'),
(22, 'fdb93775-08e8-4c90-bb9f-cd6640922b4f', 'qMXBJvW3ZIulGbRNtduUWDznzupyG6OcevMnoaTe', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, '', 200, '2026-07-12 19:37:50', '2026-07-12 19:37:50', '2026-07-12 19:37:50'),
(23, '8ff6db2d-a8b9-41b1-adf8-960e2473f306', 'qMXBJvW3ZIulGbRNtduUWDznzupyG6OcevMnoaTe', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', NULL, 'http://127.0.0.1:8000/', 200, '2026-07-12 19:37:59', '2026-07-12 19:37:59', '2026-07-12 19:37:59'),
(24, 'e0419638-89fc-4b6c-a476-e4b7222027d3', 'qMXBJvW3ZIulGbRNtduUWDznzupyG6OcevMnoaTe', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', NULL, 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 200, '2026-07-12 19:38:13', '2026-07-12 19:38:13', '2026-07-12 19:38:13'),
(25, '385fe778-08bc-433b-9ed7-ff4887cfd372', 'qMXBJvW3ZIulGbRNtduUWDznzupyG6OcevMnoaTe', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', NULL, 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 200, '2026-07-12 19:38:28', '2026-07-12 19:38:28', '2026-07-12 19:38:28'),
(26, '40c3b967-8355-412a-b920-433ae2dbc122', 'qMXBJvW3ZIulGbRNtduUWDznzupyG6OcevMnoaTe', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 200, '2026-07-12 19:38:37', '2026-07-12 19:38:37', '2026-07-12 19:38:37'),
(27, 'd61f14cb-d981-4057-b4da-5b7d5a17cf8a', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', NULL, 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 200, '2026-07-12 19:39:09', '2026-07-12 19:39:09', '2026-07-12 19:39:09'),
(28, '555638f5-939c-4211-816b-b26d90ff6cd6', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', NULL, 'http://127.0.0.1:8000/admin/comments', 200, '2026-07-12 20:21:07', '2026-07-12 20:21:07', '2026-07-12 20:21:07'),
(29, 'e84322e6-e390-4d5d-823b-13f89ec923c8', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/', 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/bai-viet/chi-tiet/boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 200, '2026-07-12 20:23:12', '2026-07-12 20:23:12', '2026-07-12 20:23:12'),
(30, '55602530-9b93-479f-8a73-84f4e3d1864e', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang', 'http://127.0.0.1:8000/bang-xep-hang', 'ranking.index', 'http://127.0.0.1:8000/', 200, '2026-07-12 20:24:25', '2026-07-12 20:24:25', '2026-07-12 20:24:25'),
(31, '7bcae3de-1c3e-49a7-bd41-7c525bd2ff73', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/bang-xep-hang/chi-tiet/tham-my-vien-dong-a', 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/tham-my-vien-dong-a', 'ranking.show', 'http://127.0.0.1:8000/bang-xep-hang', 200, '2026-07-12 20:24:29', '2026-07-12 20:24:29', '2026-07-12 20:24:29'),
(32, '8c0ac5f9-1cc1-4473-9ed6-c5e4e87919a5', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/tim-kiem', 'http://127.0.0.1:8000/tim-kiem?q=N%C3%A2ng%20m%C5%A9i', 'search', 'http://127.0.0.1:8000/bang-xep-hang/chi-tiet/tham-my-vien-dong-a', 200, '2026-07-12 20:25:01', '2026-07-12 20:25:01', '2026-07-12 20:25:01'),
(33, '77f59fa2-3a20-425c-aa42-049be7e8fcc6', '7VZpLnqzV9WBKC5F0WznVYYsIYjw96jJl9f6c6Dc', '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'GET', '/tim-kiem', 'http://127.0.0.1:8000/tim-kiem?q=C%E1%BA%AFt%20m%C3%AD', 'search', 'http://127.0.0.1:8000/tim-kiem?q=N%C3%A2ng%20m%C5%A9i', 200, '2026-07-12 20:25:03', '2026-07-12 20:25:03', '2026-07-12 20:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `slug`, `short_description`, `content`, `thumbnail`, `status`, `keyword`, `meta_title`, `meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 'sdfasd', 'sdfasd', 'fasdasda', 'dádasd', NULL, 'published', 'ádasdaád', 'adasd', 'ádadas', '2026-07-11 18:10:26', '2026-07-11 18:10:26', NULL),
(2, 3, 8, 'Bọc răng sứ giá bao nhiêu? Bảng giá 2026 và 5 điều phải hỏi trước khi làm', 'boc-rang-su-gia-bao-nhieu-bang-gia-2026-va-5-dieu-phai-hoi-truoc-khi-lam', 'Giá bọc răng sứ chênh từ 1 đến 15 triệu mỗi răng — vì sao? Phân tích từng dòng sứ, cảnh báo bọc sứ giá rẻ và 5 câu hỏi bắt buộc trước khi để nha sĩ mài răng thật của bạn.', '\"<strong>Bọc răng sứ giá</strong> bao nhiêu?\" là câu hỏi có câu trả lời dao động gấp 15 lần giữa các phòng khám — từ 1 triệu đến 15 triệu mỗi răng. Chênh lệch này có lý do chính đáng, và cũng có cả bẫy. Bài viết giúp bạn phân biệt hai thứ đó.<br><h2>Bảng giá bọc răng sứ 2026</h2><div><table class=\"w-full border-collapse border border-gray-300 mb-4\"><tbody><tr><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td></tr><tr><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loạiSứ kim loại</td></tr><tr><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">&nbsp;Sứ kim loại</td><td class=\"border border-gray-300 p-2.5\">Sứ kim loại</td></tr></tbody></table><blockquote><strong>⚠️ Cảnh báo quan trọng:</strong> mài răng là thủ thuật <em>không thể hoàn tác</em>. Răng đã mài phải mang mão sứ suốt đời. Vì vậy đừng bao giờ quyết định trong buổi tư vấn đầu tiên, và tuyệt đối tránh các gói \"bọc 20 răng giá sốc\" — răng khỏe không có lý do gì phải mài đi 20 chiếc.</blockquote><p><img src=\"data:image/jpeg;base64,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\"></p><h2>5 câu phải hỏi trước khi đồng ý mài răng</h2></div><div><ol><li><strong>\"Răng tôi có thực sự cần bọc không, hay chỉ cần tẩy trắng/dán veneer?\"</strong> — veneer chỉ mài 0.3–0.5mm, bảo tồn răng gấp nhiều lần.</li><li><strong>\"Răng tôi có thực sự cần bọc không, hay chỉ cần tẩy trắng/dán veneer?\"</strong> — veneer chỉ mài 0.3–0.5mm, bảo tồn răng gấp nhiều lần.</li><li><strong>\"Răng tôi có thực sự cần bọc không, hay chỉ cần tẩy trắng/dán veneer?\"</strong> — veneer chỉ mài 0.3–0.5mm, bảo tồn răng gấp nhiều lần.</li></ol><h2>Bọc sứ giá rẻ — rủi ro nằm ở đâu?<br></h2></div><div><ul><li>Mài quá tay cho nhanh → xâm phạm tủy, đau kéo dài, phải điều trị tủy</li><li>Mài quá tay cho nhanh → xâm phạm tủy, đau kéo dài, phải điều trị tủy</li><li>Mài quá tay cho nhanh → xâm phạm tủy, đau kéo dài, phải điều trị tủy</li></ul><h2>Kết luận<br></h2></div><div>Mức hợp lý nhất 2026 cho răng cửa là <strong><a href=\"https://admin.sxtmhavydecor.click/manage/articles/6a49c30abd5efb2f9dd3a22f\">sứ toàn phần 4–6 triệ</a>u/răng</strong> tại phòng khám có labo riêng. Nếu răng bạn lệch lạc nhiều, cân nhắc niềng răng trước thay vì bọc sứ cả hàm — chậm hơn nhưng giữ được răng thật. Xem điểm đánh giá các phòng khám nha tại <a href=\"/xep-hang\" rel=\"noopener noreferrer\" target=\"_blank\">bảng xếp hạng</a>, nổi bật là <a href=\"/clinic/benh-vien-tham-my-hoan-my\" rel=\"noopener noreferrer\" target=\"_blank\">Bệnh viện Thẩm mỹ Hoàn Mỹ</a> và <a href=\"/clinic/tham-my-vien-sai-gon-venus\" rel=\"noopener noreferrer\" target=\"_blank\">Thẩm mỹ viện Sài Gòn Venus</a>.</div>', NULL, 'published', 'bọc răng sứ giá', 'Bọc Răng Sứ Giá Bao Nhiêu? Bảng Giá 2026 & 5 Điều Phải Hỏi', 'Bảng giá bọc răng sứ 2026: sứ kim loại 1–2.5 triệu, sứ toàn phần 3–8 triệu, sứ cao cấp 8–15 triệu/răng. 5 câu phải hỏi nha sĩ trước khi mài răng — điều không thể hoàn tác.', '2026-07-12 12:24:41', '2026-07-12 12:24:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_province`
--

CREATE TABLE `post_province` (
  `post_id` bigint NOT NULL,
  `province_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '2026-07-11 23:21:58', '2026-07-11 23:21:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `id` bigint NOT NULL,
  `category_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` int DEFAULT '0',
  `rating` decimal(2,1) DEFAULT '5.0',
  `review_count` int DEFAULT '0',
  `is_featured` tinyint(1) DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salons`
--

INSERT INTO `salons` (`id`, `category_id`, `name`, `address`, `phone`, `website`, `description`, `image`, `score`, `rating`, `review_count`, `is_featured`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 'Bệnh viện Thẩm mỹ Kim Cương', '100 Đường Thẩm Mỹ, Quận Cầu Giấy, Hà Nội', '0901 234 567', 'https://thammykimcuong.example.com', 'Bệnh viện Thẩm mỹ Kim Cương cung cấp các dịch vụ nâng mũi, nâng ngực, cắt mí và trẻ hóa da. Cơ sở được thiết kế hiện đại, không gian sạch sẽ, đội ngũ tư vấn tận tâm và quy trình chăm sóc khách hàng chuyên nghiệp.', 'uploads/salons/ad213520-494b-477e-8472-ec30c4a0887f.jpg', 50, 5.0, 0, 1, 'active', '2026-07-09 18:50:48', '2026-07-11 11:32:54', NULL),
(5, 2, 'Bệnh viện Thẩm mỹ Á Âu', '102 Đường Thẩm Mỹ, Quận Thanh Xuân, Hà Nội', '0902 345 678', 'https://thammy-aau.example.com', 'Bệnh viện Thẩm mỹ Á Âu chuyên cắt mí, hút mỡ, tạo hình vóc dáng và chăm sóc da công nghệ cao. Không gian tiếp đón sang trọng, phòng điều trị riêng tư và trang thiết bị hiện đại.', 'uploads/salons/6a3baf2d-affb-4747-857d-25e41c215a67.jpg', 20, 5.0, 100, 1, 'active', '2026-07-09 18:53:43', '2026-07-11 11:32:54', NULL),
(6, 3, 'Thẩm mỹ viện Ngọc Dung', '101 Đường Thẩm Mỹ, Quận Đống Đa, Hà Nội', '0903 456 789', 'https://thammyngocdung.example.com', 'Thẩm mỹ viện Ngọc Dung cung cấp dịch vụ nâng ngực, cắt mí, chăm sóc da và trẻ hóa khuôn mặt. Cơ sở chú trọng trải nghiệm khách hàng, tư vấn rõ ràng và không gian làm đẹp thoải mái.', 'uploads/salons/af602464-8de7-4515-91c8-9ef3117eb6a6.jpg', 10, 4.0, 47, 0, 'active', '2026-07-09 18:56:13', '2026-07-11 11:32:54', NULL),
(7, 1, 'Thẩm mỹ viện Đông Á', '103 Đường Thẩm Mỹ, Quận Hai Bà Trưng, Hà Nội', '0904 567 890', 'https://thammydonga.example.com', 'Thẩm mỹ viện Đông Á chuyên hút mỡ, trẻ hóa da, điều trị nám và chăm sóc da chuyên sâu. Cơ sở có khu vực tư vấn riêng, phòng dịch vụ sạch sẽ và đội ngũ nhân viên hỗ trợ nhiệt tình.', 'uploads/salons/6a8cf201-6b13-45af-b641-c647dfae8acd.jpg', 70, 4.1, 320, 0, 'active', '2026-07-09 19:01:07', '2026-07-11 11:32:54', NULL),
(10, 4, 'Viện Thẩm mỹ Seoul Beauty', '55 Nguyễn Văn Cừ, Long Biên, Hà Nội', '0907 234 567', 'https://seoulbeauty.vn', 'Chuyên nâng mũi cấu trúc, nâng mũi sụn sườn, nâng mũi bán cấu trúc với quy trình khép kín và đội ngũ bác sĩ giàu kinh nghiệm.', '[\"uploads/salons/a675dd5b-bb5d-457a-9fd7-18bc599b1bb8.jpg\",\"uploads/salons/5c34f83b-a6d0-448e-b22d-02f2367ba3d8.jpg\",\"uploads/salons/e15f66ff-a260-4df2-8971-f6a2d7388d32.jpg\",\"uploads/salons/86cd1c84-b8e0-45bc-b175-a42745355652.jpg\"]', 80, 4.9, 448, 1, 'active', '2026-07-09 19:26:21', '2026-07-11 11:32:54', NULL),
(11, 3, 'Viện Thẩm mỹ Elite', '218 Nguyễn Chí Thanh, Đống Đa, Hà Nội', '0905 123 456', 'https://eliteclinic.vn', 'Viện Thẩm mỹ Elite chuyên hút mỡ bụng, hút mỡ bắp tay, hút mỡ đùi bằng công nghệ hiện đại. Đội ngũ bác sĩ nhiều năm kinh nghiệm cùng hệ thống phòng mổ đạt tiêu chuẩn giúp khách hàng an tâm trong suốt quá trình điều trị.', '[\"uploads/salons/403de411-8ddb-4198-a0c6-956066a593ec.jpg\",\"uploads/salons/caf0b5e2-cad6-4166-852c-c7407e6402a1.jpg\",\"uploads/salons/9e385105-ae07-484b-a86a-bd213918b263.jpg\",\"uploads/salons/a75d5d1d-c411-4b47-b94f-46f45e35d969.jpg\"]', 95, 5.0, 120, 1, 'active', '2026-07-09 19:34:42', '2026-07-10 00:15:46', '2026-07-10 00:15:46'),
(12, 4, 'Bệnh viện Thẩm mỹ Kangnam Hà Nội', '190 Trường Chinh, Quận Đống Đa, Hà Nội', '0968 999 777', 'https://benhvienthammykangnam.vn', 'Bệnh viện Thẩm mỹ Kangnam Hà Nội là một trong những cơ sở thẩm mỹ chuyên sâu về nâng mũi được nhiều khách hàng lựa chọn. Bệnh viện cung cấp đa dạng các dịch vụ như nâng mũi cấu trúc, nâng mũi sụn sườn, nâng mũi bán cấu trúc và chỉnh sửa mũi hỏng.\r\n\r\nHệ thống phòng mổ đạt tiêu chuẩn vô khuẩn, trang thiết bị hiện đại cùng đội ngũ bác sĩ giàu kinh nghiệm giúp mang lại kết quả tự nhiên, hài hòa với khuôn mặt. Khách hàng được tư vấn phương pháp phù hợp với từng tình trạng mũi và được theo dõi sau phẫu thuật theo đúng quy trình.', '[\"uploads/salons/019807a0-37ca-4582-8c49-e2deee370e9a.jpg\",\"uploads/salons/cdf0d385-aba0-4b55-91c1-39d3db473168.jpg\",\"uploads/salons/1e9a7c89-2cce-4c9d-ad5c-aa212b244817.jpg\",\"uploads/salons/486eaa6a-f801-4a22-9965-eb69c5bdb8bd.jpg\"]', 40, 4.8, 232, 0, 'active', '2026-07-09 19:38:14', '2026-07-11 11:32:54', NULL),
(13, 5, 'Bệnh viện Thẩm mỹ Á Âu', '32 Nguyễn Hữu Cảnh, Phường Bình Thạnh, TP. Hồ Chí Minh', '0908 234 567', 'https://benhvienaau.vn', 'Bệnh viện Thẩm mỹ Á Âu là cơ sở chuyên sâu về nâng ngực nội soi, nâng ngực Nano Chip và chỉnh sửa ngực hỏng. Với đội ngũ bác sĩ có nhiều năm kinh nghiệm cùng hệ thống phòng mổ vô khuẩn hiện đại, bệnh viện mang đến giải pháp nâng ngực an toàn, tự nhiên và phù hợp với từng khách hàng.\r\n\r\nKhách hàng được tư vấn kỹ lưỡng trước khi phẫu thuật, lựa chọn kích thước túi ngực phù hợp với vóc dáng và theo dõi sát sao trong quá trình hồi phục.', '[\"uploads/salons/2c301780-d45b-4145-9cf4-b42b1c3c47aa.jpg\",\"uploads/salons/fa2a924a-2152-4b45-9ed2-03b3ff895844.jpg\",\"uploads/salons/ff606905-ae4e-4d98-8b57-9fecb4c54128.jpg\",\"uploads/salons/2bbca13e-fe77-4a71-8694-c672af1e127e.jpg\"]', 60, 4.0, 123, 0, 'active', '2026-07-09 19:41:54', '2026-07-11 11:32:54', NULL),
(14, 5, 'Viện Thẩm mỹ Venus Beauty', '198 Điện Biên Phủ, Quận 3, TP. Hồ Chí Minh', '0912 567 888', 'https://venusbeauty.vn', 'Viện Thẩm mỹ Venus Beauty là địa chỉ được nhiều khách hàng lựa chọn khi có nhu cầu nâng ngực thẩm mỹ. Cơ sở cung cấp các dịch vụ nâng ngực bằng túi Motiva, Mentor và Nano Chip với quy trình thực hiện theo tiêu chuẩn an toàn.\r\n\r\nĐội ngũ bác sĩ luôn thăm khám trực tiếp, tư vấn phương pháp phù hợp với từng khách hàng nhằm mang lại vòng một cân đối, hài hòa và tự nhiên. Sau phẫu thuật, khách hàng được hướng dẫn chăm sóc và tái khám định kỳ để đảm bảo kết quả lâu dài.', '[\"uploads/salons/d913331e-54ef-4c54-bc03-3bfb37d2dd5f.jpg\",\"uploads/salons/94cf0edd-53a6-4692-a0da-43914ac72ef8.jpg\",\"uploads/salons/c9514b84-8346-4d70-a0ef-c22ffec7d2c5.jpg\",\"uploads/salons/98f57773-bbef-44d8-a148-8a1a82dc7100.jpg\"]', 30, 4.3, 100, 1, 'active', '2026-07-09 19:45:54', '2026-07-11 11:32:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salon_post`
--

CREATE TABLE `salon_post` (
  `post_id` bigint NOT NULL,
  `salon_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `role_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`, `remember_token`) VALUES
(3, 1, 'Hoàng Thanh Hiếu', 'admin2@gmail.com', '$2y$12$beyls9cqsXewLWZSfsLqqeaR6coMVv8T79OHB8uPgHmPKgm0QnMeO', '2026-07-11 23:21:58', '2026-07-11 23:21:58', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_active_unique` (`slug`,`active_deleted_at`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `salon_id` (`salon_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

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
-- Indexes for table `page_visits`
--
ALTER TABLE `page_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_visits_visited_at_status_code_path_index` (`visited_at`,`status_code`,`path`),
  ADD KEY `page_visits_visited_at_status_code_visitor_id_index` (`visited_at`,`status_code`,`visitor_id`),
  ADD KEY `page_visits_visited_at_index` (`visited_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_province`
--
ALTER TABLE `post_province`
  ADD PRIMARY KEY (`post_id`,`province_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `salon_post`
--
ALTER TABLE `salon_post`
  ADD PRIMARY KEY (`post_id`,`salon_id`),
  ADD KEY `salon_id` (`salon_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `page_visits`
--
ALTER TABLE `page_visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salons`
--
ALTER TABLE `salons`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `post_province`
--
ALTER TABLE `post_province`
  ADD CONSTRAINT `post_province_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `post_province_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `salons`
--
ALTER TABLE `salons`
  ADD CONSTRAINT `salons_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `salon_post`
--
ALTER TABLE `salon_post`
  ADD CONSTRAINT `salon_post_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `salon_post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `salon_post_ibfk_3` FOREIGN KEY (`salon_id`) REFERENCES `salons` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
