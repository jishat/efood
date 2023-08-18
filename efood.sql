-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 18, 2023 at 08:42 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efood`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'arjishat@gmail.com', '$2y$10$8/c./MNFSioEo20ZgiIEzuLC1LypxXWcK57/F0JhpJL1XkLq8bIWy', '2021-09-11 08:27:10', '2023-08-17 21:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_name_bn`, `category_slug`, `created_at`, `updated_at`) VALUES
(3, 'Dessert', 'মিষ্টি', 'dessert', '2021-09-12 10:12:30', '2021-09-14 08:20:36'),
(4, 'Juice', 'জুস', 'juice', '2021-09-14 06:58:23', '2021-09-19 10:03:32'),
(5, 'Rice Dishes', 'ভাতের থালা', 'rice_dishes', '2021-09-14 08:11:29', '2021-09-14 08:11:29'),
(6, 'Chicken', 'মুরগি', 'chicken', '2021-09-14 08:22:52', '2021-09-14 08:22:52'),
(7, 'Pizza', 'পিৎজা', 'pizza', '2021-09-14 08:23:28', '2021-09-19 19:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `coupon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_name`, `coupon_name_bn`, `coupon_code`, `coupon_method`, `coupon_value`, `coupon_quantity`, `coupon_expired_at`, `created_at`, `updated_at`) VALUES
(1, 'Bijoy Offer', 'বিজয় অফার', 'BJ2021', 'cash', '40', '198', '2021-10-31 00:00:00', '2021-09-16 11:28:55', '2021-09-26 19:27:56'),
(6, 'Cyclone offer', 'সাইক্লোন অফার', 'CYCLONE2021', 'percentage', '20', '195', '2021-10-31 00:00:00', '2021-09-16 18:39:30', '2021-09-26 19:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verify` tinyint NOT NULL,
  `rand_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_password`, `is_verify`, `rand_id`, `created_at`, `updated_at`) VALUES
(17, 'AR Jishat', 'arjishat@gmail.com', '$2y$10$I5iSYJWuSWwkiNKOvp6A6uzVEWXAp3skwRcTwkPS5e9he2Ff8ymTG', 1, '', '2021-09-24 10:25:59', '2021-09-24 17:29:03'),
(18, 'MR Demo', 'demo@mail.com', '$2y$10$ZexnvoMcAtyI7B1K2NtdUuQyCINsSKjA9.1w.P9r7tm4b6qTN6GUC', 1, '', '2021-09-26 10:09:36', '2021-09-26 10:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_09_182737_create_admins_table', 1),
(6, '2021_09_11_102634_create_categories_table', 2),
(7, '2021_09_14_134559_add_category_name_bn_to_categories_table', 3),
(8, '2021_09_14_210827_create_coupons_table', 4),
(9, '2021_09_15_184237_rename_coupon_total_column', 5),
(10, '2021_09_16_164242_add_coupon_name_bn_to_coupons_table', 6),
(11, '2021_09_17_012843_create_products_table', 7),
(12, '2021_09_17_015822_alter_table_products', 8),
(13, '2021_09_18_140301_add_product_img_to_products_table', 9),
(14, '2021_09_21_221906_create_customers_table', 10),
(15, '2021_09_21_230801_create_customers_table', 11),
(16, '2021_09_24_022619_alter_table_customers', 12),
(17, '2021_09_26_002513_create_orders_table', 13),
(18, '2021_09_26_032835_create_order_details_table', 14),
(19, '2021_09_26_175107_alter_table_order_details', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` bigint NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` double NOT NULL,
  `shipping_cost` double NOT NULL,
  `discount` double NOT NULL,
  `total_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `name`, `mobile`, `city`, `district`, `address`, `order_notes`, `sub_total`, `shipping_cost`, `discount`, `total_amount`, `created_at`, `updated_at`) VALUES
(9, 18, 'MR Demo', '01782517788', 'Motijeel', 'Dhaka', 'sdfsfsdfsdf', 'xcxcvxcxvcv', 570, 30, 114, 486, '2021-09-26 12:44:43', '2021-09-26 12:44:43'),
(10, 17, 'AR Jishat', '01837709650', 'Chattogram', 'Chattogram', 'sdfsdfsdf', 'dfsfsdf', 300, 30, 60, 270, '2021-09-26 17:50:52', '2021-09-26 17:50:52'),
(11, 18, 'MR Demo', '01892874939', 'Badda', 'Dhaka', '123 street badda', 'call me before deliver', 420, 30, 84, 366, '2021-09-26 19:08:36', '2021-09-26 19:08:36'),
(12, 18, 'MR Demo', '01892874939', 'Badda', 'Dhaka', 'ssdsd', 'sdsds', 400, 30, 80, 350, '2021-09-26 19:23:16', '2021-09-26 19:23:16'),
(13, 18, 'MR Demo', '01892874939', 'Motijeel', 'Dhaka', '123 street house xyz', 'try to deliver asap', 945, 30, 40, 935, '2021-09-26 19:27:56', '2021-09-26 19:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `product_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_img`, `product_name`, `price`, `quantity`) VALUES
(14, 9, 3, 'http://localhost:8000/storage/media/1632053901.webp', 'Chicken grill (1 pc)', 90, 3),
(15, 9, 5, 'http://localhost:8000/storage/media/1632076950.webp', 'Sweets (1 kg)', 220, 1),
(16, 9, 2, 'http://localhost:8000/storage/media/1632053774.webp', 'Chicken fry (4pc)', 80, 1),
(17, 10, 2, 'http://localhost:8000/storage/media/1632053774.webp', 'Chicken fry (4pc)', 80, 1),
(18, 10, 5, 'http://localhost:8000/storage/media/1632076950.webp', 'Sweets (1 kg)', 220, 1),
(19, 11, 1, 'http://localhost:8000/storage/media/1632059857.webp', 'Chicken Kabab 1pc', 70, 1),
(20, 11, 6, 'http://localhost:8000/storage/media/1632077034.webp', 'Cake', 50, 3),
(21, 11, 9, 'http://localhost:8000/storage/media/1632077384.webp', 'Fruit Juice (1 ltr)', 100, 2),
(22, 12, 1, 'http://localhost:8000/storage/media/1632059857.webp', 'Chicken Kabab 1pc', 70, 2),
(23, 12, 2, 'http://localhost:8000/storage/media/1632053774.webp', 'Chicken fry (4pc)', 80, 1),
(24, 12, 3, 'http://localhost:8000/storage/media/1632053901.webp', 'Chicken grill (1 pc)', 90, 2),
(25, 13, 18, 'http://localhost:8000/storage/media/1632078577.webp', 'Vegetable Juice (1 ltr)', 90, 1),
(26, 13, 19, 'http://localhost:8000/storage/media/1632079666.webp', 'Chicken Sausage Pizza (8 inch)', 710, 1),
(27, 13, 12, 'http://localhost:8000/storage/media/1632077797.webp', 'Sweet Yogurt', 30, 4),
(28, 13, 13, 'http://localhost:8000/storage/media/1632077866.webp', 'Ice Cream', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name_bn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slug`, `product_img`, `product_name_bn`, `product_price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Chicken Kabab 1pc', 'chicken-kabab', '1632059857.webp', 'চিকেন কাবাব ১পিস', 70, 6, '2021-09-19 10:44:55', '2021-09-19 13:57:37'),
(2, 'Chicken fry (4pc)', 'chicken-fry', '1632053774.webp', 'চিকেন ফ্রাই (4 পিসি)', 80, 6, '2021-09-19 12:16:14', '2021-09-19 12:16:14'),
(3, 'Chicken grill (1 pc)', 'chicken-grill', '1632053901.webp', 'চিকেন গ্রিল', 90, 6, '2021-09-19 12:18:21', '2021-09-19 12:18:21'),
(5, 'Sweets (1 kg)', 'sweets', '1632076950.webp', 'মিষ্টি সামগ্রী (১ কি:গ্রা)', 220, 3, '2021-09-19 18:42:32', '2021-09-19 18:42:32'),
(6, 'Cake', 'cake', '1632077034.webp', 'কেক', 50, 3, '2021-09-19 18:43:54', '2021-09-19 18:43:54'),
(7, 'Fried rice with chicken', 'fried-rice-with-chicken', '1632077153.webp', 'চিকেন দিয়ে ভাজা ভাত', 120, 5, '2021-09-19 18:45:53', '2021-09-19 18:45:53'),
(8, 'Mutton dum biryani', 'mutton-dum-biryani', '1632077264.webp', 'মাটন দম বিরিয়ানি', 220, 5, '2021-09-19 18:47:44', '2021-09-19 18:47:44'),
(9, 'Fruit Juice (1 ltr)', 'fruit-juice', '1632077384.webp', 'ফলের জুস (১ লিটার)', 100, 4, '2021-09-19 18:49:44', '2021-09-19 18:49:44'),
(10, 'Chicken Burger', 'chicken-burger', '1632077490.webp', 'মুরগির বার্গার', 70, 6, '2021-09-19 18:51:30', '2021-09-19 18:51:30'),
(11, 'Pitha', 'pitha', '1632077699.webp', 'পিঠা', 45, 3, '2021-09-19 18:54:59', '2021-09-19 18:54:59'),
(12, 'Sweet Yogurt', 'sweet-yogurt', '1632077797.webp', 'মিষ্টি দই', 30, 3, '2021-09-19 18:56:37', '2021-09-19 18:56:37'),
(13, 'Ice Cream', 'ice-cream', '1632077866.webp', 'আইসক্রিম', 25, 3, '2021-09-19 18:57:46', '2021-09-19 18:57:46'),
(14, 'Chicken Biryani', 'chicken-biryani', '1632077979.webp', 'মুরগি বিরিয়ানি', 110, 5, '2021-09-19 18:59:39', '2021-09-19 18:59:39'),
(15, 'Chicken polao', 'chicken-polao', '1632078071.webp', 'মুরগির পোলাও', 115, 5, '2021-09-19 19:01:11', '2021-09-19 19:01:11'),
(16, 'Akhni Biryani', 'akhni-biryani', '1632078301.webp', 'আখনি বিরিয়ানি', 240, 5, '2021-09-19 19:05:01', '2021-09-19 19:05:01'),
(17, 'Chicken kacchi', 'chicken-kacchi', '1632078398.webp', 'চিকেন কাচ্চি', 110, 5, '2021-09-19 19:06:38', '2021-09-19 19:06:38'),
(18, 'Vegetable Juice (1 ltr)', 'vegetable-juice', '1632078577.webp', 'শাকসবজির জুস (১ লিটার)', 90, 4, '2021-09-19 19:09:37', '2021-09-19 19:09:37'),
(19, 'Chicken Sausage Pizza (8 inch)', 'chicken-sausage-pizza', '1632079666.webp', 'চিকেন সসেজ পিৎজা (৮ ইঞ্চি)', 710, 7, '2021-09-19 19:27:47', '2021-09-19 19:27:47'),
(20, 'Chicken Mushroom Pizza (8 inch)', 'chicken-mushroom-pizza', '1632079762.webp', 'চিকেন মাশরুম পিজ্জা (৮ ইঞ্চি)', 550, 7, '2021-09-19 19:29:23', '2021-09-19 19:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jishat', 'arjishat@gmail.com', NULL, '$2y$10$I5iSYJWuSWwkiNKOvp6A6uzVEWXAp3skwRcTwkPS5e9he2Ff8ymTG', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_name_unique` (`coupon_name`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
