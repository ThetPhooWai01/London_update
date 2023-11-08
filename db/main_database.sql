-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 01:08 PM
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
-- Database: `cp175972_imeplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `name` text NOT NULL,
  `ph_no` text NOT NULL,
  `address` text NOT NULL,
  `role` text NOT NULL,
  `total_buy` float NOT NULL,
  `debt` float NOT NULL,
  `pay` float NOT NULL,
  `balance` float NOT NULL,
  `remain_debt` float NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `name` text NOT NULL,
  `voucher` text NOT NULL,
  `amount` float NOT NULL,
  `date` date NOT NULL,
  `receive_name` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `barcode` text NOT NULL,
  `product_name` text NOT NULL,
  `unit` float NOT NULL,
  `pieces` float NOT NULL,
  `buy` float NOT NULL,
  `rate` float NOT NULL,
  `trans` float NOT NULL,
  `round_package_price` float NOT NULL,
  `round_unit_price` float NOT NULL,
  `round_pieces_price` float NOT NULL,
  `package_price` float NOT NULL,
  `unit_price` float NOT NULL,
  `pieces_price` float NOT NULL,
  `package_fix_price` float NOT NULL,
  `unit_fix_price` float NOT NULL,
  `pieces_fix_price` float NOT NULL,
  `package_remain` float NOT NULL,
  `unit_remain` float NOT NULL,
  `pieces_remain` float NOT NULL,
  `package_sell` int(11) NOT NULL,
  `unit_sell` int(11) NOT NULL,
  `pieces_sell` int(11) NOT NULL,
  `package_exist` int(11) NOT NULL,
  `unit_exist` int(11) NOT NULL,
  `pieces_exist` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `profit` float NOT NULL,
  `currency_rate` text NOT NULL,
  `currency_buy` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_data`
--

CREATE TABLE `sell_data` (
  `date` date NOT NULL,
  `barcode` text NOT NULL,
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` float NOT NULL,
  `total` float NOT NULL,
  `tra_id` int(11) NOT NULL,
  `customer` text NOT NULL,
  `bill` text NOT NULL,
  `type` text NOT NULL,
  `exp_debt` date NOT NULL,
  `voucher` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `seller` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_name`
--

CREATE TABLE `shop_name` (
  `shop_name` text NOT NULL,
  `phone_no` text NOT NULL,
  `address` text NOT NULL,
  `manager` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop_name`
--

INSERT INTO `shop_name` (`shop_name`, `phone_no`, `address`, `manager`, `id`) VALUES
('shop_1', '09', '-', '-', 1),
('shop_2', '[value-2]', '[value-3]', '[value-4]', 2),
('shop_3', '[value-2]', '[value-3]', '[value-4]', 3),
('shop_4', '[value-2]', '[value-3]', '[value-4]', 4),
('shop_5', '[value-2]', '[value-3]', '[value-4]', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `name` text NOT NULL,
  `ph_no` text NOT NULL,
  `nrc` text NOT NULL,
  `father_name` text NOT NULL,
  `address` text NOT NULL,
  `role` text NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_1`
--

CREATE TABLE `user_1` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_1_ll`
--

CREATE TABLE `user_1_ll` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_2`
--

CREATE TABLE `user_2` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_2_ll`
--

CREATE TABLE `user_2_ll` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_3`
--

CREATE TABLE `user_3` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_3_ll`
--

CREATE TABLE `user_3_ll` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_4`
--

CREATE TABLE `user_4` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_4_ll`
--

CREATE TABLE `user_4_ll` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_5`
--

CREATE TABLE `user_5` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_5_ll`
--

CREATE TABLE `user_5_ll` (
  `product_name` text NOT NULL,
  `price` float NOT NULL,
  `f_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `total` float NOT NULL,
  `tra_id` text NOT NULL,
  `type` text NOT NULL,
  `voucher` text NOT NULL,
  `customer` text NOT NULL,
  `discount` float NOT NULL,
  `buy_type` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_database`
--

CREATE TABLE `user_database` (
  `user_name` text NOT NULL,
  `user_name_LL` text NOT NULL,
  `password` text NOT NULL,
  `ph_no` text NOT NULL,
  `email` text NOT NULL,
  `browser_id` text NOT NULL,
  `active` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_database`
--

INSERT INTO `user_database` (`user_name`, `user_name_LL`, `password`, `ph_no`, `email`, `browser_id`, `active`, `id`) VALUES
('user_1', 'user_1_ll', 'apple', '09666350555', 'user_1@gmail.com', 'b80e759302236aa4a30b79ccca997fc01697779344', '1', 1),
('user_2', 'user_2_ll', 'apple', '09', '[value-4]', '111419f79450a4c49c6816d6e754633a1693546851', '1', 2),
('user_3', 'user_3_ll', 'apple', '[value-4]', '[value-5]', '[value-6]', '[value-7]', 3),
('user_4', 'user_4_ll', 'apple', '[value-4]', '[value-5]', '[value-6]', '[value-7]', 4),
('user_5', 'user_5_ll', 'apple', '[value-4]', '[value-5]', '[value-6]', '[value-7]', 5);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_no` text NOT NULL,
  `customer_name` text NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `pay` float NOT NULL,
  `payable` float NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_data`
--
ALTER TABLE `sell_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_name`
--
ALTER TABLE `shop_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_1`
--
ALTER TABLE `user_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_1_ll`
--
ALTER TABLE `user_1_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_2`
--
ALTER TABLE `user_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_2_ll`
--
ALTER TABLE `user_2_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_3`
--
ALTER TABLE `user_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_3_ll`
--
ALTER TABLE `user_3_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_4`
--
ALTER TABLE `user_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_4_ll`
--
ALTER TABLE `user_4_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_5`
--
ALTER TABLE `user_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_5_ll`
--
ALTER TABLE `user_5_ll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_database`
--
ALTER TABLE `user_database`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=730;

--
-- AUTO_INCREMENT for table `sell_data`
--
ALTER TABLE `sell_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `shop_name`
--
ALTER TABLE `shop_name`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_1`
--
ALTER TABLE `user_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `user_1_ll`
--
ALTER TABLE `user_1_ll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `user_2`
--
ALTER TABLE `user_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `user_2_ll`
--
ALTER TABLE `user_2_ll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_3`
--
ALTER TABLE `user_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_3_ll`
--
ALTER TABLE `user_3_ll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_4`
--
ALTER TABLE `user_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_4_ll`
--
ALTER TABLE `user_4_ll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_5`
--
ALTER TABLE `user_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_5_ll`
--
ALTER TABLE `user_5_ll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_database`
--
ALTER TABLE `user_database`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
