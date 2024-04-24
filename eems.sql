-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 02:06 PM
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
-- Database: `eems`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(50) NOT NULL,
  `participents` int(100) DEFAULT 0,
  `img_link` text DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_title`, `participents`, `img_link`, `type_id`) VALUES
(3, 'Technical-Quiz', 5, 'images/quiz.png', 1),
(4, 'Competitive-Coding', 1, 'images/coding.jpg', 1),
(12, 'GDCS solution challenge', 0, 'images/coding_challenge.jpg', 1),
(13, 'cultural week', 2, 'images/cultural_week.jpg', 2),
(14, 'Art and culture', 1, 'images/art&culture1.jpg', 2),
(16, ' Media Education Summit ', 2, 'images/learning_tour.jpeg', 3),
(17, 'NEXUS Education', 1, 'images/library.jpg', 3),
(18, 'Maasai culture', 0, 'images/art&culture0.jpg', 2),
(19, 'Kusa women national Games', 3, 'images/pavillion_grounds.jpg', 4),
(20, 'Run for Mau', 1, 'images/cultural_week.jpg', 4),
(21, 'Swimming', 2, 'images/swimmingpool.jpg', 4),
(22, 'Tree planting', 0, 'images/tree_planting.jpg', 5),
(26, 'Competency based curriculum workshop training', 4, 'images/workshop_training.jpg', 1),
(27, 'Dance championship', 0, 'images/dance.jpg', 4),
(28, 'Full stack project building', 5, 'images/full_stack.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE `event_info` (
  `event_id` int(10) NOT NULL,
  `Date` date DEFAULT NULL,
  `time` varchar(20) NOT NULL,
  `venue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_info`
--

INSERT INTO `event_info` (`event_id`, `Date`, `time`, `venue_id`) VALUES
(3, '2024-03-10', '11.00 AM', 1),
(4, '2024-03-16', '9.30 AM', 2),
(12, '2024-03-07', '16:00 PM', 3),
(13, '2024-03-08', '08:00 AM ', 4),
(14, '2024-03-08', '08:00 AM ', 3),
(16, '2024-03-10', '16:00 PM', 2),
(17, '2024-03-03', '12:00 PM ', 5),
(18, '2024-03-16', '08:00 AM', 1),
(19, '2024-04-26', '12:00 PM', 3),
(20, '2024-04-26', '12:00 PM', 5),
(21, '2024-04-29', '10:00 AM', 2),
(22, '2024-05-04', '10:00 AM', 4),
(26, '2024-04-30', '10:00 AM', 4),
(27, '2024-04-27', '10:30 PM', 4),
(28, '2024-04-27', '12:30 PM', 3);

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `type_id` int(10) NOT NULL,
  `type_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `event_type`
--

