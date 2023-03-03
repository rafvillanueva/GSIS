-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2019 at 06:03 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbz_guadalupe_elem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `ID` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Level` text NOT NULL,
  `a_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`ID`, `Username`, `Email`, `Password`, `Level`, `a_name`) VALUES
(1, 'admin', 'dev.kiao@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Administrator', ''),
(2, 'qwe', 'qwe', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Finance', ''),
(3, 'user2', 'user2@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Finance', ''),
(4, 'registrar', 'reg@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Registrar', 'Kent'),
(5, 'f10005', 'f10005@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Faculty', ''),
(6, '20151933', '20151933@g.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Student', ''),
(7, '20152256', 'johnmarkeureseD@gmail.com', '5656c90fa6267b18561637822c606b53204efe5d77d5fdb442dca6980c8bd0e8', 'Student', ''),
(8, 'registrar1', 'reg@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Registrar', 'jaru'),
(9, 'faculty1', 'facul1@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Faculty', ''),
(10, 'F10006', 'facuty@gmail.com', 'c5c8706a45318ee8817f8b0000c2bfe29ce9c3517d35ee9f7d13a7a18d9c93ab', 'Faculty', ''),
(11, 'finance1', 'fin@gmail.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 'Finance', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing`
--

CREATE TABLE `tbl_billing` (
  `ID` int(11) NOT NULL,
  `b_name` text NOT NULL,
  `b_price` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_billing`
--

INSERT INTO `tbl_billing` (`ID`, `b_name`, `b_price`) VALUES
(1, 'GPTA', '400');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
  `ID` int(11) NOT NULL,
  `s_book` text NOT NULL,
  `s_description` text NOT NULL,
  `s_price` text NOT NULL,
  `s_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`ID`, `s_book`, `s_description`, `s_price`, `s_level`) VALUES
(3, 'wtfzxc', 'wzxc', '1121', '0'),
(4, 'wtf', 'wzzzz', '5999', 'G4'),
(5, 'k1', '1k', '1000', '1'),
(6, 'jk2', '2k', '2000', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facultyinfo`
--

CREATE TABLE `tbl_facultyinfo` (
  `ID` int(11) NOT NULL,
  `Fac_Id` text NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `middleName` text NOT NULL,
  `Status` text NOT NULL,
  `UnderGrad_Degree` text NOT NULL,
  `PostGrad_Degree` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facultyinfo`
--

INSERT INTO `tbl_facultyinfo` (`ID`, `Fac_Id`, `firstName`, `lastName`, `middleName`, `Status`, `UnderGrad_Degree`, `PostGrad_Degree`) VALUES
(1, 'F10005', 'qwe1', 'qwe', 'qew', 'Full-Time', 'qwe', 'qew'),
(2, 'F10006', 'john', 'mark', 'loang', 'Full-Time', 'bs1', 'grad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facultyloads`
--

CREATE TABLE `tbl_facultyloads` (
  `ID` int(11) NOT NULL,
  `Fac_id` text NOT NULL,
  `SubjectLoad` text NOT NULL,
  `Section` text NOT NULL,
  `s_year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_facultyloads`
--

INSERT INTO `tbl_facultyloads` (`ID`, `Fac_id`, `SubjectLoad`, `Section`, `s_year`) VALUES
(2, 'F10005', 'Science 1', 'A1', '2018-2019'),
(6, 'F10006', 'Math 1', 'matapat', '2019-2020'),
(7, 'F10006', 'Science 1', 'matapat', '2019-2020'),
(8, 'F10006', 'English 1', 'matapat', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE `tbl_grade` (
  `ID` int(11) NOT NULL,
  `f_id` text NOT NULL,
  `s_id` text NOT NULL,
  `s_grade` text NOT NULL,
  `s_sub` text NOT NULL,
  `s_period` text NOT NULL,
  `s_year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade`
--

INSERT INTO `tbl_grade` (`ID`, `f_id`, `s_id`, `s_grade`, `s_sub`, `s_period`, `s_year`) VALUES
(2, 'f10005', '20151933', '34', 'Science 1', '3rd Grading', '2018-2019'),
(3, 'f10005', '20151933', '32', 'Science 1', '1st Grading', '2018-2019'),
(4, 'f10005', '20151933', '75', 'Science 1', '2nd Grading', '2018-2019'),
(5, 'F10006', '20152256', '98', 'Math 1', '1st Grading', '2019-2020'),
(6, 'F10006', '20152256', '98', 'Math 1', '2nd Grading', '2019-2020'),
(7, 'F10006', '20152256', '99', 'Math 1', '3rd Grading', '2019-2020'),
(8, 'F10006', '20152256', '99', 'Math 1', '4th Grading', '2019-2020'),
(9, 'F10006', '20152256', '99', 'Science 1', '1st Grading', '2019-2020'),
(10, 'F10006', '20152256', '99', 'Science 1', '2nd Grading', '2019-2020'),
(11, 'F10006', '20152256', '99', 'Science 1', '3rd Grading', '2019-2020'),
(12, 'F10006', '20152256', '99', 'Science 1', '4th Grading', '2019-2020'),
(13, 'F10006', '20152256', '99', 'English 1', '1st Grading', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `ID` int(11) NOT NULL,
  `s_id` text NOT NULL,
  `s_amount` text NOT NULL,
  `s_level` text NOT NULL,
  `s_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_history`
--

INSERT INTO `tbl_history` (`ID`, `s_id`, `s_amount`, `s_level`, `s_date`) VALUES
(8, '0', '2900', 'G4', 'April 02, 2019 03:04:13 PM'),
(9, '0', '1121', '0', 'April 02, 2019 03:04:49 PM'),
(10, '0', '400', 'G1', 'April 02, 2019 03:04:13 PM'),
(11, '20152256', '1000', '0', 'April 09, 2019 11:04:10 PM'),
(12, '20152256', '1000', '0', 'April 09, 2019 11:04:35 PM'),
(13, '20152256', '1000', '0', 'April 09, 2019 11:04:53 PM'),
(14, '20152256', '21', '0', 'April 09, 2019 11:04:31 PM'),
(15, '20152256', '1000', '1', 'April 09, 2019 11:04:51 PM'),
(16, '20152256', '2000', '2', 'April 09, 2019 11:04:24 PM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `ID` int(11) NOT NULL,
  `building` text NOT NULL,
  `section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`ID`, `building`, `section`) VALUES
(1, 'Building 1', 'A1'),
(4, 'grade 1', 'matapat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `ID` int(11) NOT NULL,
  `s_id` text NOT NULL,
  `s_fname` text NOT NULL,
  `s_lname` text NOT NULL,
  `s_mname` text NOT NULL,
  `s_contact` text NOT NULL,
  `s_address` text NOT NULL,
  `s_gender` text NOT NULL,
  `m_fname` text NOT NULL,
  `m_lname` text NOT NULL,
  `m_mname` text NOT NULL,
  `m_contact` text NOT NULL,
  `f_fname` text NOT NULL,
  `f_lname` text NOT NULL,
  `f_mname` text NOT NULL,
  `f_contact` text NOT NULL,
  `s_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`ID`, `s_id`, `s_fname`, `s_lname`, `s_mname`, `s_contact`, `s_address`, `s_gender`, `m_fname`, `m_lname`, `m_mname`, `m_contact`, `f_fname`, `f_lname`, `f_mname`, `f_contact`, `s_level`) VALUES
(6, '20152256', 'johnmark', 'eurese', 'loang', '019321768', 'bugo', 'Male', 'asdas', 'dasdasd', 'dasdasd', '342343464', 'sdfsdf', 'sdfdf', 'sddfsdf', '0239402399', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `ID` int(11) NOT NULL,
  `subjectCode` text NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`ID`, `subjectCode`, `Description`) VALUES
(1, 'English 1', 'Alphabetical Words'),
(2, 'Science 1', 'Study of Gravity'),
(3, 'Math 1', 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjectsenrolled`
--

CREATE TABLE `tbl_subjectsenrolled` (
  `ID` int(11) NOT NULL,
  `Stud_Id` text NOT NULL,
  `subjectCode` text NOT NULL,
  `Section` text NOT NULL,
  `s_year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subjectsenrolled`
--

INSERT INTO `tbl_subjectsenrolled` (`ID`, `Stud_Id`, `subjectCode`, `Section`, `s_year`) VALUES
(1, '20151933', 'Science 1', 'A1', '2019-2020'),
(4, '20151933', 'English 1', 'A1', '2018-2019'),
(5, '20151933', 'Math 1', 'A1', '2019-2020'),
(9, '20152256', 'Math 1', 'matapat', '2019-2020'),
(10, '20152256', 'Science 1', 'matapat', '2019-2020'),
(11, '20152256', 'English 1', 'matapat', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tuition`
--

CREATE TABLE `tbl_tuition` (
  `ID` int(11) NOT NULL,
  `s_tuition` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tuition`
--

INSERT INTO `tbl_tuition` (`ID`, `s_tuition`) VALUES
(1, '1500'),
(2, '2500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_facultyinfo`
--
ALTER TABLE `tbl_facultyinfo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_facultyloads`
--
ALTER TABLE `tbl_facultyloads`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_subjectsenrolled`
--
ALTER TABLE `tbl_subjectsenrolled`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_tuition`
--
ALTER TABLE `tbl_tuition`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_billing`
--
ALTER TABLE `tbl_billing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_facultyinfo`
--
ALTER TABLE `tbl_facultyinfo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_facultyloads`
--
ALTER TABLE `tbl_facultyloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_subjectsenrolled`
--
ALTER TABLE `tbl_subjectsenrolled`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_tuition`
--
ALTER TABLE `tbl_tuition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
