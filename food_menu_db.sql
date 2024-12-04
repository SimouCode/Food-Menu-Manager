-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 07:22 AM
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
-- Database: `food_menu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `tbl_menu_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`tbl_menu_id`, `image`, `name`, `description`, `price`) VALUES
(2, './images/adobo.jpg', 'Adobo', 'A classic Filipino dish made by simmering meat (usually chicken or pork) in a savory, tangy blend of soy sauce, vinegar, garlic, and bay leaves.', 60),
(3, './images/fish.jpg', 'Fish Tinola', 'A light and nourishing soup featuring fish simmered with ginger, green papaya, and chili leaves, creating a soothing and aromatic dish.', 120),
(4, './images/menudo.jpg', 'Menudo', 'A hearty tomato-based stew with pork, liver, potatoes, and carrots, often enjoyed during family gatherings and celebrations.', 80),
(5, './images/dinuguan.jpg', 'Dinuguan', 'A rich, savory stew made from pork and pig\'s blood, seasoned with garlic, vinegar, and chili, offering a unique combination of tangy and spicy flavors.', 75),
(6, './images/bicol.jpg', 'Bicol Express', 'A spicy stew from the Bicol region made with pork, shrimp paste, and coconut milk, infused with the heat of chili peppers.', 85),
(7, './images/nilaga.jpg', 'Nilaga', 'A comforting soup featuring beef or pork boiled with vegetables like cabbage, potatoes, and corn, flavored with peppercorns and fish sauce.', 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`tbl_menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `tbl_menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
