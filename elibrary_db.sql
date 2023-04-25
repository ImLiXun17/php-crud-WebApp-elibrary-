-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 01:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibrary_db`
--
CREATE DATABASE IF NOT EXISTS `elibrary_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `elibrary_db`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `admin_id` int(10) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`admin_id`, `admin_username`, `admin_email`, `admin_password`) VALUES
(1217, 'admin', 'admin@psu.palawan.edu.ph', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `bid` int(10) NOT NULL,
  `book_name` varchar(500) NOT NULL,
  `book_author` varchar(50) NOT NULL,
  `book_isbn` bigint(20) NOT NULL,
  `year_published` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bid`, `book_name`, `book_author`, `book_isbn`, `year_published`, `quantity`) VALUES
(1, 'The Hunger Games', 'Suzanne Collins', 9780439023481, 2008, 5),
(4, 'Divergent', 'Veronica Roth', 9780062024022, 2011, 5),
(12, 'The Great Gatsby', 'F. Scott Fitzgerald', 9780140007466, 1925, 5),
(13, 'A Gentle Reminder', 'Bianca Sparacino', 9781949759297, 2020, 5),
(14, 'To Kill a Mockingbird', 'Harper Lee', 9780060173227, 1960, 5),
(15, 'It Ends with us', 'Colleen Hoover', 9781432899790, 2016, 5),
(16, 'The Inevitbale', 'Kelvin Kelly', 9780143110378, 2016, 5),
(17, 'Managing Information Technology', 'Carol V. Brown', 9783319388908, 2011, 5),
(18, 'CyberEthics', 'Richard A. Spinello', 9780763700645, 2000, 5),
(19, 'Don Quixote', 'Miguel de Cervantes', 9780099469698, 1605, 5),
(20, 'The Lord of the Rings', 'J.R.R Tolkien', 9780544003415, 1954, 5),
(21, 'The Da Vinci Code', 'Dan Brown', 9780385504201, 2003, 5),
(22, 'One Hundred Years of Soltitude', 'Gabriel Garcia Marquez', 9780060114183, 1967, 5),
(23, 'Charlotte’s Web', 'E.B. White', 9780590302715, 1952, 5),
(24, 'The Dream of the Red Chamber', 'Cao Xueqin', 9780253192646, 1791, 5),
(25, 'The Lion, the Witch and the Wardrobe', 'C.S. Lewis', 9780001831803, 1950, 5),
(28, 'Information Assurance and Security Technologies for Risk Assessment and Threat Management', 'Te-Shun Chou', 1613505078, 2011, 5),
(30, 'Thinking, Fast and Slow', 'Daniel Kahneman', 9781846140556, 2011, 5),
(31, 'Thinking, Fast and Slow', 'Daniel Kahneman', 9781846140556, 2011, 5),
(34, 'Structures: Or Why Things Don\'t Fall Down', 'J. E. Gordon', 8601419985296, 2003, 5),
(35, 'The Design of Everyday Things', 'Donald Norman', 9780465067107, 1988, 5),
(36, '	To Engineer is Human: The Role of Failure in Successful Design Vintage Series', 'Henry Petroski', 9780679734161, 1992, 5),
(37, 'Engineers\' Practical Databook: A Technical Reference Guide for Students and Professionals', 'Jay Smith', 1980619344, 2018, 5),
(38, 'The Unwritten Laws of Engineering ', ' James G. Skakoon, et al.', 9780791801628, 2001, 5),
(39, 'Life Works, And Writings Of A Genius, Writer, Scientist And National Hero', 'Gregorio F. Zaide, et al.', 9789712733239, 2014, 5);

-- --------------------------------------------------------

--
-- Table structure for table `book_return`
--

DROP TABLE IF EXISTS `book_return`;
CREATE TABLE `book_return` (
  `return_id` int(10) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `time_return` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE `borrow` (
  `borrow_id` int(50) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `coll_id` int(10) NOT NULL,
  `book_isbn` bigint(20) NOT NULL,
  `time_borrow` datetime DEFAULT NULL,
  `time_return` datetime DEFAULT NULL,
  `fines` int(10) DEFAULT NULL,
  `action` enum('Paid','Not Paid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `student_id`, `coll_id`, `book_isbn`, `time_borrow`, `time_return`, `fines`, `action`) VALUES
(17, 202080030, 138, 9780439023481, '2023-04-16 09:54:00', '2023-04-19 20:10:00', 1160, ''),
(20, 202080090, 138, 9780439023481, '2023-04-16 19:53:00', '2023-04-19 21:35:00', 980, 'Not Paid'),
(21, 202080035, 138, 9780062024022, '2023-04-16 17:15:00', '2023-04-21 13:42:00', 1840, 'Not Paid'),
(22, 202080037, 138, 9780062024022, '2023-04-16 17:15:00', '2023-04-20 20:07:00', 1480, 'Not Paid'),
(23, 202080083, 134, 9780062024022, '2023-04-16 17:16:00', '2023-04-18 20:11:00', 520, 'Not Paid'),
(27, 202080030, 138, 9780062024022, '2023-04-16 19:53:00', '2023-04-22 13:01:00', 2260, 'Not Paid'),
(31, 202080076, 133, 9780439023481, '2023-04-17 06:30:00', '2023-04-28 14:35:00', 4960, 'Not Paid'),
(32, 202080070, 138, 9780439023481, '2023-04-17 13:01:00', '2023-04-18 13:01:00', 0, 'Not Paid'),
(35, 202080129, 138, 9780439023481, '2023-04-17 14:30:00', '2023-04-22 18:44:00', 2000, 'Not Paid'),
(37, 202080058, 138, 9780439023481, '2023-04-17 14:33:00', '2023-12-18 14:34:00', 117120, ''),
(38, 202110101, 138, 9780439023481, '2023-04-17 17:31:00', '2023-04-19 17:32:00', 480, ''),
(39, 202110101, 138, 9780439023481, '2023-04-17 21:12:00', '2023-04-25 18:42:00', 3300, 'Not Paid'),
(40, 202110101, 132, 9780439023481, '2023-04-18 04:00:00', '2023-04-24 18:39:00', 2680, 'Paid'),
(45, 202080070, 134, 9780763700645, '2023-04-19 21:09:00', '2023-04-21 21:09:00', 480, 'Not Paid'),
(46, 202080030, 140, 9781949759297, '2023-04-19 21:09:00', '2023-04-18 21:09:00', 0, 'Not Paid'),
(47, 202080037, 139, 9781949759297, '2023-04-20 15:38:00', '2023-04-26 15:39:00', 2400, 'Not Paid'),
(48, 202080090, 135, 9780099469698, '2023-04-20 19:04:00', '2023-04-22 18:36:00', 460, 'Not Paid'),
(49, 202080070, 137, 9781432899790, '2023-04-20 19:54:00', '2023-04-21 18:31:00', 0, 'Not Paid'),
(50, 202080090, 136, 9783319388908, '2023-04-20 20:00:00', '2023-04-28 18:27:00', 3320, 'Not Paid'),
(51, 202080090, 137, 9780060114183, '2023-04-20 21:06:00', '2023-04-21 18:24:00', 0, 'Not Paid'),
(52, 202110101, 132, 9780385504201, '2023-04-20 21:28:00', '2023-04-26 19:49:00', 2360, 'Not Paid'),
(53, 202080090, 132, 9780385504201, '2023-04-20 21:28:00', '2023-04-29 19:54:00', 3800, 'Not Paid'),
(58, 202080070, 138, 9780544003415, '2023-04-21 19:16:00', '2023-04-29 19:53:00', 3360, 'Not Paid'),
(59, 202080070, 138, 9780385504201, '2023-04-21 19:56:00', '2023-04-29 19:57:00', 3360, 'Paid'),
(60, 202080037, 138, 9781949759297, '2023-04-21 20:11:00', '2023-04-22 10:43:00', 0, 'Not Paid'),
(64, 202030108, 0, 9780590302715, '2023-04-21 20:21:00', '0000-00-00 00:00:00', 0, 'Not Paid');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

DROP TABLE IF EXISTS `college`;
CREATE TABLE `college` (
  `id` int(10) NOT NULL,
  `college_name` enum('CAH','CBA','CCJE','CEAT','CHTM','CNHS','CS','CTE','LHS') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`id`, `college_name`) VALUES
(132, 'CAH'),
(133, 'CBA'),
(134, 'CCJE'),
(135, 'CEAT'),
(136, 'CHTM'),
(137, 'CNHS'),
(138, 'CS'),
(139, 'CTE'),
(140, 'LHS');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `sid` bigint(20) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `corporate_email` varchar(50) NOT NULL,
  `college_id` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_add` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `student_name`, `corporate_email`, `college_id`, `address`, `date_add`) VALUES
