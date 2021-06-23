-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 08:40 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apple_watch`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(2, 'role-create', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(3, 'role-edit', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(4, 'role-delete', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(5, 'product-list', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(6, 'product-create', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(7, 'product-edit', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(8, 'product-delete', 'web', '2020-11-25 05:53:20', '2020-11-25 05:53:20'),
(9, 'brand-list', 'web', '2020-11-26 05:00:09', '2020-11-26 05:00:09'),
(10, 'brand-create', 'web', '2020-11-26 05:01:46', '2020-11-26 05:01:46'),
(11, 'brand-edit', 'web', '2020-11-26 05:01:58', '2020-11-26 05:01:58'),
(12, 'brand-delete', 'web', '2020-11-26 05:02:10', '2020-11-26 05:02:10'),
(13, 'staff-list', 'web', '2020-11-26 05:03:00', '2020-11-26 05:03:00'),
(14, 'staff-create', 'web', '2020-11-26 05:03:13', '2020-11-26 05:03:13'),
(15, 'staff-edit', 'web', '2020-11-26 05:03:28', '2020-11-26 05:03:28'),
(16, 'staff-delete', 'web', '2020-11-26 05:03:55', '2020-11-26 05:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `case_size` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gps` varchar(255) COLLATE utf8_unicode_ci DEFAULT '["uploads\\/products\\/product_default_img.png"]',
  `oxygen` longtext COLLATE utf8_unicode_ci,
  `thumbnail_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'uploads/products/product_default_thumbnail.png',
  `ecg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heart_notification` longtext COLLATE utf8_unicode_ci,
  `description` longtext COLLATE utf8_unicode_ci,
  `family_setup` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `water_resistance` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `added_by`, `name`, `slug`, `unit_price`, `case_size`, `display`, `gps`, `oxygen`, `thumbnail_img`, `ecg`, `heart_notification`, `description`, `family_setup`, `water_resistance`, `created_at`, `updated_at`) VALUES
(11, NULL, 'Apple Watch Series 6', 'apple-watch-series-6-w1rf0', 399, '44mm or 40mm case size', 'Always-On Retina display', 'GPS + Cellular1', 'Blood Oxygen app2', 'uploads/products/thumbnail/R2VA75C2yo2y0FBSJP3h4UYWNKkQSJHhXxvef1Tm.png', 'ECG app3', NULL, NULL, NULL, 'Water resistant 50 meters6', '2021-06-23 07:34:10', '2021-06-23 07:34:10'),
(12, NULL, 'Apple Watch SE', 'apple-watch-se-9fYxG', 279, '44mm or 40mm case size', 'Retina display', 'GPS', NULL, 'uploads/products/thumbnail/yD7mz2GwA2MrVSHGdBvrer2eS0pHsr2qSoPk2sfH.png', NULL, NULL, NULL, NULL, 'Water resistant 50 meters6', '2021-06-23 07:36:25', '2021-06-23 07:36:25'),
(13, NULL, 'Apple Watch Series 3', 'apple-watch-series-3-CDYdf', 199, '42mm or 38mm case size', NULL, 'GPS', NULL, 'uploads/products/thumbnail/VgWky37BIvU6plOAUwJgkqCNqQQa4fYaco53a2x6.png', NULL, NULL, NULL, NULL, 'Water resistant 50 meters6', '2021-06-23 07:37:39', '2021-06-23 07:37:39'),
(14, NULL, 'Apple Watch BBN', 'apple-watch-bbn-d3yXa', 100, '42mm or 38mm case size', 'IPS', 'GPS + Cellular1', 'Blood Oxygen app2', 'uploads/products/thumbnail/abcd.png', 'ECG app3', NULL, NULL, NULL, NULL, '2021-06-23 07:40:00', '2021-06-23 07:40:00'),
(15, NULL, 'Apple Watch Test', 'apple-watch-test-KzggV', 200, 'Hard Case', 'Super Amoled', NULL, NULL, 'uploads/products/thumbnail/h7F4HaKBdatsziteZd8FY9gNxpHejR4Pz4jqC96O.png', NULL, NULL, NULL, NULL, NULL, '2021-06-23 11:34:37', '2021-06-23 11:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Sales Executive', 'web', '2020-11-25 23:35:27', '2020-11-25 23:35:27'),
(3, 'Sub Admin', 'web', '2020-11-25 23:37:27', '2020-11-25 23:37:27'),
(4, 'Super Admin', 'web', '2020-11-26 03:13:00', '2020-11-26 03:13:00'),
(5, 'publisher', 'web', '2020-11-26 03:13:00', '2020-11-26 03:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(2, 4),
(3, 3),
(3, 4),
(4, 4),
(5, 2),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `provider_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` text COLLATE utf8_unicode_ci,
  `new_email_verificiation_code` text COLLATE utf8_unicode_ci,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(256) COLLATE utf8_unicode_ci DEFAULT 'uploads/profile/default.png',
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` double(8,2) NOT NULL DEFAULT '0.00',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `referral_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_package_id` int(11) DEFAULT NULL,
  `remaining_uploads` int(11) DEFAULT '0',
  `view` int(20) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `referred_by`, `provider_id`, `user_type`, `name`, `email`, `email_verified_at`, `verification_code`, `new_email_verificiation_code`, `password`, `remember_token`, `avatar`, `avatar_original`, `address`, `country`, `city`, `postal_code`, `phone`, `balance`, `banned`, `referral_code`, `customer_package_id`, `remaining_uploads`, `view`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'admin', 'Admin', 'admin@apple.com', NULL, NULL, NULL, '$2y$10$YESPQkChEUnXGQAMCvx7leJJemzVXwLW/YcydtuHSHUpW2Rw550p6', NULL, NULL, 'uploads/profile/default.png', NULL, NULL, NULL, NULL, NULL, 0.00, 0, NULL, NULL, 0, 0, '2021-06-21 18:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
