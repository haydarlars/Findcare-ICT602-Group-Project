-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 09:48 PM
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
-- Database: `findcare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `snippet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `latitude`, `longitude`, `snippet`) VALUES
(1, 'Branch Kangar', 6.440745971355241, 100.20124493477769, 'Open Mon-Fri : 8am - 5pm'),
(2, 'Branch Arau', 6.441977573242018, 100.26266101596272, 'Open Mon-Fri : 8am - 5pm'),
(3, 'Branch Kuala Perlis', 6.397775477837341, 100.13129116336924, 'Open Mon-Fri : 8am - 5pm'),
(4, 'Branch Simpang Ampat', 6.334309786110492, 100.1587550788988, 'Open Mon-Fri : 8am - 5pm'),
(5, 'Branch Padang Besar', 6.662448276083791, 100.3190046306274, 'Open Mon-Fri : 8am - 5pm'),
(6, 'Branch Kaki Bukit', 6.649026518451656, 100.19117576158075, 'Open Mon-Fri : 8am - 5pm'),
(8, 'UK UiTM Shah Alam', 3.0627737, 101.5012001, 'open everyday');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `userAgent` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `email`, `date`, `time`, `location`, `userAgent`, `createdAt`) VALUES
(1, 'najmuddin', 'alif@gmail.com', '2025-02-01', '19:39:58', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 15; sdk_gphone64_x86_64 Build/AE3A.240806.005)', '2025-02-01 19:39:58'),
(2, 'User', 'haydar@gmail.com', '2025-02-01', '19:43:27', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 15; sdk_gphone64_x86_64 Build/AE3A.240806.005)', '2025-02-01 19:43:27'),
(3, 'Amier Hakimie', 'amier@gmail.com', '2025-02-01', '19:44:27', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 15; sdk_gphone64_x86_64 Build/AE3A.240806.005)', '2025-02-01 19:44:27'),
(4, 'Amier Hakimie', 'amier@gmail.com', '2025-02-01', '19:44:27', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 15; sdk_gphone64_x86_64 Build/AE3A.240806.005)', '2025-02-01 19:44:27'),
(5, 'Ipan maboi', 'ipan@gmail.com', '2025-02-01', '19:47:28', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 15; sdk_gphone64_x86_64 Build/AE3A.240806.005)', '2025-02-01 19:47:28'),
(6, 'najmuddin', 'alif@gmail.com', '2025-02-02', '04:10:37', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 14; SM-X205 Build/UP1A.231005.007)', '2025-02-01 20:10:37'),
(7, 'najmuddin', 'alif@gmail.com', '2025-02-02', '04:13:14', '3.1412, 101.6865', 'Dalvik/2.1.0 (Linux; U; Android 14; SM-X205 Build/UP1A.231005.007)', '2025-02-01 20:13:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
