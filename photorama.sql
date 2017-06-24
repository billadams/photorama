-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 24, 2017 at 05:59 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photorama`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Disney World'),
(2, 'Colorado'),
(3, 'MotoCross');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `caption` varchar(50) DEFAULT NULL,
  `alt_text` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_path`, `category_id`, `caption`, `alt_text`, `user_id`) VALUES
(1, 'images/mickey_mouse.jpg', 1, 'Mickey Mouse at Disney World', 'Mickey Mouse', 46),
(2, 'images/disney_castle.jpg', 1, 'Disney Castle', 'Disney Castle', 46),
(3, 'images/osprey_hotel.jpg', 2, 'Osprey Hotel in Colorado', 'Osprey Hotel', 46),
(4, 'images/hiking.png', 2, 'Hiking is great exercise', 'Colorado Hiking', 46),
(5, 'images/inverted_whip.jpg', 3, 'Whip it good!', 'Dirtbike Whip', 46),
(6, 'images/liftoff.jpg', 3, 'Lift off!', 'Dirtbike Jump', 46),
(7, 'images/frozen.jpg', 1, 'Let it go', 'Frozen Movie', 47),
(8, 'images/star_wars_disney.jpg', 1, 'Use the force Luke', 'Darth Vader', 47),
(9, 'images/rollercoaster.jpg', 1, 'Weeeeee!', 'Rollercoaster', 47),
(12, 'images/motox_kiss1.jpg', 3, 'kiss me ', 'Motox Kiss', 49),
(13, 'images/larimer_square1.jpg', 2, 'square', 'beautiful', 49);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(50) NOT NULL DEFAULT 'images/default_avatar.jpg',
  `member_since` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_image`, `member_since`) VALUES
(46, 'Triton', 'billadams1977@gmail.com', '$2y$10$84OO/IbHY67iVrl1AXrHdelq.TP/0eusF/zApZGHxgf7LDhWprzxK', 'images/terminator.jpg', '2017-06-03 20:54:02'),
(47, 'MackDaddy', 'mackdaddy@gmail.com', '$2y$10$6krQFvtOIrAzPtFLGeOsr.CPPu39g/0ydga8xhwTfZAj6EJ1Cla9e', 'images/sirmixalotmackdaddy3.jpg', '2017-06-05 17:21:24'),
(49, 'AmyKay', 'akbefort1@gmail.com', '$2y$10$lUCKucSlYpSE6/FIFlLpN.Fid2L4N5OyBosYYm5a8KzbeSozaPeu2', 'images/potty.jpg', '2017-06-06 06:13:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `IX_Username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
