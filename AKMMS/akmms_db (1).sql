-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 08:09 AM
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
  `c_type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`c_id`, `c_idnum`, `c_name`, `c_phone`, `c_address`, `c_email`, `c_type`) VALUES
(33, '031019110085', 'ARIFF DANISH ', '0169135248', 'LOT PPRT 507-2 KAMPUNG TELUK KALONG', 'ariffdanish0085@gmail.com', 1),
(35, 'UTHM2324', 'UNIVERSITI TUN HUSSEIN ONN', '03 699 987', 'UTHM BP', 'UTHM@gmail.com', 2),
(36, 'UM2000', 'UNIVERSITI MALAYA', '03 699 988', 'UM KL', 'UM@gmail.com', 2),
(38, 'UTM2023', 'UNIVERSITI TEKNOLOGI MALAYSIA', '03 699 611', 'UTM JB', 'UTM@gmail.com', 2),
(39, 'UTM2044', 'UNIVERSITI TEKNOLOGI MALAYSIA', '03 999 999', 'UTM KL', 'UTM@gmail.com', 2);

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
  `e_role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`e_id`, `e_name`, `e_pwd`, `e_tel`, `e_email`, `e_role`) VALUES
('A22EC0204', 'ARIFF DANISH', 123, '0169135248', 'ariffdanish055@gmail.com', 1),
('A22EC0205', 'AIMAN NOAH', 123, '0189132345', 'aiman_noah@gmail.com', 2),
('A22EC0216', 'IMAN FIRDAUS', 123, '0199772181', 'imanfirdaus@gmail.com', 1);

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
(6, '2024-01-07 01:38:56', 'New order placed with ID: 65');

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
(1, 'PL320-1', '2024-01-07', 'Plastik Terbiogradasi', 'Senang dikitar semula', 'Construction', 'Plastik', 20, 6),
(2, 'KT60', '2024-01-08', 'Kayu Jati', 'Kayu yang amat keras dan berkualiti', 'Advertising', 'Kayu', 50, 10),
(3, 'WD423-1', '2024-01-08', 'Besi Bergalvani', 'Besi yang padat, sesuai untuk paip', 'Advertising', 'Besi', 3, 5.9),
(5, 'KT61', '2024-01-08', 'Kayu Cengal', 'Kayu yang amat keras', 'Advertising', 'Kayu', 21, 10),
(6, 'I-A-1', '2024-01-08', 'Mata Lampu', 'Mata lampu (tanpa suis) menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 91.1),
(7, 'I-A-2', '2024-01-08', 'Mata Lampu', 'Mata lampu bagi pendawaian dua hala (tanpa suis) menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 147.3),
(8, 'I-A-3', '2024-01-08', 'Mata Lampu', 'Mata lampu bagi pendawaian dua hala dan perantaraan (tanpa suis) menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 159.3),
(9, 'I-A-4', '2024-01-08', 'Mata Lampu', 'Mata lampu (tanpa suis) l/d pemegang mentol jenis beroti atau beroti sudut bakelit menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 94.8),
(10, 'I-A-5', '2024-01-08', 'Mata Lampu', 'Mata lampu (tanpa suis) l/d ros siling dan kabel bulat PVK lentur 3 teras 23/0.16 mm sepanjang 1/2 meter menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 106.7),
(11, 'I-A-6', '2024-01-08', 'Mata Lampu', 'Mata lampu bagi pendawaian dua hala (tanpa suis) , ros siling dan kabel bulat PVK lentur 3 teras 23/0.16 mm sepanjang 1/2 meter menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 20, 135.1),
(12, 'I-A-7', '2024-01-08', 'Mata Lampu', 'Mata lampu bagi pendawaian dua hala dan perantaraan (tanpa suis) l/d ros siling dan kabel bulat PVK lentur 3 teras 23/0.16 mm sepanjang 1/2 meter menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlind', 'Construction', 'I- PENDAWAIAN', 20, 166.3),
(13, 'I-B-1', '2024-01-08', 'Mata Lampu', 'Mata lampu (tanpa suis) menggunakan kabel 2 x 1.5 mm persegi l/d kabel perlindungan.', 'Construction', 'I- PENDAWAIAN', 30, 133);

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
  `Ord_itemMaterial` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`Ord_id`, `Ord_cid`, `Ord_name`, `Ord_date`, `Ord_type`, `Ord_itemMaterial`) VALUES
(55, 36, 'SENARAI BARANG KELAB KOMPUTER', '2024-01-06', 1, ''),
(56, 33, 'SENARAI BARANG KELAB REKREASI', '2024-01-06', 1, ''),
(60, 35, 'NAIKTARAF TANDAS KOLEJ FELLOW', '2024-01-07', 2, ''),
(61, 39, 'NAIKTARAF PENGHAWA DINGIN', '2024-01-08', 1, ''),
(66, 39, 'SENARAI BARANG FAKULTI KOMPUTER', '2024-01-07', 1, ''),
(68, 38, 'PENYELENGGARAAN TANDAS KOLEJ', '2024-01-08', 2, ''),
(69, 35, 'NAIKTARAF TANDAS KOLEJ KEDIAMAN', '2024-01-07', 2, ''),
(70, 35, 'NAIKTARAF TANDAS KOLEJ FELLOW', '2024-01-07', 2, ''),
(71, 33, 'SENARAI BARANG KELAB HOKI UTHM', '2024-01-18', 1, '');

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
(1, 55, 10000, '2024-01-08', 1);

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
  `q_quantity` float NOT NULL,
  `q_price` float NOT NULL,
  `q_discount` float NOT NULL,
  `q_tax` float NOT NULL,
  `q_totalcost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`q_id`, `q_ordID`, `q_itemDesc`, `q_quantity`, `q_price`, `q_discount`, `q_tax`, `q_totalcost`) VALUES
(11, 55, 'STAINLESS STEEL VACUUM FLASK ST5168-1 WITH PRINTING 1 COLOUR', 100, 26, 0, 0, 2604),
(12, 55, 'SMART TEMPERATURE VACUUM FLASK ST7231 WITH PRINTING 1 COLOUR', 100, 20, 0, 0, 2000),
(14, 55, 'STAINLESS STEEL VACUUM FLASK ST5168-1 WITH PRINTING 1 COLOUR', 100, 26, 0, 0, 2600),
(15, 55, 'SMART TEMPERATURE VACUUM FLASK ST7231 WITH PRINTING 1 COLOUR', 100, 24, 0, 0, 2400),
(16, 55, 'NOTE BOOK ENB1255 WITH PRINTING 1 COLOUR', 100, 10, 0, 0, 1000),
(17, 56, 'NOTE BOOK ENB1255 WITH PRINTING 1 COLOUR', 100, 20, 0, 0, 2000),
(18, 66, 'JUTE BAG 238 WITH PRINTING 1 COLOUR', 100, 29, 0, 0, 2900),
(19, 66, 'SMART TEMPERATURE VACUUM FLASK ST7231 WITH PRINTING 1 COLOUR', 100, 20, 0, 0, 2000),
(20, 66, 'ALUMINIUM SPORT BOTTLE ASB102 WITH PRINTING 1 COLOUR', 100, 23, 0, 0, 2300);

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
  ADD KEY `q_ordID` (`q_ordID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_inbox`
--
ALTER TABLE `tb_inbox`
  MODIFY `inb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_item`
--
ALTER TABLE `tb_item`
  MODIFY `i_CodeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `Ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `tb_quotation_ibfk_1` FOREIGN KEY (`q_ordID`) REFERENCES `tb_order` (`Ord_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
