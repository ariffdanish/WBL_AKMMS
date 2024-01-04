-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 03:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akmms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `c_idnum` varchar(30) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `c_address` varchar(200) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_custtype`
--

CREATE TABLE `tb_custtype` (
  `CT_id` int(2) NOT NULL,
  `CT_desc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_custtype`
--

INSERT INTO `tb_custtype` (`CT_id`, `CT_desc`) VALUES
(1, 'PERSONNEL'),
(2, 'AGENCY');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `e_id` int(20) NOT NULL,
  `e_name` int(100) NOT NULL,
  `e_pwd` int(20) NOT NULL,
  `e_tel` varchar(15) NOT NULL,
  `e_email` varchar(100) NOT NULL,
  `e_role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_emprole`
--

CREATE TABLE `tb_emprole` (
  `role_id` int(2) NOT NULL,
  `role_desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_emprole`
--

INSERT INTO `tb_emprole` (`role_id`, `role_desc`) VALUES
(1, 'ADMIN'),
(2, 'STAFF');

-- --------------------------------------------------------

--
-- Table structure for table `tb_inbox`
--

CREATE TABLE `tb_inbox` (
  `inb_id` int(11) NOT NULL,
  `inb_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inb_decs` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `i_Code` varchar(10) NOT NULL,
  `i_Date` date NOT NULL,
  `i_Name` varchar(30) NOT NULL,
  `i_Desc` varchar(100) NOT NULL,
  `i_Category` varchar(20) NOT NULL,
  `i_Height` float NOT NULL,
  `i_Width` float NOT NULL,
  `i_Depth` float NOT NULL,
  `i_Length` float NOT NULL,
  `i_Weight` float NOT NULL,
  `i_Material` varchar(20) NOT NULL,
  `i_Quantity` float NOT NULL,
  `i_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `Ord_id` int(11) NOT NULL,
  `Ord_custid` varchar(30) NOT NULL,
  `Ord_name` varchar(50) NOT NULL,
  `Ord_date` date NOT NULL,
  `Ord_type` int(2) NOT NULL,
  `Ord_itemName` varchar(50) NOT NULL,
  `Ord_itemMaterial` varchar(20) NOT NULL,
  `Ord_itemHeight` float NOT NULL,
  `Ord_itemWeight` float NOT NULL,
  `Ord_itemLength` float NOT NULL,
  `Ord_itemWidth` float NOT NULL,
  `Ord_itemDepth` float NOT NULL,
  `Ord_itemQuantity` float NOT NULL,
  `Ord_itemPrice` float NOT NULL,
  `Ord_totalCost` float NOT NULL,
  `Ord_itemCode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ordertype`
--

CREATE TABLE `tb_ordertype` (
  `OT_id` int(2) NOT NULL,
  `OT_desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ordertype`
--

INSERT INTO `tb_ordertype` (`OT_id`, `OT_desc`) VALUES
(1, 'ADVERTISING'),
(2, 'CONSTRUCTION');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `p_ordID` int(11) NOT NULL,
  `p_date` date NOT NULL,
  `p_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paymentstatus`
--

CREATE TABLE `tb_paymentstatus` (
  `PS_id` int(3) NOT NULL,
  `PS_desc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_paymentstatus`
--

INSERT INTO `tb_paymentstatus` (`PS_id`, `PS_desc`) VALUES
(1, 'DEPOSIT'),
(2, 'UNPAID'),
(3, 'PAID');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`c_idnum`),
  ADD KEY `c_type` (`c_type`);

--
-- Indexes for table `tb_custtype`
--
ALTER TABLE `tb_custtype`
  ADD PRIMARY KEY (`CT_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `e_role` (`e_role`);

--
-- Indexes for table `tb_emprole`
--
ALTER TABLE `tb_emprole`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tb_inbox`
--
ALTER TABLE `tb_inbox`
  ADD PRIMARY KEY (`inb_id`);

--
-- Indexes for table `tb_item`
--
ALTER TABLE `tb_item`
  ADD PRIMARY KEY (`i_Code`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`Ord_id`),
  ADD KEY `Ord_custid` (`Ord_custid`),
  ADD KEY `Ord_type` (`Ord_type`),
  ADD KEY `Ord_itemCode` (`Ord_itemCode`);

--
-- Indexes for table `tb_ordertype`
--
ALTER TABLE `tb_ordertype`
  ADD PRIMARY KEY (`OT_id`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD KEY `p_ordID` (`p_ordID`),
  ADD KEY `p_status` (`p_status`);

--
-- Indexes for table `tb_paymentstatus`
--
ALTER TABLE `tb_paymentstatus`
  ADD PRIMARY KEY (`PS_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_inbox`
--
ALTER TABLE `tb_inbox`
  MODIFY `inb_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `Ord_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD CONSTRAINT `tb_customer_ibfk_1` FOREIGN KEY (`c_type`) REFERENCES `tb_custtype` (`CT_id`);

--
-- Constraints for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD CONSTRAINT `tb_employee_ibfk_1` FOREIGN KEY (`e_role`) REFERENCES `tb_emprole` (`role_id`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`Ord_custid`) REFERENCES `tb_customer` (`c_idnum`),
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`Ord_type`) REFERENCES `tb_ordertype` (`OT_id`),
  ADD CONSTRAINT `tb_order_ibfk_3` FOREIGN KEY (`Ord_itemCode`) REFERENCES `tb_item` (`i_Code`);

--
-- Constraints for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD CONSTRAINT `tb_payment_ibfk_1` FOREIGN KEY (`p_ordID`) REFERENCES `tb_order` (`Ord_id`),
  ADD CONSTRAINT `tb_payment_ibfk_2` FOREIGN KEY (`p_status`) REFERENCES `tb_paymentstatus` (`PS_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
