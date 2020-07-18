-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 09:38 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internshiptask`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(50) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `post_time`, `user`, `isactive`) VALUES
(2, 'my title', 'A fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.\r\n\r\nA fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.\r\n\r\nA fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.\r\n\r\nA fixed navigation bar stays visible in a fixed position (top or bottom) independent of the page scroll.\r\n\r\nA fixed navigation bar stays visible in a fixed position (top or bot', '2020-07-10 13:49:28', 'wankhedeyakash9@gmail.com', 1),
(6, 'What is Java?', 'Java is a popular programming language, created in 1995.\r\n\r\nIt is owned by Oracle, and more than 3 billion devices run Java.\r\n\r\nIt is used for:\r\n\r\nMobile applications (specially Android apps)\r\nDesktop applications\r\nWeb applications\r\nWeb servers and application servers\r\nGames\r\nDatabase connection\r\nAnd much, much more!\r\n', '2020-07-10 16:50:56', 'wankhedeyakash9@gmail.com', 0),
(10, 'HTML', 'HTML is a markup language', '2020-07-11 09:49:46', 'wankhedeyakash9@gmail.com', 1),
(11, 'HTML', 'HTML is a markup language', '2020-07-11 09:50:17', 'wankhedeyakash9@gmail.com', 1),
(13, 'title', 'my posdfjklsdf\r\nsadfajsdfa\r\nsdfajsdf\r\nafs\r\nffkasf\r\nf', '2020-07-11 12:28:47', 'admin@gmail.com', 1),
(15, 'sdfas', 'sadfas', '2020-07-11 17:18:54', 'wankhedeyakash9@gmail.com', 0),
(16, 'sdfas', 'sadfas', '2020-07-11 17:19:34', 'wankhedeyakash9@gmail.com', 0),
(17, 'HTML', 'vcbxcvbcv\r\nkhjkhk\r\n', '2020-07-14 08:01:11', 'wankhedeyakash9@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `post_id`, `user_id`) VALUES
(3, 'fdjgksdfjg\r\nfg\r\nghfkhjfkh\r\nfhfghf', 11, 'wankhedeyakash9@gmail.com'),
(15, 'dfgdsfgdf', 13, 'admin@gmail.com'),
(16, 'fsgdfgdfgsdfgsdfgdfgsdfgsdfjhskjghfj', 11, 'wankhedeyakash9@gmail.com'),
(20, 'i posted this comment', 17, 'wankhedeyakash9@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `password` varchar(15) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `phone`, `password`, `isadmin`) VALUES
('tret', '435@GSG', '35', 'HJ', 0),
('I am Admin', 'admin@gmail.com', '789456123', 'admin123', 1),
('dsdf', 'as@dad.c', '12', '12', 0),
('jfkhj', 'as@f.a', '23232332', '2', 0),
('dsfsf', 'asdfassdfas@fgsdgf', '435', 'asdfsadf', 0),
('fsdf', 'dfdf@gmail.com', '788', '7', 0),
('DGDFG', 'F@G.C', '4343', '1', 0),
('lgkgl', 'fgjdfgkwr@jfdjsfgl.c', '5453', '33', 0),
('fjklgfdsfklj', 'fkjsfl@fasf.c', '234234', 'qrw55', 0),
('dsfasf', 'fsdgfdgdg@DFGD.V', '2342424', 'we345345', 0),
('feds', 'fsf234@4', '234', '3543', 0),
('efe', 'rewfekj23542@d.c', '34', '34', 0),
('dfd', 'sd@fd.c', '34234234', '111', 0),
('shivani', 'shivi@gmail.com', '789456123', '456', 0),
('dfasdf#@dsfs.b', 'wankhedeyakasdfsh9@gmail.com', '56', 'sdf', 0),
('aakash wankhede', 'wankhedeyakash9@gmail.com', '789456', '456', 0),
('SDFGDSGF', 'WFG@SGDSG', '2454', '`5353', 0),
('fjdklsfj', '`fsjfsfkjlsjl@sdcfsf.csdf', '324234', '3434', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_fk` (`post_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`email`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_fk` FOREIGN KEY (`post_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