INSERT INTO `event_type` (`type_id`, `type_title`) VALUES
(1, 'Technical Events'),
(2, 'cultural and arts'),
(3, 'academics'),
(4, 'Sports and Recreation'),
(5, 'community service');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `reg_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `faculty` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`reg_no`, `name`, `email`, `faculty`, `password`) VALUES
('A12/05411/20', 'samuel kimani', 'samuelk@gmail.com', 'FASS', ''),
('A13/45645/19', 'gregory ambani', 'gregory@gmail.com', 'FASS', ''),
('K12/02345/20', 'brabus Teng', 'brabus@gmail.com', 'FOA', ''),
('P12/02343/20', 'jamila mbogo', 'jamilam@gmail.com', 'ENGINEERING', ''),
('S11/03213/20', 'peris bella', 'perisb@gmail.com', 'FOS', ''),
('S12/02345/20', 'paul colito', 'paulc@gmail.com', 'FOS', ''),
('S13/03185/21', 'invicto ', 'vancedg352@gmail.com', 'FOS', ''),
('S13/04345/21', 'Victor', 'example@gmail.com', 'FOS', '');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `rid` int(11) NOT NULL,
  `reg_no` varchar(20) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`rid`, `reg_no`, `event_id`) VALUES
(2, 'S13/04315/21', 18),
(4, 'S13/04315/21', 3),
(5, 'S13/03185/21', 16),
(10, 'S13/03185/21', 14),
(11, 'S13/04345/21', 13),
(12, 'S13/04345/21', 12),
(13, 'E13/03853/22', 20),
(14, 'S13/03185/21', 17),
(15, 'S13/04315/21', 13),
(16, 'S11/03213/20', 19),
(17, 'S12/02345/20', 17),
(18, 'E13/03853/22', 21),
(19, 'A12/5411/20', 16),
(20, 'E13/03853/22', 16),
(21, 'A12/5411/20', 14),
(22, 'S13/03185/21', 3),
(34, 'A12/05411/20', 21),
(35, 'S11/03213/20', 26),
(36, 'S11/03213/20', 13),
(37, 'S13/03185/21', 21),
(38, 'A13/45645/19', 19),
(39, 'S11/03213/20', 0),
(40, 'K12/02345/20', 0),
(41, 'K12/02345/20', 20),
(42, 'K12/02345/20', 19),
(43, 'K12/02345/20', 19),
(44, 'S13/03185/21', 26),
(45, 'S13/04345/21', 28),
(46, 'S13/03185/21', 28),
(47, 'S11/03213/20', 28),
(48, 'S12/02345/20', 28),
(49, 'A12/05411/20', 28),
(50, 'K12/02345/20', 26),
(51, 'A13/45645/19', 26);

--
-- Triggers `registered`
--
DELIMITER $$
CREATE TRIGGER `count` AFTER INSERT ON `registered` FOR EACH ROW update events
set events.participents=events.participents+1
WHERE events.event_id=new.event_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_coordinator`
--

CREATE TABLE `staff_coordinator` (
  `stid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff_coordinator`
--

INSERT INTO `staff_coordinator` (`stid`, `name`, `phone`, `event_id`) VALUES
(3, 'jane', '0756436456', 3),
(4, 'Andrian', '0756436789', 4),
(12, 'Aloise', '0745984981', 12),
(13, 'Timothy Arege', NULL, 13),
(14, 'Timothy Arege', NULL, 14),
(18, 'everlyne', NULL, 18),
(19, 'victor', NULL, 16),
(20, 'victor', NULL, 17),
(21, 'nicholas', NULL, 19),
(22, 'Aluoch', NULL, 20),
(23, 'kive', NULL, 21),
(24, 'wanguya', NULL, 22),
(26, 'Hezron Akinyi', NULL, 26),
(27, 'gregory otieno', NULL, 27),
(28, 'alexis', NULL, 28);

-- --------------------------------------------------------

--
-- Table structure for table `student_coordinator`
--

CREATE TABLE `student_coordinator` (
  `sid` int(11) NOT NULL,
  `st_name` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_coordinator`
--

INSERT INTO `student_coordinator` (`sid`, `st_name`, `phone`, `event_id`) VALUES
(3, 'clinton', '8956436456', 3),
(4, 'fryehh', '0715123026', 4),
(12, 'fred', '0715123026', 12),
(13, 'Ignatious Berito', NULL, 13),
(14, 'Aloise', NULL, 14),
(18, 'aluoch', NULL, 18),
(19, 'kageri', NULL, 16),
(20, 'wanguya', NULL, 17),
(21, 'simiyu', NULL, 19),
(22, 'Ignatious Berito', '0715123026', 20),
(23, 'winfrey', NULL, 21),
(24, 'victor', NULL, 22),
(26, 'David Ndii', NULL, 26),
(27, 'ignatious berito', NULL, 27),
(28, 'juma', NULL, 28);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `capacity`) VALUES
(1, 'Pavillion', 1000),
(2, 'ED10', 8),
(3, 'PST5', 5),
(4, 'ARC HOTEL', 3),
(5, 'Kilimo hall', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `staff_coordinator`
--
ALTER TABLE `staff_coordinator`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `student_coordinator`
--
ALTER TABLE `student_coordinator`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4567;

--
-- AUTO_INCREMENT for table `event_info`
--
ALTER TABLE `event_info`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4566;

--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `staff_coordinator`
--
ALTER TABLE `staff_coordinator`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `student_coordinator`
--
ALTER TABLE `student_coordinator`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
