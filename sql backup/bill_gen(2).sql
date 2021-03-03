-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2021 at 06:08 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill_gen`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `Route_No` int(11) DEFAULT NULL,
  `From_Date` varchar(20) NOT NULL,
  `To_Date` varchar(20) NOT NULL,
  `Total_Price` varchar(10) NOT NULL,
  `Currency` varchar(150) NOT NULL,
  `S_No` int(11) NOT NULL,
  `Entry_Date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`Route_No`, `From_Date`, `To_Date`, `Total_Price`, `Currency`, `S_No`, `Entry_Date`) VALUES
(48, '2021-03-01', '2021-03-05', '14238.3', 'fourteen thousands two hundred  and thirty eight  Rupees  only', 85, '01-03-2021'),
(46, '2021-03-01', '2021-03-05', '14415', 'fourteen thousands four hundred  and fifteen  Rupees  only', 87, '02-03-2021'),
(12, '2021-03-01', '2021-03-05', '5000', 'five thousand Rupees  only', 88, '02-03-2021'),
(13, '2021-03-01', '2021-03-05', '775000', 'seven lakh seventy five thousands Rupees  only', 92, '02-03-2021'),
(10, '2021-03-01', '2021-03-05', '500', 'five hundred Rupees  only', 93, '02-03-2021');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Owner_Name` varchar(30) NOT NULL,
  `Route_No` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Vehicle_No` varchar(50) NOT NULL,
  `Trip_Type` varchar(10) NOT NULL,
  `Trip_Count` varchar(30) NOT NULL,
  `Km` int(11) NOT NULL DEFAULT 1,
  `Address` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Owner_Name`, `Route_No`, `user_id`, `Vehicle_No`, `Trip_Type`, `Trip_Count`, `Km`, `Address`) VALUES
('k.chelladurai', 12, 27, 'TN 37 F 1179', 'trip', '', 0, '11 sathamangalam main road anna nagar madurai-20'),
('k.ganesan', 46, 28, 'TN 45 R 9995', 'km', '', 155, '1/4 A  purathchi thalaivar colony karumbalai madurai-20'),
('c.maheshwari', 56, 29, 'TN 41 R 9995', 'trip', '', 0, '11 A sathamangalam main road west anna nagar madurai-20'),
('k.chelladurai', 13, 30, 'TN 41 R 9995', 'km', 'one', 155, '11 A sathamangalam main road west anna nagar madurai-20'),
('k.chelladurai', 10, 31, 'TN 37 F 1178', 'trip', 'two', 1, '11 A sathamangalam main road west anna nagar madurai-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`S_No`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`Route_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `S_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
