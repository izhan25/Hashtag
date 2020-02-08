-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2019 at 08:53 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hashtag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `scope` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `scope`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'cosmetics'),
(2, 'jewellery');

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_products`
--

INSERT INTO `ordered_products` (`id`, `user_id`, `prod_id`, `order_id`, `qty`, `price`) VALUES
(5, 24, 40, 1, 1, 6000),
(6, 24, 7, 1, 1, 3500);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `total` int(11) NOT NULL,
  `dispatched` varchar(3) NOT NULL DEFAULT 'no',
  `delivered` varchar(3) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `name`, `address`, `email`, `phone`, `total`, `dispatched`, `delivered`) VALUES
(1, 24, 'Hashir', 'karachi', 'hash@gmail.com', '03333333333', 9500, 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `subCatId` int(11) NOT NULL,
  `information` text NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `catId`, `subCatId`, `information`, `image`) VALUES
(1, 'Black and White Stripes ', 3500, 1, 1, 'description\r\n', '6.jpg'),
(2, 'Flamboyant Pink Top', 3500, 2, 2, '     descriptionawdasdads', '7.jpg'),
(3, 'Flamboyant Pink Top', 3500, 2, 8, 'description', '8.jpg'),
(4, 'Black and White Stripes Dress', 3500, 2, 8, 'description', '10.jpg'),
(6, 'Flamboyant Pink Top', 3500, 1, 1, 'description', '12.jpg'),
(7, 'Flamboyant Pink Top', 3500, 1, 5, ' description', '5.jpg'),
(8, 'Flamboyant Pink Top', 3500, 2, 8, 'description', '9.jpg'),
(29, 'Bosca', 1200, 1, 1, 'Charcoal isnâ€™t the only super-powered black skin care ingredient known to revolutionize acne-busting beauty. African black soap, moringa, and black tea also deserve honorable mentions, as they also combat oiliness,  keeping unwanted breakouts and pimples under control. To bring some black skin care products to your everyday routine, here are 16 essentials your face is totally going to fall in love with.', 'Luminizing-Black-Mask.jpg'),
(30, 'Revlon colorsilk hair colour 20 brown black', 2000, 1, 15, 'Revlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown blackRevlon colorsilk hair colour 20 brown black', 'd8bb833d51b4d92525c305168f309a1d.jpg'),
(31, 'Revlon colorsilk hair colour 47 medium rich brown', 1000, 1, 15, 'Revlon colorsilk hair colour 47 medium rich brown', 'fe44e82e62826278c9e61ed488d63df0.jpg'),
(33, 'Wrinkle Cream', 2000, 1, 1, 'Wrinkle Cream,', 'elastine-jour_3.png'),
(34, 'marc jacobs', 15000, 1, 2, 'marc jacobs', 'large.jpg'),
(35, 'Visima Jewelry', 6000, 2, 7, 'Visima Jewelry', '20.jpg'),
(37, 'ring spiral', 6000, 2, 7, 'ring spiral', 'www.jpg'),
(38, 'necklace white', 6000, 2, 6, 'necklace white', '10d.jpg'),
(39, 'white necklace', 6000, 2, 6, 'white necklace', '11aaa.jpg'),
(40, 'bracelet', 6000, 2, 8, 'bracelet', '07b7a6f89ee30bef5855753ffb6857ad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `parentId`) VALUES
(1, 'face', 1),
(2, 'lips', 1),
(5, 'nails', 1),
(6, 'necklace', 2),
(7, 'rings', 2),
(8, 'bangles & bracelets', 2),
(9, 'pendants', 2),
(10, 'earings', 2),
(15, 'hair', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `workPhone` varchar(11) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `dateOfBirth` varchar(200) NOT NULL,
  `intrested` varchar(200) NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `workPhone`, `phone`, `address`, `password`, `dateOfBirth`, `intrested`) VALUES
(24, 'Hashir', 'hash@gmail.com', '03312245789', '03312245789', 'karachi', '123456', '1/Jan/1990', 'both');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catId` (`catId`),
  ADD KEY `subCatId` (`subCatId`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `catId` FOREIGN KEY (`catId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subCatId` FOREIGN KEY (`subCatId`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `parentId` FOREIGN KEY (`parentId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
