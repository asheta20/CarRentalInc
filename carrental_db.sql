-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 23, 2024 at 10:10 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `car_option` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `additional_info` text,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `full_name`, `email`, `car_option`, `start_date`, `end_date`, `additional_info`, `attachment`, `created_at`) VALUES
(11, 'erion boobs', 'broom@mail.com', 'Toyota Yaris 1.6 Turbo 2021', '2024-05-23 09:13:00', '2024-05-23 13:09:00', 'saddd', NULL, '2024-05-22 19:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `Inquiry` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `File` longblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `email`, `category`, `Inquiry`, `File`, `created_at`) VALUES
(1, 'darlingselita17@gmail.com', '0', 'xccxcx', NULL, '2024-05-18 23:04:44'),
(2, 'albanhysa17@gmail.com', '0', 'nxsnnxn', NULL, '2024-05-18 23:04:51'),
(3, 'albanhysa17@gmail.com', '0', 'saddsa', NULL, '2024-05-21 06:28:09'),
(4, 'albanhysa17@gmail.com', 'Other', 'djdjdjdjdjsjsjssasss', NULL, '2024-05-22 21:43:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'Darli', 'Selita', 'Adssaj', 'admin@gmail.com', '$2y$10$VN720ZMF2DLINIMJ9MgIh.Wi9ZDu4uIxQ1y.fXC7X7E7tl3lZ5knC', '2024-05-18 21:58:45'),
(2, 'John', 'Doe', 'johndoe123', 'john.doe@example.com', '$2y$10$gMtxu68N105kbpEKIoORWe42JOLA3yj.I8tfu6NnkiTi.k9vRFcqK', '2024-05-18 22:36:03'),
(5, 'gruba', 'luba', 'grubaluba123', 'gruba.luba@gmail.com', '$2y$10$lVCU5cxdGaYsybJMgNcAFOV4K88hYEIe4lSjA.ZApyer9X1oKNvUW', '2024-05-18 22:40:22'),
(6, 'Tech', 'Support', 'Bangerbanzi', 'TechSupport@yahoo.com', '$2y$10$fE8p6G2baTn7NqXqC7Kc4uUud8J3bz67FcDVEpLpnnUXdWvNjNZ/2', '2024-05-21 22:55:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
