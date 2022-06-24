-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4000
-- Generation Time: Jun 24, 2022 at 05:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminId` int(10) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `Name`, `Email`, `Password`) VALUES
(3, 'salma', 'yassersalma305@gmail.com', 'a30b0212749f5117ef24fb34320badf0');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `ClassId` int(10) NOT NULL,
  `StudentsNo` int(10) NOT NULL,
  `ClassName` tinytext NOT NULL,
  `AdminId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassId`, `StudentsNo`, `ClassName`, `AdminId`) VALUES
(1, 26, 'primary one', 3),
(2, 29, 'primary two', 3);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `DegreeId` int(10) NOT NULL,
  `StudentId` int(10) NOT NULL,
  `SubjectId` int(10) NOT NULL,
  `degree` int(50) NOT NULL,
  `TeacherId` int(10) NOT NULL,
  `ParentId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`DegreeId`, `StudentId`, `SubjectId`, `degree`, `TeacherId`, `ParentId`) VALUES
(7, 2, 11, 50, 6, 19),
(8, 2, 11, 50, 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `ParentId` int(10) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `phone` varchar(14) NOT NULL,
  `Admin` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`ParentId`, `Name`, `Email`, `Password`, `phone`, `Admin`) VALUES
(19, 'ebrahium', 'hamed@gmail.com', 'fc4771388eef69231947de8e494ee62c', '0115582720', 3),
(20, 'yasser', 'yasser@gmail.com', '34318a3bf49c8f7177aad35738dea811', '0116576654', 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentId` int(10) NOT NULL,
  `Name` text NOT NULL,
  `BirthDate` date NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Grade` text NOT NULL,
  `phone` varchar(14) NOT NULL,
  `ClassId` int(10) NOT NULL,
  `ParentId` int(10) NOT NULL,
  `AdminId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentId`, `Name`, `BirthDate`, `Email`, `Password`, `Grade`, `phone`, `ClassId`, `ParentId`, `AdminId`) VALUES
(2, 'ahmed', '2012-02-08', 'ahmed@gmail.com', '725a8d35191cc5f9ec2229e93608d192', 'A+', '0107876545', 2, 19, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectId` int(10) NOT NULL,
  `Title` text NOT NULL,
  `Content` text NOT NULL,
  `Image` text NOT NULL,
  `AdminId` int(10) NOT NULL,
  `ClassId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectId`, `Title`, `Content`, `Image`, `AdminId`, `ClassId`) VALUES
(10, 'math', 'sdddggggggtttttttttttt', '62b41c4764c971655970887.jpeg', 3, 1),
(11, 'arabic', 'sdddggggggtttttttttttt', '62b41c661d6821655970918.jpeg', 3, 2),
(12, 'art', 'it supports the side of the creativity for each child.', '62b5cfbcec3cf1656082364.jpeg', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjectteacher`
--

CREATE TABLE `subjectteacher` (
  `ExamsId` int(10) NOT NULL,
  `SubjectId` int(10) NOT NULL,
  `TeacherId` int(10) NOT NULL,
  `Exams` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(10) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `Name`, `Email`, `Password`) VALUES
(2, 'ammar', 'ammar@gmail.com', '7942636d28cab8f3ae5073b556be27fa');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherId` int(10) NOT NULL,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Phone` varchar(14) NOT NULL,
  `Image` text NOT NULL,
  `AdminId` int(10) NOT NULL,
  `SubjectId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TeacherId`, `Name`, `Email`, `Password`, `Phone`, `Image`, `AdminId`, `SubjectId`) VALUES
(5, 'soaad', 'soaad@gmail.com', '231bedb5f424ebb473177b0c4dc73865', '0115582720', '62b466215f84b1655989793.jpeg', 3, 11),
(6, 'samia', 'samia@gmail.com', 'e82da853ccee4c73708c920fb0d1d14a', '0116766567', '62b46647ecc1b1655989831.jpeg', 3, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ClassId`),
  ADD KEY `Adminn` (`AdminId`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`DegreeId`),
  ADD KEY `StudentId` (`StudentId`),
  ADD KEY `Subject` (`SubjectId`),
  ADD KEY `Teacher` (`TeacherId`),
  ADD KEY `Parent` (`ParentId`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`ParentId`),
  ADD KEY `adminnnn` (`Admin`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentId`),
  ADD KEY `ParentId` (`ParentId`),
  ADD KEY `ClassId` (`ClassId`),
  ADD KEY `AdminId` (`AdminId`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectId`),
  ADD KEY `admin_id` (`AdminId`),
  ADD KEY `Class` (`ClassId`);

--
-- Indexes for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  ADD PRIMARY KEY (`ExamsId`),
  ADD KEY `SubjectId` (`SubjectId`),
  ADD KEY `TeacherId` (`TeacherId`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherId`),
  ADD KEY `Admin` (`AdminId`),
  ADD KEY `Subjectttt` (`SubjectId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `ClassId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `DegreeId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `ParentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `StudentId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SubjectId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  MODIFY `ExamsId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TeacherId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `Adminn` FOREIGN KEY (`AdminId`) REFERENCES `admin` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `Parent` FOREIGN KEY (`ParentId`) REFERENCES `parent` (`ParentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StudentId` FOREIGN KEY (`StudentId`) REFERENCES `student` (`StudentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Subject` FOREIGN KEY (`SubjectId`) REFERENCES `subject` (`SubjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Teacher` FOREIGN KEY (`TeacherId`) REFERENCES `teacher` (`TeacherId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `adminnnn` FOREIGN KEY (`Admin`) REFERENCES `admin` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `AdminId` FOREIGN KEY (`AdminId`) REFERENCES `admin` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ClassId` FOREIGN KEY (`ClassId`) REFERENCES `class` (`ClassId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ParentId` FOREIGN KEY (`ParentId`) REFERENCES `parent` (`ParentId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `Class` FOREIGN KEY (`ClassId`) REFERENCES `class` (`ClassId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_id` FOREIGN KEY (`AdminId`) REFERENCES `admin` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectteacher`
--
ALTER TABLE `subjectteacher`
  ADD CONSTRAINT `SubjectId` FOREIGN KEY (`SubjectId`) REFERENCES `subject` (`SubjectId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `TeacherId` FOREIGN KEY (`TeacherId`) REFERENCES `teacher` (`TeacherId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `Admin` FOREIGN KEY (`AdminId`) REFERENCES `admin` (`AdminId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Subjectttt` FOREIGN KEY (`SubjectId`) REFERENCES `subject` (`SubjectId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
