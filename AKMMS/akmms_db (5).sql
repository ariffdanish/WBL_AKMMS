-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 05:33 PM
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
-- Database: `akmms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `c_id` int(11) NOT NULL,
  `c_idnum` varchar(30) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_phone` varchar(20) NOT NULL,
  `c_address` varchar(200) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_type` int(2) NOT NULL,
  `c_is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`c_id`, `c_idnum`, `c_name`, `c_phone`, `c_address`, `c_email`, `c_type`, `c_is_deleted`) VALUES
(41, 'UTM2024', 'UNIVERSITI TEKNOLOGI MALAYSIA', '03 699 600', 'UTM JB', 'UTM@gmail.com', 2, 0),
(42, '031019110044', 'AISYAH RANI', '0169130087', 'SKUDAI ', 'aisyahrani@gmail.com', 1, 0);

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
  `e_id` varchar(20) NOT NULL,
  `e_name` varchar(100) NOT NULL,
  `e_pwd` int(20) NOT NULL,
  `e_tel` varchar(15) NOT NULL,
  `e_email` varchar(100) NOT NULL,
  `e_role` int(2) NOT NULL,
  `e_resetcode` varchar(10) NOT NULL,
  `e_timereset` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`e_id`, `e_name`, `e_pwd`, `e_tel`, `e_email`, `e_role`, `e_resetcode`, `e_timereset`) VALUES
('A22EC0200', 'Azhar', 123, '0169135200', 'azharr@gmail.com', 1, '', '2024-01-11 15:31:09'),
('A22EC0204', 'ARIFF DANISH', 123, '0169135248', 'ariffdanish055@gmail.com', 1, '', '2024-01-11 15:31:09'),
('A22EC0205', 'AIMAN NOAH', 123, '0189132345', 'aiman_noah@gmail.com', 2, '', '2024-01-11 15:31:09'),
('A22EC0216', 'IMAN FIRDAUS', 123, '0199772181', 'imanfirdaus@gmail.com', 1, '', '2024-01-11 15:31:09');

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

--
-- Dumping data for table `tb_inbox`
--

INSERT INTO `tb_inbox` (`inb_id`, `inb_timestamp`, `inb_decs`) VALUES
(1, '2024-01-07 01:38:56', 'New order placed with ID: 55'),
(2, '2024-01-07 01:38:56', 'New order placed with ID: 56'),
(3, '2024-01-07 01:38:56', 'New order placed with ID: 60'),
(4, '2024-01-07 01:38:56', 'New order placed with ID: 61'),
(5, '2024-01-07 01:38:56', 'New order placed with ID: 63'),
(6, '2024-01-07 01:38:56', 'New order placed with ID: 65'),
(7, '2024-01-09 19:00:38', 'Low stock for item: Besi Bergalvani_WD423-1'),
(8, '2024-01-09 19:00:38', 'New order placed with ID: 71');

-- --------------------------------------------------------

--
-- Table structure for table `tb_item`
--

CREATE TABLE `tb_item` (
  `i_CodeID` int(11) NOT NULL,
  `i_Code` varchar(11) NOT NULL,
  `i_Date` date NOT NULL,
  `i_Name` varchar(30) NOT NULL,
  `i_Desc` varchar(200) NOT NULL,
  `i_Category` varchar(20) NOT NULL,
  `i_Material` varchar(20) NOT NULL,
  `i_Quantity` float NOT NULL,
  `i_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`i_CodeID`, `i_Code`, `i_Date`, `i_Name`, `i_Desc`, `i_Category`, `i_Material`, `i_Quantity`, `i_Price`) VALUES
(1, 'ENB1255', '2024-01-07', 'NOTE BOOK', '', 'Advertising', 'BUKU', 200, 6),
(14, 'ASB102', '2024-01-10', 'SPORT BOTTLE', '', 'Advertising', 'ALUMINIUM', 2000, 10.9),
(16, 'ST5168-1', '2024-01-10', 'VACUUM FLASK', '', 'Advertising', '', 200, 25),
(18, 'ST7231', '2024-01-10', 'VACUUM FLASK', '', 'Advertising', '', 200, 30),
(19, 'B238', '2024-01-10', 'BAG', '', 'Advertising', 'JUTE', 200, 20),
(20, 'K001', '2024-01-10', 'KAD KAHWIN', '', 'Advertising', 'KADBOD', 200, 1),
(21, 'S001', '2024-01-10', 'STICKER', '', 'Advertising', '', 200, 0.9),
(22, 'S002', '2024-01-10', 'SIJIL', '', 'Advertising', '', 200, 4),
(23, 'K002', '2024-01-10', 'KALENDAR', '', 'Advertising', '', 200, 8.9),
(24, 'K003', '2024-01-10', 'FLYER/BROCHURE', '', 'Advertising', '', 200, 5.9),
(25, 'B001', '2024-01-10', 'BAJU/JERSI', '', 'Advertising', '', 200, 40),
(26, 'K004', '2024-01-10', 'KAD BISNES', '', 'Advertising', 'KADBOD', 200, 5.9),
(27, 'C001', '2024-01-10', 'CENDERAHATI', '', 'Advertising', 'PIALA', 200, 10.9),
(28, 'B001', '2024-01-10', 'BANNER/BUNTING', '', 'Advertising', '', 200, 30),
(29, 'S002', '2024-01-10', 'SAMPUL ', '', 'Advertising', '', 200, 2.9),
(30, 'C002', '2024-01-10', 'CENDERAHATI', '', 'Advertising', 'PINGAT', 200, 8.9),
(31, 'C003', '2024-01-10', 'CENDERAHATI', '', 'Advertising', 'PLATE', 200, 8.9),
(32, 'K005', '2024-01-10', 'KERTAS ', '', 'Advertising', 'A4', 200, 0.9),
(33, 'K006', '2024-01-10', 'KERTAS ', '', 'Advertising', 'A3', 200, 1.9),
(34, 'K007', '2024-01-10', 'KERTAS ', '', 'Advertising', 'A1', 200, 3.9),
(35, 'K008', '2024-01-10', 'KERTAS ', '', 'Advertising', 'A0', 200, 4.9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `Ord_id` int(11) NOT NULL,
  `Ord_cid` int(11) NOT NULL,
  `Ord_name` varchar(50) NOT NULL,
  `Ord_date` date NOT NULL,
  `Ord_type` int(2) NOT NULL,
  `Ord_codeID` int(11) NOT NULL,
  `Ord_is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`Ord_id`, `Ord_cid`, `Ord_name`, `Ord_date`, `Ord_type`, `Ord_codeID`, `Ord_is_deleted`) VALUES
