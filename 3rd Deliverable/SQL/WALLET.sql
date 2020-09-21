-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 04:21 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_wallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `BankID` double NOT NULL,
  `BANumber` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`BankID`, `BANumber`) VALUES
(1111, 1212),
(3333, 2121),
(4444, 2121),
(5555, 3131),
(4455, 3311);

-- --------------------------------------------------------

--
-- Table structure for table `elec_address`
--

CREATE TABLE `elec_address` (
  `Identifier` varchar(30) NOT NULL,
  `Verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `elec_address`
--

INSERT INTO `elec_address` (`Identifier`, `Verified`) VALUES
('51515151', 0),
('57575757', 0),
('83838383', 0),
('97979797', 0),
('dmsd@njit.edu', 0),
('oj33@njit.edu', 0),
('ss4354@njit.edu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `EmailAdd` varchar(30) NOT NULL,
  `SSN` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`EmailAdd`, `SSN`) VALUES
('ss4354@njit.edu', 123456789),
('oj33@njit.edu', 987456321);

-- --------------------------------------------------------

--
-- Table structure for table `from_table`
--

CREATE TABLE `from_table` (
  `RTid` int NOT NULL,
  `Identifier` varchar(30) NOT NULL,
  `Percentage` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `from_table`
--

INSERT INTO `from_table` (`RTid`, `Identifier`, `Percentage`) VALUES
(2222, '51515151', 100),
(9762, 'ss4354@njit.edu', 100),
(34667, '51515151', 100),
(49189, 'oj33@njit.edu', 100),
(56828, '51515151', 100),
(85458, 'ss4354@njit.edu', 20);

-- --------------------------------------------------------

--
-- Table structure for table `has_additional`
--

CREATE TABLE `has_additional` (
  `SSN` int NOT NULL,
  `BankID` double NOT NULL,
  `BANumber` double NOT NULL,
  `Verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `has_additional`
--

INSERT INTO `has_additional` (`SSN`, `BankID`, `BANumber`, `Verified`) VALUES
(123456789, 1111, 1212, 0),
(987456321, 4455, 3311, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `PhoneNo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`PhoneNo`) VALUES
('51515151'),
('57575757'),
('83838383'),
('97979797');

-- --------------------------------------------------------

--
-- Table structure for table `request_transaction`
--

CREATE TABLE `request_transaction` (
  `RTid` int NOT NULL,
  `Amount` int NOT NULL,
  `DATE_TIME` datetime NOT NULL,
  `Memo` varchar(30) NOT NULL,
  `SSN` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `request_transaction`
--

INSERT INTO `request_transaction` (`RTid`, `Amount`, `DATE_TIME`, `Memo`, `SSN`) VALUES
(1111, 2500, '2020-04-02 10:38:02', 'REQUEST 3', 987456321),
(2222, 3500, '2020-02-11 10:38:45', 'REQUEST 4', 123456789),
(9762, 500, '2020-05-05 02:47:30', 'EMAIL REQUEST 2', 987456321),
(16145, 500, '2020-05-05 02:47:04', 'NEW REQUEST 2', 987456321),
(21169, 20000, '2020-05-05 03:15:59', 'REQUEST MAJOR ', 987456321),
(34667, 2000, '2020-05-03 01:04:01', 'TEST REQUEST 1', 123456789),
(49189, 100, '2020-05-03 01:13:23', 'EMAIL REQUEST 1', 123456789),
(56828, 2000, '2020-05-02 04:02:41', 'REQUEST 1', 123456789),
(70773, 200, '2020-05-02 02:25:28', 'REQUEST 1', 987456321),
(79429, 500, '2020-05-05 02:46:49', 'NEW REQUEST 1', 987456321),
(85458, 200, '2020-05-05 02:47:44', 'EMAIL REQUEST 3', 987456321);

-- --------------------------------------------------------

--
-- Table structure for table `send_transaction`
--

CREATE TABLE `send_transaction` (
  `STid` int NOT NULL,
  `Amount` int NOT NULL,
  `DATE_TIME` datetime NOT NULL,
  `Memo` varchar(30) NOT NULL,
  `Cancel_Reason` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Identifier` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `SSN` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `send_transaction`
--

INSERT INTO `send_transaction` (`STid`, `Amount`, `DATE_TIME`, `Memo`, `Cancel_Reason`, `Identifier`, `SSN`) VALUES
(570, 100, '2020-05-05 02:41:51', 'NEW SEND 1', NULL, '97979797', 987456321),
(2242, 200, '2020-01-09 07:43:12', 'Test', NULL, '51515151', 123456789),
(28285, 200, '2020-05-03 01:09:47', 'TEST SEND 2', NULL, '51515151', 123456789),
(54410, 2000, '2020-05-02 12:23:08', 'SEND 3', NULL, '57575757', 123456789),
(92353, 1000, '2020-05-05 02:46:29', 'NEW SEND 3', NULL, '97979797', 987456321),
(96032, 100, '2020-05-05 02:44:35', 'EMAIL SEND 1', NULL, 'ss4354@njit.edu', 987456321),
(98184, 100, '2020-05-03 01:13:06', 'EMAIL SEND 1', '', 'oj33@njit.edu', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `SSN` int NOT NULL,
  `Name` varchar(20) NOT NULL,
  `PhoneNo` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Balance` int NOT NULL,
  `BankID` double DEFAULT NULL,
  `BANumber` double DEFAULT NULL,
  `PBAVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`SSN`, `Name`, `PhoneNo`, `Balance`, `BankID`, `BANumber`, `PBAVerified`) VALUES
(123456789, 'Shivam Sharma', NULL, 105899, 1111, 1212, 1),
(987456321, 'Ojas Jain', '51515151', 89099, 4455, 3311, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`BankID`,`BANumber`),
  ADD KEY `BANumber` (`BANumber`) USING BTREE;

--
-- Indexes for table `elec_address`
--
ALTER TABLE `elec_address`
  ADD PRIMARY KEY (`Identifier`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`EmailAdd`),
  ADD UNIQUE KEY `EmailAdd` (`EmailAdd`),
  ADD KEY `SSN_EM_FK` (`SSN`);

--
-- Indexes for table `from_table`
--
ALTER TABLE `from_table`
  ADD PRIMARY KEY (`RTid`,`Identifier`),
  ADD KEY `IDENTIFIER_FROM` (`Identifier`);

--
-- Indexes for table `has_additional`
--
ALTER TABLE `has_additional`
  ADD PRIMARY KEY (`SSN`,`BankID`,`BANumber`),
  ADD KEY `BANumber_HA_FK` (`BANumber`),
  ADD KEY `BID_BNO_HA_FK` (`BankID`,`BANumber`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`PhoneNo`);

--
-- Indexes for table `request_transaction`
--
ALTER TABLE `request_transaction`
  ADD PRIMARY KEY (`RTid`),
  ADD KEY `SSN_RT_FK` (`SSN`);

--
-- Indexes for table `send_transaction`
--
ALTER TABLE `send_transaction`
  ADD PRIMARY KEY (`STid`),
  ADD KEY `IDENT_ST_FK` (`Identifier`),
  ADD KEY `SSN_ST_FK` (`SSN`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`SSN`),
  ADD KEY `BANO_FK` (`BANumber`),
  ADD KEY `USER_PHONE_FK` (`PhoneNo`),
  ADD KEY `BID_BNO_UA_FK` (`BankID`,`BANumber`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `EMAIL_FK` FOREIGN KEY (`EmailAdd`) REFERENCES `elec_address` (`Identifier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SSN_EM_FK` FOREIGN KEY (`SSN`) REFERENCES `user_account` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `from_table`
--
ALTER TABLE `from_table`
  ADD CONSTRAINT `IDENTIFIER_FROM` FOREIGN KEY (`Identifier`) REFERENCES `elec_address` (`Identifier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `RTID_FROM` FOREIGN KEY (`RTid`) REFERENCES `request_transaction` (`RTid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `has_additional`
--
ALTER TABLE `has_additional`
  ADD CONSTRAINT `BID_BNO_HA_FK` FOREIGN KEY (`BankID`,`BANumber`) REFERENCES `bank_account` (`BankID`, `BANumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SSN_HA_FK` FOREIGN KEY (`SSN`) REFERENCES `user_account` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `PHONE_FK` FOREIGN KEY (`PhoneNo`) REFERENCES `elec_address` (`Identifier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_transaction`
--
ALTER TABLE `request_transaction`
  ADD CONSTRAINT `SSN_RT_FK` FOREIGN KEY (`SSN`) REFERENCES `user_account` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `send_transaction`
--
ALTER TABLE `send_transaction`
  ADD CONSTRAINT `IDENT_ST_FK` FOREIGN KEY (`Identifier`) REFERENCES `elec_address` (`Identifier`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `SSN_ST_FK` FOREIGN KEY (`SSN`) REFERENCES `user_account` (`SSN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `BID_BNO_UA_FK` FOREIGN KEY (`BankID`,`BANumber`) REFERENCES `bank_account` (`BankID`, `BANumber`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `USER_PHONE_FK` FOREIGN KEY (`PhoneNo`) REFERENCES `phone` (`PhoneNo`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
