-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 02:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `core_practical`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `language` enum('PHP','JAVA','ANDROID') NOT NULL,
  `expirience` varchar(20) NOT NULL,
  `currentctc` varchar(20) NOT NULL,
  `expectedctc` varchar(20) NOT NULL,
  `noticeperiod` varchar(20) NOT NULL,
  `interviewdate` date NOT NULL,
  `reasonleavejob` varchar(500) NOT NULL,
  `currentstatus` enum('Reviewed','Hired','Selected') NOT NULL,
  `rejectedreason` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `userid`, `firstname`, `middlename`, `lastname`, `education`, `language`, `expirience`, `currentctc`, `expectedctc`, `noticeperiod`, `interviewdate`, `reasonleavejob`, `currentstatus`, `rejectedreason`) VALUES
(2, 3, 'Ignacia', 'Avye Cook', 'Williamson', 'B.c.a.', 'JAVA', '1', '10000', '15000', '1', '2021-04-07', 'Consectetur delectu', 'Hired', NULL),
(3, 3, 'Chava', 'Dorothy Parker', 'Beach', 'B.tech.', 'ANDROID', '2', '15000', '30000', '2', '2021-04-06', 'Qui ipsam rerum aspe', 'Reviewed', NULL),
(4, 10, 'Kelsey', 'Geoffrey Sloan', 'Dickson', 'B.tech.', 'JAVA', '1', '10000', '20000', '3', '2021-04-28', 'Ab incidunt dolorem', 'Reviewed', NULL),
(5, 3, 'Kalia', 'Sonia Carpenter', 'Henry', 'B.e.', 'PHP', '4', '0', '25000', '3', '2021-04-14', 'Veritatis necessitat', 'Reviewed', NULL),
(6, 3, 'Oleg', 'Kylynn Dillard', 'Cooley', 'B.tech.', 'PHP', '2', '0', '35000', '1', '2021-04-10', 'Non et ut inventore', 'Reviewed', 'Non exercitation vol');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `profile_image` varchar(500) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `profile_image`, `role`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1616086391_4f9ba1fb95f27a8ef9e1.jpeg', 'admin', '2021-02-22 17:49:59', '2021-03-18 16:53:11', NULL, '1'),
(2, 'hd', 'hd@gmail.com', '912ec803b2ce49e4a541068d495ab570', NULL, 'admin', '2021-03-13 09:17:10', '2021-04-03 06:09:02', NULL, '1'),
(3, 'akash', 'akash@gmail.com', '94754d0abb89e4cf0a7f1c494dbb9d2c', '1617813773_156080d557a82132c536.jpg', 'user', '2021-03-18 17:04:01', '2021-04-07 16:42:53', NULL, '1'),
(4, 'Ralph Pugh', 'xatyjozy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', NULL, 'user', '2021-03-28 09:23:42', '2021-04-03 06:09:02', NULL, '1'),
(6, 'akash', 'admin265@gmail.com', 'dfd7468ac613286cdbb40872c8ef3b06', 'myprofile.png', 'user', '2021-03-28 12:35:13', '2021-03-28 12:35:13', NULL, '1'),
(7, 'akash', 'admin444@gmail.com', 'aa677d660eefd1fe0d323c1dc9bfa869', 'myprofile.png', 'user', '2021-03-28 15:59:33', '2021-03-28 15:59:33', NULL, '1'),
(8, 'Aadf', 'adf@gmail.com', '7815696ecbf1c96e6894b779456d330e', NULL, 'user', '2021-03-28 16:04:07', '2021-03-28 16:04:07', NULL, '1'),
(9, 'Ainsley', 'dyva@mailinator.com', 'c20ad4d76fe97759aa27a0c99bff6710', NULL, 'user', '2021-04-03 06:00:03', '2021-04-03 06:00:03', NULL, '1'),
(10, 'AKASH', 'prajapati.akash16043@gmail.com', '', 'https://lh3.googleusercontent.com/a-/AOh14GjGH6uw2uYzPzvWmkn_wzyXt7fTFdAQF0oHhdyAlg=s96-c', 'user', '2021-04-03 06:06:02', '2021-04-07 16:46:30', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
