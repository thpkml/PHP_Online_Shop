-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2019 at 01:51 PM
-- Server version: 8.0.13
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CL`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `username`, `rank`, `pic`, `status`, `password`) VALUES
(1, 'Kamal', 'Thapa', 'email1@gmail.com', 'admin1', '1', 'images/admin/admin1.jpg', 1, 'kamalthapa'),
(2, 'Luisa', 'Dominguez', 'email2@gmail.com', 'admin2', '1', 'images/admin/admin2.jpg', 1, 'pass2'),
(3, 'Joe', 'Johnson', 'email3@gmail.com', 'admin3', '2', 'images/admin/admin3.jpg', 1, 'pass3'),
(4, 'Mikela', 'Mikelen', 'email4@gmail.com', 'admin4', '2', 'images/admin/admin4.jpg', 1, 'pass4'),
(5, 'Chani', 'Chow', 'email5@gmail.com', 'admin5', '3', 'images/admin/admin5.jpg', 1, 'pass5'),
(6, 'Darth', 'Vader', 'email6@gmail.com', 'admin6', '3', 'images/admin/admin6.jpg', 1, 'pass6'),
(7, 'Colin', 'Cool', 'email7@gmail.com', 'admin7', '4', 'images/admin/admin7.jpg', 1, 'pass7'),
(8, 'Henry', 'The8', 'email8@gmail.com', 'admin8', '4', 'images/admin/admin8.jpg', 1, 'pass8');

--
-- Indexes for dumped tables
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
