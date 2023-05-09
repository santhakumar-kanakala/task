-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 04:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` text NOT NULL,
  `status` int(3) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `phone`, `skills`, `status`, `created`, `updated`) VALUES
(2, 'RAJ GOPAL VARMA', 'NAIDU', 'rajgopalvarmanaidu89@gmail.com', '7894563212', 'HTML5,CSS3,JAVASCRIPT', 2, '2023-05-08 18:54:22', '2023-05-08 20:24:29'),
(3, 'VENU GOPAL', 'KAMINI', 'tester-old@gmail.com', '7894563214', 'HTML5,CSS3,JAVASCRIPT,JQUERY,TYPESCRIPT JS,VUE JS', 1, '2023-05-08 18:57:16', '2023-05-08 20:10:57'),
(4, 'VENU GOPAL', 'KAMINI', 'tester-new@gmail.com', '7894563213', 'HTML5,CSS3,JAVASCRIPT,JQUERY,TYPESCRIPT JS,VUE JS', 1, '2023-05-08 18:58:53', '2023-05-08 19:54:57'),
(5, 'SAI PHANEEDRA BHASKAR', 'BATLA', 'bhakarbatla.89@gmail.com', '7891236544', 'DATA SCIENCE,DIGITAL MARKETING,SEO MANAGEMENT,SOCIAL MEDIA MARKETING', 1, '2023-05-08 21:56:29', '2023-05-08 21:57:09');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
