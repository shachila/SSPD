-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 11:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network_monitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `ping_result` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id`, `ip_address`, `status`, `ping_result`, `created_at`) VALUES
(1, 'google.com', 'up', 'successful', '2023-02-13 05:53:50'),
(2, '10.10.10.10', 'down', 'unsuccessful', '2023-02-13 05:54:02'),
(3, '10.10.10.10', 'down', 'unsuccessful', '2023-02-13 05:54:41'),
(4, 'google.com', 'up', 'successful', '2023-02-13 05:54:51'),
(5, 'google.com', 'up', 'successful', '2023-02-13 06:06:59'),
(6, '10.10.10.10', 'down', 'unsuccessful', '2023-02-13 06:07:47'),
(7, '10.10.10.10', 'down', 'unsuccessful', '2023-02-13 06:14:49'),
(8, 'google.com', 'up', 'successful', '2023-02-13 06:15:00'),
(9, '10.10.10.10 ', 'down', 'unsuccessful', '2023-02-13 06:15:14'),
(10, '10.10.10.10 ', 'down', 'unsuccessful', '2023-02-13 06:17:49'),
(11, '10.10.10.10 ', 'down', 'unsuccessful', '2023-02-13 06:20:27'),
(12, 'humber.ca', 'up', 'successful', '2023-02-13 06:21:50'),
(13, 'shubham.ca', 'up', 'successful', '2023-02-13 19:33:27'),
(14, 'shubham.ca', 'up', 'successful', '2023-02-13 19:35:02'),
(15, '20.119.70.101', 'down', 'unsuccessful', '2023-02-13 20:21:06'),
(16, '20.119.70.101', 'down', 'unsuccessful', '2023-02-13 20:22:57'),
(17, '20.119.70.101', 'down', 'unsuccessful', '2023-02-13 20:24:57'),
(18, '20.119.70.101', 'down', 'unsuccessful', '2023-02-13 20:25:47'),
(19, '20.119.70.101', 'down', 'unsuccessful', '2023-02-13 20:54:31'),
(20, '10.1.0.4', 'down', 'unsuccessful', '2023-02-13 20:55:07'),
(21, 'shubham.ca', 'down', 'unsuccessful', '2023-02-14 22:55:29'),
(22, 'shubham.ca', 'up', 'successful', '2023-02-14 22:55:59'),
(23, 'dhruv.com', 'up', 'successful', '2023-02-14 22:57:06'),
(24, '10.10.5.5', 'down', 'unsuccessful', '2023-02-14 23:21:49'),
(25, '1.1.1.1', 'up', 'successful', '2023-02-21 20:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `network_status`
--

CREATE TABLE `network_status` (
  `id` int(6) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `network_status`
--

INSERT INTO `network_status` (`id`, `ip_address`, `status`, `date_added`) VALUES
(1, '192.168.1.2', '', '2023-02-14 04:58:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_status`
--
ALTER TABLE `network_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `network_status`
--
ALTER TABLE `network_status`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
