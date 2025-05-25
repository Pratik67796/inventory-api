-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 09:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Beverages', 'hello description', '2025-05-25 01:54:44', '2025-05-25 01:54:44', NULL),
(2, 'Phone', 'hello description', '2025-05-25 01:55:05', '2025-05-25 01:55:05', NULL),
(3, 'Laptop', 'hello description', '2025-05-25 01:55:11', '2025-05-25 01:55:11', NULL),
(4, 'Ac', 'hello description', '2025-05-25 01:55:17', '2025-05-25 01:55:17', NULL);

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
-- Table structure for table `inventory_logs`
--

CREATE TABLE `inventory_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('add','reduce') NOT NULL,
  `quantity` int(11) NOT NULL,
  `previous_quantity` int(11) NOT NULL,
  `new_quantity` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_logs`
--

INSERT INTO `inventory_logs` (`id`, `product_id`, `user_id`, `type`, `quantity`, `previous_quantity`, `new_quantity`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'add', 2, 1, 3, 'hello', '2025-05-25 02:08:14', '2025-05-25 02:08:14'),
(2, 2, 1, 'reduce', 2, 3, 1, 'hello', '2025-05-25 02:08:46', '2025-05-25 02:08:46');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_24_053623_create_suppliers', 1),
(6, '2025_05_24_053732_create_categories', 1),
(7, '2025_05_24_053809_create_products', 1),
(8, '2025_05_24_054117_create_inventory_logs', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', 'f642ffdac01e13cfb150c21b41ea4ba8542ed9368e1cd3f679ba8d7cf2446197', '[\"*\"]', NULL, NULL, '2025-05-24 00:39:10', '2025-05-24 00:39:10'),
(2, 'App\\Models\\User', 2, 'auth_token', '7ce02059537a8c9498ad86377392f9563fb51fa11847a4cf78419399b5a63235', '[\"*\"]', NULL, NULL, '2025-05-24 00:45:48', '2025-05-24 00:45:48'),
(3, 'App\\Models\\User', 3, 'auth_token', '3abb30730f5ac71daaadb9b280ced5415d4171a22f6f100f16776133848bd2dd', '[\"*\"]', NULL, NULL, '2025-05-24 00:48:08', '2025-05-24 00:48:08'),
(4, 'App\\Models\\User', 4, 'auth_token', '334f0bf321d92b0dad80df02e6e8e14dd7aa3828a815451848df23a8a6842ddb', '[\"*\"]', NULL, NULL, '2025-05-24 00:48:57', '2025-05-24 00:48:57'),
(5, 'App\\Models\\User', 5, 'auth_token', 'f4c0f4772280748a8c0bd4efd8e4e350a94bc068ad86d2aa85d9ea57e98de6d9', '[\"*\"]', NULL, NULL, '2025-05-24 01:01:00', '2025-05-24 01:01:00'),
(6, 'App\\Models\\User', 5, 'auth_token', '3ac26df63ca6d84e77ba8489d2f6fb8cfcad9102a0b5de45129162b3b4e20c30', '[\"*\"]', NULL, NULL, '2025-05-24 01:01:13', '2025-05-24 01:01:13'),
(7, 'App\\Models\\User', 5, 'auth_token', '159fc8e4954bfc24edf56ab95ecfd62255902c68cc5cb3a4275d445347e1cc39', '[\"*\"]', NULL, NULL, '2025-05-24 01:04:05', '2025-05-24 01:04:05'),
(8, 'App\\Models\\User', 5, 'auth_token', '1717282adf80c887336e7426678414b08ba08de5a3e535e662dd473817e8d755', '[\"*\"]', NULL, NULL, '2025-05-24 01:07:28', '2025-05-24 01:07:28'),
(9, 'App\\Models\\User', 5, 'auth_token', '68ff1ec8c6ac0e7dd622af5086b49de801a50e4008709a0d0783e5db6f005a7b', '[\"*\"]', NULL, NULL, '2025-05-24 01:07:34', '2025-05-24 01:07:34'),
(10, 'App\\Models\\User', 5, 'auth_token', '15af432f983f34aa8683cb23b8b2b84cad88b72332d36f80ac875dfd3899ec3e', '[\"*\"]', NULL, NULL, '2025-05-24 01:07:38', '2025-05-24 01:07:38'),
(14, 'App\\Models\\User', 5, 'auth_token', '5627b286e4c00483d65af85961136f2c04132ea5f299d50f239726f4ca82d3da', '[\"*\"]', '2025-05-25 00:16:45', NULL, '2025-05-24 02:45:19', '2025-05-25 00:16:45'),
(15, 'App\\Models\\User', 7, 'api-token', '4ed76a75d6dc258383aeedd22f2c8ff874ef1a8e8f34d9ce975415546b510cca', '[\"*\"]', NULL, NULL, '2025-05-24 08:44:15', '2025-05-24 08:44:15'),
(16, 'App\\Models\\User', 8, 'api-token', '137fdc8550bda523ff949a38080766864dcb7fcb30dec72e30fd265e458d8999', '[\"*\"]', NULL, NULL, '2025-05-24 08:53:17', '2025-05-24 08:53:17'),
(17, 'App\\Models\\User', 9, 'api-token', 'ee7ab6de6a55ed5e7c145d1262336b48ea4d2542361071e92105b8ff4c7b845b', '[\"*\"]', NULL, NULL, '2025-05-24 08:54:40', '2025-05-24 08:54:40'),
(18, 'App\\Models\\User', 5, 'api-token', '0913db92e2296048f5f7907759a735c4e599f34a53036864e56ceee85f990017', '[\"*\"]', NULL, NULL, '2025-05-24 08:56:05', '2025-05-24 08:56:05'),
(19, 'App\\Models\\User', 5, 'api-token', '0a8c6fec58d7fced2e450b183035b9c4099c31fdac8454be9194180137772a2a', '[\"*\"]', NULL, NULL, '2025-05-24 08:58:11', '2025-05-24 08:58:11'),
(21, 'App\\Models\\User', 5, 'api-token', '17514d8c179e9a999feb9903d9df50b712bd78ba4b1178016c2cfe85bc598903', '[\"*\"]', '2025-05-24 10:49:58', NULL, '2025-05-24 09:42:10', '2025-05-24 10:49:58'),
(23, 'App\\Models\\User', 5, 'api-token', '55ad96db6359ae88466fc4df933275e3877ba3fe24f958e2963225df5fd87033', '[\"*\"]', NULL, NULL, '2025-05-24 23:44:25', '2025-05-24 23:44:25'),
(24, 'App\\Models\\User', 5, 'api-token', '75bcb69c70f6ad08d98cb68295db2aea4a9cfee3674a9cd0b7df4bc0ddcf40dc', '[\"*\"]', '2025-05-25 00:06:48', NULL, '2025-05-24 23:46:19', '2025-05-25 00:06:48'),
(25, 'App\\Models\\User', 5, 'api-token', '17e115a0c8d0d3882e683f43035dfa8299455b3b1a7d520c39bb33e4f9f46ede', '[\"*\"]', NULL, NULL, '2025-05-24 23:50:44', '2025-05-24 23:50:44'),
(26, 'App\\Models\\User', 5, 'api-token', '345b57fd0ca56109db3226e36163842e1fdd29e590e40529180f6ff0bc9041b2', '[\"*\"]', '2025-05-25 00:11:38', NULL, '2025-05-25 00:09:13', '2025-05-25 00:11:38'),
(27, 'App\\Models\\User', 1, 'api-token', 'f9030ead76bcbc572c7d6bd96b5118b489cc7911e601536e27025ef85a5dc074', '[\"*\"]', NULL, NULL, '2025-05-25 01:40:52', '2025-05-25 01:40:52'),
(28, 'App\\Models\\User', 1, 'api-token', '2178c75c98a34c6581c66ea1772bf849d5ed924e1539064783ff292883f6208c', '[\"*\"]', '2025-05-25 02:08:46', NULL, '2025-05-25 01:54:32', '2025-05-25 02:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `supplier_id`, `name`, `description`, `sku`, `price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 'Iphone 12', 'Product description', 'IPH1748158086', 99999999.99, 1, '2025-05-25 01:58:06', '2025-05-25 01:58:06', NULL),
(2, 4, 1, 'New Ac', 'Product description', 'NEW1748158171', 99999999.99, 1, '2025-05-25 01:59:31', '2025-05-25 02:08:46', NULL),
(3, 4, 1, 'New Ac', 'Product description', 'NEW1748158369', 999.99, 1, '2025-05-25 02:02:49', '2025-05-25 02:02:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_email`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pratik', 'pratik@yopmail.com', '1234567890', '2025-05-24 03:32:06', '2025-05-24 03:32:06', NULL),
(2, 'Ravi', 'ravi@yopmail.com', '9898586644', '2025-05-24 03:32:06', '2025-05-24 03:32:06', NULL),
(3, 'Dwarkesh', 'dwarkesh@yopmail.com', '9898123456', '2025-05-24 03:32:06', '2025-05-24 03:32:06', NULL);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pratik', 'pratik@yopmail.com', NULL, '$2y$12$Fb0k4xjYvFnSEwAmTaDeEu3GJTrf5Tn96sd9ACgEg1TlmGq2YuQxG', NULL, '2025-05-25 01:39:50', '2025-05-25 01:39:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_logs_product_id_foreign` (`product_id`),
  ADD KEY `inventory_logs_user_id_foreign` (`user_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_contact_email_unique` (`contact_email`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_logs`
--
ALTER TABLE `inventory_logs`
  ADD CONSTRAINT `inventory_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
