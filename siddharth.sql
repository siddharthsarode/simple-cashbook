-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 08:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siddharth`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `t_id` bigint(20) NOT NULL,
  `state` varchar(10) NOT NULL,
  `t_date` date NOT NULL DEFAULT current_timestamp(),
  `day` varchar(10) NOT NULL,
  `t_amount` double NOT NULL,
  `t_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`t_id`, `state`, `t_date`, `day`, `t_amount`, `t_desc`, `created_at`) VALUES
(1, 'credit', '2024-04-23', 'Tue', 500, 'My salary', '2024-04-23 06:37:52'),
(2, 'expense', '2024-04-23', 'Tuesday', 100, 'Petrol', '2024-04-23 06:53:04'),
(3, 'expense', '2024-04-23', 'Tuesday', 50000, 'Laptop', '2024-04-23 07:21:27'),
(4, 'income', '2024-04-23', 'Tuesday', 100, 'salary', '2024-04-23 07:22:58'),
(5, 'income', '2024-04-24', 'Wednesday', 35000, 'My first Salary', '2024-04-24 04:20:26'),
(6, 'income', '2024-04-24', 'Wednesday', 50000, 'My Second salary', '2024-04-24 04:47:30'),
(7, 'expense', '2024-04-24', 'Wednesday', 100, 'Petrol', '2024-04-24 04:54:12'),
(8, 'expense', '2024-04-24', 'Wednesday', 1000, 'Party with friends', '2024-04-24 05:15:13'),
(9, 'income', '2024-04-24', 'Wednesday', 100, 'dad', '2024-04-24 05:50:41'),
(10, 'income', '2024-04-24', 'Wednesday', 100, 'dad', '2024-04-24 05:50:44'),
(11, 'income', '2024-04-24', 'Wednesday', 200, 'mom', '2024-04-24 05:55:22'),
(12, 'expense', '2024-04-24', 'Wednesday', 100, 'Fun', '2024-04-24 05:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `t_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
