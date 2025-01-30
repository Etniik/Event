-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 05:36 PM
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
-- Database: `event`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `organizer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT '2025-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `start_time`, `end_time`, `location`, `organizer_id`, `created_at`, `name`, `date`) VALUES
(10, '', 'adaaaaq`', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Prishtine', 5, '2025-01-28 16:37:24', '1', '2025-01-01'),
(11, '', 'Nje event shume entuziast', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Prishtine', 7, '2025-01-30 15:41:58', 'Sunny Hill', '2025-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event_id`, `user_id`, `purchase_date`) VALUES
(4, 10, 7, '2025-01-30 15:40:11'),
(5, 10, 9, '2025-01-30 16:06:34'),
(6, 10, 10, '2025-01-30 16:11:07'),
(7, 10, 10, '2025-01-30 16:11:14'),
(8, 10, 11, '2025-01-30 16:20:33'),
(9, 10, 11, '2025-01-30 16:21:32'),
(10, 10, 11, '2025-01-30 16:24:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('organizer','participant') DEFAULT 'participant',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'test test', 'test@gmail.com', '$2y$10$hif6uAAqbiStlsVYDFwDnuUnz7JxFO/BT/u6r2O4tIqlGUXMGQ9SG', 'participant', '2025-01-23 15:49:59'),
(4, 'test', 'test2@gmail.com', '$2y$10$sG.fCugzpJLTxQN8d4ZXjOVs3mjZsRP5b6XpIsF4C8OL8Y4nfihXK', 'participant', '2025-01-28 15:56:04'),
(5, 'testii', 'testi@gmail.com', '$2y$10$pkvD9MO0nov5KX6AGUfLQOo.rS.Pdc2Ecw56LUJ1WX7ov4n.WfIzK', 'participant', '2025-01-28 16:25:23'),
(6, 'Yll', 'yll@gmail.com', '$2y$10$F4xsY7Rj7VNnjRlb3GVmSeH.Xc7ENFiZixShLipty8VJf.PBDvTn6', 'participant', '2025-01-28 16:37:52'),
(7, 'testt', 'testt@gmail.com', '$2y$10$UxgtPoL5clRKOOLMwxs9feX8814lUz0FwiBWLKEsHu60OyGBxRa7G', 'participant', '2025-01-30 15:28:51'),
(8, 'Etnik Izmaku', 'etnik332@gmail.com', '$2y$10$rBtDiI8fcD3nRFEd4acPReay4FtePERKiJRoqshYqcnXz36w7Ktme', 'participant', '2025-01-30 15:51:05'),
(9, 'Blerta ma e mira', 'blerta@gmail.com', '$2y$10$Y5Vngp0R9WJeVjUepUtYgOyTxYdpDmegFQZN5Ij/iB/BBCq68jiza', 'participant', '2025-01-30 16:05:24'),
(10, 'Dren', 'dren@gmai.com', '$2y$10$HGSCbrwot1St.qIh.UegOu.TTyp9rSGc3uld7EC.jiUoQPWxuVEri', 'participant', '2025-01-30 16:09:52'),
(11, 'baab', 'baab@gmail.com', '$2y$10$mYADcRKGsEuQ1nwf90.DIuNpZJzBFdjiwYMIMN5bGvVS3PV/ee6l.', 'participant', '2025-01-30 16:20:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organizer_id` (`organizer_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`organizer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
