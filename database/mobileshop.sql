-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2020 at 11:01 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_stock` int(11),
  `item_description` varchar(8000) NOT NULL,
  `item_section` varchar(255) NOT NULL,
  `item_register` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_image`,`item_stock`,`item_description`,`item_section`,`item_register`) VALUES
(1, 'Samsung', 'Samsung Galaxy S6 Edge', 250.00, './assets/products/1.png',5,'Samsung Galaxy S6 Edge','Top Sale',NOW()),
(2, 'Xiaomi', 'Redmi Note 3', 215.00, './assets/products/2.png',3,'Redmi Note 3','Special Price',NOW()),
(3, 'Xiaomi', 'Redmi 6', 200.00, './assets/products/3.png',4,'Redmi 6','New Phones',NOW()),
(4, 'Xiaomi', 'Redmi 5', 185.00, './assets/products/4.png',2,'Redmi 5', 'Special Price',NOW()),
(5, 'Xiaomi', 'Redmi 5A', 195.00, './assets/products/5.png',1,'Redmi 5A','Top Sale', NOW()),
(6, 'Xiaomi', 'Redmi 5 Pro', 200.00, './assets/products/6.png',7,'Redmi 5 Pro','Top Sale', NOW()),
(7, 'Xiaomi', 'Redmi Note 5', 250.00, './assets/products/8.png',5,'Redmi Note 5','Special Price',NOW()),
(8, 'Xiaomi', 'Redmi Note 4', 225.00, './assets/products/10.png',10,'Redmi Note 4','Top Sale',NOW()),
(9, 'Samsung', 'Samsung Galaxy S6', 250.00, './assets/products/11.png',9,'Samsung Galaxy S6','Special Price', NOW()),
(10, 'Samsung', 'Samsung Galaxy S7', 350.00, './assets/products/12.png',6,'Samsung Galaxy S7','New Phones' ,NOW()),
(11, 'Apple', 'Apple iPhone X', 400.00, './assets/products/13.png',3,'Apple iPhone X','New Phones', NOW()),
(12, 'Apple', 'Apple iPhone 4', 215.00, './assets/products/14.png',2,'Apple iPhone 4','Special Price', NOW()),
(13, 'Apple', 'Apple iPhone 6', 315.00, './assets/products/15.png',1,'Apple iPhone 6','New Phones', NOW());

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profileImage` varchar(255),
  `register_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `order-items`
--

CREATE TABLE `order-items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orders`
--

ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order-items`
--

ALTER TABLE `order-items`
  ADD PRIMARY KEY (`id`);
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order-items`
--
ALTER TABLE `order-items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
