-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2021 at 10:56 AM
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
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `examID` int(11) NOT NULL,
  `examTitle` varchar(50) NOT NULL,
  `courseID` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `duration` int(5) NOT NULL,
  `totalQuestion` int(5) NOT NULL,
  `rightAnsMark` float NOT NULL,
  `wrongAnsMark` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`examID`, `examTitle`, `courseID`, `date`, `time`, `duration`, `totalQuestion`, `rightAnsMark`, `wrongAnsMark`) VALUES
(1, 'PHP Quiz 1', 'BCSI', '2021-02-26', '14:10:00', 20, 10, 1.5, -2),
(2, 'Life Process Quiz', 'FIS', '2021-02-25', '13:20:00', 20, 10, 1, -1.5);

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
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionID` int(11) NOT NULL,
  `examID` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) NOT NULL,
  `option3` varchar(50) NOT NULL,
  `option4` varchar(50) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionID`, `examID`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 'PHP Stands for?', 'PHP Hypertex Processor', 'PHP Hyper Markup Processor', 'PHP Hyper Markup Preprocessor', 'PHP Hypertext Preprocessor', 'PHP Hypertext Preprocessor'),
(2, 1, 'PHP is an example of ___________ scripting language.', 'Server-side', 'Client-side', 'Browser-side', 'In-side', 'Server-side'),
(3, 1, 'Who is known as the father of PHP?', 'Rasmus Lerdorf', 'Willam Makepiece', 'Drek Kolkevi', 'List Barely', 'Rasmus Lerdorf'),
(4, 1, 'Which of the following is not true?', 'PHP can be used to develop web', 'PHP makes a website dynamic', 'PHP applications can not be co', 'PHP can not be embedded into h', 'PHP can not be embedded into h'),
(5, 1, 'PHP’s numerically indexed array begin with position ___________', '1', '2', '0', '-1', '0'),
(6, 1, 'Which of the following variables is not a predefined variable?', '$get', '$ask', '$request', '$post', '$ask'),
(7, 1, 'Which of the following function returns a text in title case from a variable?', 'ucwords($var)', 'upper($var)', 'toupper($var)', 'ucword($var)', 'ucwords($var)'),
(8, 1, 'Which of the following method sends input to a script via a URL?', 'Get', 'Post', 'Both', 'None', 'Get'),
(9, 1, 'Which of the following function returns the number of characters in a string variable?', 'count($variable)', 'len($variable)', 'strcount($variable)', 'strlen($variable)', 'strlen($variable)'),
(10, 1, 'How to define a function in PHP?', 'function {function body}', 'data type functionName(parameters) {function body}', 'functionName(parameters) {function body}', 'function functionName(parameters) {function body}', 'function functionName(parameters) {function body}'),
(11, 2, 'Which of the following are energy foods?', 'Carbohydrates and fats', 'Proteins and mineral salts', 'Vitamins and minerals', 'Water and roughage', 'Carbohydrates and fats'),
(12, 2, 'The mode of nutrition found in fungi is:', 'Parasitic nutrition', 'Holozoic nutrition', 'Autotrophic nutrition', 'Saprotrophic nutrition', 'Saprotrophic nutrition'),
(13, 2, 'Roots of the plants absorb water from the soil through the process of:', 'diffusion', 'transpiration', 'osmosis', 'None of these', 'osmosis'),
(14, 2, 'The site of photosynthesis in the cells of a leaf is', 'chloroplast', 'mitochondria', 'cytoplasm', 'protoplasm', 'chloroplast'),
(15, 2, 'In amoeba, food is digested in the:', 'food vacuole', 'mitochondria', 'pseudopodia', 'chloroplast', 'food vacuole'),
(16, 2, 'Which region of the alimentary canal absorbs the digested food?', 'Stomach', 'Small intestine', 'Large intestine', 'Liver', 'Small intestine'),
(17, 2, 'The contraction and expansion movement of the walls of the food pipe is called:', 'translocation', 'transpiration', 'peristaltic movement', 'digestion', 'peristaltic movement'),
(18, 2, 'The exit of unabsorbed food material is regu-lated by', 'liver', 'anus', 'small intestine', 'anal sphincter', 'anal sphincter'),
(19, 2, 'What are the products obtained by anaerobic respiration in plants?', 'Lactic acid + Energy', 'Carbon dioxide + Water + Energy', 'Ethanol + Carbon dioxide + Energy', 'Pyruvate', 'Ethanol + Carbon dioxide + Energy'),
(20, 2, 'The breakdown of pyruvate to give carbon di-oxide, water and energy takes place in', 'cytoplasm', 'mitochondria', 'chloroplast', 'nucleus', 'nucleus');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `resultID` int(11) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `examID` int(11) DEFAULT NULL,
  `questionID` int(11) NOT NULL,
  `studentAns` varchar(50) NOT NULL,
  `correctAns` varchar(50) NOT NULL,
  `result` varchar(10) NOT NULL,
  `marks` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`resultID`, `studentID`, `examID`, `questionID`, `studentAns`, `correctAns`, `result`, `marks`) VALUES
