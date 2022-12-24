-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 24, 2022 at 10:07 PM
-- Server version: 5.7.18
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worker_shifts`
--

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `worker_id` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`worker_id`, `first_name`, `last_name`, `role_id`, `date`) VALUES
('WRK202212728', 'Mike', 'Test', 1, '1671907249');

-- --------------------------------------------------------

--
-- Table structure for table `workers_roles`
--

CREATE TABLE `workers_roles` (
  `role_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers_roles`
--

INSERT INTO `workers_roles` (`role_id`, `title`) VALUES
(1, 'Shift worker');

-- --------------------------------------------------------

--
-- Table structure for table `workers_shifts`
--

CREATE TABLE `workers_shifts` (
  `id` int(11) NOT NULL,
  `shift_id` varchar(100) DEFAULT NULL,
  `worker_id` varchar(100) DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  `status` enum('missed','present') DEFAULT 'missed',
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers_shifts`
--

INSERT INTO `workers_shifts` (`id`, `shift_id`, `worker_id`, `duration`, `start_time`, `end_time`, `status`, `date`) VALUES
(1, '63a763171470d', 'WRK202212728', 8, '1671951600', '1671980400', 'missed', '1671914263'),
(2, '63a7632d8e0ca', 'WRK202212728', 8, '1672009200', '1672038000', 'missed', '1671914285');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`worker_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `workers_roles`
--
ALTER TABLE `workers_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `workers_shifts`
--
ALTER TABLE `workers_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_id` (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workers_shifts`
--
ALTER TABLE `workers_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `workers_roles` (`role_id`);

--
-- Constraints for table `workers_shifts`
--
ALTER TABLE `workers_shifts`
  ADD CONSTRAINT `workers_shifts_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`worker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
