-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2021 at 08:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `userID` int(30) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product` varchar(25) DEFAULT NULL,
  `quantity` int(25) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `productID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `name`, `product`, `quantity`, `size`, `productID`) VALUES
(22, 1, 'kasshif', '3piece', 1, 'Medium', '2');

-- --------------------------------------------------------

--
-- Table structure for table `dilivery`
--

CREATE TABLE `dilivery` (
  `userID` int(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `product` varchar(30) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dilivery`
--

INSERT INTO `dilivery` (`userID`, `name`, `email`, `address`, `product`, `quantity`, `size`) VALUES
(1, 'kasshif', 'kashif.imran0313@gmail.com', 'home', 'Kidshirt', 1, 'Small'),
(1, 'kasshif', 'kashif.imran0313@gmail.com', 'home', 'threepiece', 1, 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `product` varchar(30) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `disc` int(25) DEFAULT NULL,
  `gender` varchar(25) DEFAULT NULL,
  `price` int(30) DEFAULT NULL,
  `cash` int(30) DEFAULT NULL,
  `sizesmall` varchar(30) DEFAULT NULL,
  `sizemedium` varchar(30) DEFAULT NULL,
  `sizelarge` varchar(30) DEFAULT NULL,
  `discript` varchar(50) DEFAULT NULL,
  `img1` varchar(50) DEFAULT NULL,
  `img2` varchar(50) DEFAULT NULL,
  `img3` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `brand`, `disc`, `gender`, `price`, `cash`, `sizesmall`, `sizemedium`, `sizelarge`, `discript`, `img1`, `img2`, `img3`) VALUES
(2, '3piece', 'khaddie', 0, '1', 2100, 120, '4', '199', 'no', 'this is the brand of the pakistan', 'productImages/3piecekhaddie1.jpg', 'productImages/3piecekhaddie2.jpg', 'productImages/3piecekhaddie3.jpg'),
(3, 'threepiece', 'limelight', 10, '1', 1000, 12, '22', '7', 'no', 'this is the brand and product  of the pakistan', 'productImages/3piecelimelight1.jpg', 'productImages/3piecelimelight2.jpg', 'productImages/3piecelimelight3.jpg'),
(5, 'Kidshirt', 'hello', 0, '11', 500, 0, '32', '4', 'no', 'hi this is a product of kids', 'productImages/Kidshirthello1.jpg', 'productImages/Kidshirthello2.jpg', 'productImages/Kidshirthello3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `weblogin`
--

CREATE TABLE `weblogin` (
  `id` int(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `age` int(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `loginYorN` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weblogin`
--

INSERT INTO `weblogin` (`id`, `name`, `lastname`, `gender`, `email`, `age`, `password`, `address`, `loginYorN`) VALUES
(1, 'kasshif', 'imran', 'Male', 'kashif.imran0313@gmail.com', 23, 'asd', 'home', 1),
(2, 'abcd', 'user', 'Female', 'guestuser@gmail.com', 12, 'asd', '1234asdf', 1),
(3, 'bisma', 'imran', 'Male', 'kashif.imran55@gmail.com', 23, 'asd', 'sweethome', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weblogin`
--
ALTER TABLE `weblogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weblogin`
--
ALTER TABLE `weblogin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
