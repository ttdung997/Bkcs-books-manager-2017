-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2017 at 09:42 AM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.21-1~ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BKCS_Book`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Publication_date` date NOT NULL,
  `check` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `type`, `img`, `Publication_date`, `check`, `created_at`, `updated_at`) VALUES
(78, 'giải tích', 'toán học', 'http://35.192.32.4/uploads/Đại số đại cương.png', '2017-07-27', 1, '2017-07-26 19:38:49', '2017-07-26 19:38:49'),
(79, 'SQL Server Security Distilled', 'tin học', 'http://35.192.32.4/uploads/sql.jpg', '2017-07-27', 0, '2017-07-26 19:41:25', '2017-07-26 19:41:25'),
(80, 'Real 802.11 Security: Wi-Fi Protected Access and 802.11i', 'tin học', 'http://35.192.32.4/uploads/Real 802.11 Security: Wi-Fi Protected Access and 802.11i.jpg', '2017-07-27', 0, '2017-07-26 19:42:32', '2017-07-26 19:42:32'),
(81, 'Malicious Cryptography: Exposing Cryptovirology', 'tin học', 'http://35.192.32.4/uploads/Malicious Cryptography: Exposing Cryptovirology.jpg', '2017-07-27', 0, '2017-07-26 19:44:34', '2017-07-26 19:44:34'),
(82, 'CCNP 1: Advanced Routing Companion Guide', 'tin học', 'http://35.192.32.4/uploads/CCNP 1: Advanced Routing Companion Guide .jpg', '2017-07-27', 0, '2017-07-26 19:46:13', '2017-07-26 19:46:13'),
(83, 'The CISSP prep guide', 'tin học', 'http://35.192.32.4/uploads/The CISSP prep guide.jpg', '2017-07-27', 0, '2017-07-26 19:47:39', '2017-07-26 19:47:39'),
(84, 'Security+ Guide to Network Security Fundamentals (Cyber Security)', 'tin học', 'http://35.192.32.4/uploads/Security+ Guide to Network Security Fundamentals (Cyber Security) .jpg', '2017-07-27', 0, '2017-07-26 19:48:47', '2017-07-26 19:48:47'),
(85, 'The CISSP prep guide 2', 'tin học', 'http://35.192.32.4/uploads/The CISSP prep guide.jpg', '2017-07-27', 0, '2017-07-26 19:49:44', '2017-07-26 19:49:44'),
(86, 'Security+: Exam SY0-101', 'tin học', 'http://35.192.32.4/uploads/Security+ Study Guide: Exam SY0-101.jpg', '2017-07-27', 0, '2017-07-26 19:52:12', '2017-07-26 19:52:12'),
(87, 'SQL Server Security (Osborne Networking)', 'tin học', 'http://35.192.32.4/uploads/SQL Server Security (Osborne Networking) .jpg', '2017-07-27', 0, '2017-07-26 19:54:51', '2017-07-26 19:54:51'),
(88, 'How to Break Software', 'tin học', 'http://35.192.32.4/uploads/How to Break Software.jpg', '2017-07-27', 0, '2017-07-26 19:56:04', '2017-07-26 19:56:04'),
(89, 'Using SANs and NAS', 'tin học', 'http://35.192.32.4/uploads/Using SANs and NAS.jpg', '2017-07-27', 0, '2017-07-26 19:58:13', '2017-07-26 19:58:13'),
(90, 'Implementing Intrusion Detection Systems: A Hands-On Guide for Securing the Network', 'tin học', 'http://35.192.32.4/uploads/Implementing Intrusion Detection Systems: A Hands-On Guide for Securing the Network .jpg', '2017-07-27', 0, '2017-07-26 19:59:51', '2017-07-26 19:59:51'),
(91, 'How to Break Software Security', 'tin học', 'http://35.192.32.4/uploads/How to Break Software Security .jpg', '2017-07-27', 0, '2017-07-26 20:01:27', '2017-07-26 20:01:27'),
(92, 'Web Security Sourcebook', 'tin học', 'http://35.192.32.4/uploads/Web Security Sourcebook.jpg', '2017-07-27', 0, '2017-07-26 20:03:00', '2017-07-26 20:03:00'),
(93, 'Linux Network Servers', 'tin học', 'http://35.192.32.4/uploads/Linux Network Servers.jpg', '2017-07-27', 0, '2017-07-26 20:04:16', '2017-07-26 20:04:16'),
(94, 'Building Open Source Network Security Tools: Components and Techniques', 'tin học', 'http://35.192.32.4/uploads/Building Open Source Network Security Tools: Components and Techniques.jpg', '2017-07-27', 0, '2017-07-26 20:05:37', '2017-07-26 20:05:37'),
(95, 'Time Based Security', 'tin học', 'http://35.192.32.4/uploads/Time Based Security.jpg', '2017-07-27', 0, '2017-07-26 20:08:14', '2017-07-26 20:08:14'),
(96, 'the process of network security: designing and managing a safe network', 'tin học', 'http://35.192.32.4/uploads/the process of network security: designing and managing a safe network.jpg', '2017-07-27', 0, '2017-07-26 20:09:46', '2017-07-26 20:09:46'),
(97, 'Smart Homes For Dummies', 'tin học', 'http://35.192.32.4/uploads/2799399._UY402_SS402_.jpg', '2017-07-27', 0, '2017-07-26 20:12:53', '2017-07-26 20:12:53'),
(98, 'MCSE Windows 2000 Network Security', 'tin học', 'http://35.192.32.4/uploads/MCSE Windows 2000 Network Security .jpg', '2017-07-27', 0, '2017-07-26 20:15:00', '2017-07-26 20:15:00'),
(99, 'Hacking Exposed: Windows Server 2003', 'tin học', 'http://35.192.32.4/uploads/Hacking Exposed: Windows Server 2003.jpg', '2017-07-27', 0, '2017-07-26 20:16:14', '2017-07-26 20:16:14'),
(100, 'A short course on computer viruses', 'tin học', 'http://35.192.32.4/uploads/A short course on computer viruses.jpg', '2017-07-27', 0, '2017-07-26 20:17:04', '2017-07-26 20:17:04'),
(101, 'Crime: Computer Viruses to Twin Towers', 'tin học', 'http://35.192.32.4/uploads/Crime: Computer Viruses to Twin Towers .jpg', '2017-07-27', 0, '2017-07-26 20:18:41', '2017-07-26 20:18:41'),
(102, 'Malware: Fighting Malicious Code', 'tin học', 'http://35.192.32.4/uploads/Malware: Fighting Malicious Code.jpg', '2017-07-27', 0, '2017-07-26 20:19:44', '2017-07-26 20:19:44'),
(103, 'Hacking Exposed: Network Security Secrets & Solutions, Fourth Edition', 'tin học', 'http://35.192.32.4/uploads/Hacking Exposed: Network Security Secrets & Solutions, Fourth Edition.jpg', '2017-07-27', 0, '2017-07-26 20:21:10', '2017-07-26 20:21:10'),
(104, 'Wireless Security Essentials: Defending Mobile Systems from Data Piracy', 'tin học', 'http://35.192.32.4/uploads/Wireless Security Essentials: Defending Mobile Systems from Data Piracy.jpg', '2017-07-27', 0, '2017-07-26 20:24:45', '2017-07-26 20:24:45'),
(105, 'Cryptography and e-commerce', 'tin học', 'http://35.192.32.4/uploads/Cryptography and e-commerce.jpg', '2017-07-27', 0, '2017-07-26 20:26:05', '2017-07-26 20:26:05'),
(106, 'Network security hacks', 'tin học', 'http://35.192.32.4/uploads/Network security hacks.jpg', '2017-07-27', 0, '2017-07-26 20:27:03', '2017-07-26 20:27:03'),
(107, 'Cryptography and Public Key Infrastructure on the Internet', 'toán học', 'http://35.192.32.4/uploads/Cryptography and Public Key Infrastructure on the Internet.jpg', '2017-07-27', 0, '2017-07-26 20:28:28', '2017-07-26 20:28:28'),
(108, 'Security Engineering: A Guide to Building Dependable Distributed Systems', 'tin học', 'http://35.192.32.4/uploads/Security Engineering: A Guide to Building Dependable Distributed Systems.jpg', '2017-07-27', 0, '2017-07-26 20:31:16', '2017-07-26 20:31:16'),
(109, 'Firewall Architecture for the Enterprise', 'tin học', 'http://35.192.32.4/uploads/Firewall Architecture for the Enterprise.jpg', '2017-07-27', 0, '2017-07-26 20:32:50', '2017-07-26 20:32:50'),
(110, 'The Databa Hacker\'s Handbook: Defending Database Servers', 'tin học', 'http://35.192.32.4/uploads/The Database Hacker\'s Handbook: Defending Database Servers.jpg', '2017-07-27', 0, '2017-07-26 20:34:51', '2017-07-26 20:34:51'),
(111, 'The Shellcoder\'s Handbook: Discovering and Exploiting Security Holes', 'tin học', 'http://35.192.32.4/uploads/The Shellcoder\'s Handbook: Discovering and Exploiting Security Holes.jpg', '2017-07-27', 0, '2017-07-26 20:35:54', '2017-07-26 20:35:54'),
(112, 'Hacker Debugging Uncovered', 'tin học', 'http://35.192.32.4/uploads/Hacker Debugging Uncovered.jpg', '2017-07-27', 0, '2017-07-26 20:40:14', '2017-07-26 20:40:14'),
(113, 'Intrusion Detection with SNORT', 'tin học', 'http://35.192.32.4/uploads/Intrusion Detection with SNORT.jpg', '2017-07-27', 0, '2017-07-26 20:43:47', '2017-07-26 20:43:47'),
(114, 'Deploying Secure 802.11 Wireless Networks with Microsoft Windows', 'tin học', 'http://35.192.32.4/uploads/Deploying Secure 802.11 Wireless Networks with Microsoft Windows.jpg', '2017-07-27', 0, '2017-07-26 20:46:13', '2017-07-26 20:46:13'),
(115, 'Honeypots: Tracking Hackers', 'tin học', 'http://35.192.32.4/uploads/Honeypots: Tracking Hackers.jpg', '2017-07-27', 0, '2017-07-26 20:47:07', '2017-07-26 20:47:07'),
(116, 'Building Internet Firewalls, 2nd Edition', 'tin học', 'http://35.192.32.4/uploads/Building Internet Firewalls, 2nd Edition.jpg', '2017-07-27', 0, '2017-07-26 20:48:20', '2017-07-26 20:48:20'),
(117, 'Firewalls and Internet Security, Second Edition', 'tin học', 'http://35.192.32.4/uploads/Firewalls and Internet Security:.jpg', '2017-07-27', 0, '2017-07-26 20:49:54', '2017-07-26 20:49:54'),
(118, 'Security planning & disaster recovery', 'toán học', 'http://35.192.32.4/uploads/Security planning & disaster recovery.jpg', '2017-07-27', 0, '2017-07-26 20:51:35', '2017-07-26 20:51:35'),
(119, 'Planning for Survivable Networks', 'tin học', 'http://35.192.32.4/uploads/Planning for Survivable Networks.jpg', '2017-07-27', 0, '2017-07-26 20:52:52', '2017-07-26 20:52:52'),
(120, 'Biometrics', 'toán học', 'http://35.192.32.4/uploads/Biometrics.jpg', '2017-07-27', 0, '2017-07-26 20:53:47', '2017-07-26 20:53:47'),
(121, 'Internetworking with TCP/IP Volume One, 6th Edition', 'tin học', 'http://35.192.32.4/uploads/Internetworking with TCP-IP Volume One, 6th Edition.jpg', '2017-07-27', 0, '2017-07-26 20:55:37', '2017-07-26 20:55:37'),
(122, 'SSL & TLS Essentials', 'tin học', 'http://35.192.32.4/uploads/SSL & TLS Essentials.jpg', '2017-07-27', 0, '2017-07-26 20:56:31', '2017-07-26 20:56:31'),
(123, 'Disappearing Cryptography:', 'tin học', 'http://35.192.32.4/uploads/Disappearing Cryptography: .jpg', '2017-07-27', 0, '2017-07-26 21:01:14', '2017-07-26 21:01:14'),
(124, 'Security in Computing, 3rd Edition', 'tin học', 'http://35.192.32.4/uploads/Security in Computing, 3rd Edition.jpg', '2017-07-27', 0, '2017-07-26 21:02:49', '2017-07-26 21:02:49'),
(125, 'Inside Network Perimeter Security', 'tin học', 'http://35.192.32.4/uploads/Inside Network Perimeter Security.jpg', '2017-07-27', 0, '2017-07-26 21:04:52', '2017-07-26 21:04:52'),
(126, 'Writing Secure Code', 'toán học', 'http://35.192.32.4/uploads/Writing Secure Code.jpg', '2017-07-27', 0, '2017-07-26 21:05:44', '2017-07-26 21:05:44'),
(127, 'The Art of Deception', 'tin học', 'http://35.192.32.4/uploads/The Art of Deception.jpg', '2017-07-27', 0, '2017-07-26 21:06:55', '2017-07-26 21:06:55'),
(128, 'Modern Digital and Analog Communication Systems', 'tin học', 'http://35.192.32.4/uploads/Modern Digital and Analog Communication Systems.jpg', '2017-07-27', 0, '2017-07-26 21:07:59', '2017-07-26 21:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE `book_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`id`, `name`) VALUES
(1, 'toán học'),
(2, 'tin học'),
(5, 'văn học'),
(6, 'vật lý'),
(7, 'pháp luật'),
(8, 'triết học'),
(9, 'tiểu thuyết\r\n'),
(10, 'khác');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `book_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `check` int(11) NOT NULL,
  `Lend_date` date NOT NULL,
  `Pay_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone_number`, `book_name`, `check`, `Lend_date`, `Pay_date`, `created_at`, `updated_at`) VALUES
(1, 'Trương tiến dũng', '0936167485', 'Đại số đại cương', 0, '2017-07-18', '2017-11-18', '2017-07-18 00:22:13', '2017-07-26 18:53:53'),
(2, 'trương tiến phong', '0123123123123', 'Mật mã và độ phức tạp thuật toán', 0, '2017-07-26', '2017-08-22', '2017-07-25 18:09:21', '2017-07-25 20:43:22'),
(10, 'admin', '0123123123', 'Đại số đại cương', 0, '2017-07-26', '2017-07-26', '2017-07-25 20:42:09', '2017-07-25 20:43:26'),
(11, 'asdád', '213123123', 'Đại số đại cương', 0, '2017-07-26', '2017-07-26', '2017-07-26 00:44:50', '2017-07-26 00:44:50'),
(12, '213213', 'xdsadasdasd', 'Đại số đại cương', 0, '2017-07-26', '2017-07-26', '2017-07-26 00:44:58', '2017-07-26 00:44:58'),
(13, '213123', '123123', 'Đại số đại cương', 0, '2017-07-26', '2017-07-26', '2017-07-26 00:45:06', '2017-07-26 00:45:06'),
(14, 'admin', '1245321', 'cơ sở dữ liệu', 0, '2017-07-27', '2017-07-27', '2017-07-26 18:21:02', '2017-07-26 18:21:02'),
(15, 'trương tiến dũng', '0936167485', 'The CISSP prep guide', 0, '2017-07-27', '2017-07-27', '2017-07-26 21:13:47', '2017-07-26 21:13:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_06_014950_change-me', 1),
(4, '2017_07_18_062539_create_book_table', 1),
(5, '2017_07_18_062614_create_customer_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0', 'Trương tiến dũng', 'ttdung997@gmail.com', '$2y$10$xbOPpf4MGsPZija0SDSbFeez/oly02F2UOBeWMy8yuzwil5VU6Z9a', 'QTpoBMb4YWDCPpUX6RlY7pIAFjDrbA5ec7GQXAB012vBf6AESF3hM4IPvT2q', '2017-07-18 00:07:04', '2017-07-18 00:07:04'),
(3, '0', 'tiến dũng', 'admin@gmail.com', '$2y$10$JN4X2huqDOfCjkZucRrn2OhG3lfYuDNXyvCfeKg.covUynjulrmdm', '6TvdNxatgSsFUK5br0i9eKGAra40hGfI9gNbRFG8SeDw9kzupZJxbJYBW2Tt', '2017-07-19 00:37:35', '2017-07-19 00:37:35'),
(22, NULL, 'test', 'test@gmail.com', '$2y$10$Zz/dRPHaZeepVUchs9dL4eULFy1h8scLIVIfnQztUBu15RKoQ3bOa', 'F3JDUe19sQw2VtMvyLpuEtHirkwA2rWAHiDemBpragOS8QOhXChg7Xotkc0R', '2017-07-24 20:59:49', '2017-07-24 20:59:49'),
(34, '1089068834562019', 'Tiến Dũng BL', 'dung927@yahoo.com.vn', '$2y$10$t8fpPdYVik/qFpICI4SCOuemj7qYsrlU.ShnT987KUdqdy.fQRgfu', 'qAfpjdaT6uthFVo0Yp3FVkTnfH5H6pZ7wkjdjz7fYv4OVIf2YERGCXxDaEVO', '2017-07-25 01:00:39', '2017-07-25 01:00:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