(73, 41, 'SENARAI BARANG KELAB FKM', '2024-01-10', 1, 0, 0),
(74, 41, 'RENOVATION TOILET KRP', '2024-01-10', 2, 0, 0),
(75, 42, 'BUNTING KAHWIN', '2024-01-10', 1, 0, 0);

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
  `p_id` int(11) NOT NULL,
  `p_ordID` int(11) NOT NULL,
  `p_amount` float NOT NULL,
  `p_date` date NOT NULL,
  `p_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`p_id`, `p_ordID`, `p_amount`, `p_date`, `p_status`) VALUES
(4, 73, 6000, '2024-01-11', 1),
(5, 73, 1011, '2024-01-12', 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_quotation`
--

CREATE TABLE `tb_quotation` (
  `q_id` int(11) NOT NULL,
  `q_ordID` int(11) NOT NULL,
  `q_itemDesc` varchar(100) NOT NULL,
  `q_codeID` int(11) NOT NULL,
  `q_quantity` float NOT NULL,
  `q_price` float NOT NULL,
  `q_discount` float NOT NULL,
  `q_tax` float NOT NULL,
  `q_totalcost` float NOT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`q_id`, `q_ordID`, `q_itemDesc`, `q_codeID`, `q_quantity`, `q_price`, `q_discount`, `q_tax`, `q_totalcost`, `is_deleted`) VALUES
(24, 73, 'ALUMINIUM SPORT BOTTLE ASB102 WITH PRINTING 1 COLOUR', 1, 100, 10, 90, 1, 911, 0),
(25, 73, 'JUTE BAG 238 WITH PRINTING 1 COLOUR', 19, 25, 20, 5, 3, 498, 0),
(26, 75, 'BUNTING KAHWIN 25x40', 28, 1, 20, 0, 1, 21, 0),
(27, 73, 'SMART TEMPERATURE VACUUM FLASK ST7231 WITH PRINTING 1 COLOUR', 16, 200, 28, 0, 2, 5602, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`c_id`),
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
  ADD PRIMARY KEY (`i_CodeID`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`Ord_id`),
  ADD KEY `Ord_custid` (`Ord_cid`),
  ADD KEY `Ord_type` (`Ord_type`);

--
-- Indexes for table `tb_ordertype`
--
ALTER TABLE `tb_ordertype`
  ADD PRIMARY KEY (`OT_id`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_ordID` (`p_ordID`),
  ADD KEY `p_status` (`p_status`);

--
-- Indexes for table `tb_paymentstatus`
--
ALTER TABLE `tb_paymentstatus`
  ADD PRIMARY KEY (`PS_id`);

--
-- Indexes for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `q_ordID` (`q_ordID`),
  ADD KEY `q_codeID` (`q_codeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_inbox`
--
ALTER TABLE `tb_inbox`
  MODIFY `inb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `i_CodeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `Ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`Ord_type`) REFERENCES `tb_ordertype` (`OT_id`),
  ADD CONSTRAINT `tb_order_ibfk_4` FOREIGN KEY (`Ord_cid`) REFERENCES `tb_customer` (`c_id`);

--
-- Constraints for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD CONSTRAINT `tb_payment_ibfk_1` FOREIGN KEY (`p_ordID`) REFERENCES `tb_order` (`Ord_id`),
  ADD CONSTRAINT `tb_payment_ibfk_2` FOREIGN KEY (`p_status`) REFERENCES `tb_paymentstatus` (`PS_id`);

--
-- Constraints for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD CONSTRAINT `tb_quotation_ibfk_1` FOREIGN KEY (`q_ordID`) REFERENCES `tb_order` (`Ord_id`),
  ADD CONSTRAINT `tb_quotation_ibfk_2` FOREIGN KEY (`q_codeID`) REFERENCES `tb_item` (`i_CodeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
