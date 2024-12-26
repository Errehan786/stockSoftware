-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2024 at 02:00 PM
-- Server version: 5.6.51
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineholi_rayInfoSolution_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `accountName` char(255) DEFAULT NULL,
  `accountGroup` char(255) DEFAULT NULL,
  `remarks` char(255) DEFAULT NULL,
  `creditPeriod` char(255) DEFAULT NULL,
  `opeaning` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `accountName`, `accountGroup`, `remarks`, `creditPeriod`, `opeaning`) VALUES
(11, 'factory expenses', 'Misc. Expenditure', '', '', 0),
(10, 'vicky ji', 'sundry debitors', '', '90', 100),
(8, 'nivan jain', 'sundry debitors', 'ok', '20', 10000),
(4, 'sanjai ji', 'Capital Accounts', 'ok', '', 50000),
(5, 'rahul ji', 'Interest Accounts', 'ok', '', 5),
(9, 'subham ji', 'sundry debitors', 'okk', '20', 5500);

-- --------------------------------------------------------

--
-- Table structure for table `cableProduction`
--

CREATE TABLE `cableProduction` (
  `id` int(11) NOT NULL,
  `productCat` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `quantity` char(255) DEFAULT NULL,
  `unit` char(255) DEFAULT NULL,
  `tranId` char(255) DEFAULT NULL,
  `date` char(255) DEFAULT NULL,
  `type` char(255) DEFAULT NULL,
  `factor` float DEFAULT NULL,
  `strand` float DEFAULT NULL,
  `guage` float DEFAULT NULL,
  `core` float DEFAULT NULL,
  `twisting` float DEFAULT NULL,
  `coilWt` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `grade1` char(255) DEFAULT NULL,
  `grade2` char(255) DEFAULT NULL,
  `grade3` char(255) DEFAULT NULL,
  `grade4` char(255) DEFAULT NULL,
  `grade5` char(255) DEFAULT NULL,
  `grade6` char(255) DEFAULT NULL,
  `percentage1` float DEFAULT NULL,
  `percentage2` float DEFAULT NULL,
  `percentage3` float DEFAULT NULL,
  `percentage4` float DEFAULT NULL,
  `percentage5` float DEFAULT NULL,
  `percentage6` float DEFAULT NULL,
  `weight1` float DEFAULT NULL,
  `weight2` float DEFAULT NULL,
  `weight3` float DEFAULT NULL,
  `weight4` float DEFAULT NULL,
  `weight5` float DEFAULT NULL,
  `weight6` float DEFAULT NULL,
  `stock1` float DEFAULT NULL,
  `stock2` float DEFAULT NULL,
  `stock3` float DEFAULT NULL,
  `stock4` float DEFAULT NULL,
  `stock5` float DEFAULT NULL,
  `stock6` float DEFAULT NULL,
  `copper` char(255) DEFAULT NULL,
  `copper1` char(255) DEFAULT NULL,
  `PVCWeight1` float DEFAULT NULL,
  `PVCWeight2` float DEFAULT NULL,
  `gullaText` char(255) DEFAULT NULL,
  `wasteText` char(255) DEFAULT NULL,
  `gullaAmount` char(255) DEFAULT NULL,
  `wasteAmount` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cableProduction`
--

INSERT INTO `cableProduction` (`id`, `productCat`, `description`, `quantity`, `unit`, `tranId`, `date`, `type`, `factor`, `strand`, `guage`, `core`, `twisting`, `coilWt`, `length`, `grade1`, `grade2`, `grade3`, `grade4`, `grade5`, `grade6`, `percentage1`, `percentage2`, `percentage3`, `percentage4`, `percentage5`, `percentage6`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `weight6`, `stock1`, `stock2`, `stock3`, `stock4`, `stock5`, `stock6`, `copper`, `copper1`, `PVCWeight1`, `PVCWeight2`, `gullaText`, `wasteText`, `gullaAmount`, `wasteAmount`) VALUES
(1, 'WPTC', '4 MM WPTC', '8820.00', 'Meters', '8160', '2024-11-21', 'A', 137, 7, 34, 2, 0, 9.5, 90, 'A-1', 'A-2', '', '', '', '', 30, 70, 0, 0, 0, 0, 220.5, 514.5, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '196.00', '196.00', 735, 735, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expance`
--

CREATE TABLE `expance` (
  `id` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL,
  `category` char(255) DEFAULT NULL,
  `cost` bigint(20) DEFAULT NULL,
  `currentDate` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expance`
--

INSERT INTO `expance` (`id`, `name`, `category`, `cost`, `currentDate`) VALUES
(7, 'rajesh', 'Labour', 1222, '2024-11-29'),
(4, 'Rent', 'rent', 5000, '2024-10-28'),
(5, 'rohit K', 'maintenance', 6000, '2024-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `factor_tbl`
--

CREATE TABLE `factor_tbl` (
  `id` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factor_tbl`
--

INSERT INTO `factor_tbl` (`id`, `name`) VALUES
(1, '450'),
(2, '452'),
(3, '137');

-- --------------------------------------------------------

--
-- Table structure for table `finishGoods`
--

CREATE TABLE `finishGoods` (
  `id` int(11) NOT NULL,
  `groupName` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `openingStock` char(255) DEFAULT NULL,
  `stockLimit` char(255) DEFAULT NULL,
  `Unit` char(255) DEFAULT NULL,
  `costPrice` char(255) DEFAULT NULL,
  `Rate` char(255) DEFAULT NULL,
  `type` char(255) DEFAULT NULL,
  `factor` float DEFAULT NULL,
  `strand` float DEFAULT NULL,
  `guage` float DEFAULT NULL,
  `core` float DEFAULT NULL,
  `twisting` float DEFAULT NULL,
  `coilWt` float DEFAULT NULL,
  `length` float DEFAULT NULL,
  `metalWt` float DEFAULT NULL,
  `drawing` float DEFAULT NULL,
  `rRate` float DEFAULT NULL,
  `grade1` char(255) DEFAULT NULL,
  `grade2` char(255) DEFAULT NULL,
  `grade3` char(255) DEFAULT NULL,
  `grade4` char(255) DEFAULT NULL,
  `grade5` char(255) DEFAULT NULL,
  `grade6` char(255) DEFAULT NULL,
  `avgRate1` float DEFAULT NULL,
  `avgRate2` float DEFAULT NULL,
  `avgRate3` float DEFAULT NULL,
  `avgRate4` float DEFAULT NULL,
  `avgRate5` float DEFAULT NULL,
  `avgRate6` float DEFAULT NULL,
  `percentage1` float DEFAULT NULL,
  `percentage2` float DEFAULT NULL,
  `percentage3` float DEFAULT NULL,
  `percentage4` float DEFAULT NULL,
  `percentage5` float DEFAULT NULL,
  `percentage6` float DEFAULT NULL,
  `weight1` float DEFAULT NULL,
  `weight2` float DEFAULT NULL,
  `weight3` float DEFAULT NULL,
  `weight4` float DEFAULT NULL,
  `weight5` float DEFAULT NULL,
  `weight6` float DEFAULT NULL,
  `amount1` float DEFAULT NULL,
  `amount2` float DEFAULT NULL,
  `amount3` float DEFAULT NULL,
  `amount4` float DEFAULT NULL,
  `amount5` float DEFAULT NULL,
  `amount6` float DEFAULT NULL,
  `PVCWt` float DEFAULT NULL,
  `avjWt` float DEFAULT NULL,
  `totalAmount` float DEFAULT NULL,
  `labourCharge` float DEFAULT NULL,
  `pacCharge` float DEFAULT NULL,
  `ratePer` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finishGoods`
--

INSERT INTO `finishGoods` (`id`, `groupName`, `description`, `openingStock`, `stockLimit`, `Unit`, `costPrice`, `Rate`, `type`, `factor`, `strand`, `guage`, `core`, `twisting`, `coilWt`, `length`, `metalWt`, `drawing`, `rRate`, `grade1`, `grade2`, `grade3`, `grade4`, `grade5`, `grade6`, `avgRate1`, `avgRate2`, `avgRate3`, `avgRate4`, `avgRate5`, `avgRate6`, `percentage1`, `percentage2`, `percentage3`, `percentage4`, `percentage5`, `percentage6`, `weight1`, `weight2`, `weight3`, `weight4`, `weight5`, `weight6`, `amount1`, `amount2`, `amount3`, `amount4`, `amount5`, `amount6`, `PVCWt`, `avjWt`, `totalAmount`, `labourCharge`, `pacCharge`, `ratePer`) VALUES
(2, 'SUB', 'GEM 2.5 MM', '10940.00', '', 'Meters', '', '59.16', 'C', 450, 36, 10.7, 3, 2, 16.5, 100, 5.68, 20, 850, 'A-1', 'A-2', 'A-3', 'A-5', '', '', 26, 55.67, 44, 32.27, 0, 0, 20, 30, 20, 30, 0, 0, 2.16, 3.25, 2.16, 3.25, 0, 0, 56.16, 180.93, 95.04, 104.88, 0, 0, 10.82, 40.38, 5378.51, 10, 0, 100),
(5, 'WPTC', '4 MM WPTC', '4500.00', '', 'Meters', '', '11.25', 'A', 137, 7, 34, 2, 0, 9.5, 90, 2, 15, 270, 'A-1', 'A-2', '', '', '', '', 26, 55.67, 0, 0, 0, 0, 30, 70, 0, 0, 0, 0, 2.25, 5.25, 0, 0, 0, 0, 0, 292.27, 0, 0, 0, 0, 7.5, 46.77, 920.78, 10, 0, 90),
(4, 'WPTC', '6 MM WPTC', '4500.00', '', 'Meters', '', '14.31', 'A', 137, 7, 40, 2, 0, 11.5, 90, 2.76, 0, 276, 'A-1', 'A-2', '', '', '', '', 26, 55.67, 0, 0, 0, 0, 30, 70, 0, 0, 0, 0, 2.62, 6.12, 0, 0, 0, 0, 68.12, 340.7, 0, 0, 0, 0, 8.74, 46.77, 1170.53, 10, 0, 90),
(6, 'MS', 'gem 1 mm', '54000.00', '', 'Meters', '', '7.77', 'C', 450, 14, 11, 1, 2, 1.25, 90, 0.7, 22, 850, 'A-1', 'A-2', '', '', '', '', 25.55, 54.26, 0, 0, 0, 0, 30, 70, 0, 0, 0, 0, 0.17, 0.39, 0, 0, 0, 0, 0, 21.16, 0, 0, 0, 0, 0.55, 45.65, 635.51, 10, 0, 90),
(7, 'MS', 'GEM 1.5 MM', '63000.00', '', 'Meters', '', '12.06', 'C', 450, 22, 11, 1, 2, 1.7, 90, 1.1, 22, 850, 'A-1', 'A-2', '', '', '', '', 25.55, 54.26, 0, 0, 0, 0, 30, 70, 0, 0, 0, 0, 0.18, 0.42, 0, 0, 0, 0, 0, 22.79, 0, 0, 0, 0, 0.6, 45.65, 986.59, 10, 0, 90),
(8, 'SUB', 'GEM 4 MM SUB', '6000.00', '', 'Meters', '', '94.32', 'C', 450, 56, 11, 3, 2, 21.5, 100, 9.33, 20, 850, 'A-1', 'A-2', 'A-3', 'A-5', '', '', 25.55, 54.26, 44, 32.27, 0, 0, 30, 12, 40, 18, 0, 0, 3.65, 1.46, 4.87, 2.19, 0, 0, 93.26, 79.22, 214.28, 70.67, 0, 0, 12.17, 37.58, 8574.45, 10, 0, 100),
(9, 'AL S/C', '6 MM S/C', '54000.00', '', 'Meters', '', '4.62', 'A', 137, 7, 34, 1, 0, 3.2, 90, 0.998, 0, 278, 'A-1', 'A-2', '', '', '', '', 25.55, 54.26, 0, 0, 0, 0, 30, 70, 0, 0, 0, 0, 0.66, 1.54, 0, 0, 0, 0, 16.86, 83.56, 0, 0, 0, 0, 2.2, 45.65, 377.87, 10, 0, 90);

-- --------------------------------------------------------

--
-- Table structure for table `gauge_tbl`
--

CREATE TABLE `gauge_tbl` (
  `id` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gauge_tbl`
--

INSERT INTO `gauge_tbl` (`id`, `name`) VALUES
(1, '11'),
(2, '10.7'),
(3, '34'),
(4, '40'),
(5, '10'),
(6, '11');

-- --------------------------------------------------------

--
-- Table structure for table `goodsGroup`
--

CREATE TABLE `goodsGroup` (
  `id` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goodsGroup`
--

INSERT INTO `goodsGroup` (`id`, `name`) VALUES
(1, 'MS'),
(2, 'WPTC'),
(3, 'SUB'),
(4, 'FLEXIBLE ROUND'),
(5, 'AL S/C'),
(6, 'SINGLE STAND'),
(7, 'AL 3 CORE'),
(8, 'AL 4 CORE'),
(9, 'FLEXIBLE'),
(10, 'WPTC S/S');

-- --------------------------------------------------------

--
-- Table structure for table `goodsRawMetrial`
--

CREATE TABLE `goodsRawMetrial` (
  `id` int(11) NOT NULL,
  `voucherNo` bigint(20) DEFAULT NULL,
  `groupName` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `packingUnit` char(255) DEFAULT NULL,
  `length` char(255) DEFAULT NULL,
  `qtyPack` float(19,2) DEFAULT NULL,
  `totalQty` float(19,2) DEFAULT NULL,
  `coilWt` char(20) DEFAULT NULL,
  `rate` decimal(19,2) DEFAULT NULL,
  `lrNo` char(255) DEFAULT NULL,
  `transport` char(255) DEFAULT NULL,
  `lotNo` char(255) DEFAULT NULL,
  `type` enum('purchaseFinishedGoods','salesFinishedGoods','salesReturnFinishedGoods') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `goodsRawMetrial`
--

INSERT INTO `goodsRawMetrial` (`id`, `voucherNo`, `groupName`, `description`, `packingUnit`, `length`, `qtyPack`, `totalQty`, `coilWt`, `rate`, `lrNo`, `transport`, `lotNo`, `type`) VALUES
(1, 3272, 'SUB', 'GEM 2.5 MM', 'COIL', '300', 7.00, 2100.00, 'Meters', 59.00, '0222', '255', '25', 'salesFinishedGoods'),
(2, 4173, 'SUB', 'GEM 2.5 MM', 'COIL', '300', 5.00, 1500.00, 'Meters', 59.00, '', '', '', 'salesReturnFinishedGoods'),
(3, 4, 'SUB', 'GEM 2.5 MM', 'COKIL', '300', 2.00, 600.00, 'Meters', 59.16, '1254', '8541', '5424', 'purchaseFinishedGoods'),
(4, 7969, 'WPTC', '4 MM WPTC', 'COIL', '90', 30.00, 2700.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(5, 7767, 'WPTC', '4 MM WPTC', 'COIL', '90', 18.00, 1620.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(7, 8809, 'WPTC', '4 MM WPTC', 'COIL', '90', 10.00, 900.00, 'Meters', 11.25, '', '', '', 'salesReturnFinishedGoods'),
(8, 8625, 'WPTC', '4 MM WPTC', 'COIL', '450', 10.00, 4500.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(10, 4, 'WPTC', '4 MM WPTC', 'COIL', '450', 10.00, 4500.00, 'Meters', 11.25, '5864', '8574', '6584', 'purchaseFinishedGoods'),
(13, 4, 'WPTC', '4 MM WPTC', 'COIL', '100', 10.00, 1000.00, 'Meters', 11.25, '8547', '0252', '5854', 'purchaseFinishedGoods'),
(14, 4, 'WPTC', '4 MM WPTC', 'coil', '90', 10.00, 900.00, 'Meters', 11.25, '985', '586', '8547', 'purchaseFinishedGoods'),
(15, 5506, 'WPTC', '4 MM WPTC', 'coil', '90', 70.00, 6300.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(16, 5506, 'WPTC', '4 MM WPTC', 'coil', '450', 50.00, 22500.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(18, 3571, 'WPTC', '4 MM WPTC', 'coil', '100', 10.00, 1000.00, 'Meters', 11.25, '', '', '', 'salesFinishedGoods'),
(19, 4973, 'SUB', 'GEM 2.5 MM', 'coil', '500', 12.00, 6000.00, 'Meters', 59.16, '', '', '', 'salesFinishedGoods'),
(47, 6, 'MS', 'gem 1 mm', 'coil', '20', 14.00, 280.00, 'Meters', 7.77, '25', '58', '14', 'purchaseFinishedGoods'),
(21, 3, 'WPTC', '6 MM WPTC', 'coil', '10', 4.00, 40.00, 'Meters', 14.31, '', '', '', 'salesReturnFinishedGoods'),
(22, 7, 'MS', 'gem 1 mm', 'COIL', '90', 200.00, 18000.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(23, 7, 'MS', 'GEM 1.5 MM', 'COIL', '90', 300.00, 27000.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(24, 8, 'MS', 'GEM 1.5 MM', 'coil', '90', 10.00, 900.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(44, 5, 'WPTC', '4 MM WPTC', 'coil', '20', 10.00, 200.00, 'Meters', 11.25, '14', '54', '41', 'purchaseFinishedGoods'),
(26, 9, 'MS', 'gem 1 mm', 'coil', '90', 10.00, 900.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(27, 9, 'MS', 'gem 1 mm', 'coil', '90', 10.00, 900.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(28, 9, 'MS', 'gem 1 mm', 'coil', '90', 10.00, 900.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(29, 9, 'MS', 'gem 1 mm', 'coil', '90', 20.00, 1800.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(30, 10, 'MS', 'gem 1 mm', 'coil', '90', 10.00, 900.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(31, 11, 'MS', 'gem 1 mm', 'coil', '90', 50.00, 4500.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(33, 12, 'MS', 'GEM 1.5 MM', 'coil', '90', 100.00, 9000.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(34, 13, 'MS', 'gem 1 mm', 'coil', '90', 100.00, 9000.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(36, 13, 'MS', 'GEM 1.5 MM', 'coil', '90', 100.00, 9000.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(37, 14, 'MS', 'GEM 1.5 MM', 'coil', '90', 100.00, 9000.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(38, 14, 'MS', 'gem 1 mm', 'coil', '90', 100.00, 9000.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(43, 16, 'MS', 'GEM 1.5 MM', 'coil', '50', 10.00, 500.00, 'Meters', 12.06, '', '', '', 'salesFinishedGoods'),
(40, 15, 'MS', 'gem 1 mm', 'coil', '20', 10.00, 200.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(41, 15, 'MS', 'gem 1 mm', 'coil', '90', 10.00, 900.00, 'Meters', 7.77, '', '', '', 'salesFinishedGoods'),
(42, 4, 'MS', 'GEM 1.5 MM', 'coil', '50', 50.00, 2500.00, 'Meters', 12.06, '', '', '', 'purchaseFinishedGoods'),
(45, 5, 'MS', 'gem 1 mm', 'coil', '15', 41.00, 615.00, 'Meters', 7.77, '54', '74', '14', 'purchaseFinishedGoods'),
(46, 6, 'AL S/C', '6 MM S/C', 'coil', '10', 25.00, 250.00, 'Meters', 4.62, '876', '858', '9654', 'purchaseFinishedGoods');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'RAW MATERIALS'),
(2, 'PVC'),
(3, 'box '),
(4, 'wooden drum');

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
-- Table structure for table `metalType`
--

CREATE TABLE `metalType` (
  `id` int(11) NOT NULL,
  `type` char(255) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metalType`
--

INSERT INTO `metalType` (`id`, `type`, `price`) VALUES
(1, 'C', 0),
(2, 'A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `productCalculation`
--

CREATE TABLE `productCalculation` (
  `id` int(11) NOT NULL,
  `groupName` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `quantity` char(255) DEFAULT NULL,
  `qtyKg` char(255) DEFAULT NULL,
  `units` char(255) DEFAULT NULL,
  `rate` char(255) DEFAULT NULL,
  `pvcDescription` char(255) DEFAULT NULL,
  `totalQuantity` char(255) DEFAULT NULL,
  `prodQuantity` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productCalculation`
--

INSERT INTO `productCalculation` (`id`, `groupName`, `description`, `quantity`, `qtyKg`, `units`, `rate`, `pvcDescription`, `totalQuantity`, `prodQuantity`) VALUES
(1, 'RAW MATERIALS', 'resin', '10', '10', 'Kg', '55', 'A-1', '31', '379.81'),
(2, 'RAW MATERIALS', 'cal 1010', '10', '10', 'Kg', '12', 'A-1', '31', '353.36'),
(3, 'RAW MATERIALS', 'tbls', '10', '10', 'Kg', '11', 'A-1', '31', '180.02'),
(4, 'RAW MATERIALS', 'resin', '10', '10', 'Kg', '55', 'A-2', '31', '379.81'),
(5, 'RAW MATERIALS', 'TT', '10', '10', 'Kg', '100', 'A-2', '31', '173.34'),
(6, 'RAW MATERIALS', 'cal 1010', '10', '10', 'Kg', '12', 'A-2', '31', '353.36'),
(7, 'RAW MATERIALS', 'resin', '10', '10', 'Kg', '55', 'A-3', '50', '379.81'),
(8, 'RAW MATERIALS', 'cal 1010', '10', '10', 'Kg', '12', 'A-3', '50', '353.36'),
(9, 'RAW MATERIALS', 'tbls', '10', '10', 'Kg', '11', 'A-3', '50', '180.02'),
(10, 'RAW MATERIALS', 'TT', '10', '10', 'Kg', '100', 'A-3', '50', '173.34'),
(11, 'RAW MATERIALS', 'cal 1010', '10', '10', 'Kg', '13', 'A-5', '55', '353.36'),
(12, 'RAW MATERIALS', 'cal 1010', '10', '10', 'Kg', '12', 'A-3', '50', '353.36'),
(13, 'RAW MATERIALS', 'cal 1010', '20', '20', 'Kg', '12', 'A-5', '55', '353.36'),
(15, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '54', 'A-5', '55', '379.81'),
(19, 'RAW MATERIALS', 'cal 1010', '12', '12', 'Kg', '12', 'a-4', '40', '353.36'),
(20, 'RAW MATERIALS', 'tbls', '2', '2', 'Kg', '11', 'a-4', '40', '180.02'),
(21, 'RAW MATERIALS', 'TT', '1', '1', 'Kg', '100', 'a-4', '40', NULL),
(22, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '54', 'a-4', '40', '379.81'),
(30, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '94', 'j-62', '47.25', '379.81'),
(29, 'RAW MATERIALS', 'dop', '13', '13', 'Kg', '145', 'j-61', '38', '13.75'),
(28, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '94', 'j-61', '38', '379.81'),
(26, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '91', 'j-60', '25', '379.81'),
(31, 'RAW MATERIALS', 'mhs-90', '8', '8', 'Kg', '26', 'j-62', '47.25', '8.47'),
(32, 'RAW MATERIALS', 'c.s', '0.200', '0.200', 'Kg', '140', 'j-62', '47.25', '0.21'),
(33, 'RAW MATERIALS', 'one pack', '1', '1', 'Kg', '190', 'j-62', '47.25', '1.05'),
(34, 'RAW MATERIALS', 'FINAWAX', '0.050', '0.050', 'Kg', '750', 'j-62', '47.25', '0.05'),
(35, 'RAW MATERIALS', 'dop', '13', '13', 'Kg', '145', 'j-62', '47.25', '13.75'),
(36, 'RAW MATERIALS', 'RESIN', '25', '25', 'Kg', '94', 'j-9', '52.150000000000006', '379.81'),
(37, 'RAW MATERIALS', 'cpw', '12', '12', 'Kg', '61', 'j-9', '52.150000000000006', NULL),
(38, 'RAW MATERIALS', 'c.s', '0.200', '0.200', 'Kg', '140', 'j-9', '52.150000000000006', '0.21'),
(39, 'RAW MATERIALS', 'dop', '2', '2', 'Kg', '145', 'j-9', '52.150000000000006', '13.75'),
(40, 'RAW MATERIALS', 'tbls', '0.500', '0.500', 'Kg', '250', 'j-9', '52.150000000000006', '180.02'),
(41, 'RAW MATERIALS', 'dblp', '0.200', '0.200', 'Kg', '260', 'j-9', '52.150000000000006', NULL),
(42, 'RAW MATERIALS', 'mhs-90', '12', '12', 'Kg', '26', 'j-9', '52.150000000000006', '8.47'),
(43, 'RAW MATERIALS', 'TT', '0.250', '0.250', 'Kg', '425', 'j-9', '52.150000000000006', NULL),
(44, 'RAW MATERIALS', 'green pipe', '55', '55', 'Kg', '57', 'ISRP', '105.5', NULL),
(45, 'RAW MATERIALS', 'cpw', '25', '25', 'Kg', '61', 'ISRP', '105.5', NULL),
(46, 'RAW MATERIALS', '998', '25', '25', 'Kg', '6', 'ISRP', '105.5', NULL),
(47, 'RAW MATERIALS', 'carbon', '0.500', '0.500', 'Kg', '125', 'ISRP', '105.5', NULL),
(49, 'box', 'Testing', '20', '20', '10', '20', 'j-56', '40', NULL),
(50, 'box', 'Testing', '20', '20', '2', '20', 'j-56', '40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productSize`
--

CREATE TABLE `productSize` (
  `id` int(11) NOT NULL,
  `size` char(255) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productSize`
--

INSERT INTO `productSize` (`id`, `size`, `price`) VALUES
(1, '10', 11),
(2, '11', 12),
(3, '40', 0),
(4, '34', 0),
(5, '105', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseGoodsRawMaterial`
--

CREATE TABLE `purchaseGoodsRawMaterial` (
  `id` int(11) NOT NULL,
  `partyAccountName` char(255) DEFAULT NULL,
  `accountName` char(255) DEFAULT NULL,
  `voucherNo` bigint(20) DEFAULT NULL,
  `date` char(255) DEFAULT NULL,
  `totalAmount` bigint(20) DEFAULT NULL,
  `discountPer` char(255) DEFAULT NULL,
  `addChargeAmount` bigint(20) DEFAULT NULL,
  `dudChargeAmount` bigint(20) DEFAULT NULL,
  `addChargeRemark` char(255) DEFAULT NULL,
  `dudChargeRemark` char(255) DEFAULT NULL,
  `totalBill` bigint(20) DEFAULT NULL,
  `remark` char(255) DEFAULT NULL,
  `type` enum('purchaseFinishedGoods','salesFinishedGoods','salesReturnFinishedGoods') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseGoodsRawMaterial`
--

INSERT INTO `purchaseGoodsRawMaterial` (`id`, `partyAccountName`, `accountName`, `voucherNo`, `date`, `totalAmount`, `discountPer`, `addChargeAmount`, `dudChargeAmount`, `addChargeRemark`, `dudChargeRemark`, `totalBill`, `remark`, `type`) VALUES
(1, 'sanjai ji', 'Capital Accounts', 1, '21-11-2024', 123900, '10', 10, 5, '', '', 111515, '', 'salesFinishedGoods'),
(2, 'nivan jain', 'sundry debitors', 1, '21-11-2024', 88500, '10', 50, 50, '', '', 79650, 'OK', 'salesReturnFinishedGoods'),
(3, 'nivan jain', 'sundry debitors', 1, '21-11-2024', 35496, '', 0, 1, '', '', 35495, '', 'purchaseFinishedGoods'),
(4, 'nivan jain', 'sundry debitors', 2, '21-11-2024', 30375, '', 0, 4, '', '', 30371, '', 'salesFinishedGoods'),
(5, 'rahul ji', 'Interest Accounts', 3, '21-11-2024', 36450, '', 0, 2, '', '', 36448, '', 'salesFinishedGoods'),
(6, 'nivan jain', 'sundry debitors', 2, '21-11-2024', 10125, '', 0, 0, '', '', 10125, '', 'salesReturnFinishedGoods'),
(7, 'sanjai ji', 'Capital Accounts', 4, '21-11-2024', 101250, '', 0, 0, '', '', 101250, '', 'salesFinishedGoods'),
(8, 'sanjai ji', 'Capital Accounts', 2, '21-11-2024', 151875, '', 0, 2, '', '', 151873, '', 'purchaseFinishedGoods'),
(9, 'sanjai ji', 'Capital Accounts', 3, '22-11-2024', 10125, '', 0, 0, '', '', 10125, '', 'purchaseFinishedGoods'),
(10, 'sanjai ji', 'Capital Accounts', 5, '22-11-2024', 11250, '', 0, 0, '', '', 11250, '', 'salesFinishedGoods'),
(11, 'nivan jain', 'sundry debitors', 6, '22-11-2024', 6440, '10', 34, 15, '', '', 5815, '', 'salesFinishedGoods'),
(12, 'nivan jain', 'sundry debitors', 3, '22-11-2024', 572, '10', 21, 15, '', '', 521, '', 'salesReturnFinishedGoods'),
(13, 'rahul ji', 'Interest Accounts', 7, '23-11-2024', 465480, '', 0, 0, '', '', 465480, '', 'salesFinishedGoods'),
(14, 'sanjai ji', 'Capital Accounts', 8, '25-11-2024', 0, '', 0, 0, '', '', 0, '', 'salesFinishedGoods'),
(15, 'nivan jain', 'sundry debitors', 9, '25-11-2024', 34965, '10', 21, 15, '', '', 31475, '', 'salesFinishedGoods'),
(16, 'nivan jain', 'sundry debitors', 10, '25-11-2024', 6993, '10', 42, 15, '', '', 6321, '', 'salesFinishedGoods'),
(17, 'sanjai ji', 'Capital Accounts', 11, '25-11-2024', 69930, '', 0, 1, '', '', 69929, '', 'salesFinishedGoods'),
(18, 'nivan jain', 'sundry debitors', 12, '25-11-2024', 108540, '', 0, 1, '', '', 108539, '', 'salesFinishedGoods'),
(19, 'nivan jain', 'sundry debitors', 13, '29-11-2024', 178470, '', 0, 1, '', '', 178469, '', 'salesFinishedGoods'),
(20, 'nivan jain', 'sundry debitors', 14, '30-11-2024', 178470, '', 0, 0, '', '', 178470, '', 'salesFinishedGoods'),
(21, 'vicky ji', 'sundry debitors', 15, '11-12-2024', 8547, '', 0, 1, '', '', 8546, '', 'salesFinishedGoods'),
(22, 'vicky ji', 'sundry debitors', 4, '16-12-2024', 33258, '', 0, 1, '', '', 33257, '', 'purchaseFinishedGoods'),
(23, 'vicky ji', 'sundry debitors', 16, '16-12-2024', 6030, '', 0, 1, '', '', 6029, '', 'salesFinishedGoods'),
(25, 'subham ji', 'sundry debitors', 5, '20-12-2024', 7029, '10', 20, 40, 'test 01', 'test 02', 6306, 'test', 'purchaseFinishedGoods'),
(26, 'subham ji', 'sundry debitors', 6, '21-12-2024', 3331, '14', 32, 15, 'carry Charge', 'invest', 2882, 'test', 'purchaseFinishedGoods');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseLotWise`
--

CREATE TABLE `purchaseLotWise` (
  `id` int(11) NOT NULL,
  `partyAccount` char(255) DEFAULT NULL,
  `accountName` char(255) DEFAULT NULL,
  `voucherNo` bigint(20) DEFAULT NULL,
  `cDate` char(255) DEFAULT NULL,
  `invoiceNo` char(255) DEFAULT NULL,
  `remark` char(255) DEFAULT NULL,
  `metal` char(255) DEFAULT NULL,
  `type` char(255) DEFAULT NULL,
  `typeSize` char(255) DEFAULT NULL,
  `noOfReel` bigint(20) DEFAULT NULL,
  `grossWt` char(255) DEFAULT NULL,
  `rodRate` bigint(20) DEFAULT NULL,
  `drawing` int(11) DEFAULT NULL,
  `emptyDate` char(255) DEFAULT NULL,
  `emptyNoOfReel` int(11) DEFAULT NULL,
  `reelWt` char(255) DEFAULT NULL,
  `netWeight` char(255) DEFAULT NULL,
  `totalAmount` int(11) DEFAULT NULL,
  `interest` int(11) DEFAULT NULL,
  `netAmount` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseLotWise`
--

INSERT INTO `purchaseLotWise` (`id`, `partyAccount`, `accountName`, `voucherNo`, `cDate`, `invoiceNo`, `remark`, `metal`, `type`, `typeSize`, `noOfReel`, `grossWt`, `rodRate`, `drawing`, `emptyDate`, `emptyNoOfReel`, `reelWt`, `netWeight`, `totalAmount`, `interest`, `netAmount`) VALUES
(1, 'nivan jain', 'sundry debitors', 3873, '21-11-2024', '2781', '', 'A', 'Reel', '34', 14, '256.45', 256, 0, '2024-11-21', 14, '11.15', '245.30', 62797, 0, '62796.80'),
(2, 'sanjai ji', 'Capital Accounts', 3434, '21-11-2024', '0841', '', 'A', 'Reel', '40', 32, '1223.45', 276, 0, '2024-11-21', 0, '0', '1223.45', 337672, 0, '337672.20'),
(3, 'nivan jain', 'sundry debitors', 3821, '21-11-2024', '9051', '', 'A', 'Coil', '105', 7, '1222.5', 276, 0, '2024-11-21', 0, '0', '1222.50', 337410, 0, '337410.00'),
(4, 'nivan jain', 'sundry debitors', 3675, '21-11-2024', '6022', '', 'C', 'Reel', '11', 220, '2330.85', 850, 20, '2024-11-21', 0, '0', '2330.85', 2027840, 0, '2027839.50'),
(5, 'sanjai ji', 'Capital Accounts', 4004, '22-11-2024', '8823', '', 'C', 'Reel', '10', 100, '544.45', 850, 11, '2024-11-22', 0, '0', '544.45', 468771, 0, '468771.45'),
(6, 'sanjai ji', 'Capital Accounts', 7643, '22-11-2024', '6715', '', 'C', 'Reel', '11', 220, '543.25', 850, 12, '2024-11-22', 0, '0', '543.25', 468282, 0, '468281.50'),
(7, 'sanjai ji', 'Capital Accounts', 3474, '23-11-2024', '5000', '', 'C', 'Reel', '10', 200, '1222.5', 850, 11, '2024-11-23', 0, '0', '1222.50', 1052573, 0, '1052572.50');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseRawMaterial`
--

CREATE TABLE `purchaseRawMaterial` (
  `id` int(11) NOT NULL,
  `prodCat` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `baseQty` char(255) DEFAULT NULL,
  `containerType` char(255) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `netQty` char(255) DEFAULT NULL,
  `unit` char(255) DEFAULT NULL,
  `rate` char(255) DEFAULT NULL,
  `voucherNo` int(11) DEFAULT NULL,
  `type` enum('purchase','return','rawSale') DEFAULT NULL,
  `cDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseRawMaterial`
--

INSERT INTO `purchaseRawMaterial` (`id`, `prodCat`, `description`, `baseQty`, `containerType`, `content`, `netQty`, `unit`, `rate`, `voucherNo`, `type`, `cDate`) VALUES
(1, 'RAW MATERIALS', 'resin', '2', 'drum', '50', '100', 'Kg', '55', 1, 'purchase', '2024-12-03'),
(2, 'RAW MATERIALS', 'resin', '2', 'drum', '5', '10', 'Kg', '55', 2, 'purchase', '2024-11-05'),
(3, 'RAW MATERIALS', 'cal 1010', '2', 'bag', '5', '10', 'Kg', '12', 3, 'purchase', '2024-12-03'),
(4, 'RAW MATERIALS', 'tbls', '2', 'bag', '5', '10', 'Kg', '11', 4, 'purchase', '2024-12-03'),
(5, 'RAW MATERIALS', 'TT', '2', 'bag', '5', '10', 'Kg', '100', 5, 'purchase', '2024-11-22'),
(6, 'PVC', 'A-1', '2', 'bag', '5', '10', 'Kg', '26.00', 6, 'purchase', '2024-12-03'),
(7, 'PVC', 'A-2', '2', 'bag', '5', '10', 'Kg', '55.67', 1, 'purchase', '2024-10-03'),
(8, 'RAW MATERIALS', 'resin', '2', 'bag', '50', '100', 'Kg', '55', 1, 'return', '2024-11-22'),
(9, 'RAW MATERIALS', 'resin', '2', 'bag', '50', '100', 'Kg', '55', 1, 'return', '2024-12-03'),
(10, 'RAW MATERIALS', 'resin', '10', 'bag', '2', '20', 'Kg', '55', 1, 'return', '2024-12-03'),
(11, 'RAW MATERIALS', 'resin', '2', 'bag', '50', '100', 'Kg', '58', 5, 'purchase', '2024-11-22'),
(12, 'RAW MATERIALS', 'TT', '2', 'bag', '25', '50', 'Kg', '100', 2, 'return', '2024-12-03'),
(13, 'box', '1 mm rm', '2', 'bag', '500', '1000', 'Pcs', '25', 8, 'purchase', '2024-12-03'),
(14, 'PVC', 'A-1', '4', 'bag', '25', '100', 'Kg', '26.25', 7, 'rawSale', '2024-11-22'),
(15, 'PVC', 'A-1', '2', 'bag', '25', '50', 'Kg', '26.55', 6, 'purchase', '2024-12-03'),
(16, 'box', '1 mm rm', '2', 'bag', '500', '1000', 'Pcs', '12', 5, 'purchase', '2024-11-22'),
(17, 'RAW MATERIALS', 'RESIN', '10', 'bag', '10', '100', 'Kg', '54', 2, 'rawSale', '2024-12-02'),
(18, 'RAW MATERIALS', 'RESIN', '20', 'drum', '30', '600', 'Kg', '54', 7, 'purchase', '2024-11-22'),
(19, 'box', 'gem 1 mm', '2', 'bag', '300', '600', 'Pcs', '11', 8, 'purchase', '2024-12-03'),
(20, 'box', 'gem 1 mm', '2', 'bag', '100', '200', 'Pcs', '11', 9, 'purchase', '2024-12-03'),
(21, 'box', 'gem 1.5 mm', '2', 'bag', '100', '200', 'Pcs', '13', 10, 'purchase', '2024-12-03'),
(22, 'RAW MATERIALS', 'cal 1010', '2', 'bag', '50', '100', 'Kg', '12', 11, 'purchase', '2024-11-24'),
(23, 'RAW MATERIALS', 'tbls', '2', 'bag', '50', '100', 'Kg', '11', 11, 'purchase', '2024-11-24'),
(24, 'RAW MATERIALS', 'TT', '2', 'bag', '50', '100', 'Kg', '100', 11, 'purchase', '2024-11-24'),
(25, 'RAW MATERIALS', 'RESIN', '2', 'bag', '50', '100', 'Kg', '54', 11, 'purchase', '2024-11-24'),
(26, 'PVC', 'A-1', '2', 'bag', '50', '100', 'Kg', '25.55', 11, 'purchase', '2024-11-24'),
(27, 'PVC', 'A-2', '2', 'bag', '50', '100', 'Kg', '54.26', 11, 'purchase', '2024-11-24'),
(28, 'PVC', 'A-3', '2', 'bag', '50', '100', 'Kg', '44', 11, 'purchase', '2024-11-24'),
(29, 'PVC', 'A-5', '2', 'bag', '50', '100', 'Kg', '32.27', 11, 'purchase', '2024-11-24'),
(30, 'box', '1 mm rm', '20', 'bag', '10', '200', 'Pcs', '12', 12, 'purchase', '2024-11-25'),
(32, 'box', 'gem 1 mm', '2', 'bag', '50', '100', 'Pcs', '11', 13, 'purchase', '2024-11-29'),
(34, 'box', 'gem 1.5 mm', '2', 'bag', '50', '100', 'Pcs', '13', 13, 'purchase', '2024-11-29'),
(35, 'box', 'gem 1 mm', '10', 'bag', '10', '100', 'Pcs', '11', 14, 'purchase', '2024-12-03'),
(36, 'box', 'gem 1.5 mm', '10', 'bag', '10', '100', 'Pcs', '13', 14, 'purchase', '2024-12-03'),
(38, 'box', 'Testing', '20', 'bag', '10', '200', '4', '20', 3, 'rawSale', '2024-12-03'),
(39, 'RAW MATERIALS', 'cal 1010', '10', 'bag', '10', '100', 'Kg', '12', 15, 'purchase', '2024-12-03'),
(40, 'RAW MATERIALS', 'tbls', '5', 'bag', '5', '25', 'Kg', '11', 15, 'purchase', '2024-12-03'),
(41, 'RAW MATERIALS', 'cpw', '20', 'bag', '20', '400', 'Kg', '61', 16, 'purchase', '2024-12-13'),
(42, 'RAW MATERIALS', 'carbon', '10', 'drum', '14', '140', 'Kg', '120', 16, 'purchase', '2024-12-13'),
(43, 'RAW MATERIALS', 'c.s', '15', 'drum', '10', '150', 'Kg', '140', 16, 'purchase', '2024-12-13'),
(44, 'RAW MATERIALS', 'carbon', '20', 'bag', '10', '200', 'Kg', '120', 17, 'purchase', '2024-12-13'),
(45, 'RAW MATERIALS', 'carbon', '10', 'drum', '14', '140', 'Kg', '120', 17, 'purchase', '2024-12-13'),
(46, 'RAW MATERIALS', 'RESIN', '15', 'drum', '10', '150', 'Kg', '54', 17, 'purchase', '2024-12-13'),
(47, 'PVC', 'A-2', '10', 'bag', '40', '400', 'Kg', '54.26', 4, 'rawSale', '2024-12-16');

-- --------------------------------------------------------

--
-- Table structure for table `quantityData`
--

CREATE TABLE `quantityData` (
  `id` int(11) NOT NULL,
  `prodCat` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `length` char(255) DEFAULT NULL,
  `quantity` char(255) DEFAULT NULL,
  `unit` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quantityData`
--

INSERT INTO `quantityData` (`id`, `prodCat`, `description`, `length`, `quantity`, `unit`) VALUES
(1, 'MS', '1 MM G', '90', '100', 'coil'),
(2, 'MS', '1 MM G', '80', '70', 'coil'),
(3, 'SUB', 'GEM 2.5 MM', '300', '3', 'coil'),
(4, 'SUB', 'GEM 2.5 MM', '500', '3', 'coil'),
(5, 'SUB', 'GEM 2.5 MM', '255', '1', 'coil'),
(6, 'SUB', 'GEM 2.5 MM', '55', '1', 'coil'),
(7, 'SUB', 'GEM 2.5 MM', '65', '2', 'coil'),
(8, 'SUB', 'GEM 2.5 MM', '300', '5', 'COIL'),
(9, 'SUB', 'GEM 2.5 MM', '300', '2', 'COKIL'),
(10, 'SUB', 'GEM 2.5 MM', '100', '20', 'coil'),
(11, 'SUB', 'GEM 2.5 MM', '500', '15', 'coil'),
(12, 'SUB', 'GEM 2.5 MM', '100', '5286', 'coil'),
(13, 'SUB', 'GEM 2.5 MM', '1000', '15', 'coil'),
(14, 'SUB', 'GEM 2.5 MM', '500', '10', 'coil'),
(15, 'SUB', 'GEM 2.5 MM', '500', '15', 'coil'),
(16, 'SUB', 'GEM 2.5 MM', '90', '100', 'coil'),
(17, 'SUB', 'GEM 2.5 MM', '500', '10', 'coil'),
(18, 'SUB', 'GEM 2.5 MM', '500', '10', 'coil'),
(19, 'WPTC', 'GEM 4 MM', '90', '50', 'coil'),
(20, 'WPTC', '6 MM WPTC', '90', '50', 'coil'),
(21, 'WPTC', '4 MM WPTC', '90', '-68', 'coil'),
(22, 'WPTC', '4 MM WPTC', '90', '48', 'coil'),
(23, 'WPTC', '4 MM WPTC', '450', '-30', 'coil'),
(24, 'WPTC', '4 MM WPTC', '90', '10', 'COIL'),
(25, 'WPTC', '4 MM WPTC', '450', '10', 'COIL'),
(26, 'WPTC', '4 MM WPTC', '450', '10', 'COIL'),
(27, 'WPTC', '4 MM WPTC', '450', '10', 'COIL'),
(28, 'WPTC', '4 MM WPTC', '100', '0', 'COIL'),
(29, 'WPTC', '4 MM WPTC', '90', '10', 'coil'),
(30, 'WPTC', '6 MM WPTC', '10', '4', 'coil'),
(32, 'MS', 'gem 1 mm', '90', '90', 'coil'),
(33, 'MS', 'GEM 1.5 MM', '90', '90', 'coil'),
(34, 'SUB', 'GEM 4 MM SUB', '500', '12', 'coil'),
(35, 'AL S/C', '6 MM S/C', '90', '600', 'coil'),
(37, 'SUB', '2.5 3 core flat cable', '500', '5', 'coil'),
(38, 'SUB', '2.5 3CORE FLAT CABLE', '500', '1', 'coil'),
(39, 'SUB', '2.5 3CORE FLAT CABLE', '500', '1', 'coil'),
(40, 'MS', 'gem 1 mm', '20', '10', '10'),
(41, 'MS', 'GEM 1.5 MM', '50', '40', 'coil'),
(42, 'WPTC', '4 MM WPTC', '20', '10', 'coil'),
(43, 'MS', 'gem 1 mm', '15', '41', 'coil'),
(44, 'AL S/C', '6 MM S/C', '10', '25', 'coil'),
(45, 'MS', 'gem 1 mm', '20', '14', 'coil');

-- --------------------------------------------------------

--
-- Table structure for table `rawMeterial`
--

CREATE TABLE `rawMeterial` (
  `id` int(11) NOT NULL,
  `groupName` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `openingStock` bigint(20) DEFAULT NULL,
  `priceUnit` char(255) DEFAULT NULL,
  `rate` char(255) DEFAULT NULL,
  `unit` char(255) DEFAULT NULL,
  `pcs` char(255) DEFAULT NULL,
  `otherExpance` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawMeterial`
--

INSERT INTO `rawMeterial` (`id`, `groupName`, `description`, `openingStock`, `priceUnit`, `rate`, `unit`, `pcs`, `otherExpance`) VALUES
(8, 'box', '1 mm rm', 100, '', '12', 'Pcs', '1', 0),
(2, 'RAW MATERIALS', 'cal 1010', 500, '', '12', 'Kg', '1', 0),
(3, 'RAW MATERIALS', 'tbls', 500, '', '11', 'Kg', '1', 0),
(4, 'PVC', 'A-1', 200, '', '25.52', 'Kg', '1', 0),
(5, 'RAW MATERIALS', 'TT', 500, '', '100', 'Kg', '1', 0),
(6, 'PVC', 'A-2', 500, '', '54.26', 'Kg', '1', 0),
(7, 'PVC', 'A-3', 500, '', '44', 'Kg', '1', 0),
(15, 'PVC', 'a-4', 777, '', '41.40', 'Kg', '1', 1),
(10, 'box', '2.5 mm rms', 200, '', '15', 'Pcs', '1', 0),
(11, 'RAW MATERIALS', 'RESIN', 500, '', '54', 'Kg', '1', 0),
(12, 'PVC', 'A-5', 200, '', '32.27', 'Kg', '1', 1),
(13, 'box', 'gem 1 mm', 1000, '', '11', 'Pcs', '1', 0),
(14, 'box', 'gem 1.5 mm', 900, '', '13', 'Pcs', '1', 0),
(16, 'RAW MATERIALS', 'dop', 200, '', '145', 'Kg', '1', 0),
(17, 'RAW MATERIALS', 'one pack', 19, '', '190', 'Kg', '1', 0),
(18, 'RAW MATERIALS', 'c.s', 200, '', '140', 'Kg', '1', 0),
(19, 'RAW MATERIALS', 'mhs-90', 1000, '', '26', 'Kg', '1', 0),
(20, 'RAW MATERIALS', 'FINAWAX', 10, '', '750', 'Kg', '1', 0),
(21, 'PVC', 'j-60', 1000, '', '', 'Kg', '1', 0),
(22, 'PVC', 'j-62', 1000, '', '114.44', 'Kg', '1', 15),
(23, 'RAW MATERIALS', 'green pipe', 1000, '', '57', 'Kg', '1', 0),
(24, 'RAW MATERIALS', 'cpw', 1000, '', '61', 'Kg', '1', 0),
(25, 'RAW MATERIALS', '998', 1000, '', '6', 'Kg', '1', 0),
(26, 'RAW MATERIALS', 'carbon', 1000, '', '120', 'Kg', '1', 0),
(27, 'RAW MATERIALS', 'dblp', 1000, '', '260', 'Kg', '1', 0),
(28, 'PVC', 'j-9', 1000, '', '91.61', '', '1', 15),
(29, 'PVC', 'ISRP', 1000, '', '61.18', 'Kg', '1', 15),
(30, 'PVC', 'J-55', 2100, '', '', 'Kg', '1', 0),
(31, 'box', 'Testing', 500, '', '20', '', '1', 0),
(32, 'PVC', 'j-56', 500, '', '40.00', 'Kg', '1', 20);

-- --------------------------------------------------------

--
-- Table structure for table `semiGoodsProduct`
--

CREATE TABLE `semiGoodsProduct` (
  `id` int(11) NOT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `prodCat` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `cDate` char(255) DEFAULT NULL,
  `unit` char(255) DEFAULT NULL,
  `newRate` float(19,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semiGoodsProduct`
--

INSERT INTO `semiGoodsProduct` (`id`, `quantity`, `prodCat`, `description`, `cDate`, `unit`, `newRate`) VALUES
(1, 11, 'PVC', 'A-1', '2024-11-20', 'Kg', 26.00),
(2, 20, 'PVC', 'A-2', '2024-11-20', 'Kg', 56.00),
(3, 500, 'PVC', 'A-1', '2024-11-22', 'Kg', 26.00),
(4, 500, 'PVC', 'A-2', '2024-11-22', 'Kg', 26.00),
(5, 10, 'PVC', 'A-1', '2024-12-23', 'Kg', 26.00),
(6, 20, 'PVC', 'A-1', '2024-12-23', 'Kg', 25.52),
(7, 20, 'PVC', 'j-62', '2024-12-26', 'Kg', 114.44),
(8, 30, 'PVC', 'j-62', '2024-12-26', 'Kg', 114.44);

-- --------------------------------------------------------

--
-- Table structure for table `SemiMaterialFinal`
--

CREATE TABLE `SemiMaterialFinal` (
  `id` int(11) NOT NULL,
  `partyAccountName` char(255) DEFAULT NULL,
  `accountName` char(255) DEFAULT NULL,
  `voucherNo` bigint(20) DEFAULT NULL,
  `date` char(255) DEFAULT NULL,
  `invoiceNo` bigint(20) DEFAULT NULL,
  `addCharges` bigint(20) DEFAULT NULL,
  `totalAmountBase` char(255) DEFAULT NULL,
  `deductionCharge` bigint(20) DEFAULT NULL,
  `addChargesRemark` char(255) DEFAULT NULL,
  `deductionChargeRemark` char(255) DEFAULT NULL,
  `totalBill` bigint(20) DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  `type` enum('purchase','return','rawSale') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SemiMaterialFinal`
--

INSERT INTO `SemiMaterialFinal` (`id`, `partyAccountName`, `accountName`, `voucherNo`, `date`, `invoiceNo`, `addCharges`, `totalAmountBase`, `deductionCharge`, `addChargesRemark`, `deductionChargeRemark`, `totalBill`, `remark`, `type`) VALUES
(1, 'kailash elect', 'sundry debitors', 1, '20-11-2024', 1, 0, NULL, 1, '', '', 5499, '', 'purchase'),
(2, 'kailash elect', 'sundry debitors', 2, '20-11-2024', 2, 0, NULL, 1, '', '', 2596, '', 'purchase'),
(3, 'rahul ji', 'sundry creditors', 1, '20-11-2024', 1, 0, NULL, 1, '', '', 5499, '', 'return'),
(4, 'sanjai ji', 'Capital Accounts', 2, '20-11-2024', 2, 0, NULL, 1, '', '', 5499, '', 'return'),
(5, 'sanjai ji', 'Capital Accounts', 3, '21-11-2024', 3, 0, NULL, 2, '', '', 5798, '', 'purchase'),
(6, 'shiv gopal', 'sundry debitors', 3, '21-11-2024', 3, 0, NULL, 0, '', '', 5000, '', 'return'),
(7, 'rahul ji', 'Interest Accounts', 4, '21-11-2024', 4, 0, NULL, 0, '', '', 25000, 'OK', 'purchase'),
(8, 'sanjai ji', 'Capital Accounts', 1, '22-11-2024', 1, 1, NULL, 0, '', '', 2626, '', 'rawSale'),
(9, 'nivan jain', 'sundry debitors', 5, '22-11-2024', 5, 0, NULL, 0, '', '', 1328, '', 'purchase'),
(10, 'sanjai ji', 'Capital Accounts', 6, '22-11-2024', 6, 0, NULL, 0, '', '', 12000, '', 'purchase'),
(11, 'sanjai ji', 'Capital Accounts', 2, '22-11-2024', 2, 21, NULL, 15, '', '', 5406, '', 'rawSale'),
(12, 'nivan jain', 'sundry debitors', 7, '22-11-2024', 7, 21, NULL, 15, '', '', 32406, '', 'purchase'),
(13, 'rahul ji', 'Interest Accounts', 8, '24-11-2024', 8, 0, NULL, 0, '', '', 6600, '', 'purchase'),
(14, 'sanjai ji', 'Capital Accounts', 9, '24-11-2024', 9, 0, NULL, 1, '', '', 2199, '', 'purchase'),
(15, 'rahul ji', 'Interest Accounts', 10, '24-11-2024', 10, 0, NULL, 1, '', '', 2599, '', 'purchase'),
(16, 'nivan jain', 'sundry debitors', 11, '24-11-2024', 11, 0, NULL, 1, '', '', 33307, '', 'purchase'),
(17, 'nivan jain', 'sundry debitors', 12, '25-11-2024', 12, 10, NULL, 10, 'carry Charge', 'invest', 2400, 'gfd', 'purchase'),
(18, 'nivan jain', 'sundry debitors', 13, '29-11-2024', 13, 0, NULL, 1, '', '', 2199, '', 'purchase'),
(19, 'sanjai ji', 'Capital Accounts', 14, '30-11-2024', 14, 0, NULL, 0, '', '', 2400, '', 'purchase'),
(20, 'vicky ji', 'sundry debitors', 3, '05-12-2024', 3, 20, NULL, 15, 'carry Charge', 'sfd', 5205, '', 'rawSale'),
(21, 'vicky ji', 'sundry debitors', 15, '13-12-2024', 15, 32, NULL, 15, 'carry Charge', 'dsa', 1492, 'testing', 'purchase'),
(22, 'subham ji', 'sundry debitors', 16, '13-12-2024', 16, 20, '48900.00', 25, 'Carban', 'Travel', 62195, 'This is Remark', 'purchase'),
(23, 'subham ji', 'sundry debitors', 17, '13-12-2024', 17, 20, '48900.00', 10, 'Tour', 'Invest', 48910, 'Second Remark', 'purchase'),
(24, 'vicky ji', 'sundry debitors', 4, '16-12-2024', 4, 0, NULL, 1, '', '', 21813, '', 'rawSale');

-- --------------------------------------------------------

--
-- Table structure for table `twisting_tbl`
--

CREATE TABLE `twisting_tbl` (
  `id` int(11) NOT NULL,
  `name` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `twisting_tbl`
--

INSERT INTO `twisting_tbl` (`id`, `name`) VALUES
(1, '2'),
(2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `type_tbl`
--

CREATE TABLE `type_tbl` (
  `id` int(11) NOT NULL,
  `type` char(255) DEFAULT NULL,
  `price` char(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_tbl`
--

INSERT INTO `type_tbl` (`id`, `type`, `price`) VALUES
(1, 'C', '0'),
(2, 'A', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cableProduction`
--
ALTER TABLE `cableProduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expance`
--
ALTER TABLE `expance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factor_tbl`
--
ALTER TABLE `factor_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finishGoods`
--
ALTER TABLE `finishGoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gauge_tbl`
--
ALTER TABLE `gauge_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goodsGroup`
--
ALTER TABLE `goodsGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goodsRawMetrial`
--
ALTER TABLE `goodsRawMetrial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metalType`
--
ALTER TABLE `metalType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productCalculation`
--
ALTER TABLE `productCalculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productSize`
--
ALTER TABLE `productSize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseGoodsRawMaterial`
--
ALTER TABLE `purchaseGoodsRawMaterial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseLotWise`
--
ALTER TABLE `purchaseLotWise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseRawMaterial`
--
ALTER TABLE `purchaseRawMaterial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quantityData`
--
ALTER TABLE `quantityData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rawMeterial`
--
ALTER TABLE `rawMeterial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semiGoodsProduct`
--
ALTER TABLE `semiGoodsProduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `SemiMaterialFinal`
--
ALTER TABLE `SemiMaterialFinal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `twisting_tbl`
--
ALTER TABLE `twisting_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_tbl`
--
ALTER TABLE `type_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cableProduction`
--
ALTER TABLE `cableProduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expance`
--
ALTER TABLE `expance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `factor_tbl`
--
ALTER TABLE `factor_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `finishGoods`
--
ALTER TABLE `finishGoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gauge_tbl`
--
ALTER TABLE `gauge_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `goodsGroup`
--
ALTER TABLE `goodsGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `goodsRawMetrial`
--
ALTER TABLE `goodsRawMetrial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `metalType`
--
ALTER TABLE `metalType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productCalculation`
--
ALTER TABLE `productCalculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `productSize`
--
ALTER TABLE `productSize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchaseGoodsRawMaterial`
--
ALTER TABLE `purchaseGoodsRawMaterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `purchaseLotWise`
--
ALTER TABLE `purchaseLotWise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `purchaseRawMaterial`
--
ALTER TABLE `purchaseRawMaterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quantityData`
--
ALTER TABLE `quantityData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `rawMeterial`
--
ALTER TABLE `rawMeterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `semiGoodsProduct`
--
ALTER TABLE `semiGoodsProduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `SemiMaterialFinal`
--
ALTER TABLE `SemiMaterialFinal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `twisting_tbl`
--
ALTER TABLE `twisting_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_tbl`
--
ALTER TABLE `type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
