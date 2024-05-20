-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 07:16 PM
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
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `Incident_No` int(11) NOT NULL,
  `Person_ID` int(11) DEFAULT NULL,
  `Emergency_Level` varchar(30) DEFAULT NULL,
  `Reporter_Name` varchar(100) DEFAULT NULL,
  `Description_` text DEFAULT NULL,
  `Location_` varchar(100) DEFAULT NULL,
  `Date_Created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`Incident_No`, `Person_ID`, `Emergency_Level`, `Reporter_Name`, `Description_`, `Location_`, `Date_Created`) VALUES
(1, 12345, 'Low', 'Ahmed Salem', 'he falll from the stairs and he is fall out', 'B128', '2022-01-22'),
(2, 12346, 'high', 'Ali Nasser', 'Someone fainted near the entrance of building 125', 'B125', '2022-01-22'),
(3, 12347, 'Low', 'Mohammed yousef', 'Someone is bleeding heavily in the parking lot', 'parking lot on B105', '2022-01-22'),
(4, 12348, 'medium', 'Ahmed Mohammed', 'My friend has diabetes and he is having low sugar', 'B122', '2022-01-22'),
(5, 12349, 'Low', 'Mazen Ali', 'Someone is having a seizure near the cafeteria ', 'B110', '2022-01-22'),
(29, 4105555, 'High', 'Abdulaziz Alamri', 'someone is sick', 'B125', '2023-05-24'),
(36, 4109876, 'Medium', 'Khalid Abdulrahman Alabdali', 'A student has passed out', 'B125 - first floor', '2023-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `ID` int(11) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `Birth_date` date DEFAULT NULL,
  `Address_` text DEFAULT NULL,
  `Person_Role` varchar(30) DEFAULT NULL,
  `Profession_Name` varchar(30) DEFAULT NULL,
  `College` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`ID`, `fname`, `mname`, `lname`, `Birth_date`, `Address_`, `Person_Role`, `Profession_Name`, `College`) VALUES
(1, 'admin', 'admin', 'admin', '2000-01-01', 'Taibah University', 'employee', 'Administrator', ''),
(12345, 'Ahmed', 'khaled', 'Salem', '1995-03-12', 'madina-Alslam', 'Student', '', 'CS_college'),
(12346, 'Ali', 'khaled', 'Nasser', '1995-03-12', 'madina-Alslam', 'Student', '', 'CS_college'),
(12347, 'mohammed', 'khaled', 'yousef', '1995-03-12', 'madina-Alslam', 'Student', '', 'CS_college'),
(12348, 'Ahmed', 'Ali', 'mohammed', '1995-03-12', 'madina-Alslam', 'Employee', 'Lecturer', ''),
(12349, 'Mazen', 'Nasser', 'Ali', '1995-03-12', 'madina-Alslam', 'Employee', 'security', ''),
(4105555, 'Abdulaziz', 'Muslih', 'Alamri', '2023-05-15', 'ABC', 'student', '', 'CS'),
(4109876, 'Khalid', 'Abdulrahman', 'Alabdali', '2002-01-23', 'Madinah', 'student', '', 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `person_phone_number`
--

CREATE TABLE `person_phone_number` (
  `Person_ID` int(11) DEFAULT NULL,
  `Phone_Number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person_phone_number`
--

INSERT INTO `person_phone_number` (`Person_ID`, `Phone_Number`) VALUES
(12345, '555551235'),
(12345, '555553215'),
(12346, '555555785'),
(12346, '556105555'),
(12348, '554565555'),
(12348, '554523555'),
(12346, '556145555'),
(12349, '554935555'),
(12347, '556123555'),
(4105555, '0555555555'),
(1, '0501234567'),
(4109876, '0506135674');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `username` varchar(30) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Person_ID` int(11) DEFAULT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `numberOfReports` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`username`, `Password`, `Person_ID`, `Full_Name`, `numberOfReports`) VALUES
('ahmed1222', 'abc5', 12345, '', 1),
('Ali7070', 'abc6', 12346, '', 1),
('newMan', 'abc7', 12347, '', 1),
('NoOne', 'abc8', 12348, '', 1),
('bestOne', 'abc9', 12349, '', 1),
('aziz', '$2y$10$lzUvclRCuB.cLo.TUa5HieRvP7bLgaaVdPgEA6/jZADPQsF1r7Yiu', 4105555, 'Abdulaziz Muslih Alamri', 1),
('admin', '$2y$10$bs/Co56EbiqhTFZNU4gRpukac5WkzhX4hMOCrWiPw2pzP75ZwTFrm', 1, 'admin admin admin', 0),
('khalid', '$2y$10$Hx88C44B6rXalLhWR4jbSe9pLbotd0az8XuVk3HqANE1HvkLb4nOG', 4109876, 'Khalid Abdulrahman Alabdali', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`Incident_No`),
  ADD KEY `Person_ID` (`Person_ID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `person_phone_number`
--
ALTER TABLE `person_phone_number`
  ADD KEY `Person_ID` (`Person_ID`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD KEY `Person_ID` (`Person_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incident`
--
ALTER TABLE `incident`
  MODIFY `Incident_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `incident_ibfk_1` FOREIGN KEY (`Person_ID`) REFERENCES `person` (`ID`);

--
-- Constraints for table `person_phone_number`
--
ALTER TABLE `person_phone_number`
  ADD CONSTRAINT `person_phone_number_ibfk_1` FOREIGN KEY (`Person_ID`) REFERENCES `person` (`ID`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`Person_ID`) REFERENCES `person` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
