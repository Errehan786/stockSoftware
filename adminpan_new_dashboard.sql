-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2023 at 11:27 AM
-- Server version: 5.7.42
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpan_new_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `Category_Name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Description_No` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Measuring_Units` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `percentage` enum('No','Yes') COLLATE utf8_bin NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `user_reg_id`, `Category_Name`, `Description_No`, `Measuring_Units`, `percentage`) VALUES
(12, 2147483647, 'Wax Kerasoya', 'wax', 'kg', 'Yes'),
(13, 2147483647, 'Fragrance Oil', 'Oil', 'Grams', 'Yes'),
(14, 2147483647, 'Container', 'Container', 'Pcs', 'No'),
(15, 2147483647, 'Lid', 'Lid for Karen glass', 'Pcs', 'No'),
(16, 2147483647, 'Essential OIL', 'Essential OIL', 'Grams', 'No'),
(17, 2147483647, 'abc', 'demo', 'Pcs', 'No'),
(18, 1670926384, 'RCat-01', 'rss user cat-01', 'Pcs', 'No'),
(19, 1670926384, 'RCat-02', 'test', 'Grams', 'Yes'),
(29, 1670926384, 'RCat-03', 'testing', 'metres', 'No'),
(30, 1670926384, 'RCat-04', 'abcd', 'Grams', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `reg_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `password` char(255) COLLATE utf8_bin DEFAULT NULL,
  `pass` char(255) COLLATE utf8_bin DEFAULT NULL,
  `remark` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `city` char(255) COLLATE utf8_bin DEFAULT NULL,
  `state` char(255) COLLATE utf8_bin DEFAULT NULL,
  `country` char(255) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` char(255) COLLATE utf8_bin DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `reg_id`, `name`, `email`, `mobile_no`, `password`, `pass`, `remark`, `address`, `city`, `state`, `country`, `zipcode`, `entry_date`) VALUES
(1, 1670926384, 'Rssinfotech Pvt. Ltd.', 'rss09@gmail.com', 8521236585, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', 'abcd', 'new delhi', NULL, NULL, NULL, NULL, '2022-12-13 15:49:29'),
(2, 1671013014, 'Abcinfotech Pvt. Ltd.', 'abcin321@gmail.com', 8987887897, '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '321', 'abcd', 'new delhi', NULL, NULL, NULL, NULL, '2022-12-14 15:46:54'),
(3, 1672206662, 'Kamseen AS', 'vedanta@kamseen.no', 47, '3accd85cb890ca775a995c4d039e53b8f78423b8', 'N0vember@123', '', 'Stavanger, Norway', NULL, NULL, NULL, NULL, '2022-12-28 11:21:02'),
(4, 1674303287, 'Ramratan Pvt. Ltd.', 'ramrat321@gmail.com', 8523636612, '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '321', '', 'new delhi', NULL, NULL, NULL, NULL, '2023-01-21 17:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `currency_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `basic_conversion` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `user_reg_id`, `currency_name`, `basic_conversion`) VALUES
(2, 2147483647, 'INR', '0.13'),
(3, 2147483647, 'USD', '0.012'),
(4, 2147483647, 'GBP', NULL),
(5, 1670926384, 'USD', NULL),
(6, 1670926384, 'Doller', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `reg_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_reg_id`, `reg_id`, `name`, `email`, `mobile_no`, `address`) VALUES
(1, 2147483647, 1673864844, 'Mithlesh Kumar', 'mkumar321@gmail.com', 8521236582, 'new delhi'),
(3, 2147483647, 1673871946, 'Raj kumar', 'rajkumar321@gmail.com', 8523232323, 'abcd'),
(4, 2147483647, 1673871979, 'Amit Kumar', 'amitKr3214@gmail.com', 8523232323, 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_sheet`
--

CREATE TABLE `delivery_sheet` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `select_date` date DEFAULT NULL,
  `Order_ID` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `user_reg_id`, `name`, `category`, `cost`) VALUES
(1, 2147483647, 'Electricity for candle', 'TAX', '10'),
(2, 2147483647, 'sdf', 'Expense', '45'),
(3, 2147483647, 'setfgs', 'Expense', '45'),
(4, 2147483647, 'Scented candle making cost', 'Expense', '10'),
(5, 2147483647, 'electricity for candle', 'Expense', '10'),
(6, 1670926384, 'RssElectricityBill-01', 'Expense', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `expense_sub_items`
--

CREATE TABLE `expense_sub_items` (
  `id` int(11) NOT NULL,
  `formula_id` int(255) DEFAULT NULL,
  `expense_id` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `expense_sub_items`
--

INSERT INTO `expense_sub_items` (`id`, `formula_id`, `expense_id`) VALUES
(10, 5, '5'),
(11, 5, '4'),
(13, 7, '1'),
(14, 11, '6');

-- --------------------------------------------------------

--
-- Table structure for table `formula_entry`
--

CREATE TABLE `formula_entry` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `formula_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `formula_description` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `formula_entry`
--

INSERT INTO `formula_entry` (`id`, `user_reg_id`, `formula_name`, `formula_description`) VALUES
(5, 2147483647, 'Product formula 10 cl tin 9% oil ', 'Product formula 1'),
(7, 2147483647, 'Product formula 20 cl tin 10% oil', 'Product formula 20 cl tin 10% oil'),
(8, 2147483647, 'lotion grape seed oil', 'lotion grape seed oil'),
(9, 2147483647, 'lotion Maris', 'lotion Maris'),
(10, 2147483647, 'Essential Oil Bottle 10 ml', 'Essential Oil Bottle 10 ml'),
(11, 1670926384, 'RssFormula-01', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `formula_sub_items`
--

CREATE TABLE `formula_sub_items` (
  `id` int(11) NOT NULL,
  `formula_id` int(255) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Item` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `formula_sub_items`
--

INSERT INTO `formula_sub_items` (`id`, `formula_id`, `category`, `Item`, `qty`) VALUES
(24, 5, '12', '23', '91'),
(25, 5, '13', '24', '9'),
(26, 5, '14', '29', '1'),
(30, 7, '12', '55', '90'),
(31, 7, '13', '44', '10'),
(32, 7, '14', '52', '1'),
(33, 8, '25', '39', '70'),
(34, 8, '23', '37', '5'),
(35, 8, '24', '38', '25'),
(36, 9, '27', '42', '250ml'),
(37, 9, '14', '41', '1'),
(38, 10, '16', '54', '10'),
(39, 10, '14', '53', '1'),
(40, 11, '18', '57', '20'),
(41, 11, '19', '57', '30');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `item_code` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_desc` varchar(10000) COLLATE utf8_bin DEFAULT NULL,
  `vender_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `measurement_unit` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `weight_unit` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `location_name` varchar(10000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `user_reg_id`, `item_code`, `item_name`, `item_desc`, `vender_name`, `category`, `measurement_unit`, `weight_unit`, `location_name`) VALUES
(44, 2147483647, 'FRAG3284', 'Christmas Tree', 'Christmas Tree', '9', '13', 'Grams', '', 'Hillevåg'),
(45, 2147483647, 'FRAG3124', 'Espresso Martini ', 'Espresso Martini ', '9', '13', 'Grams', '', 'rr'),
(46, 2147483647, '001', 'abcTesting', 'auto add item as corresponding row after click on add new button ', '6', '12', 'Pcs', '500', 'delhi'),
(47, 2147483647, 'FRAG1495', 'Kabuki ', 'Fragrance oil', '9', '13', 'kg', '1000', 'hillevåg'),
(48, 2147483647, 'LID00031', 'Lid for 20cl Karen', 'Lid for 20cl Karen', '9', '15', 'Pcs', '19', 'hillevåg'),
(49, 2147483647, 'FRAG3122', 'Expresso martini (grams)', 'Express martini', '9', '13', 'Grams', '', 'hillevåg'),
(50, 2147483647, 'FRAG0432', 'Coffee mocha (grams)', 'Coffee mocha ', '9', '13', 'Grams', '', 'hillevåg'),
(51, 2147483647, 'FRAG1802', 'Whiskey (grams)', 'Whiskey', '9', '13', 'Grams', '', 'hillevåg'),
(52, 2147483647, 'TIN20CL001', 'Tin 20 CL Silver', 'Tin 20 CL Silver', '9', '14', 'Pcs', '22', 'Hillevåg'),
(53, 2147483647, 'Bottle10ML001', 'Bottle 10 ml', 'Bottle 10 ml', '9', '14', 'Pcs', '20', 'Hillevåg'),
(54, 2147483647, 'EO001', 'EO Lavender', 'EO Lavender', '9', '16', 'Grams', '20', 'Hillevåg'),
(55, 2147483647, 'WAX001', 'K WAX', 'K WAX', '9', '12', 'Grams', '', 'h'),
(56, 2147483647, '100012', 'TestingUnit-item01', 'testing item', '6', '16', 'Grams', '', 'delhi'),
(57, 1670926384, 'Ritem-01', 'RssItem01', 'testing rss cat-01', '10', '18', 'Pcs', '500', 'abcd'),
(58, 1670926384, 'Ritem-02', 'RssItem02', 'test', '11', '19', 'Grams', '', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` bigint(20) NOT NULL,
  `reg_id` bigint(20) NOT NULL,
  `name` char(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `email` char(255) COLLATE utf8_bin DEFAULT NULL,
  `mobile_no` char(255) COLLATE utf8_bin DEFAULT NULL,
  `pass` char(255) COLLATE utf8_bin DEFAULT NULL,
  `remark` char(255) COLLATE utf8_bin DEFAULT NULL,
  `address` char(255) COLLATE utf8_bin DEFAULT NULL,
  `city` char(255) COLLATE utf8_bin DEFAULT NULL,
  `state` char(255) COLLATE utf8_bin DEFAULT NULL,
  `country` char(255) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` char(255) COLLATE utf8_bin DEFAULT NULL,
  `entry_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `reg_id`, `name`, `password`, `email`, `mobile_no`, `pass`, `remark`, `address`, `city`, `state`, `country`, `zipcode`, `entry_date`) VALUES
(2147483647, 2147483647, 'admin', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-26 11:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `new_item`
--

CREATE TABLE `new_item` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) NOT NULL,
  `items_id` int(11) NOT NULL COMMENT 'foregien key',
  `item_name` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cost` decimal(19,4) DEFAULT NULL,
  `local_currency` decimal(19,4) DEFAULT NULL COMMENT 'Cost_in_local_currency',
  `batch_no` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `per_item_shippment_cost` decimal(19,4) DEFAULT NULL,
  `per_unit_cost_item` decimal(19,4) DEFAULT NULL,
  `date` date DEFAULT NULL COMMENT 'entry date',
  `delivery_date` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='purchage entry sub';

--
-- Dumping data for table `new_item`
--

INSERT INTO `new_item` (`id`, `user_reg_id`, `items_id`, `item_name`, `qty`, `cost`, `local_currency`, `batch_no`, `per_item_shippment_cost`, `per_unit_cost_item`, `date`, `delivery_date`) VALUES
(3, 2147483647, 2, '47', '5', '139.1600', '1809.0800', '175886', '16.0833', '381.1127', '2022-01-24', '2022-12-09 19:24:06'),
(4, 2147483647, 2, '48', '100', '81.0000', '1053.0000', 'None', '6.1117', '11.3951', '2022-01-24', '2022-12-09 19:24:06'),
(5, 2147483647, 2, '49', '100', '7.0000', '91.0000', '175926', '0.3217', '1.7172', '2022-01-24', '2022-12-09 19:24:06'),
(6, 2147483647, 2, '50', '100', '6.0000', '78.0000', '175937', '0.3217', '1.5872', '2022-01-24', '2022-12-09 19:24:06'),
(7, 2147483647, 2, '51', '100', '7.0000', '91.0000', '175859', '0.3217', '1.7172', '2022-01-24', '2022-12-09 19:24:06'),
(8, 2147483647, 3, '46', '20', '2.6000', '4.1600', 'b001', '0.0000', '4.2080', '2022-12-03', NULL),
(9, 2147483647, 3, '48', '10', '2.0000', '3.2000', 'b02', '0.0000', '8.3200', '2022-12-03', NULL),
(10, 2147483647, 4, '46', '100', '3.3000', '5.2800', 'b003', '0.0000', '0.8528', '2022-12-03', NULL),
(11, 2147483647, 4, '47', '100', '3.6000', '5.7600', 'b02', '0.0000', '0.8576', '2022-12-03', NULL),
(12, 2147483647, 5, '51', '40', '13.6200', '181.5546', '11', '0.6186', '9.5793', '2022-12-06', '2022-12-05 14:36:57'),
(13, 2147483647, 5, '48', '100', '62.3500', '831.1255', '11', '29.3814', '10.6151', '2022-12-06', '2022-12-05 14:36:57'),
(14, 2147483647, 6, '55', '100000', '20.0000', '202.2000', '11', '296.7710', '0.0070', '2022-12-06', '2022-12-06'),
(15, 2147483647, 6, '52', '100', '62.3500', '630.3585', '33', '6.5290', '8.3789', '2022-12-06', '2022-12-06'),
(16, 1670926384, 7, '57', '5', '1000.0000', '100000.0000', 'r001', '0.0000', '20020.0000', '2022-12-26', '2022-12-26 18:44:24'),
(17, 1670926384, 8, '57', '50', '100.0000', '10000.0000', 'B001', '9960.1594', '450.2032', '2022-12-26', NULL),
(18, 1670926384, 8, '58', '100', '300.0000', '30000.0000', 'B002', '39.8406', '325.8984', '2022-12-26', NULL),
(19, 2147483647, 9, '45', '2', '123.0000', '147600.0000', '234', '147600.0000', '761400.0000', '2022-12-29', NULL),
(20, 2147483647, 10, '44', '32', '2334.0000', '546156.0000', '123', '45.0000', '17070.9063', '2023-02-15', NULL),
(21, 2147483647, 11, '44', '32', '2334.0000', '546156.0000', '123', '45.0000', '17070.9063', '2023-02-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_sheet`
--

CREATE TABLE `order_sheet` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `order_ID` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `delivery_date` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_sheet`
--

INSERT INTO `order_sheet` (`id`, `user_reg_id`, `customer_name`, `date`, `order_ID`, `status`, `delivery_status`, `delivery_date`) VALUES
(2, 2147483647, '1673864844', '2023-01-05', '10007', 'Work in progress', 'Delivered', NULL),
(3, 2147483647, '1673871946', '2023-01-16', '1673872606', 'Pending', 'Pending', NULL),
(4, 2147483647, '1673864844', '2023-01-17', '1673878173', 'Array', 'Not delivered', NULL),
(5, 2147483647, '1673871946', '2023-01-19', '1674123219', 'Array', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `product_qty` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'In Gram',
  `description` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `formula_name` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_reg_id`, `product_name`, `product_qty`, `description`, `formula_name`) VALUES
(8, 2147483647, 'Fir 100 gram', '100', 'Fir 100 gram', '5'),
(9, 2147483647, 'TestingMK', '2000', 'abc23', '5'),
(10, 2147483647, 'MKtesting', '500', 'xyz', '5'),
(11, 1670926384, 'RssProduct-01', '500', 'testing', '11');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch`
--

CREATE TABLE `product_batch` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `purpose` char(255) COLLATE utf8_bin NOT NULL,
  `manufacturing_date` char(255) COLLATE utf8_bin NOT NULL,
  `customer_name` char(255) COLLATE utf8_bin NOT NULL,
  `batch_code` char(255) COLLATE utf8_bin NOT NULL,
  `stock_maintenance` int(11) NOT NULL,
  `totalManufacringCost` decimal(19,2) NOT NULL DEFAULT '0.00',
  `order_id` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_batch`
--

INSERT INTO `product_batch` (`id`, `user_reg_id`, `purpose`, `manufacturing_date`, `customer_name`, `batch_code`, `stock_maintenance`, `totalManufacringCost`, `order_id`) VALUES
(1, 2147483647, 'Pre order from customer', '2022-12-08', 'Mithlesh kr', 'b00001', 0, '0.00', NULL),
(2, 2147483647, 'Pre order from customer', '2022-12-08', '', 'b00002', 1000, '0.00', NULL),
(3, 2147483647, '', '2022-12-10', '1673864844', 'b000011', 0, '0.00', NULL),
(4, 2147483647, '', '2022-12-11', '1673871979', 'b00003', 0, '0.00', NULL),
(5, 2147483647, '', '2022-12-11', '1673871979', 'b00003', 0, '0.00', NULL),
(6, 2147483647, '', '2022-12-12', '1673871946', 'b00004', 0, '0.00', NULL),
(7, 1670926384, 'Stock Maintenance', '2022-12-26', '', 'pb001', 100, '0.00', NULL),
(8, 2147483647, 'Stock Maintenance', '2023-01-17', '', '11111', 0, '0.00', NULL),
(9, 2147483647, 'Stock Maintenance', '2023-01-17', '', '11111', 0, '0.00', NULL),
(10, 2147483647, 'Stock Maintenance', '2023-01-16', '', 'ssss', 0, '0.00', NULL),
(11, 2147483647, 'Stock Maintenance', '2023-01-17', '', '11111', 0, '0.00', NULL),
(12, 2147483647, 'Pre order from customer', '2023-01-18', '1673864844', 'b00001', 0, '0.00', NULL),
(13, 2147483647, 'Pre order from customer', '2023-01-20', '1673871946', 'r0001', 0, '0.00', '1673872606'),
(14, 2147483647, 'Pre order from customer', '2023-01-21', '1673871946', '11111', 0, '0.00', '1674123219');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch_sub_iteam`
--

CREATE TABLE `product_batch_sub_iteam` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `batch_id` int(11) NOT NULL DEFAULT '0',
  `product_id` char(255) COLLATE utf8_bin NOT NULL,
  `quantity` char(255) COLLATE utf8_bin NOT NULL,
  `work_status` char(255) COLLATE utf8_bin NOT NULL,
  `costPerUnit` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `totalCost` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `manufacturing_date` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_batch_sub_iteam`
--

INSERT INTO `product_batch_sub_iteam` (`id`, `user_reg_id`, `batch_id`, `product_id`, `quantity`, `work_status`, `costPerUnit`, `totalCost`, `manufacturing_date`) VALUES
(1, 2147483647, 1, '8', '100', 'Completed', '20083.5700', '2008357.0000', NULL),
(2, 2147483647, 2, '8', '500', 'Completed', '20083.5700', '10041785.0000', NULL),
(3, 2147483647, 3, '8', '100', 'Completed', '20083.5700', '2008357.0000', NULL),
(4, 2147483647, 4, '9', '100', 'Completed', '263087.1100', '26308711.0000', NULL),
(5, 2147483647, 5, '9', '100', 'Completed', '263087.1100', '26308711.0000', NULL),
(6, 2147483647, 6, '8', '500', 'Work in progress', '20083.5700', '10041785.0000', NULL),
(7, 1670926384, 7, '11', '5', 'Work in progress', '468930.4800', '2344652.4000', NULL),
(8, 2147483647, 8, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(9, 2147483647, 9, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(10, 2147483647, 10, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(11, 2147483647, 11, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(12, 2147483647, 12, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(13, 2147483647, 13, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL),
(14, 2147483647, 14, '8', '100', 'Work in progress', '20083.5700', '2008357.0000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_item`
--

CREATE TABLE `product_sub_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `category_in` char(255) COLLATE utf8_bin DEFAULT NULL,
  `item` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_qty` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `item_selected_date` char(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'date_row_id',
  `unit_price` decimal(19,2) DEFAULT NULL,
  `item_cost` decimal(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `product_sub_item`
--

INSERT INTO `product_sub_item` (`id`, `product_id`, `category`, `category_in`, `item`, `item_qty`, `item_selected_date`, `unit_price`, `item_cost`) VALUES
(1, 3, 'Wax ', 'Yes', 'WAX Kerasoya', '91', '77', '101.16', '20232.00'),
(2, 3, 'Oil', 'Yes', 'Fir ', '9', '78', '1005.66', '201132.00'),
(3, 3, 'Container', 'No', '10 CL Silver Tin', '1', '79', '10071.05', '2014210.00'),
(4, 4, 'Wax ', 'Yes', 'WAX Kerasoya', '91', '73', '120.72', '12072.00'),
(5, 4, 'Oil', 'Yes', 'Fir ', '9', '74', '240.72', '24072.00'),
(6, 4, 'Container', 'No', '10 CL Silver Tin', '1', '79', '10071.05', '1007105.00'),
(7, 5, 'Wax ', 'Yes', 'WAX Kerasoya', '91', '73', '120.72', '12072.00'),
(8, 5, 'Oil', 'Yes', 'Fir ', '9', '78', '1005.66', '100566.00'),
(9, 5, 'Container', 'No', '10 CL Silver Tin', '1', '79', '10071.05', '1007105.00'),
(10, 6, 'Oil', 'Yes', 'Lavander', '10', '81', '0.21', '2.10'),
(11, 6, 'Container', 'No', '10 ml bottle ', '1', '82', '2.70', '2.70'),
(12, 6, 'Package', '', 'Box for 10 ml EO bottle', '1', '83', '13.00', '13.00'),
(13, 7, 'Oil', 'Yes', 'Lavander', '10', '81', '0.21', '2.10'),
(14, 7, 'Container', 'No', '10 ml bottle ', '1', '82', '2.70', '2.70'),
(15, 7, 'Package', '', 'Box for 10 ml EO bottle', '1', '83', '13.00', '13.00'),
(16, 8, 'Wax ', 'Yes', 'WAX Kerasoya', '91', '73', '120.72', '10985.52'),
(17, 8, 'Oil', 'Yes', 'Fir ', '9', '76', '1005.66', '9050.94'),
(18, 8, 'Container', 'No', '10 CL Silver Tin', '1', '75', '27.11', '27.11'),
(19, 9, 'Wax ', 'Yes', 'WAX Kerasoya', '1820', '73', '120.72', '219710.40'),
(20, 9, 'Oil', 'Yes', 'Pandura', '180', '74', '240.72', '43329.60'),
(21, 9, 'Container', 'No', '10 CL Gold Tin', '1', '75', '27.11', '27.11'),
(22, 10, 'Wax ', 'Yes', 'WAX Kerasoya', '455', '73', '120.72', '54927.60'),
(23, 10, 'Oil', 'Yes', 'Pandura', '45', '76', '1005.66', '45254.70'),
(24, 10, 'Container', 'No', '10 CL Rose Gold Tin', '1', '79', '10071.05', '10071.05'),
(25, 11, 'RCat-01', 'No', 'RssItem01 - Pcs (20 Pcs)', '20', '16', '20020.00', '400400.00'),
(26, 11, 'RCat-02', 'Yes', 'RssItem02 - Grams (30 %)', '150', '17', '450.20', '67530.48');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_entry`
--

CREATE TABLE `purchase_entry` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date` date DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `currency_conversion` decimal(19,4) DEFAULT NULL,
  `miscellaneous_cost` decimal(19,4) DEFAULT NULL,
  `shipping_cost` decimal(19,4) DEFAULT NULL,
  `admin_cost_custom` decimal(19,4) DEFAULT NULL COMMENT 'admin cost item',
  `custom_tax` decimal(19,4) DEFAULT NULL,
  `total_wet_shippment` decimal(19,4) DEFAULT NULL,
  `status` char(255) COLLATE utf8_bin DEFAULT NULL,
  `per_unit_shipment_cost` decimal(19,4) DEFAULT NULL,
  `per_item_admin_cost` decimal(19,4) DEFAULT NULL,
  `per_item_miscellaneous_cost` decimal(19,4) DEFAULT NULL,
  `entryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_date` char(255) COLLATE utf8_bin DEFAULT NULL,
  `miscellaneousCost_Currency` char(255) COLLATE utf8_bin DEFAULT NULL,
  `ShippingCost_Currency` char(255) COLLATE utf8_bin DEFAULT NULL,
  `AdminCost_Currency` char(255) COLLATE utf8_bin DEFAULT NULL,
  `CustomTax_Currency` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `purchase_entry`
--

INSERT INTO `purchase_entry` (`id`, `user_reg_id`, `vendor_name`, `date`, `invoice_no`, `currency`, `currency_conversion`, `miscellaneous_cost`, `shipping_cost`, `admin_cost_custom`, `custom_tax`, `total_wet_shippment`, `status`, `per_unit_shipment_cost`, `per_item_admin_cost`, `per_item_miscellaneous_cost`, `entryDate`, `delivery_date`, `miscellaneousCost_Currency`, `ShippingCost_Currency`, `AdminCost_Currency`, `CustomTax_Currency`) VALUES
(2, 2147483647, '9', '2022-01-24', '355548', 'GBP', '13.0000', '0.0000', '23.1600', '402.0000', '0.0000', '7200.0000', 'Delivered', '0.0032', '80.4000', '0.0000', '2022-12-03 12:59:31', '2022-12-09', 'NOK', 'NOK', 'NOK', 'NOK'),
(3, 2147483647, '7', '2022-12-03', '01122', 'USD', '1.6000', '160.0000', '0.0000', '0.0000', '160.0000', '10190.0000', 'Waiting for delivery', '0.0000', '0.0000', '80.0000', '2022-12-03 14:10:18', NULL, 'USD', 'NOK', 'NOK', 'USD'),
(4, 2147483647, '6', '2022-12-03', '0112233', 'USD', '1.6000', '160.0000', '0.0000', '0.0000', '160.0000', '150000.0000', 'Waiting for delivery', '0.0000', '0.0000', '80.0000', '2022-12-03 15:10:17', NULL, 'USD', 'NOK', 'NOK', 'USD'),
(5, 2147483647, '9', '2022-12-06', '111', 'GBP', '13.3300', '0.0000', '30.0000', '402.0000', '0.0000', '1940.0000', 'Delivered', '0.0155', '201.0000', '0.0000', '2022-12-05 14:34:22', '2022-12-05', 'NOK', 'NOK', 'NOK', 'NOK'),
(6, 2147483647, '9', '2022-12-06', '2222', 'USD', '10.1100', '0.0000', '303.3000', '402.0000', '0.0000', '102200.0000', 'Delivered', '0.0030', '201.0000', '0.0000', '2022-12-05 14:54:26', '2022-12-06', 'NOK', 'USD', 'NOK', 'NOK'),
(7, 1670926384, '10', '2022-12-26', '4645', 'USD', '100.0000', '100.0000', '0.0000', '0.0000', '0.0000', '2500.0000', 'Delivered', '0.0000', '0.0000', '100.0000', '2022-12-26 18:42:29', '2022-12-26', 'NOK', 'NOK', 'NOK', 'NOK'),
(8, 1670926384, '11', '2022-12-26', '51351', 'USD', '100.0000', '100.0000', '10000.0000', '5000.0000', '0.0000', '25100.0000', 'Waiting for delivery', '0.3984', '2500.0000', '50.0000', '2022-12-26 19:24:55', NULL, 'NOK', 'USD', 'Doller', 'NOK'),
(9, 2147483647, '12', '2022-12-29', '123', 'INR', '1200.0000', '147600.0000', '147600.0000', '1080000.0000', '147600.0000', '2.0000', 'Waiting for delivery', '73800.0000', '1080000.0000', '147600.0000', '2022-12-29 13:35:34', NULL, 'INR', 'INR', 'INR', 'INR'),
(10, 2147483647, '12', '2023-02-15', '123', 'NOK', '234.0000', '45.0000', '45.0000', '23.0000', '34.0000', '32.0000', 'Waiting for delivery', '1.4063', '23.0000', '45.0000', '2023-02-07 20:46:38', NULL, 'NOK', 'NOK', 'NOK', 'NOK'),
(11, 2147483647, '12', '2023-02-15', '123', 'NOK', '234.0000', '45.0000', '45.0000', '23.0000', '34.0000', '32.0000', 'Waiting for delivery', '1.4063', '23.0000', '45.0000', '2023-02-07 20:46:38', NULL, 'NOK', 'NOK', 'NOK', 'NOK');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_overview`
--

CREATE TABLE `raw_material_overview` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `batch_sub_id` int(11) NOT NULL,
  `item` char(255) COLLATE utf8_bin DEFAULT NULL,
  `item_qty` char(255) COLLATE utf8_bin DEFAULT NULL,
  `status` enum('Work in progress','Completed','Cancel') COLLATE utf8_bin NOT NULL DEFAULT 'Work in progress',
  `manufacture_date` char(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `raw_material_overview`
--

INSERT INTO `raw_material_overview` (`id`, `user_reg_id`, `batch_sub_id`, `item`, `item_qty`, `status`, `manufacture_date`) VALUES
(1, 2147483647, 1, 'WAX Kerasoya', '9100', 'Completed', '2022-12-08'),
(2, 2147483647, 1, 'Fir', '900', 'Completed', '2022-12-08'),
(3, 2147483647, 1, '10 CL Silver Tin', '100', 'Completed', '2022-12-08'),
(4, 2147483647, 2, 'WAX Kerasoya', '45500', 'Work in progress', '2022-12-08'),
(5, 2147483647, 2, 'Fir', '4500', 'Work in progress', '2022-12-08'),
(6, 2147483647, 2, '10 CL Silver Tin', '500', 'Work in progress', '2022-12-08'),
(7, 2147483647, 3, 'WAX Kerasoya', '9100', 'Completed', '2022-12-10'),
(8, 2147483647, 3, 'Fir', '900', 'Completed', '2022-12-10'),
(9, 2147483647, 3, '10 CL Silver Tin', '100', 'Completed', '2022-12-10'),
(10, 2147483647, 4, 'WAX Kerasoya', '182000', 'Completed', '2022-12-11'),
(11, 2147483647, 4, 'Pandura', '18000', 'Completed', '2022-12-11'),
(12, 2147483647, 4, '10 CL Gold Tin', '100', 'Completed', '2022-12-11'),
(13, 2147483647, 5, 'WAX Kerasoya', '182000', 'Completed', '2022-12-11'),
(14, 2147483647, 5, 'Pandura', '18000', 'Completed', '2022-12-11'),
(15, 2147483647, 5, '10 CL Gold Tin', '100', 'Completed', '2022-12-11'),
(16, 2147483647, 6, 'WAX Kerasoya', '45500', 'Work in progress', '2022-12-12'),
(17, 2147483647, 6, 'Fir', '4500', 'Work in progress', '2022-12-12'),
(18, 2147483647, 6, '10 CL Silver Tin', '500', 'Work in progress', '2022-12-12'),
(19, 1670926384, 7, 'RssItem01 - Pcs (20 Pcs)', '100', 'Work in progress', '2022-12-26'),
(20, 1670926384, 7, 'RssItem02 - Grams (30 %)', '750', 'Work in progress', '2022-12-26'),
(21, 2147483647, 8, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-17'),
(22, 2147483647, 8, 'Fir', '900', 'Work in progress', '2023-01-17'),
(23, 2147483647, 8, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-17'),
(24, 2147483647, 9, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-17'),
(25, 2147483647, 9, 'Fir', '900', 'Work in progress', '2023-01-17'),
(26, 2147483647, 9, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-17'),
(27, 2147483647, 10, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-16'),
(28, 2147483647, 10, 'Fir', '900', 'Work in progress', '2023-01-16'),
(29, 2147483647, 10, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-16'),
(30, 2147483647, 11, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-17'),
(31, 2147483647, 11, 'Fir', '900', 'Work in progress', '2023-01-17'),
(32, 2147483647, 11, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-17'),
(33, 2147483647, 12, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-18'),
(34, 2147483647, 12, 'Fir', '900', 'Work in progress', '2023-01-18'),
(35, 2147483647, 12, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-18'),
(36, 2147483647, 13, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-20'),
(37, 2147483647, 13, 'Fir', '900', 'Work in progress', '2023-01-20'),
(38, 2147483647, 13, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-20'),
(39, 2147483647, 14, 'WAX Kerasoya', '9100', 'Work in progress', '2023-01-21'),
(40, 2147483647, 14, 'Fir', '900', 'Work in progress', '2023-01-21'),
(41, 2147483647, 14, '10 CL Silver Tin', '100', 'Work in progress', '2023-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `sub_delivery_sheet`
--

CREATE TABLE `sub_delivery_sheet` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `delivery_sheet_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `sub_order_list`
--

CREATE TABLE `sub_order_list` (
  `id` int(11) NOT NULL,
  `order_list_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(255) DEFAULT NULL,
  `cost` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sub_order_list`
--

INSERT INTO `sub_order_list` (`id`, `order_list_id`, `product_id`, `qty`, `cost`) VALUES
(2, 2, 8, 100, 5000),
(3, 2, 9, 500, 2000),
(4, 3, 9, 10, 10000),
(5, 4, 8, 100, 11),
(6, 5, 8, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `user_reg_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `user_reg_id`, `name`, `email`, `mobile_no`, `address`) VALUES
(6, 2147483647, 'Vendor01', 'vedanta@gmail.com', 4636312901, 'TEST address1'),
(7, 2147483647, 'Vendor2', 'vedanta@gmail.com', 1234567891, 'test'),
(8, 2147483647, 'Testing Ven-01', 'test@gmail.com', 8799788888, 'delhi'),
(9, 2147483647, 'CS UK', '0', 0, 'CS UK'),
(10, 1670926384, 'RssVendor-01', 'rssv01@gmail.com', 8521236363, 'rssAddress abc'),
(11, 1670926384, 'RssVendor-02', 'rsven02@gmail.com', 8545636363, 'xyz'),
(12, 2147483647, 'prerna', 'mail', 1123349990, 'address');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_sheet`
--
ALTER TABLE `delivery_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_sub_items`
--
ALTER TABLE `expense_sub_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formula_entry`
--
ALTER TABLE `formula_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formula_sub_items`
--
ALTER TABLE `formula_sub_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_item`
--
ALTER TABLE `new_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test` (`items_id`);

--
-- Indexes for table `order_sheet`
--
ALTER TABLE `order_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_batch`
--
ALTER TABLE `product_batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_batch_sub_iteam`
--
ALTER TABLE `product_batch_sub_iteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_item`
--
ALTER TABLE `product_sub_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_overview`
--
ALTER TABLE `raw_material_overview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_delivery_sheet`
--
ALTER TABLE `sub_delivery_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_order_list`
--
ALTER TABLE `sub_order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `delivery_sheet`
--
ALTER TABLE `delivery_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expense_sub_items`
--
ALTER TABLE `expense_sub_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `formula_entry`
--
ALTER TABLE `formula_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `formula_sub_items`
--
ALTER TABLE `formula_sub_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `new_item`
--
ALTER TABLE `new_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_sheet`
--
ALTER TABLE `order_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_batch_sub_iteam`
--
ALTER TABLE `product_batch_sub_iteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_sub_item`
--
ALTER TABLE `product_sub_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `raw_material_overview`
--
ALTER TABLE `raw_material_overview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sub_delivery_sheet`
--
ALTER TABLE `sub_delivery_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_order_list`
--
ALTER TABLE `sub_order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `new_item`
--
ALTER TABLE `new_item`
  ADD CONSTRAINT `Test` FOREIGN KEY (`items_id`) REFERENCES `purchase_entry` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
