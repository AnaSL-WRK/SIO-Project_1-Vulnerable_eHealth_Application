-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Nov 15, 2022 at 06:14 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIO`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` int DEFAULT NULL,
  `date` date NOT NULL,
  `department` varchar(64) NOT NULL,
  `doctor` varchar(64) NOT NULL,
  `message` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`name`, `email`, `phone`, `date`, `department`, `doctor`, `message`) VALUES
('José António', 'jo.toni@gmail.com', NULL, '2022-11-22', 'Checkup', 'Dr. Aaron Glassman', ''),
('Joaquim Silveira', 'jocas.sivs@gmail.com', 930912364, '2022-12-02', 'Checkup', 'Dr. Shawn Murphy', ''),
('Maria Constantina', 'mcmcmc@gmail.com', NULL, '2023-02-10', 'Surgery', 'Dr. Shawn Murphy', 'preciso de costas novas');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `subject` varchar(64) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES
('hacker', 'hacker@gmail.com', 'oops', '<script>alert(\"Youve been hacked!\")</script>'),
('Maria da luz', 'mdl@gmail.com', 'Informações', 'Queria saber se era preciso fazer jejum para as analises');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `code` int NOT NULL,
  `NHS` int NOT NULL,
  `size` int NOT NULL,
  `pdfname` varchar(64) NOT NULL,
  `downloads` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`code`, `NHS`, `size`, `pdfname`, `downloads`) VALUES
(123123123, 987654321, 42, 'phpBoZ5Ic', 3),
(666666666, 987654321, 52, 'phpDkMOKH', NULL),
(999999999, 987654321, 127728, 'php8UUmZt', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `userType` varchar(255) NOT NULL DEFAULT 'normal',
  `name` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` bigint NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(255) NOT NULL,
  `DOB` date NOT NULL,
  `NHS` int NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userType`, `name`, `email`, `phone`, `address`, `postal`, `city`, `DOB`, `NHS`, `password`) VALUES
(1, 'admin', 'eHealth Corp', 'eHealth@ies.com', 351252409100, 'Universidade de Aveiro', '0000-000', 'Aveiro', '2002-07-25', 111111111, 'admin'),
(2, 'normal', 'Maria da Luz Alberta', 'mdl123@gmail.com', 911111111, 'Rua Padre José Maria Taborda', '3804-012', 'Aveiro', '1953-01-27', 987654321, 'mdl123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
