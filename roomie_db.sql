-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 10:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roomie`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(11) NOT NULL,
  `queries` varchar(300) DEFAULT NULL,
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `response`) VALUES
(1, 'What is roomie?', 'COF Roomie is a platform designed to help students!'),
(2, 'Where is Wentworth located?', '550 Huntington Ave, Boston, MA 02115'),
(4, 'Why Wentworth?', 'Universities make a lot of promises but at the end of four years what do they really deliver? At Wentworth, we offer the educational programs for which there is a strong labor market demand that enables us to produce graduates who consistently bring extraordinary value to their organizations and to the world. We walk the talk with hands-on learning, required cooperative education experiences and caring faculty. Read on to discover our promise to you and our strategy to make these promises a reality'),
(5, 'Wentworth undergraduate', 'Undergraduate students who take fewer than 12 credits in a semester will be charged per credit rather than the flat full-time rate. Undergraduate students who overload (take more than 20 credits in a semester) will be charged at the per credit rate for each credit over 20.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(3) NOT NULL,
  `username` varchar(256) NOT NULL,
  `post_id` int(3) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `post_id`, `comment`, `created_at`) VALUES
(36, 'Demo', 48, 'Me!', '2023-08-01 06:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `roomie_profile`
--

CREATE TABLE `roomie_profile` (
  `id` int(3) NOT NULL,
  `roomiename` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `colleges` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomie_profile`
--

INSERT INTO `roomie_profile` (`id`, `roomiename`, `major`, `colleges`, `profile_pic`, `body`, `created_dt`) VALUES
(70, 'Eren Yeager', 'Pharmacy', 'Massachusetts College of Pharmacy and Health Science', 'Eren Yeager64c89e8d439df1.48859913.jpg', 'Interested in the pharmaceutical industry.', '2023-08-01 05:56:29'),
(71, 'Jian Huang', 'Computer Information Systems', 'Wentworth Institute of Technology', 'Jian Huang64c89ec1a42138.31435788.jpg', 'Interested in Business Analytics.', '2023-08-01 05:57:21'),
(72, 'TJ Durkin', 'Computer Information Systems', 'Wentworth Institute of Technology', 'TJ Durkin64c89ef082a1a3.18157163.jpg', 'Interested in IT.', '2023-08-01 05:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`id`, `title`, `body`, `username`, `created_dt`) VALUES
(48, 'Looking for textbook', 'Does anyone have \"E-Commerce 2020–2021: Business, Technology and Society, Global Edition\" for sale?', 'Demo', '2023-08-01 05:42:02'),
(49, 'New to Boston', 'Hi everyone,\r\n\r\nI just moved to Boston last week and looking forward to meeting new people. Leave a comment if anyone wants to hang out this weekend :)', 'Demo', '2023-08-01 05:44:36'),
(50, 'Looking for 2 roommates', 'Leave a comment with your contact info if you are interested in renting a 3B2B together around Fenway. ', 'Demo', '2023-08-01 05:46:01'),
(52, 'Testing', 'Testing', 'Jian', '2023-08-01 06:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(3) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(28, 'demo@wit.edu', 'Demo', '$2y$10$.UsHn1uO0.ar2C023VSUm.TNU.aE2UCbq7VSMYRO.gKHit80gAVXG', '2023-08-01'),
(29, 'jian@wit.edu', 'Jian', '$2y$10$xmKLbo/0JLlrA4hPuwREjudZ3oo7RmpJq.7sC.f6TSfWX3NW6NN26', '2023-08-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomie_profile`
--
ALTER TABLE `roomie_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roomie_profile`
--
ALTER TABLE `roomie_profile`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