(1, 'student02', 1, 1, 'PHP Hypertext Preprocessor', 'PHP Hypertext Preprocessor', 'Right', 1.5),
(2, 'student02', 1, 2, 'Server-side', 'Server-side', 'Right', 1.5),
(3, 'student02', 1, 3, 'Willam Makepiece', 'Rasmus Lerdorf', 'Wrong', -2),
(4, 'student02', 1, 4, 'PHP can not be embedded into html.', 'PHP can not be embedded into html.', 'Right', 1.5),
(5, 'student02', 1, 5, '0', '0', 'Right', 1.5),
(6, 'student02', 1, 6, '$ask', '$ask', 'Right', 1.5),
(7, 'student02', 1, 7, 'Get', 'Get', 'Right', 1.5),
(8, 'student02', 1, 8, 'ucword($var)', 'ucwords($var)', 'Wrong', -2),
(9, 'student02', 1, 9, 'strlen($variable)', 'strcount($variable)', 'Wrong', -2),
(10, 'student02', 1, 10, 'function functionName(parameters) {function body}', 'function functionName(parameters) {function body}', 'Right', 1.5),
(11, 'student07', 2, 11, 'Carbohydrates and fats', 'Carbohydrates and fats', 'Right', 1),
(12, 'student07', 2, 12, 'Autotrophic nutrition', 'Saprotrophic nutrition', 'Wrong', -1.5),
(13, 'student07', 2, 13, 'osmosis', 'osmosis', 'Right', 1),
(14, 'student07', 2, 14, 'chloroplast', 'chloroplast', 'Right', 1),
(15, 'student07', 2, 15, 'food vacuole', 'food vacuole', 'Right', 1),
(16, 'student07', 2, 16, 'Small intestine', 'Small intestine', 'Right', 1),
(17, 'student07', 2, 17, 'digestion', 'peristaltic movement', 'Wrong', -1.5),
(18, 'student07', 2, 18, 'anal sphincter', 'anal sphincter', 'Right', 1),
(19, 'student07', 2, 19, 'Carbon dioxide + Water + Energy', 'Ethanol + Carbon dioxide + Energy', 'Wrong', -1.5),
(20, 'student07', 2, 20, 'mitochondria', 'mitochondria', 'Right', 1);

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
('student07', 'student_07', 'student07@gmail.com', 'FIS', '$2y$10$XoP.9O6fymS2OVi1iYnFo.ITSl4BIa/p.ZtXgwuXwzjzhmoX2ILb6'),
('student08', 'student_08', 'student08@gmail.com', 'FIS', '$2y$10$230HQb2IGE.jRPd7wQHozuIZ.p98gWKphCPAPn6o8wX91HHdgQomm'),
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
('teacher04', 'teacher_04', 'FHLS', 'teacher04@gmail.com', '$2y$10$0FhFC/020x4CkbMHpr6bgeQSoLAnLbULEsc0E18NlCY8720GoLc4a'),
('teacher05', 'teacher_05', 'FIT', 'teacher05@gmail.com', '$2y$10$StU2Q9CffPvJOZjpW.SJJe9Bt2tKDfZMWtmcXJYgPzEoEfabzDfBq'),
('teacher06', 'teacher_06', 'FIT', 'teacher06@gmail.com', '$2y$10$TLXfnS2CA7EsmY5XKuwPzOegV/WhjuzcHsGhfEnv7QuS5QmYL5aIq'),
('teacher07', 'teacher_07', 'FEQS', 'teacher07@gmail.com', '$2y$10$2agd/ugr.PZzxsXO5Tu3sOFkGPJTJB6rYHcCUYMXDYsM8lSnme8ze'),
('teacher08', 'teacher_08', 'FOBCAL', 'teacher08@gmail.com', '$2y$10$07wOvEq9G/7r0LXMNGMyGOELiofvsH9SYPmxKb05WYtdKPkKUYpA6'),
('teacher09', 'teacher_09', 'FEQS', 'teacher09@gmail.com', '$2y$10$8SSgKv8IFKUmtEqxIClPxuAcDv/sAYAi4d00/BcA0FUgiVV7zv/mC'),
('teacher10', 'teacher_10', 'FIT', 'teacher10@gmail.com', '$2y$10$zACtV/lQNuitHZqkGqajvOjNLkvBSko/bWa.RqZJNSnBAE2AiQQka'),
('teacher11', 'teacher_11', 'FIT', 'teacher11@gmail.com', '$2y$10$3ciqm1khNNt1vS6HBdeVEOo9yT26xT2XKejOD3/da5eI/PFZC3Jl2'),
('teacher12', 'teacher_12', 'FHLS', 'teacher12@gmail.com', '$2y$10$vqY5rdfmWQ.7Nnx0m6IcoOqKj0vhIa/1ZNqyGeDQ5qCnOWKY1T7ku'),
('teacher13', 'teacher_13', 'FEQS', 'teacher13@gmail.com', '$2y$10$rdkHjIcDbfxQQWu0.Nj9i.28zCm4ARU5564qJLhTnORMzcdawM1V2'),
('teacher14', 'teacher_14', 'FOBCAL', 'teacher14@gmail.com', '$2y$10$uO0mIBZePJnKSGbPD7G9Gup57FAc7OO1584/ClyQixXd3bn.Z0vaK'),
('teacher15', 'teacher_15', 'FEQS', 'teacher15@gmail.com', '$2y$10$G2x6M1XniYABGryjV6Epg./YbdT5sHSVJTlSgGfHrglEjeTYSUEOG'),
('teacher16', 'teacher_16', 'FIT', 'teacher16@gmail.com', '$2y$10$9w7ILTqoA4ECH6/ZH6y0W.F0ysUrV1oZJh240uxZ1JOZYNVhS1bl.'),
('teacher17', 'teacher_17', 'FIT', 'teacher17@gmail.com', '$2y$10$JAvwzlSHJCo9Wy9SO5I.OeypVRdy7mu5xVHhddKCrpvOBPzRvrL0a'),
('teacher18', 'teacher_18', 'FOBCAL', 'teacher18@gmail.com', '$2y$10$GHXGwtqQ/5w.koDUqUvHvumXoXvbTbYUvuwhrTlbkQRxKq5ZRwcM6'),
('teacher19', 'teacher_19', 'FHLS', 'teacher19@gmail.com', '$2y$10$OAIjtxlyefwfBNldbglrAeHBHEYs/5aNoFpa5zIOjx9XY6fiecCsi');

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
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`examID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `examID` (`examID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`resultID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `questionID` (`questionID`),
  ADD KEY `examID` (`examID`) USING BTREE;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `examID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `resultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`examID`) REFERENCES `exam` (`examID`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `question` (`questionID`),
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`examID`) REFERENCES `exam` (`examID`);

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
