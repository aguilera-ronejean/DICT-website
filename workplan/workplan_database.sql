-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2021 at 05:35 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workplan_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessibility`
--

CREATE TABLE `accessibility` (
  `id` int(2) NOT NULL,
  `Accessibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accessibility`
--

INSERT INTO `accessibility` (`id`, `Accessibility`) VALUES
(1, 'Public'),
(2, 'Closed Group'),
(3, '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(5) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `Category`) VALUES
(1, 'Face to Face Training/Orientaion'),
(2, 'Local/Intl Event'),
(3, 'PAP Implementation'),
(4, 'Webinar'),
(5, 'Others'),
(6, '');

-- --------------------------------------------------------

--
-- Table structure for table `ictcompetencyareas`
--

CREATE TABLE `ictcompetencyareas` (
  `id` int(3) NOT NULL,
  `ICTCompetencyAreas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ictcompetencyareas`
--

INSERT INTO `ictcompetencyareas` (`id`, `ICTCompetencyAreas`) VALUES
(1, 'D1 - Techonoloy Operatios and Concept'),
(2, 'D2 - Social, Ethical, Legal and Cybersafety'),
(3, 'D3 - Pedagogical'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `june`
--

CREATE TABLE `june` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `StartTime` varchar(250) NOT NULL,
  `EndTime` varchar(250) NOT NULL,
  `Duration` double NOT NULL,
  `Title` varchar(255) NOT NULL,
  `LC3Category` varchar(100) NOT NULL,
  `Accesiblity` varchar(15) NOT NULL,
  `Category` varchar(64) NOT NULL,
  `ProjectProgram` varchar(64) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Province` varchar(64) NOT NULL,
  `OtherDetails` varchar(64) NOT NULL,
  `InviteExecutives` varchar(10) NOT NULL,
  `InvitedExecutives` varchar(64) NOT NULL,
  `TargetSector` varchar(64) NOT NULL,
  `IctCompetencyAreas` varchar(64) NOT NULL,
  `Mode` varchar(64) NOT NULL,
  `ResourcePersonUnit` varchar(255) NOT NULL,
  `PartnerInstitution` varchar(64) NOT NULL,
  `StatusRemarks` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `june`
--

INSERT INTO `june` (`id`, `Date`, `StartDate`, `EndDate`, `StartTime`, `EndTime`, `Duration`, `Title`, `LC3Category`, `Accesiblity`, `Category`, `ProjectProgram`, `Location`, `Province`, `OtherDetails`, `InviteExecutives`, `InvitedExecutives`, `TargetSector`, `IctCompetencyAreas`, `Mode`, `ResourcePersonUnit`, `PartnerInstitution`, `StatusRemarks`) VALUES
(51, '2021-07-08', '2021-07-08', '2021-07-09', '01:29', '13:29', 12.5, 'ICT Specialized Training for Students: Graphics Design Training using Adobe Photoshop and Adobe Illustrator', 'Training', 'Closed Group', 'Others', 'Stakeholder Engagement/Meeting with Partners', 'Tayabas', 'Palawan', 'dfgh', 'FALSE', 'dgh', 'LGUs', 'D1 - Techonoloy Operatios and Concept', 'Blended', 'dgh', '1', 'For Finalization'),
(52, '2021-07-08', '2021-07-08', '2021-07-08', '01:50', '22:53', 123, 'Digital Literacy Training on Productivity Tools and Tech4ED Information Caravan for Camarines Sur', 'Wifi Launching', 'Closed Group', 'Local/Intl Event', 'GAD', '123', 'Camarines Norte', '123', 'TRUE', 'sample', 'NGA', 'D1 - Techonoloy Operatios and Concept', 'Blended', '123', '123', 'Reschedule');

-- --------------------------------------------------------

--
-- Table structure for table `lc3category`
--

