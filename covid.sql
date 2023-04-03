-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 03:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid`
--
CREATE DATABASE IF NOT EXISTS `covid` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covid`;

-- --------------------------------------------------------

--
-- Table structure for table `pcr`
--

CREATE TABLE `pcr` (
  `s_no` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `emp_no` varchar(250) NOT NULL,
  `pcr_name` varchar(250) NOT NULL,
  `pcr_no` varchar(250) NOT NULL,
  `page_type` varchar(250) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `subject_no` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pcr`
--

INSERT INTO `pcr` (`s_no`, `date`, `emp_no`, `pcr_name`, `pcr_no`, `page_type`, `reason`, `subject_no`, `status`, `file`) VALUES
(2, '2021-10-31 06:01:42', 'as', 'EU', 'EU12395', '123', 'Allowance', '123', 'Incomplete', ''),
(16, '2021-10-31 09:03:02', 'EMP001', 'EM', 'EM123', 'claim', 'Pension', 'SUB002', 'Incomplete', 'bg.jpg'),
(18, '2021-10-31 09:02:54', 'as kkk', 'EU', 'EU12395', '12345', 'Maturnity', 'dsv', 'Incomplete', 'bg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `user_name`, `email`, `password`, `date`) VALUES
(1, 27402466, 'gd', 'judeamiladinukaperera@gmail.com', 'dvsvs', '2021-10-29 14:05:55'),
(2, 193227567868192604, 'eff', 'efw', 'ewf', '2021-10-29 14:06:11'),
(3, 69526, 'dhananjaya', 'dhanajude@gmail.com', '1234', '2021-10-30 02:51:41'),
(4, 9223372036854775807, 'Dinuka', 'judeamiladinukaperera@gmail.com', '1234', '2021-10-30 03:18:45'),
(5, 3221676090590851, 'shanika', 'shanika@gmail.com', '1234', '2021-10-30 03:20:52'),
(6, 8961098953462774, 'prasanna', 'prasanna@gmail.com', '1234', '2021-10-30 03:22:13'),
(7, 797320001115607, 'lakshari', 'lakshari@gmail.com', '1234', '2021-10-30 03:24:21'),
(8, 817861, 'admin', 'admin@gmail.com', '1234', '2021-10-31 06:47:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pcr`
--
ALTER TABLE `pcr`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pcr`
--
ALTER TABLE `pcr`
  MODIFY `s_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
