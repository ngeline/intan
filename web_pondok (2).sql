-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2023 at 02:50 PM
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
-- Database: `web_pondok`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `nama`, `createdAt`, `updatedAt`) VALUES
(3, 1, 'admin', '2023-01-23 22:22:31', '2023-01-23 22:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Group untuk pengguna administrator website'),
(2, 'wali santri', 'Group untuk pengguna wali santri di web pondok');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 1),
(2, 2),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 3),
(2, 8),
(2, 10),
(2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin@gmail.com', 1, '2023-01-23 14:22:39', 1),
(2, '::1', 'admin@gmail.com', 1, '2023-01-23 14:24:09', 1),
(3, '::1', 'admin@gmail.com', 1, '2023-01-23 14:27:28', 1),
(4, '::1', 'admin@gmail.com', 1, '2023-01-23 14:50:06', 1),
(5, '::1', 'admin@gmail.com', NULL, '2023-01-23 14:50:35', 0),
(6, '::1', 'admin@gmail.com', 1, '2023-01-23 14:50:41', 1),
(7, '::1', 'admin@gmail.com', 1, '2023-01-24 21:39:17', 1),
(8, '::1', 'admin@gmail.com', 1, '2023-01-25 13:22:13', 1),
(9, '::1', 'admin@gmail.com', 1, '2023-01-25 13:37:00', 1),
(10, '::1', 'admin@gmail.com', 1, '2023-01-25 13:47:44', 1),
(11, '::1', 'admin@gmail.com', 1, '2023-01-25 13:49:54', 1),
(12, '::1', 'admin@gmail.com', 1, '2023-01-28 11:36:32', 1),
(13, '::1', 'admin@gmail.com', 1, '2023-01-28 13:26:56', 1),
(14, '::1', 'admin@gmail.com', 1, '2023-01-28 13:28:59', 1),
(15, '::1', 'admin@gmail.com', 1, '2023-01-28 13:31:24', 1),
(16, '::1', 'admin@gmail.com', 1, '2023-01-28 13:41:49', 1),
(17, '::1', 'admin@gmail.com', NULL, '2023-01-28 15:44:12', 0),
(18, '::1', 'admin', NULL, '2023-01-28 15:44:17', 0),
(19, '::1', 'admin', NULL, '2023-01-28 15:44:29', 0),
(20, '::1', 'admin', NULL, '2023-01-28 15:45:10', 0),
(21, '::1', 'admin@gmail.com', NULL, '2023-01-28 15:45:28', 0),
(22, '::1', 'admin', NULL, '2023-01-28 15:47:24', 0),
(23, '::1', 'admin', NULL, '2023-01-28 15:47:36', 0),
(24, '::1', 'admin', NULL, '2023-01-28 15:48:12', 0),
(25, '::1', 'admin', NULL, '2023-01-28 15:50:01', 0),
(26, '::1', 'admin', NULL, '2023-01-28 15:50:05', 0),
(27, '::1', 'admin@gmail.com', 1, '2023-01-28 15:50:27', 1),
(28, '::1', 'admin', NULL, '2023-01-28 15:51:56', 0),
(29, '::1', 'admin@gmail.com', 1, '2023-01-29 01:47:04', 1),
(30, '::1', 'admin@gmail.com', 1, '2023-01-29 07:45:22', 1),
(31, '::1', 'admin@gmail.com', 1, '2023-01-30 12:25:00', 1),
(32, '::1', 'eklesia', 8, '2023-01-30 13:23:20', 0),
(33, '::1', 'Eklesia@gmail.com', 8, '2023-01-30 13:23:54', 1),
(34, '::1', 'admin@gmail.com', 1, '2023-01-30 14:03:56', 1),
(35, '::1', 'Eklesia@gmail.com', 8, '2023-01-30 14:05:42', 1),
(36, '::1', 'eklesia', NULL, '2023-01-30 14:13:29', 0),
(37, '::1', 'Eklesia@gmail.com', 8, '2023-01-30 14:13:36', 1),
(38, '::1', 'admin@gmail.com', 1, '2023-02-08 13:15:19', 1),
(39, '::1', 'admin@gmail.com', 1, '2023-02-17 15:45:15', 1),
(40, '::1', 'Eklesia@gmail.com', 8, '2023-02-17 16:57:17', 1),
(41, '::1', 'alvaro@gmail.com', 9, '2023-02-17 17:20:49', 1),
(42, '::1', 'test@gmail.com', 10, '2023-02-17 17:40:36', 1),
(43, '::1', 'admin@gmail.com', 1, '2023-02-17 18:05:45', 1),
(44, '::1', 'test', 10, '2023-02-17 18:13:01', 0),
(45, '::1', 'test', NULL, '2023-02-17 18:20:14', 0),
(46, '::1', 'test', 10, '2023-02-17 18:20:23', 0),
(47, '::1', 'admin@gmail.com', 1, '2023-02-18 11:49:34', 1),
(48, '::1', 'admin@gmail.com', 1, '2023-02-18 12:15:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'Dashboard', 'Dashboard aplikasi web pondok'),
(2, 'My Profile', 'Mengelola data diri pengguna'),
(3, 'Santri', 'Mengelola data santri'),
(4, 'Wali Santri', 'Mengelola data Wali Santri'),
(5, 'Kelas', 'Mengelola data Kelas'),
(6, 'SPP', 'Mengelola data Sumbangan Pembinaan Pendidikan'),
(7, 'User', 'Mengelola data user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int UNSIGNED NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_admin`, `nama_kelas`, `createdAt`, `updatedAt`) VALUES
(13, 3, 'Tadika Mesra', '2023-01-24 21:48:47', '2023-01-24 21:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-01-18-231215', 'App\\Database\\Migrations\\User', 'default', 'App', 1674084566, 1),
(2, '2023-01-18-231414', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1674084566, 1),
(9, '2023-01-18-232153', 'App\\Database\\Migrations\\Kelas', 'default', 'App', 1674084784, 2),
(10, '2023-01-18-232238', 'App\\Database\\Migrations\\Santri', 'default', 'App', 1674084784, 2),
(11, '2023-01-18-232240', 'App\\Database\\Migrations\\Spp', 'default', 'App', 1674084784, 2),
(12, '2023-01-18-232442', 'App\\Database\\Migrations\\Walisantri', 'default', 'App', 1674084784, 2),
(13, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1674483080, 3),
(15, '2023-02-18-120946', 'App\\Database\\Migrations\\TempSpp', 'default', 'App', 1676724495, 4);

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `nis` varchar(10) NOT NULL,
  `id_kelas` int UNSIGNED NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `status_santri` varchar(10) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`nis`, `id_kelas`, `id_admin`, `nama_santri`, `jenis_kelamin`, `status_santri`, `createdAt`, `updatedAt`) VALUES
('123343', 13, 3, 'Budi Tabudin', 'Laki-laki', 'Aktif', '2023-01-24 22:19:50', '2023-01-24 22:34:05'),
('1827493', 13, 3, 'Adam Malik', 'Laki-laki', 'Aktif', '2023-01-24 22:22:28', '2023-01-24 22:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int UNSIGNED NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_iuran` int NOT NULL,
  `foto` text,
  `keterangan` text,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `id_admin`, `nis`, `nama_santri`, `tanggal`, `jumlah_iuran`, `foto`, `keterangan`, `createdAt`, `updatedAt`) VALUES
(2, 3, '123343', 'Budi Tabudin', '2023-01-29', 200000, NULL, 'Pembayaran SPP semester', NULL, '2023-01-29 08:46:37'),
(26, 3, '123343', 'Budi Tabudin', '2023-01-30', 2000, NULL, 'check rekening', '2023-01-30 14:05:26', '2023-01-30 14:05:26'),
(32, 3, '1827493', 'Adam Malik', '2023-02-18', 200000, '', 'TEST', '2023-02-18 14:45:23', '2023-02-18 14:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `temp_spp`
--

CREATE TABLE `temp_spp` (
  `id` int UNSIGNED NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_iuran` int NOT NULL,
  `foto` text NOT NULL,
  `keterangan` text,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$FZF9jlFLdMyRiBnQ1Uolb.oolmkPuvqZCSNzgKYpZ1UKCCIJDYb8e', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-01-23 14:22:29', '2023-01-30 13:22:55', NULL),
(3, 'Mahmud Jalaludin@gmail.com', 'Mahmud Jalaludin', '$2y$10$GyUCrr5hEEvG6D/x2oZcweSPpPXr6bfQKoldAcPBYAYgct5BbzuBW', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, NULL),
(8, 'Eklesia@gmail.com', 'Eklesia', '$2y$10$zmWIZGcuNJrl1CkG4k2HaeWDBVW13f2SVhX8OCcKKx2UUy1mHx05G', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-01-30 12:46:18', '2023-01-30 13:36:59', NULL),
(9, 'alvaro@gmail.com', 'alvaro fuzhi', '$2y$10$oSxgLjYEXLSP77oY6XNZtOep5AAPPYNy.cTJcsHhcN45VPJAZIKW.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-17 17:20:30', '2023-02-17 17:20:30', NULL),
(10, 'test@gmail.com', 'test', '$2y$10$Cb1.DkRxQ0gCVsqcV.tAhu6kaCARw.HkZVY0iQoSqfb0UU91CBKVq', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2023-02-17 17:40:26', '2023-02-17 18:03:42', NULL),
(11, 'tester@gmail.com', 'tester', '$2y$10$2d4H7rREou818aJVKNtsqeMsbrLSkI/kuX87Gx39keC/IiX0HMCTu', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-02-18 11:56:10', '2023-02-18 11:56:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `walisantri`
--

CREATE TABLE `walisantri` (
  `id` int UNSIGNED NOT NULL,
  `id_user` int UNSIGNED NOT NULL,
  `nis` varchar(10) NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `nama_walisantri` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat` varchar(15) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `usia_santri` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `nama_ayah` varchar(25) NOT NULL,
  `nama_ibu` varchar(25) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `pekerjaan_ayah` varchar(20) NOT NULL,
  `pekerjaan_ibu` varchar(20) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `walisantri`
--

INSERT INTO `walisantri` (`id`, `id_user`, `nis`, `id_admin`, `nama_walisantri`, `jenis_kelamin`, `tempat`, `tanggal_lahir`, `usia_santri`, `alamat`, `nama_ayah`, `nama_ibu`, `no_telepon`, `pekerjaan_ayah`, `pekerjaan_ibu`, `createdAt`, `updatedAt`) VALUES
(1, 3, '1827493', 3, 'Mahmud Jalaludin', 'Laki-laki', 'Kediri', '2010-06-28', '13', 'Jl. Bersama siapa', 'Badi', 'Bunga', '081273840173', 'Programmer', 'Ibu Rumah Tanggah', '2023-01-28 15:53:53', '2023-01-29 03:32:44'),
(3, 8, '1827493', 3, 'Eklesia', 'Laki-laki', 'Kediri', '1999-02-28', '23', 'Jl. Sumenep No. 23 Surabaya', 'Eklesia', 'Alvina', '08290194831', 'Karyawan Swasta', 'Karyawan Swasta', '2023-01-30 12:46:18', '2023-01-30 13:36:59'),
(10, 10, '123343', 3, 'test', 'Laki-laki', 'Kediri', '2000-02-12', '22', 'Kediri, Jawa Timur', 'Ayah', 'Ibu', '08172371293', 'Kerja', 'Kerja', '2023-02-17 18:03:42', '2023-02-17 18:03:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `admin_id_user_foreign` (`id_user`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `kelas_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `santri_id_kelas_foreign` (`id_kelas`),
  ADD KEY `santri_id_admin_foreign` (`id_admin`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spp_id_admin_foreign` (`id_admin`),
  ADD KEY `spp_nis_foreign` (`nis`);

--
-- Indexes for table `temp_spp`
--
ALTER TABLE `temp_spp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_spp_id_admin_foreign` (`id_admin`),
  ADD KEY `temp_spp_nis_foreign` (`nis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `walisantri`
--
ALTER TABLE `walisantri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `walisantri_nis_foreign` (`nis`),
  ADD KEY `walisantri_id_user_foreign` (`id_user`),
  ADD KEY `walisantri_id_admin_foreign` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `temp_spp`
--
ALTER TABLE `temp_spp`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `walisantri`
--
ALTER TABLE `walisantri`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `santri`
--
ALTER TABLE `santri`
  ADD CONSTRAINT `santri_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `santri_id_kelas_foreign` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spp`
--
ALTER TABLE `spp`
  ADD CONSTRAINT `spp_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spp_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `santri` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temp_spp`
--
ALTER TABLE `temp_spp`
  ADD CONSTRAINT `temp_spp_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_spp_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `santri` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `walisantri`
--
ALTER TABLE `walisantri`
  ADD CONSTRAINT `walisantri_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `walisantri_id_admin_foreign` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `walisantri_nis_foreign` FOREIGN KEY (`nis`) REFERENCES `santri` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
