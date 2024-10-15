-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 06:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im_projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_address`
--

CREATE TABLE `billing_address` (
  `billID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(22) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_address`
--

INSERT INTO `billing_address` (`billID`, `userID`, `firstName`, `lastName`, `address`, `phone`, `country`, `province`, `city`, `zipCode`) VALUES
(1, 6, 'Mart', 'Barbon', '1762, Purok 5 Brgy. San Pablo, Ormoc City', 2147483647, 'Philippines', 'Leyte', 'Ormoc', 6541);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `messageID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `contactInfo` varchar(255) NOT NULL,
  `concerns` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`messageID`, `userID`, `fullName`, `contactInfo`, `concerns`) VALUES
(6, 6, 'mart kraig a. barbon', 'schton@gmail.com', 'great service');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) NOT NULL,
  `userID` int(11) NOT NULL,
  `dateOrdered` datetime NOT NULL DEFAULT current_timestamp(),
  `productType` varchar(255) NOT NULL,
  `quantity` int(10) NOT NULL,
  `size` varchar(255) NOT NULL,
  `productFile` blob NOT NULL,
  `details` varchar(255) NOT NULL,
  `orderType` enum('Non-priority','Priority') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Pending','In-progress','Completed','Canceled') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `userID`, `dateOrdered`, `productType`, `quantity`, `size`, `productFile`, `details`, `orderType`, `price`, `status`) VALUES
(21, 6, '2024-07-13 19:04:42', 'Business Cards (5pcs)', 20, '54mm x 85.6mm', 0x61663237356134643339623637366666386133626563623264653661333535392e706e67, 'aers', 'Priority', '180.00', 'Pending'),
(26, 6, '2024-07-13 22:04:23', 'Signages', 3, '150\" x 150\"', 0x36653466636536323265623132343066373262363231616436636531623765662e6a7067, 'tydfghdrtygjb455 33333', 'Non-priority', '600.00', 'Pending'),
(27, 6, '2024-07-13 22:33:01', 'Stickers (5pcs)', 5, '3\" x 2\"', 0x63663931616235303534383431323930373234613137643061393036313066322e6a7067, 'fjghfdfbv', 'Priority', '90.00', 'Pending'),
(28, 6, '2024-07-13 22:48:54', 'Signages', 8, '150\" x 150\"', 0x65386338653135363762383435636532366661333863343562323435343238312e6a7067, 'weiarbdjs234234', 'Priority', '2400.00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `method` enum('Master card','Visa','Paypal') NOT NULL,
  `card_name` int(64) NOT NULL,
  `card_number` int(64) NOT NULL,
  `expiration_date` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `last_name`, `first_name`, `email`, `password`, `createdAt`) VALUES
(1, '', '', 'admin@gmail.com', 'admin', '2024-07-10 11:24:39'),
(2, '', '', 'employee@gmail.com', 'employee', '2024-07-13 17:25:16'),
(6, 'barbon', 'mart', 'schton@gmail.com', '123', '2024-07-11 13:08:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD PRIMARY KEY (`billID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_address`
--
ALTER TABLE `billing_address`
  MODIFY `billID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_address`
--
ALTER TABLE `billing_address`
  ADD CONSTRAINT `billing_address_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
