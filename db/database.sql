-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2025 at 02:39 PM
-- Server version: 8.0.44-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coachconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
                           `coach_id` int NOT NULL,
                           `exp_years` int DEFAULT '0',
                           `bio` text,
                           `pic_url` text,
                           `niveau` enum('master','professionel','debutant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
                               `id` int NOT NULL,
                               `coach_id` int DEFAULT NULL,
                               `sportif_id` int DEFAULT NULL,
                               `seance_id` int DEFAULT NULL,
                               `status` enum('confirmed','in progress','declined') DEFAULT NULL,
                               `date_reserved` date DEFAULT (curdate())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seances`
--

CREATE TABLE `seances` (
                           `id` int NOT NULL,
                           `coach_id` int DEFAULT NULL,
                           `date_seance` date DEFAULT NULL,
                           `start` timestamp NULL DEFAULT NULL,
                           `end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sportifs`
--

CREATE TABLE `sportifs` (
                            `sportif_id` int DEFAULT NULL,
                            `status` enum('banned','active') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `user_id` int NOT NULL,
                         `nom` varchar(40) NOT NULL,
                         `email` varchar(100) NOT NULL,
                         `password` text NOT NULL,
                         `phone` varchar(10) DEFAULT NULL,
                         `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                         `role` enum('sportif','coach') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
    ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
    ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `sportif_id` (`sportif_id`),
  ADD KEY `seance_id` (`seance_id`);

--
-- Indexes for table `seances`
--
ALTER TABLE `seances`
    ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`);

--
-- Indexes for table `sportifs`
--
ALTER TABLE `sportifs`
    ADD KEY `sportif_id` (`sportif_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seances`
--
ALTER TABLE `seances`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
    ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
    ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`sportif_id`) REFERENCES `sportifs` (`sportif_id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`seance_id`) REFERENCES `seances` (`id`);

--
-- Constraints for table `seances`
--
ALTER TABLE `seances`
    ADD CONSTRAINT `seances_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coaches` (`coach_id`);

--
-- Constraints for table `sportifs`
--
ALTER TABLE `sportifs`
    ADD CONSTRAINT `sportifs_ibfk_1` FOREIGN KEY (`sportif_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;