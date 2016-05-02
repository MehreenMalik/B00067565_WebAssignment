-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 02, 2016 at 01:29 PM
-- Server version: 10.1.9-MariaDB-log
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webassignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` varchar(50) NOT NULL,
  `instructorUsername` varchar(100) NOT NULL,
  `noOfStudents` int(11) NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `instructorUsername`, `noOfStudents`, `level`) VALUES
('1', 'admin', 12, 'Yellow Belt'),
('2', 'matt', 16, 'Black Belt'),
('3', 'admin', 12, 'Orange Belt'),
('4', 'admin', 14, 'Green Belt'),
('5', 'matt', 17, 'Purple Belt'),
('6', 'matt', 10, 'White Belt');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `instructorUsername` varchar(50) NOT NULL,
  `currentGrade` text NOT NULL,
  `ageAttendance` int(11) NOT NULL,
  `nextGrading` date NOT NULL,
  `averageGrade` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `classId`, `username`, `instructorUsername`, `currentGrade`, `ageAttendance`, `nextGrading`, `averageGrade`, `status`) VALUES
(0, 1, 'Alex', 'matt', 'Black Belt', 100, '2016-05-13', 'A+', 'Available'),
(1, 1, 'James', 'matt', 'white belt', 63, '2016-05-11', 'B+', 'Available'),
(2, 2, 'Sam', 'AlexRidder', 'Green Belt', 35, '2016-05-12', 'D+', 'available'),
(3, 2, 'Sarah', 'Admin', 'Yellow Belt', 78, '2016-05-13', 'C-', 'Out Sick');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `surname` text NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `plainPassword` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `email`, `username`, `password`, `plainPassword`, `role`) VALUES
(1, 'Alex', 'Ridder', 'test@example.com', 'test', '$2y$10$.sJKzo1iy644pLja.SGY6O7s7As6bmg1sGXOnPkCHyqM4c6XWHVWK', 'password', 1),
(2, 'test', 'test', 'test@example.com', 'testy', '$2y$10$.sJKzo1iy644pLja.SGY6O7s7As6bmg1sGXOnPkCHyqM4c6XWHVWK', 'password', 1),
(3, 'matt', 'smith', 'smith@example.com', 'matt', '$2y$10$.sJKzo1iy644pLja.SGY6O7s7As6bmg1sGXOnPkCHyqM4c6XWHVWK', 'password', 2),
(4, 'admin', 'admin', 'admin@example.com', 'admin', '$2y$10$.sJKzo1iy644pLja.SGY6O7s7As6bmg1sGXOnPkCHyqM4c6XWHVWK', 'password', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
