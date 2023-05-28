-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 11:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forsan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `pass` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `pass`, `active`, `type`) VALUES
(1, 'admin', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `cu_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `cu_date`, `active`) VALUES
(6, 'ziad muzaffar', '2023-05-22 22:26:29', 1),
(7, 'ziadziad', '2023-05-24 11:31:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `process_type` int(1) NOT NULL,
  `balance` double NOT NULL,
  `total` int(11) NOT NULL,
  `descr` text NOT NULL,
  `tr_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `customer_id`, `process_type`, `balance`, `total`, `descr`, `tr_date`) VALUES
(57, 17, 6, 2, 100, 100, '', '2023-05-23 11:19:05'),
(58, 17, 6, 1, 50, 50, '', '2023-05-23 11:19:17'),
(59, 18, 6, 2, 100, 100, '', '2023-05-23 11:19:43'),
(60, 22, 7, 2, 100, 100, '', '2023-05-24 11:33:28'),
(61, 22, 6, 1, 100, 0, '', '2023-05-24 13:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `balance` int(11) NOT NULL,
  `pass` text NOT NULL,
  `phone` text NOT NULL,
  `main_email` text NOT NULL,
  `email` text NOT NULL,
  `us_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `balance`, `pass`, `phone`, `main_email`, `email`, `us_date`, `active`, `type`) VALUES
(17, 'zizusoft', 0, 'zizusoft', '4534', 'zizusoft', '', '2023-05-23 11:18:52', 1, 2),
(18, 'zizusoft12', 0, 'zizusoft', '657', 'zizusoft@f', '', '2023-05-23 11:19:37', 1, 2),
(19, 'zizu', 0, 'zizuzizu', '1342432', '', 'zizu@zizu', '2023-05-23 13:22:59', 0, 2),
(20, 'zizu1', 0, 'zizu1zizu1', '765675765675765675765675', 'y yh', 'zizu1@zizu1', '2023-05-23 13:24:34', 0, 2),
(21, 'zizu2', 0, 'zizu2zizu2', '786876', 'edfd@bvg', 'zizu2@ziz', '2023-05-23 13:28:43', 0, 2),
(22, 'jhjghjgh', 0, 'jhjghjgh', '564654', 'jhjghjgh', '', '2023-05-24 10:53:25', 1, 2),
(23, 'jghjghjjghjghj', 0, 'jghjghjjghjghj', '76876', 'jghjghj', '', '2023-05-24 10:56:51', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