CREATE TABLE `lc3category` (
  `id` int(7) NOT NULL,
  `LC3Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lc3category`
--

INSERT INTO `lc3category` (`id`, `LC3Category`) VALUES
(1, 'Profiency/Diagnostic Exam'),
(2, 'Stakeholder Engagement/Meeting with Partners'),
(3, 'Webinar'),
(4, 'Training'),
(5, 'Tech4ED Launching'),
(6, 'Wifi Launching'),
(7, 'Others'),
(8, '');

-- --------------------------------------------------------

--
-- Table structure for table `mode`
--

CREATE TABLE `mode` (
  `id` int(3) NOT NULL,
  `Mode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mode`
--

INSERT INTO `mode` (`id`, `Mode`) VALUES
(1, 'Online'),
(2, 'Face-to-face'),
(3, 'Blended'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `projectprogram`
--

CREATE TABLE `projectprogram` (
  `id` int(19) NOT NULL,
  `ProjectProgram` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectprogram`
--

INSERT INTO `projectprogram` (`id`, `ProjectProgram`) VALUES
(1, 'Profiency/Diagnostic Exam'),
(2, 'Stakeholder Engagement/Meeting with Partners'),
(3, 'Tech4ED Launching'),
(4, 'Training'),
(5, 'Webinar'),
(6, 'Wifi Launching'),
(7, 'BIMP-EAGA'),
(8, 'ITU'),
(9, 'APEC'),
(10, 'NBP'),
(11, 'eBPLS/iBPLS'),
(12, 'IIDB'),
(13, 'ILCDB'),
(14, 'Cybersecurity'),
(15, 'GAD'),
(16, 'NPCMB'),
(17, 'FW4A'),
(18, 'GECS'),
(19, 'Others'),
(20, '');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(100) NOT NULL,
  `province` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `province`) VALUES
(1, 'Albay'),
(2, 'Camarines Sur'),
(3, 'Camarines Norte'),
(4, 'Catanduanes'),
(5, 'Masbate'),
(6, 'Sorsogon'),
(7, 'Oriental Mindoro'),
(8, 'Occidental Mindoro'),
(9, 'Marinduque'),
(10, 'Romblon'),
(11, 'Palawan'),
(12, 'RCO/ROO'),
(0, '');

-- --------------------------------------------------------

--
-- Table structure for table `statusremarks`
--

CREATE TABLE `statusremarks` (
  `id` int(5) NOT NULL,
  `StatusRemarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statusremarks`
--

INSERT INTO `statusremarks` (`id`, `StatusRemarks`) VALUES
(1, 'Final'),
(2, 'For Finalization'),
(3, 'Tentative'),
(4, 'Reschedule'),
(5, 'Postponed'),
(6, '');

-- --------------------------------------------------------

--
-- Table structure for table `targetsectors`
--

CREATE TABLE `targetsectors` (
  `id` int(4) NOT NULL,
  `TargetSectors` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `targetsectors`
--

INSERT INTO `targetsectors` (`id`, `TargetSectors`) VALUES
(1, 'All Sectors'),
(2, 'LGUs'),
(3, 'NGA'),
(4, 'Teachers'),
(5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessibility`
--
ALTER TABLE `accessibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ictcompetencyareas`
--
ALTER TABLE `ictcompetencyareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `june`
--
ALTER TABLE `june`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lc3category`
--
ALTER TABLE `lc3category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projectprogram`
--
ALTER TABLE `projectprogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statusremarks`
--
ALTER TABLE `statusremarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targetsectors`
--
ALTER TABLE `targetsectors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessibility`
--
ALTER TABLE `accessibility`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ictcompetencyareas`
--
ALTER TABLE `ictcompetencyareas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `june`
--
ALTER TABLE `june`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `lc3category`
--
ALTER TABLE `lc3category`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mode`
--
ALTER TABLE `mode`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projectprogram`
--
ALTER TABLE `projectprogram`
  MODIFY `id` int(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `statusremarks`
--
ALTER TABLE `statusremarks`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `targetsectors`
--
ALTER TABLE `targetsectors`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
