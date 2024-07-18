-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 03:47 PM
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
-- Database: `read2rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` int(11) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `bookGenre` varchar(255) NOT NULL,
  `bookAuthor` varchar(255) NOT NULL,
  `bookImageLocation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `bookName`, `bookGenre`, `bookAuthor`, `bookImageLocation`) VALUES
(1, 'the wizard of oz', 'fantasy', 'L. Frank Baum', 'oz.avif'),
(2, 'harry potter', 'fantasy', 'JK Rofl', 'somewhere nice.png'),
(6, 'asdfg', 'asdfg', 'asdfg', ''),
(7, 'asdfasdf', 'asdfdsafsafs', 'asdfasdfas', ''),
(8, 'asdf', 'asdf', 'asdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `buyrent`
--

CREATE TABLE `buyrent` (
  `transID` int(11) NOT NULL,
  `transType` varchar(255) DEFAULT NULL,
  `usID` int(11) DEFAULT NULL,
  `payID` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buyrent`
--

INSERT INTO `buyrent` (`transID`, `transType`, `usID`, `payID`, `status`) VALUES
(1, 'buy', 29, 1, 'Approved'),
(2, NULL, 29, NULL, 'Pending'),
(3, NULL, 29, NULL, 'Pending'),
(4, NULL, NULL, 4, 'Pending'),
(5, 'rent', NULL, NULL, 'Pending'),
(6, NULL, 29, NULL, 'Pending'),
(7, NULL, NULL, 5, 'Pending'),
(8, 'rent', NULL, NULL, 'Pending'),
(9, 'rent', 29, 6, 'Decline'),
(10, 'rent', 29, 7, 'Approved'),
(11, 'buy', 29, 8, 'Approve'),
(12, 'buy', 29, 9, 'Approve'),
(13, 'buy', 29, 10, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `usID` int(11) NOT NULL,
  `cusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `deID` int(11) NOT NULL,
  `deDate` date DEFAULT NULL,
  `transID` int(11) DEFAULT NULL,
  `bookID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`deID`, `deDate`, `transID`, `bookID`) VALUES
(1, '2024-06-25', 1, 1),
(2, NULL, 8, NULL),
(3, NULL, NULL, 1),
(4, '0000-00-00', NULL, NULL),
(5, '0000-00-00', 9, 1),
(6, '2024-06-29', 10, 1),
(7, '2024-06-29', 11, 1),
(8, '2024-06-29', 12, 1),
(9, '2024-06-29', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `usID` int(11) DEFAULT NULL,
  `empID` int(11) NOT NULL,
  `empType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`usID`, `empID`, `empType`) VALUES
(29, 1, 'staff'),
(30, 2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payID` int(11) NOT NULL,
  `payAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payID`, `payAmount`) VALUES
(1, 25),
(2, 25),
(3, 25),
(4, 25),
(5, 25),
(6, 25),
(7, 25),
(8, 25),
(9, 25),
(10, 25);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usID` int(11) NOT NULL,
  `usUsername` varchar(255) NOT NULL,
  `usAdress` varchar(255) NOT NULL,
  `usPassword` varchar(255) NOT NULL,
  `usEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usID`, `usUsername`, `usAdress`, `usPassword`, `usEmail`) VALUES
(29, 'agaresxpurson', 'no. 11, Lorong 7, Taman Kempadang Perdana, 25150, Kuantan Pahang', '7e806dd24dd0a2de81eae4996782a265', 'nabkill013@gmail.com'),
(30, 'Purson', 'no. 11, Lorong 7, Taman Kempadang Perdana, 25150, Kuantan Pahang', 'c6e352a784a77dfab6badcc83595cc74', '2022817032@student.uitm.edu.my');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `buyrent`
--
ALTER TABLE `buyrent`
  ADD PRIMARY KEY (`transID`),
  ADD KEY `usID` (`usID`),
  ADD KEY `payID` (`payID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusID`),
  ADD KEY `usID` (`usID`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`deID`),
  ADD KEY `transID` (`transID`),
  ADD KEY `bookID` (`bookID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empID`),
  ADD KEY `usID` (`usID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `buyrent`
--
ALTER TABLE `buyrent`
  MODIFY `transID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `deID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `empID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyrent`
--
ALTER TABLE `buyrent`
  ADD CONSTRAINT `buyrent_ibfk_1` FOREIGN KEY (`usID`) REFERENCES `users` (`usID`),
  ADD CONSTRAINT `buyrent_ibfk_2` FOREIGN KEY (`payID`) REFERENCES `payment` (`payID`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`usID`) REFERENCES `users` (`usID`);

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`transID`) REFERENCES `buyrent` (`transID`),
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`bookID`) REFERENCES `book` (`bookID`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`usID`) REFERENCES `users` (`usID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
