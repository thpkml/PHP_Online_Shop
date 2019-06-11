-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2019 at 07:31 AM
-- Server version: 8.0.13
-- PHP Version: 7.1.16

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
  `id` int(8) UNSIGNED NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int(8) NOT NULL,
  `pic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `username`, `rank`, `pic`, `status`, `password`) VALUES
(1, 'Kamal', 'Thapa', 'email1@gmail.com', 'admin1', 1, 'images/admin/admin1.jpg', 1, 'kamalthapa'),
(2, 'Luisa', 'Dominguez', 'email2@gmail.com', 'admin2', 1, 'images/admin/admin2.jpg', 1, 'luisadominguez'),
(3, 'Joe', 'Johnson', 'email3@gmail.com', 'admin3', 2, 'images/admin/admin3.jpg', 1, 'pass3'),
(4, 'Mikela', 'Mikelen', 'email4@gmail.com', 'admin4', 2, 'images/admin/admin4.jpg', 1, 'pass4'),
(5, 'Chani', 'Chow', 'email5@gmail.com', 'admin5', 3, 'images/admin/admin5.jpg', 1, 'password5'),
(6, 'Darth', 'Vader', 'email6@gmail.com', 'admin6', 3, 'images/admin/admin6.jpg', 1, 'password6'),
(7, 'Colin', 'Cool', 'email7@gmail.com', 'admin7', 4, 'images/admin/admin7.jpg', 1, 'colincool'),
(8, 'Henry', 'The8', 'email8@gmail.com', 'admin8', 4, 'images/admin/admin8.jpg', 1, 'pass8');

-- --------------------------------------------------------

--
-- Table structure for table `adminmessage`
--

CREATE TABLE `adminmessage` (
  `id` int(8) UNSIGNED NOT NULL,
  `sender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminmessage`
--

INSERT INTO `adminmessage` (`id`, `sender`, `receiver`, `subject`, `message`) VALUES
(2, 'Kamal Thapa', 'Luisa Dominguez', 'about dinner', 'how about dinner?'),
(3, 'Kamal Thapa', 'Henry The8', 'howdy', 'how dy da!!'),
(4, 'Kamal Thapa', 'Luisa Dominguez', 'blah', 'blah blah'),
(5, 'Kamal Thapa', 'Joe Johnson', 'hi joe', 'how are you ?'),
(6, 'Kamal Thapa', 'Colin Cool', 'hello colin', 'cool. how u doing?'),
(7, 'Kamal Thapa', 'Darth Vader', 'Hi DV', 'This is gonna be a looong message. \r\nThis is gonna be a looong message.This is gonna be a looong message.This is gonna be a looong message.This is gonna be a looong message.This is gonna be a looong message.'),
(8, 'Luisa Dominguez', 'Kamal Thapa', 'howdyda', 'do! blah blah blah');

-- --------------------------------------------------------

--
-- Table structure for table `camping`
--

CREATE TABLE `camping` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `camping`
--

INSERT INTO `camping` (`id`, `name`, `image`, `price`, `status`, `category`) VALUES
(13, 'Tent Style1', 'images/camping/tent1.jpg', 165.00, 1, 'camping'),
(14, 'Tent Style2', 'images/camping/tent2.jpg', 165.00, 1, 'camping'),
(15, 'Tent Style3', 'images/camping/tent3.jpg', 165.00, 1, 'camping'),
(16, 'Tent Style4', 'images/camping/tent4.jpg', 165.00, 1, 'camping'),
(17, 'Tent Style5', 'images/camping/tent5.jpg', 165.00, 1, 'camping'),
(18, 'Tent Style6', 'images/camping/tent6.jpg', 165.00, 1, 'camping');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_date`) VALUES
(1, 'kamal thapa', 'kamal@email.com', 'hello there', '2019-01-04'),
(2, 'luisa', 'luisa@email.com', 'hi there', '2019-01-04'),
(3, 'john appleseed', 'apple@seed.com', 'apples are nice !', '2019-01-04'),
(4, 'john appleseed', 'apple@seed.com', 'apples are nice !', '2019-01-04'),
(5, 'Jolly ', 'Molly', 'Hi I am Jolly!\r\n', '2019-01-05'),
(6, 'Paulinan', 'dominpau@gmmail.com', 'thaanksssss for the bra! ', '2019-01-05'),
(7, '', '', '', '2019-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `contact1`
--

CREATE TABLE `contact1` (
  `id` int(8) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mens`
--

CREATE TABLE `mens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mens`
--

INSERT INTO `mens` (`id`, `name`, `image`, `price`, `status`, `category`) VALUES
(19, 'Shirt Style1', 'images/mens/shirt1.jpg', 17.00, 1, 'mens'),
(20, 'Shirt Style2', 'images/mens/shirt2.jpg', 17.00, 1, 'mens'),
(21, 'Shirt Style3', 'images/mens/shirt3.jpg', 17.00, 1, 'mens'),
(22, 'Shirt Style4', 'images/mens/shirt4.jpg', 17.00, 1, 'mens'),
(23, 'Shirt Style5', 'images/mens/shirt5.jpg', 17.00, 1, 'mens'),
(24, 'Shirt Style6', 'images/mens/shirt6.jpg', 17.00, 1, 'mens');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) UNSIGNED NOT NULL,
  `item_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gross` float(10,2) NOT NULL,
  `currency_code` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `item_number`, `txn_id`, `payment_gross`, `currency_code`, `payment_status`) VALUES
(1, '1', '33R07453CA1967449', 15.00, 'USD', 'Completed'),
(2, '4', '5MF031570T052434D', 15.00, 'USD', 'Completed'),
(3, '19', '5J617610D36075603', 17.00, 'USD', 'Completed'),
(4, '7', '24W30694DT404020D', 45.00, 'USD', 'Completed'),
(5, '19', '69K100468W061262Y', 17.00, 'USD', 'Completed'),
(6, '2', '9HS06531H63408623', 15.00, 'USD', 'Completed'),
(7, '3', '6559054655994864N', 15.00, 'USD', 'Completed'),
(8, '20', '2BS80970A06353626', 17.00, 'USD', 'Completed'),
(9, '19', '5SS73768SG0198227', 17.00, 'USD', 'Completed'),
(10, '14', '6FA62831N7932984B', 165.00, 'USD', 'Completed'),
(11, '20', '0MR81768JD960473A', 17.00, 'USD', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `status`, `category`) VALUES
(1, 'Sports Bra Style1', 'images/womens/bra1.jpg', 15.00, 1, 'womens'),
(2, 'Sports Bra Style2', 'images/womens/bra2.jpg', 15.00, 1, 'womens'),
(3, 'Sports Bra Style3', 'images/womens/bra3.jpg', 15.00, 1, 'womens'),
(4, 'Sports Bra Style4', 'images/womens/bra4.jpg', 15.00, 1, 'womens'),
(5, 'Sports Bra Style5', 'images/womens/bra5.jpg', 15.00, 1, 'womens'),
(6, 'Sports Bra Style6', 'images/womens/bra6.jpg', 15.00, 1, 'womens'),
(7, 'Trainer Style1', 'images/shoes/trainer1.jpg', 45.00, 1, 'shoes'),
(8, 'Trainer Style2', 'images/shoes/trainer2.jpg', 45.00, 1, 'shoes'),
(9, 'Trainer Style3', 'images/shoes/trainer3.jpg', 45.00, 1, 'shoes'),
(10, 'Trainer Style4', 'images/shoes/trainer4.jpg', 45.00, 1, 'shoes'),
(11, 'Trainer Style5', 'images/shoes/trainer5.jpg', 45.00, 1, 'shoes'),
(12, 'Trainer Style6', 'images/shoes/trainer6.jpg', 45.00, 1, 'shoes'),
(13, 'Tent Style1', 'images/camping/tent1.jpg', 165.00, 1, 'camping'),
(14, 'Tent Style2', 'images/camping/tent2.jpg', 165.00, 1, 'camping'),
(15, 'Tent Style3', 'images/camping/tent3.jpg', 165.00, 1, 'camping'),
(16, 'Tent Style4', 'images/camping/tent4.jpg', 165.00, 1, 'camping'),
(17, 'Tent Style5', 'images/camping/tent5.jpg', 165.00, 1, 'camping'),
(18, 'Tent Style6', 'images/camping/tent6.jpg', 165.00, 1, 'camping'),
(19, 'Shirt Style1', 'images/mens/shirt1.jpg', 17.00, 1, 'mens'),
(20, 'Shirt Style2', 'images/mens/shirt2.jpg', 17.00, 1, 'mens'),
(21, 'Shirt Style3', 'images/mens/shirt3.jpg', 17.00, 1, 'mens'),
(22, 'Shirt Style4', 'images/mens/shirt4.jpg', 17.00, 1, 'mens'),
(23, 'Shirt Style5', 'images/mens/shirt5.jpg', 17.00, 1, 'mens'),
(24, 'Shirt Style6', 'images/mens/shirt6.jpg', 17.00, 1, 'mens');

-- --------------------------------------------------------

--
-- Table structure for table `shoes`
--

CREATE TABLE `shoes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shoes`
--

INSERT INTO `shoes` (`id`, `name`, `image`, `price`, `status`, `category`) VALUES
(7, 'Trainer Style1', 'images/shoes/trainer1.jpg', 45.00, 1, 'shoes'),
(8, 'Trainer Style2', 'images/shoes/trainer2.jpg', 45.00, 1, 'shoes'),
(9, 'Trainer Style3', 'images/shoes/trainer3.jpg', 45.00, 1, 'shoes'),
(10, 'Trainer Style4', 'images/shoes/trainer4.jpg', 45.00, 1, 'shoes'),
(11, 'Trainer Style5', 'images/shoes/trainer5.jpg', 45.00, 1, 'shoes'),
(12, 'Trainer Style6', 'images/shoes/trainer6.jpg', 45.00, 1, 'shoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', '$2y$10$1drlXgDnjRO9lmCycfWI3uOFWWnxor1P8LGWe5MQPjwf4m/h3guQK'),
(2, 'user2', '$2y$10$cKqRgxaWzCcVVyFQsJgqt.3zBWPRJPn6GGP.kUqaYI4.5XBtNYSYi'),
(3, 'user3', '$2y$10$dHg27qUdts1olY5MvNnzgufHPpcE4sHeqp4EMbPwteqVTFJAvtbou'),
(4, 'user4', '$2y$10$T3sFhsQMXnsP9M7PpXFifOb1PtjXiRDFWk97O2s4LsjWfIJk4CyEK'),
(5, 'user5', '$2y$10$eB5Wl/aLokZyfSfUlAB3dOE/j50AG4Byrqhqcun6yvkxloA2x2etm'),
(6, 'user6', '$2y$10$8vpRhtha33VQ4LNnWqMKnuQG3H1TxQRaBwlEq3i97taChYISe.FDO'),
(7, 'kamalin', '$2y$10$.V0KOAPMNpYGnkf522fHoO0OotSJT9rwTdNyAljPxWykZtTYbFaVW'),
(8, 'myname', '$2y$10$IsZIYG5OsVWPJNQdKbs5c.4H/AfzJ0BL24wAdaIf6pmm7aMHGNanC');

-- --------------------------------------------------------

--
-- Table structure for table `womens`
--

CREATE TABLE `womens` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `womens`
--

INSERT INTO `womens` (`id`, `name`, `image`, `price`, `status`, `category`) VALUES
(1, 'Sports Bra Style1', 'images/womens/bra1.jpg', 15.00, 1, 'womens'),
(2, 'Sports Bra Style2', 'images/womens/bra2.jpg', 15.00, 1, 'womens'),
(3, 'Sports Bra Style3', 'images/womens/bra3.jpg', 15.00, 1, 'womens'),
(4, 'Sports Bra Style4', 'images/womens/bra4.jpg', 15.00, 1, 'womens'),
(5, 'Sports Bra Style5', 'images/womens/bra5.jpg', 15.00, 1, 'womens'),
(6, 'Sports Bra Style6', 'images/womens/bra6.jpg', 15.00, 1, 'womens');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminmessage`
--
ALTER TABLE `adminmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camping`
--
ALTER TABLE `camping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact1`
--
ALTER TABLE `contact1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mens`
--
ALTER TABLE `mens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoes`
--
ALTER TABLE `shoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `womens`
--
ALTER TABLE `womens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `adminmessage`
--
ALTER TABLE `adminmessage`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `camping`
--
ALTER TABLE `camping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact1`
--
ALTER TABLE `contact1`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mens`
--
ALTER TABLE `mens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `shoes`
--
ALTER TABLE `shoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `womens`
--
ALTER TABLE `womens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
