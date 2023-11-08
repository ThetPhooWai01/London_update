-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 03:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `london`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_1`
--

CREATE TABLE `user_1` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_1`
--

INSERT INTO `user_1` (`product_name`, `price`, `qty`, `total`, `tra_id`, `type`, `voucher`, `id`) VALUES
('စပွန်ဆာ', 100, 6, 600, '26802069', 'ဗူး/ခု', 'လက်လီ', 129),
('စပွန်ဆာ', 100, 5, 500, '42483138', 'ဗူး/ခု', 'လက်လီ', 130),
('ကျွဲခေါင်း ပုလင်း', 3700, 1, 3700, '94067865', 'ဗူး/ခု', 'လက်လီ', 131);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_1`
--
ALTER TABLE `user_1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_1`
--
ALTER TABLE `user_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
