-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 08:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybersecurity_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `content_type` enum('article','video','infographic') NOT NULL,
  `content_body` text DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `module_id`, `content_type`, `content_body`, `media_url`, `created_at`) VALUES
(1, 1, 'article', 'Cybersecurity is the practice of protecting systems and networks from attacks.', NULL, '2024-08-16 16:18:26'),
(2, 2, 'article', 'Phishing is a method used by attackers to trick users into providing sensitive information.', NULL, '2024-08-16 16:18:26'),
(3, 3, 'article', 'Strong passwords should be at least 12 characters long and include a mix of letters, numbers, and symbols.', NULL, '2024-08-16 16:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `module_id`, `rating`, `comments`, `created_at`) VALUES
(1, 12, 3, 'testing experiance ', '2024-08-18 16:55:05'),
(3, 12, 3, 'testing ', '2024-08-18 16:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `description`, `created_at`, `content`, `image_path`) VALUES
(1, 'Introduction to Cybersecurity', 'Learn the basics of cybersecurity in schools', '2024-08-16 16:18:26', 'testing testing', NULL),
(2, 'Phishing Attacks', 'Understand phishing attacks and how to avoid them.', '2024-08-16 16:18:26', '', NULL),
(3, 'Password Security', 'Tips on creating and managing secure passwords.', '2024-08-16 16:18:26', '', NULL),
(4, 'cyber security in schools', 'the attacks of cyber security in schools ', '2024-08-16 17:32:15', 'cyber security in schools causes harm to student with internet access  testing testing testing testing testing vvvtesting testing testing testing ', NULL),
(11, 'image ', 'image testing', '2024-08-18 14:21:56', 'image testing ', 'uploads/MMM.jpg'),
(12, 'testing image ', 'image ', '2024-08-18 14:33:22', 'image testing ', NULL),
(13, 'testing cyber security model', 'module module m', '2024-08-18 18:23:52', 'module testing ', NULL),
(14, 'testing cyber security model', 'module module m', '2024-08-18 18:24:55', 'module testing ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_images`
--

CREATE TABLE `module_images` (
  `id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_images`
--

INSERT INTO `module_images` (`id`, `module_id`, `image_path`) VALUES
(1, 12, 'uploads/3057ffbf06c4541dd60a273d6f0d3525.jpg'),
(2, 12, 'uploads/cd348b55d06f92d252109ad2784a9382.jpg'),
(5, 1, 'uploads/cd348b55d06f92d252109ad2784a9382.jpg'),
(6, 1, 'uploads/images.jfif'),
(7, 13, 'uploads/cd348b55d06f92d252109ad2784a9382.jpg'),
(8, 13, 'uploads/HD-wallpaper-programming-coding-language.jpg'),
(9, 14, 'uploads/cd348b55d06f92d252109ad2784a9382.jpg'),
(10, 14, 'uploads/HD-wallpaper-programming-coding-language.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_images`
--
ALTER TABLE `module_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `module_images`
--
ALTER TABLE `module_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Constraints for table `module_images`
--
ALTER TABLE `module_images`
  ADD CONSTRAINT `module_images_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
