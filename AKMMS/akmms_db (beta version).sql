-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 05:11 AM
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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `password_reset_id` int(11) NOT NULL,
  `password_reset_user_id` varchar(20) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `password_reset_status` int(11) NOT NULL DEFAULT 1,
  `password_reset_created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`password_reset_id`, `password_reset_user_id`, `password_reset_token`, `password_reset_status`, `password_reset_created_at`) VALUES
(26, 'A22EC0204', '88eff5f769662116f5ee6665a6fdca49', 1, '2024-01-14 04:58:43'),
(27, 'A22EC0204', '94faf909b6238e69e554c920a2585188', 1, '2024-01-14 05:06:14');

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
(43, '031019110011', 'INFINIX', '0169130096', 'UTM JB', 'infinix_example@gmail.com', 1, 0);

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
  `e_pwd` varchar(255) NOT NULL,
  `e_tel` varchar(15) NOT NULL,
  `e_email` varchar(100) NOT NULL,
  `e_role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`e_id`, `e_name`, `e_pwd`, `e_tel`, `e_email`, `e_role`) VALUES
('A22EC0204', 'Ariff Danish', '$2y$10$2pc7ov82qG.T/Rpp30gonOTOKY3nv4XV466Tq5lrxgaXVRFYxo8Vu', '0169135248', 'ariffdanish055@gmail.com', 1);

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
(2, 'STAFF'),
(3, 'INACTIVE');

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
(1, 'ENB1255', '2024-01-07', 'NOTE BOOK', '', 'Advertising', 'BUKU', 145, 6),
(14, 'ASB102', '2024-01-10', 'SPORT BOTTLE', '', 'Advertising', 'ALUMINIUM', 200, 10.9),
(16, 'ST5168-1', '2024-01-10', 'VACUUM FLASK', '', 'Advertising', '', 200, 25),
(18, 'ST7231', '2024-01-10', 'VACUUM FLASK', '', 'Advertising', '', 200, 30),
(19, 'B238', '2024-01-10', 'BAG', '', 'Advertising', 'JUTE', 180, 20),
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
(76, 43, 'SENARAI BARANG KELAB KOMPUTER', '2024-01-14', 1, 0, 0);

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
  `p_status` int(2) NOT NULL,
  `p_proof` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`p_id`, `p_ordID`, `p_amount`, `p_date`, `p_status`, `p_proof`) VALUES
(8, 76, 100, '2024-01-14', 1, 0x437573746f6d6572496e766f6963652d31313732302e706466);

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
(30, 76, 'NOTE BOOK ENB1255 WITH PRINTING 1 COLOUR', 1, 10, 23, 0, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`password_reset_id`),
  ADD KEY `password_reset_user_id` (`password_reset_user_id`);

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
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `password_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
  MODIFY `Ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`password_reset_user_id`) REFERENCES `tb_employee` (`e_id`);

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
