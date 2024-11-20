-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2024 at 01:25 AM
-- Server version: 8.0.37
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `present_at` datetime NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `present_at`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12, '2021-08-25 00:00:00', 'Hadir tapi agak terlambat dikarenakan macet', '2021-08-25 00:00:00', '2021-08-25', NULL),
(3, 9, '2021-08-26 00:00:00', 'hadir', '2021-08-26 00:00:00', '2021-08-26', '2021-08-26'),
(4, 11, '2021-06-06 00:00:00', 'Kecelakaan', '2021-08-28 00:00:00', '2021-08-28', NULL),
(5, 12, '2021-08-29 00:00:00', 'Hadir', '2021-08-29 00:00:00', NULL, NULL),
(6, 12, '2021-08-29 07:59:56', 'Hadir', '2021-08-29 07:59:56', '2021-08-29', NULL),
(7, 12, '2021-08-29 08:00:23', 'Hadir', '2021-08-29 08:00:23', '2021-08-29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `concession`
--

CREATE TABLE `concession` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reason` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Dumping data for table `concession`
--

INSERT INTO `concession` (`id`, `user_id`, `reason`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'sakit', 'Gak enak badan', '2021-08-25 00:00:00', '2021-08-25 00:00:00', NULL),
(2, 4, 'izin', 'Izin ke bogor pulang', '2021-08-25 00:00:00', '2021-08-25 00:00:00', NULL),
(5, 12, 'sakit', 'lagi demam tinggi', '2021-08-27 00:00:00', '2021-08-27 00:00:00', NULL),
(6, 12, 'cuti', 'Mau ke kondangan sodara', '2021-08-27 00:00:00', '2021-08-27 00:00:00', NULL),
(7, 4, 'sakit', 'TIPES', '2021-08-28 00:00:00', '2021-08-28 00:00:00', NULL),
(8, 12, 'sakit', 'Test', '2021-08-28 00:00:00', '2021-08-28 00:00:00', NULL),
(9, 12, 'sakit', 'Lagi kena kopit', '2021-08-28 00:00:00', '2021-08-28 00:00:00', NULL);
-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super admin', '2021-08-24', '2021-08-24', NULL),
(2, 'Pimpinan', '2021-08-24', '2021-08-24', NULL),
(3, 'Staff kantor', '2021-08-24', '2021-08-28', NULL),
(4, 'Karyawan', '2021-08-24', '2021-08-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `role_id` int NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'aldiansyah ibrahim', 'aldi@gmail.com', '$2y$12$Asa.p.LIF7yKDxaW2rmEgebhL7oRYUczJyE3pDxV2Bf0LhaLY69vG', '0892928271232', 'cimareme bandung barat', 1, '2021-08-24', '2021-08-28', NULL),
(3, 'andrean', 'admin@gmail.com', '$2y$12$Asa.p.LIF7yKDxaW2rmEgebhL7oRYUczJyE3pDxV2Bf0LhaLY69vG', '0892928271232a', 'cimareme', 1, '2021-08-24', '2021-08-24', '2021-08-24'),
(4, 'Nurkamalia', 'aldispartan12@gmail.com', '$2y$10$NxytEdg0SXQORCVuSdGJfuK1O8B1dFh3lQ78cV3guFdqOzEqoPJtq', '089128931212', 'bogor', 1, '2021-08-24', '2021-08-24', NULL),
(5, 'ahmad', 'asd@asd.asd', '$2y$10$EMz5FH2L4hQWu7gIAQydWegTqmhT7kPGwx7Zrey7jGICs.ODCwsLK', '089123123123', 'bandung', 1, '2021-08-24', '2021-08-24', NULL),
(6, 'ahmad oriza', 'ahmad@gmail.com', '$2y$10$ywSpMZyWCiwCdLH1f3qMxu4KCM.AciLeKrsncaZ5QU75Jf8v64hgK', '089123123123', 'bandung', 1, '2021-08-24', '2021-08-24', NULL),
(7, 'fajar', 'fajar@gmail.com', '$2y$10$VuzHPA6h4XdUpevzs3h9N.vxRctgaXJXgGKmmR4aoo6AwRuH1AgFS', '0892189832132', 'Bandung', 4, '2021-08-24', '2021-08-25', '2021-08-25'),
(8, 'oriza ahmad', 'oriza@gmail.com', '$2y$10$k.SlAooBhzO8HoDpmez4xehle9fL3D3zmW4uWQuFt2uJo2025s4n6', '089123123123', 'Carinign', 3, '2021-08-24', '2021-08-24', NULL),
(9, 'Fajar', 'fajjar@gmail.com', '$2y$10$zop71UcFKD0sbkvff.naiOA2Ak7Qo4Xr/9kxMryEMQ7gwsBLXyEhO', '081293898123', 'Bandung', 4, '2021-08-25', '2021-08-25', NULL),
(10, 'asep nughraha', 'oday@gmail.com', '$2y$10$aaEk75UOBC1RzIKnCOuIzugyMo9RwPL5j836H.AyyTY2O3udQQfMm', '089879789789', 'Bandung', 1, '2021-08-25', '2021-08-25', '2021-08-25'),
(11, 'Binza', 'binza@gmail.com', '$2y$10$4hYwdwDFiUezMNCJ5fFxrONOqycKPWVs3GPkVzYrm2UhDv1M3uqh.', '089123123123', 'Cimareme', 3, '2021-08-26', '2021-08-26', NULL),
(12, 'aldian', 'aldian@gmail.com', '$2y$10$FYsIRlpnUSSXqpwy/B0mVecDMcTnUttWf5WgzTmQSuqTrGGGbjs6S', '089123123123', 'Cimareme', 3, '2021-08-26', '2021-08-26', NULL),
(13, 'igo', 'igo@gmail.com', '$2y$10$Wrt8CTSBMzqqCwIKtKiDZu/KIAEpPN2PvnMS/EK041O72a20JsMxS', '08929282712', 'Cimareme', 1, '2021-08-26', '2021-08-26', NULL),
(14, 'Ukuyy', 'ukuy@gmail.com', '$2y$10$n5rRKIZR8aV3vr2TezZa9uwhE3mN3PkLGeALq8ZCm3PPmMlhkdGFa', '089123123123', 'Cikole', 1, '2021-08-28', '2021-08-28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concession`
--
ALTER TABLE `concession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `concession`
--
ALTER TABLE `concession`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
