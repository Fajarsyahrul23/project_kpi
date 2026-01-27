-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2026 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kpi_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_25_140837_create_tbl_department_table', 1),
(5, '2026_01_25_140838_create_tbl_bpds_table', 1),
(6, '2026_01_25_140838_create_tbl_kpis_table', 1),
(7, '2026_01_26_030057_create_tbl_master_bpds_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8fYX3oC7n3IO2S6tSXYiuQM8IR4HbSNcNO5ebMan', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnM4a3BETlhsWFZOa3hQdlh1TGdCRUQ5Z2FZMHZXa0VMcUVqN0txaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1769415744),
('n4nv6e0dvEfRPvpBhJX2jWRUBGgV2kvdQy8YIXk1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieGtJZU8xM3dxQXU4c05ZY1JTWTVsb0RDU2dFRnVEeldIaXZ2NEF0MCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9icGQvMS9rcGkiO3M6NToicm91dGUiO3M6OToia3BpLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxMzoiZGVwYXJ0bWVudF9pZCI7aToxO3M6MTU6ImRlcGFydG1lbnRfbmFtZSI7czoyMjoiSW5mb3JtYXRpb24gVGVjaG5vbG9neSI7fQ==', 1769419695);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bpds`
--

CREATE TABLE `tbl_bpds` (
  `id_bpd` bigint(20) UNSIGNED NOT NULL,
  `id_department` bigint(20) UNSIGNED NOT NULL,
  `no_bpd` varchar(255) NOT NULL,
  `objective` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_bpds`
--

INSERT INTO `tbl_bpds` (`id_bpd`, `id_department`, `no_bpd`, `objective`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2.2', 'Cost Reduction', NULL, NULL, '2026-01-26 02:25:08'),
(2, 1, '1.2', 'increase', 1, '2026-01-25 08:43:22', '2026-01-25 08:43:22'),
(4, 1, '1.4', 'dsdsdsds', 1, '2026-01-25 19:49:30', '2026-01-25 19:49:30'),
(5, 1, '2.4', 'abcdbdbdb', 1, '2026-01-25 19:52:44', '2026-01-25 19:52:44'),
(6, 1, '1.3', 'Total Recordable Injury Frequency Rate (TRIFR)', 1, '2026-01-25 20:11:01', '2026-01-25 20:11:01'),
(7, 1, '1.1', 'Fatal Incident', 1, '2026-01-26 02:28:00', '2026-01-26 02:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id_department` bigint(20) UNSIGNED NOT NULL,
  `dept_code` varchar(255) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `pin` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id_department`, `dept_code`, `dept_name`, `pin`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'Information Technology', 123456, 1, '2026-01-25 07:20:38', '2026-01-25 07:20:38'),
(2, 'HR', 'Human Resources', 654321, 1, '2026-01-25 07:20:38', '2026-01-25 07:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kpis`
--

CREATE TABLE `tbl_kpis` (
  `id_kpi` bigint(20) UNSIGNED NOT NULL,
  `id_bpd` bigint(20) UNSIGNED NOT NULL,
  `definition` text DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `com_target` int(10) DEFAULT NULL,
  `com_actual` int(10) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `actual` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_kpis`
--

INSERT INTO `tbl_kpis` (`id_kpi`, `id_bpd`, `definition`, `periode`, `com_target`, `com_actual`, `target`, `actual`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 2, 'xxxxx', '2026-01-25', 100, 100, '100', '100', 'xxxxxxxx', 1, '2026-01-25 09:13:16', '2026-01-25 09:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_bpds`
--

CREATE TABLE `tbl_master_bpds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_bpd` varchar(255) NOT NULL,
  `objective` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_master_bpds`
--

INSERT INTO `tbl_master_bpds` (`id`, `no_bpd`, `objective`, `created_at`, `updated_at`) VALUES
(1, '1.1', 'Fatal Incident', '2026-01-25 20:03:46', '2026-01-25 20:03:46'),
(2, '1.2', 'Lost Time Injury (LTI)', '2026-01-25 20:03:46', '2026-01-25 20:03:46'),
(3, '1.3', 'Total Recordable Injury Frequency Rate (TRIFR)', '2026-01-25 20:03:47', '2026-01-25 20:03:47'),
(4, '2.1', 'Operational Efficiency', '2026-01-25 20:03:47', '2026-01-25 20:03:47'),
(5, '2.2', 'Cost Reduction', '2026-01-25 20:03:47', '2026-01-25 20:03:47'),
(6, '4.4', 'nanananannana', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbl_bpds`
--
ALTER TABLE `tbl_bpds`
  ADD PRIMARY KEY (`id_bpd`),
  ADD UNIQUE KEY `tbl_bpds_no_bpd_unique` (`no_bpd`),
  ADD KEY `tbl_bpds_id_department_foreign` (`id_department`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `tbl_kpis`
--
ALTER TABLE `tbl_kpis`
  ADD PRIMARY KEY (`id_kpi`),
  ADD KEY `tbl_kpis_id_bpd_foreign` (`id_bpd`);

--
-- Indexes for table `tbl_master_bpds`
--
ALTER TABLE `tbl_master_bpds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_master_bpds_no_bpd_unique` (`no_bpd`);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_bpds`
--
ALTER TABLE `tbl_bpds`
  MODIFY `id_bpd` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id_department` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kpis`
--
ALTER TABLE `tbl_kpis`
  MODIFY `id_kpi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_master_bpds`
--
ALTER TABLE `tbl_master_bpds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bpds`
--
ALTER TABLE `tbl_bpds`
  ADD CONSTRAINT `tbl_bpds_id_department_foreign` FOREIGN KEY (`id_department`) REFERENCES `tbl_department` (`id_department`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_kpis`
--
ALTER TABLE `tbl_kpis`
  ADD CONSTRAINT `tbl_kpis_id_bpd_foreign` FOREIGN KEY (`id_bpd`) REFERENCES `tbl_bpds` (`id_bpd`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
