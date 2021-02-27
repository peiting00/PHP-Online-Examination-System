-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2021 at 01:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(10) NOT NULL,
  `adminName` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `email`, `password_hash`) VALUES
('admin01', 'admin_01', 'admin01@gmail.com', '$2y$10$.x/GkPKZ7MuephxdahxiROMzT9Xr1xTcVN1er2EoKG8VuXXNniRFq'),
('admin02', 'admin_02', 'admin02@gmail.com', '$2y$10$m51ebyxb/SvoJ1T/.3Tk5ethBeEAR5XoBxI0JJWqZ6x5slLgilG0O'),
('admin03', 'admin_03', 'admin03@gmail.com', '$2y$10$Z5u7AB/rdXppiEveLIExJO8eir.x4LRuRvsyDcUYHvZ74JT71ypm6'),
('admin04', 'admin_04', 'admin04@gmail.com', '$2y$10$cmYr/7UIL2fKF1C0f3HUWeOgBi.BbHfA2QHKWbXFX09.OqRK9Efem');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` varchar(10) NOT NULL,
  `courseName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`) VALUES
('AUP', 'American University Program'),
('BCSI', 'Bachelor in Computer Science'),
('BITI', 'Bachelor in Information Technology'),
('DIA', 'Diploma In Accounting'),
('DIB', 'Diploma in Business'),
('DIQS', 'Diploma In Quantity Surveying'),
('DITN', 'Diploma in Information Technology'),
('FIA', 'Foundation In Arts'),
('FIS', 'Foundation In Science');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `facultyID` varchar(10) NOT NULL,
  `facultyName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyID`, `facultyName`) VALUES
('FEQS', 'Faculty of Engineering & Quantity Surveying'),
('FHLS', 'Faculty of Health & Life Science'),
('FIT', 'Faculty of Information'),
('FOBCAL', 'Faculty of Business, Communication and Law');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(10) NOT NULL,
  `studentName` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `courseID` varchar(10) NOT NULL,
  `password_hash` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `studentName`, `email`, `courseID`, `password_hash`) VALUES
('student01', 'student_01', 'student01@gmail.com', 'AUP', '$2y$10$Q5cFeUXDpwlSI7unPtotZeDU5AUjhnxdx0az74wSI6ipBwYkZT9Z6'),
('student02', 'student_02', 'student02@gmail.com', 'BCSI', '$2y$10$6gUGG5Bn5xgSgEEXqUoW3uFy5Wv.HK7pIGVJKdWfCDi3y9MRypW7q'),
('student03', 'student_03', 'student03@gmail.com', 'BITI', '$2y$10$NSadUWvQ.MUdcbsdUXA.cej6DHTXmBIyvnsNQHCxVed1.kSZHNpku'),
('student04', 'student_04', 'student04@gmail.com', 'DIA', '$2y$10$U4nr9dIJDEycftPb11yO4.6f9WCi9HoQ4JcwSShGHlChoZJTHQfYi'),
('student05', 'student_05', 'student05@gmail.com', 'DIB', '$2y$10$GV.msMUED.tyCvdQTJhtKORQ8b3jcz5xqJdQ8UzmQgccaphdyKLLq'),
('student06', 'student_06', 'student06@gmail.com', 'BCSI', '$2y$10$sL..iIzi6MtJrp2WFDw9HOua38i.n/6hvC1ZUX4c1M6.1tqCFzvLC'),
('student07', 'student_07', 'student07@gmail.com', 'DIA', '$2y$10$XoP.9O6fymS2OVi1iYnFo.ITSl4BIa/p.ZtXgwuXwzjzhmoX2ILb6'),
('student08', 'student_08', 'student08@gmail.com', 'DITN', '$2y$10$230HQb2IGE.jRPd7wQHozuIZ.p98gWKphCPAPn6o8wX91HHdgQomm'),
('student09', 'student_09', 'student09@gmail.com', 'DITN', '$2y$10$ZJmLT.mXCGIDpRActPEYderVqVugKWVnrkCOohC9HSdjZ8qplVizq'),
('student10', 'student_10', 'student10@gmail.com', 'AUP', '$2y$10$7ZeCQGFfagxaM/6ILMRjlempmiK0/G9GBlB2TUiYMnc/2l1AVSx8i'),
('student11', 'student_11', 'student11@gmail.com', 'FIA', '$2y$10$bRYdt2YM4J0jGYcRlsSOMecXSZP.2B6J0tN7HqV9pbi5LSxZCaJxi'),
('student12', 'student_12', 'student12@gmail.com', 'DIA', '$2y$10$en3hezecdMCNqOvCUxurIOY34joKF18hABaoP5gQCE6uPfeVkOzQK');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherID` varchar(10) NOT NULL,
  `teacherName` varchar(40) NOT NULL,
  `facultyID` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherID`, `teacherName`, `facultyID`, `email`, `password_hash`) VALUES
('teacher04', 'teacher_04', 'FEQS', 'teacher04@gmail.com', '$2y$10$vG7qigeaP21I/5voslZ7O.MO7YpJ/QAXpCZbA/xr2pg6ERhhJT59y'),
('teacher05', 'teacher_05', 'FIT', 'teacher05@gmail.com', '$2y$10$StU2Q9CffPvJOZjpW.SJJe9Bt2tKDfZMWtmcXJYgPzEoEfabzDfBq'),
('teacher06', 'teacher_06', 'FIT', 'teacher06@gmail.com', '$2y$10$TLXfnS2CA7EsmY5XKuwPzOegV/WhjuzcHsGhfEnv7QuS5QmYL5aIq'),
('teacher07', 'teacher_07', 'FEQS', 'teacher07@gmail.com', '$2y$10$2agd/ugr.PZzxsXO5Tu3sOFkGPJTJB6rYHcCUYMXDYsM8lSnme8ze'),
('teacher08', 'teacher_08', 'FOBCAL', 'teacher08@gmail.com', '$2y$10$07wOvEq9G/7r0LXMNGMyGOELiofvsH9SYPmxKb05WYtdKPkKUYpA6'),
('teacher09', 'teacher_09', 'FEQS', 'teacher09@gmail.com', '$2y$10$8SSgKv8IFKUmtEqxIClPxuAcDv/sAYAi4d00/BcA0FUgiVV7zv/mC'),
('teacher10', 'teacher_10', 'FIT', 'teacher10@gmail.com', '$2y$10$zACtV/lQNuitHZqkGqajvOjNLkvBSko/bWa.RqZJNSnBAE2AiQQka'),
('teacher11', 'teacher_11', 'FIT', 'teacher11@gmail.com', '$2y$10$3ciqm1khNNt1vS6HBdeVEOo9yT26xT2XKejOD3/da5eI/PFZC3Jl2'),
('teacher12', 'teacher_12', 'FIT', 'teacher12@gmail.com', '$2y$10$.qeawBFwjtSMhnmcv6hc9egfEHe8DTX36hNxR4FTHwqNkcFNgfOzK'),
('teacher13', 'teacher_13', 'FEQS', 'teacher13@gmail.com', '$2y$10$rdkHjIcDbfxQQWu0.Nj9i.28zCm4ARU5564qJLhTnORMzcdawM1V2'),
('teacher14', 'teacher_14', 'FOBCAL', 'teacher14@gmail.com', '$2y$10$uO0mIBZePJnKSGbPD7G9Gup57FAc7OO1584/ClyQixXd3bn.Z0vaK'),
('teacher15', 'teacher_15', 'FEQS', 'teacher15@gmail.com', '$2y$10$G2x6M1XniYABGryjV6Epg./YbdT5sHSVJTlSgGfHrglEjeTYSUEOG'),
('teacher16', 'teacher_16', 'FIT', 'teacher16@gmail.com', '$2y$10$9w7ILTqoA4ECH6/ZH6y0W.F0ysUrV1oZJh240uxZ1JOZYNVhS1bl.'),
('teacher17', 'teacher_17', 'FIT', 'teacher17@gmail.com', '$2y$10$JAvwzlSHJCo9Wy9SO5I.OeypVRdy7mu5xVHhddKCrpvOBPzRvrL0a'),
('teacher18', 'teacher_18', 'FOBCAL', 'teacher18@gmail.com', '$2y$10$GHXGwtqQ/5w.koDUqUvHvumXoXvbTbYUvuwhrTlbkQRxKq5ZRwcM6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherID`),
  ADD KEY `facultyID` (`facultyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`facultyID`) REFERENCES `faculty` (`facultyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