(201840137, 'Martinez, Francis', '201840137@psu.palawan.edu.ph', 138, 'Santa Monica, PPC', '2023-04-19 08:41:24'),
(201990069, 'Malvas, Mia Erika D.', '201990069@psu.palawan.edu.ph', 136, 'San Pedro, PPC', '2023-04-23 09:39:26'),
(202010113, 'Favila, Je-an A.', '202010113@psu.palawan.edu.ph', 132, 'Tiniguiban, PPC', '2023-04-23 16:00:37'),
(202010357, 'Tingson, Angelica', '202010357@psu.palawan.edu.ph', 132, 'Tiniguiban, PPC', '2023-04-23 16:02:36'),
(202020734, 'Cuerdo, Madelyn', '202020734@psu.palawan.edu.ph', 133, 'Santa Monica, PPC', '2023-04-25 07:45:22'),
(202020775, 'Lucmayon, Mark Kevin B.', '202020775@psu.palawan.edu.ph', 133, 'Tagburos, PPC', '2023-04-23 15:45:05'),
(202030044, 'Lopez, Christine', '202030044@psu.palawan.edu.ph', 139, 'Tiniguiban, PPC', '2023-04-25 07:43:03'),
(202030108, 'Beating, Princess', '202030108@psu.palawan.edu.ph', 139, 'San Pedro, PPC', '2023-04-19 07:41:24'),
(202040196, 'Gripon, Erick Jay', '202040196@psu.palawan.edu.ph', 135, 'Sicsican, PPC', '2023-04-23 15:53:32'),
(202070082, 'Garcia, Oliver L.', '202070082@psu.palawan.edu.ph', 137, 'Tagburos, PPS', '2023-04-23 15:58:30'),
(202070181, 'Tierra, Nicole Angel', '202070181@psu.palawan.edu.ph', 137, 'Tiniguiban, PPC', '2023-04-24 00:28:20'),
(202080012, 'Namuco, Nerysol A.', '202080012@psu.palawan.edu.ph', 138, 'Tiniguiban, PPC', '2023-04-20 07:44:57'),
(202080030, 'Calma, Ingrid', '202080030@psu.palawan.edu.ph', 138, 'Naval, PPC', '2023-04-19 08:45:24'),
(202080031, 'Casayas, Jiezca', '202080031@psu.palawan.edu.ph', 138, 'San Pedro, PPC', '2023-04-20 08:41:24'),
(202080035, 'Gabayan, Angel', '202080035@psu.palawan.edu.ph', 138, 'Manalo, PPC', '2023-04-18 02:41:24'),
(202080037, 'Dorero, Charles Jazon C.', '202080037@psu.palawan.edu.ph', 138, 'Santa Lourdes, PPC', '2023-04-19 07:41:24'),
(202080058, 'Hachero, Anniza ', '202080058@psu.palawan.edu.ph', 138, 'San Jose, PPC', '2023-04-18 09:51:24'),
(202080070, 'Llado, Maurene C.', '202080070@psu.palawan.edu.ph', 138, 'Santa Monica, PPC', '2023-04-20 10:41:24'),
(202080076, 'Llado, Geranz', '202080076@psu.palawan.edu.ph', 133, 'Santa Monica, PPC', '2023-04-19 06:41:24'),
(202080083, 'Delacruz, Juan C.', '202080083@psu.palawan.edu.ph', 134, 'Tiniguiban, PPC', '2023-04-22 03:41:24'),
(202080090, 'Orga, Sean Harvey D.', '202080090@psu.palawan.edu.ph', 138, 'Elnido, Palawan', '2023-04-19 09:41:24'),
(202080129, 'Vitero, Randel', '202080129@psu.palawan.edu.ph', 138, 'San Jose, PPC', '2023-04-16 09:41:24'),
(202080343, 'Del Moro, Maria Victoria', '202080343@psu.palawan.edu.ph', 138, 'San Pedro, PPC', '2023-04-23 15:20:35'),
(202110101, 'Diosane, Jovel', '202110101@psu.palawan.edu.ph', 132, 'San Pedro, PPC', '2023-04-19 05:41:24'),
(202120155, 'Cacacha, Angel Andrea, D', '202120155@psu.palawan.edu.ph', 133, 'Tiniguiban, PPC', '2023-04-23 15:47:41'),
(202130519, 'Sanchez, Jella Mae', '202130519@psu.palawan.edu.ph', 139, 'Buncag, PPC', '2023-04-23 15:43:13'),
(2020120097, 'Paruco, Anjel Mae U.', '2020120097@psu.palawan.edu.ph', 134, 'Santa Monica, PPC', '2023-04-23 15:55:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `book_isbn` (`book_isbn`);

--
-- Indexes for table `book_return`
--
ALTER TABLE `book_return`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `book_isbn` (`book_isbn`),
  ADD KEY `coll_id` (`coll_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `college_id` (`college_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `book_return`
--
ALTER TABLE `book_return`
  MODIFY `return_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
