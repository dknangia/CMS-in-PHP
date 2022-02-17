-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 10:39 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `published_year` int(11) NOT NULL,
  `cover_image` varchar(500) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `isbn`, `price`, `description`, `author`, `published_year`, `cover_image`, `is_enabled`) VALUES
(1, 'PHP Programming for Beginners: Programming Concepts. How to use PHP with MySQL and Oracle databases (MySqli, PDO)', '978-1548980078', '25.95', 'Want to build an interactive website using PHP with MySQL or Oracle database? This book is for you, even if you are new to computer programming. In this book, you will learn key programming concepts that are essential for any programming language and find practical solutions that can be used for your own website.', 'Victor Beth', 2019, '', 1),
(2, 'PHP Programming: Learn PHP Programming: - CRUSH IT IN ONE DAY. Learn It Fast. Learn It Once. Get Coding Today', '96814-254-25766', '53.00', 'HP PROGRAMMING – LEARN PHP PROGRAMMING IN LESS THAT A DAY Learn the scripting language used in over 81% of websites. Don’t waste weeks and lots of money learning PHP programming when you can download this simple to learn, easy to read guide and learn PHP programming in less than a day.', 'Rolles Nicine', 2021, '', 1),
(3, 'Computer Science Distilled: Learn the Art of Solving Computational Problems', '978-0997316025', '26.69', 'A walkthrough of computer science concepts you must know. Designed for readers who don\'t care for academic formalities, it\'s a fast and easy computer science guide. It teaches the foundations you need to program computers effectively. ', 'Wladston Ferreira Filho', 2014, '', 1),
(4, 'C The Ultimate Crash Course to Learning C (from basics to advanced)', '978-1976240478', '16.85', 'The Ultimate Crash Course to Learning C (from basics to advanced)\r\nIf you have been looking for a new and easy way to learn C look no further. This book will teach you the basics about C and how to get started as well as more advanced issues.', 'Paul Laurence', 2017, '', 1),
(5, 'Learn Python in One Day and Learn It Well (2nd Edition): Python for Beginners with Hands-on Project.', '978-1546488330', '15.50', 'Have you always wanted to learn computer programming but are afraid it\'ll be too difficult for you? Or perhaps you know other programming languages but are interested in learning the Python language fast?', 'Jamie Chan', 2017, '', 1),
(6, 'Learn SQL Quickly: A Beginner’s Guide to Learning SQL, Even If You’re New to Databases', NULL, '23.59', 'Do you have a burning desire to expand your skillset but don\'t have the time or care to go back to studying for the next 4+ years?\r\nDo you feel as if you are capable of so much more, and that you should be making a bigger contribution to the world?\r\nAre you ready to learn one of the most in-demand skills of the 21st century.', 'Robbie Dam', 2020, '', 1),
(7, 'Python Crash Course, 2nd Edition: A Hands-On, Project-Based Introduction to Programming', '978-1593279288', '39.32', 'The second edition of the best-selling Python book in the world (over 1 million copies sold!). A fast-paced, no-nonsense guide to programming in Python. Updated and thoroughly revised to reflect the latest in Python code and practices. Python Crash Course is the world\'s best-selling guide to the Python programming language.', 'Eric Matthes', 2019, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 1),
(6, 3),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `book_inventory`
--

CREATE TABLE `book_inventory` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `inventory_count` int(11) NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_inventory`
--

INSERT INTO `book_inventory` (`id`, `book_id`, `inventory_count`, `last_modified`) VALUES
(1, 1, -9, '2022-02-15 00:00:00'),
(2, 2, 93, '2022-02-13 00:00:00'),
(3, 3, 66, '2022-02-16 22:38:27'),
(4, 4, 50, '2022-02-14 22:38:27'),
(5, 5, 6, '2022-02-03 22:39:03'),
(6, 6, 74, '2022-02-15 22:39:03'),
(7, 7, 18, '2022-02-16 04:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `book_inventory_order`
--

CREATE TABLE `book_inventory_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(200) NOT NULL,
  `credit_card` int(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_inventory_order`
--

INSERT INTO `book_inventory_order` (`id`, `order_id`, `first_name`, `last_name`, `address`, `address2`, `city`, `state`, `zip`, `credit_card`, `created_on`) VALUES
(2, 4, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:46:50'),
(3, 5, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:47:36'),
(4, 6, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:51:20'),
(5, 7, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:51:29'),
(6, 8, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:51:48'),
(7, 9, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:52:35'),
(8, 10, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:56:51'),
(9, 11, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:57:24'),
(10, 12, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:58:09'),
(11, 13, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:58:49'),
(12, 14, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:58:49'),
(13, 15, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:59:13'),
(14, 16, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:59:13'),
(15, 17, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:59:48'),
(16, 18, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 20:59:48'),
(17, 19, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:08:10'),
(18, 20, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:08:10'),
(19, 21, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:08:55'),
(20, 22, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:10:32'),
(21, 23, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:11:03'),
(22, 24, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:11:24'),
(23, 25, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:11:46'),
(24, 26, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:14:16'),
(25, 27, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 21:17:41'),
(26, 28, 'Deepak', '', '49 Columbia Street West', 'Apt 402, Room 424', 'Waterloo', 'ON', 'N2L 3K4', 0, '2022-02-16 22:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Web Development'),
(2, 'General Programming'),
(3, 'SQL');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `book_id`, `price`, `created_on`) VALUES
(4, 1, '26', '2022-02-16 20:46:50'),
(5, 1, '26', '2022-02-16 20:47:36'),
(6, 1, '26', '2022-02-16 20:51:20'),
(7, 1, '26', '2022-02-16 20:51:29'),
(8, 1, '26', '2022-02-16 20:51:48'),
(9, 1, '26', '2022-02-16 20:52:35'),
(10, 1, '26', '2022-02-16 20:56:51'),
(11, 1, '26', '2022-02-16 20:57:24'),
(12, 1, '26', '2022-02-16 20:58:09'),
(13, 1, '26', '2022-02-16 20:58:49'),
(14, 1, '26', '2022-02-16 20:58:49'),
(15, 1, '26', '2022-02-16 20:59:13'),
(16, 1, '26', '2022-02-16 20:59:13'),
(17, 1, '26', '2022-02-16 20:59:48'),
(18, 1, '26', '2022-02-16 20:59:48'),
(19, 2, '53', '2022-02-16 21:08:10'),
(20, 2, '53', '2022-02-16 21:08:10'),
(21, 2, '53', '2022-02-16 21:08:55'),
(22, 2, '53', '2022-02-16 21:10:32'),
(23, 2, '53', '2022-02-16 21:11:03'),
(24, 2, '53', '2022-02-16 21:11:24'),
(25, 3, '27', '2022-02-16 21:11:46'),
(26, 2, '53', '2022-02-16 21:14:16'),
(27, 3, '27', '2022-02-16 21:17:41'),
(28, 3, '27', '2022-02-16 22:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$zoD.qAALjJDDQtM4hxuJMO438jwb4xhx8HouLDf4VRM8gaEy.lYZ.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `book_inventory`
--
ALTER TABLE `book_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `book_inventory_order`
--
ALTER TABLE `book_inventory_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_inventory`
--
ALTER TABLE `book_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_inventory_order`
--
ALTER TABLE `book_inventory_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `book_inventory`
--
ALTER TABLE `book_inventory`
  ADD CONSTRAINT `book_inventory_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
