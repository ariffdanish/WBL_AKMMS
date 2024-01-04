-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 06:17 PM
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
-- Database: `db_akmms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_advertising`
--

CREATE TABLE `tb_advertising` (
  `adv_type` int(20) NOT NULL,
  `adv_decs` varchar(30) NOT NULL,
  `i_Code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_agency`
--

CREATE TABLE `tb_agency` (
  `agency_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `agency_tel` varchar(15) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_construction`
--

CREATE TABLE `tb_construction` (
  `cons_type` int(50) NOT NULL,
  `cons_decs` varchar(50) NOT NULL,
  `i_Code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `c_id` int(11) NOT NULL,
  `c_idnum` varchar(30) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_phone` varchar(15) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `c_type` varchar(10) NOT NULL,
  `c_typeOrd` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`c_id`, `c_idnum`, `c_name`, `c_phone`, `c_address`, `c_email`, `c_type`, `c_typeOrd`) VALUES
(39, 'UTM2023', 'UNIVERSITI TEKNOLOGI MALAYSIA', '03 699 987', 'UTM Skudai', 'UTM@gmail.com', 'Agency', 'Construction'),
(40, '031019110085', 'ARIFF DANISH', '0169135248', 'KEMAMAN, TERENGGANU', 'ariffdanish055@gmail.com', 'Personnel', 'Advertising'),
(42, 'UTM2023', 'UNIVERSITI TEKNOLOGI MALAYSIA', '03 699 978', 'UTM Skudai', 'UTM@gmail.com', 'Agency', 'Construction'),
(44, 'UTHM2324', 'UNIVERSITI TUN HUSSEIN ONN', '03 699 600', 'UTHM, Batu Pahat', 'UTHM@gmail.com', 'Agency', 'Advertising');

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE `tb_employee` (
  `e_id` varchar(20) NOT NULL,
  `e_name` varchar(50) NOT NULL,
  `e_pwd` varchar(20) NOT NULL,
  `e_tel` varchar(12) NOT NULL,
  `e_email` varchar(100) NOT NULL,
  `e_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`e_id`, `e_name`, `e_pwd`, `e_tel`, `e_email`, `e_type`) VALUES
('A22EC0204', 'Ariff Danish', '123', '0169135248', 'ariffdanish055@gmail.com', 'Admin'),
('A22EC0216', 'Iman Firdaus', '123', '01135042433', 'imanfirdaus@gmail.com', 'Staff'),
('A22EC0220', 'Muhammad Nur Azhar', '5285', '0192765285', 'azhar200305@gmail', 'Admin');

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
  `i_Quantity` int(50) NOT NULL,
  `i_Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_item`
--

INSERT INTO `tb_item` (`i_Code`, `i_Date`, `i_Name`, `i_Desc`, `i_Category`, `i_Height`, `i_Width`, `i_Depth`, `i_Length`, `i_Weight`, `i_Material`, `i_Quantity`, `i_Price`) VALUES
('KT60', '2024-01-01', 'Kaca 1', 'Mudah pecah', 'Advertising', 9, 3, 3, 3, 32, 'Kaca', 9, 7.6),
('PL320-1', '2024-01-02', 'Plastik Terbiogradasi', 'Plastik mudah terungkai', 'Construction', 9, 3.5, 3, 3.6, 0.5, 'Besi', 50, 0.5),
('WD41', '2024-01-01', 'Kayu Cengal Kualiti', 'Kayu yang amat keras', 'Construction', 3.5, 2.5, 2.5, 3.5, 4, 'Wood', 14, 10),
('WD423-1', '2024-01-01', 'Besi Bergalvani', 'Besi yang padat dan sesuai untuk paip', 'Construction', 10, 3.5, 2, 3.5, 20, 'Besi', 18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `Ord_id` int(11) NOT NULL,
  `Ord_name` varchar(50) NOT NULL,
  `Ord_date` date NOT NULL,
  `Ord_type` int(2) NOT NULL,
  `Ord_address` varchar(200) NOT NULL,
  `Ord_itemCategory` varchar(20) NOT NULL,
  `Ord_itemName` varchar(50) NOT NULL,
  `Ord_itemMaterial` varchar(20) NOT NULL,
  `Ord_itemHeight` float NOT NULL,
  `Ord_itemWeight` float NOT NULL,
  `Ord_itemLength` float NOT NULL,
  `Ord_itemWidth` float NOT NULL,
  `Ord_itemDepth` float NOT NULL,
  `Ord_itemQuantity` int(50) NOT NULL,
  `Ord_itemPrice` float NOT NULL,
  `Ord_totalCost` float NOT NULL,
  `c_id` int(11) NOT NULL,
  `i_Code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `p_id` int(11) NOT NULL,
  `p_date` date NOT NULL,
  `p_status` varchar(20) NOT NULL,
  `p_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_personnel`
--

CREATE TABLE `tb_personnel` (
  `personnel_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_address` varchar(100) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `personnel_tel` varchar(15) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_advertising`
--
ALTER TABLE `tb_advertising`
  ADD PRIMARY KEY (`adv_type`),
  ADD KEY `i_Code` (`i_Code`);

--
-- Indexes for table `tb_agency`
--
ALTER TABLE `tb_agency`
  ADD PRIMARY KEY (`agency_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `tb_construction`
--
ALTER TABLE `tb_construction`
  ADD PRIMARY KEY (`cons_type`),
  ADD KEY `i_Code` (`i_Code`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD PRIMARY KEY (`e_id`);

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
  ADD KEY `c_id` (`c_id`),
  ADD KEY `i_Code` (`i_Code`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `tb_personnel`
--
ALTER TABLE `tb_personnel`
  ADD PRIMARY KEY (`personnel_id`),
  ADD KEY `c_id` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agency`
--
ALTER TABLE `tb_agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `Ord_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_personnel`
--
ALTER TABLE `tb_personnel`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_advertising`
--
ALTER TABLE `tb_advertising`
  ADD CONSTRAINT `tb_advertising_ibfk_1` FOREIGN KEY (`i_Code`) REFERENCES `tb_item` (`i_Code`);

--
-- Constraints for table `tb_agency`
--
ALTER TABLE `tb_agency`
  ADD CONSTRAINT `tb_agency_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `tb_customer` (`c_id`);

--
-- Constraints for table `tb_construction`
--
ALTER TABLE `tb_construction`
  ADD CONSTRAINT `tb_construction_ibfk_1` FOREIGN KEY (`i_Code`) REFERENCES `tb_item` (`i_Code`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `tb_customer` (`c_id`),
  ADD CONSTRAINT `tb_order_ibfk_2` FOREIGN KEY (`i_Code`) REFERENCES `tb_item` (`i_Code`);

--
-- Constraints for table `tb_personnel`
--
ALTER TABLE `tb_personnel`
  ADD CONSTRAINT `tb_personnel_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `tb_customer` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
