-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2019 at 01:47 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp_ca4_tunjing_ang_xingnuo_cen`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` bigint(40) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `email`, `hash`) VALUES
(1, 'admin', 'd00198874@student.dkit.ie', '$2y$12$RC7GZepOh4ArFw35iCfax.mq7nuWdWNebRNAOJgtfGLBW/PGFCutu'),
(102, 'tester02', 'tunjing998@icloud.com', '$2y$12$RC7GZepOh4ArFw35iCfax.mq7nuWdWNebRNAOJgtfGLBW/PGFCutu');

--
-- Triggers `accounts`
--
DELIMITER $$
CREATE TRIGGER `createClient` AFTER INSERT ON `accounts` FOR EACH ROW INSERT INTO clients(client_id,nickname) VALUES (new.account_id, new.username)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` bigint(40) UNSIGNED NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `registerdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `nickname`, `registerdate`) VALUES
(1, 'admin', '2019-04-26 10:28:15'),
(102, 'test33', '2019-04-24 01:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(40) UNSIGNED NOT NULL,
  `client_id` bigint(40) UNSIGNED NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `order_status`, `order_date`) VALUES
(1, 102, 'Unpaid', '2019-04-25 16:11:20'),
(2, 102, 'Dispatching', '2019-04-25 16:11:57'),
(3, 102, 'Canceled', '2019-04-25 16:12:11'),
(4, 102, 'Completed', '2019-04-25 16:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `order_id` bigint(40) UNSIGNED NOT NULL,
  `product_id` bigint(40) UNSIGNED NOT NULL,
  `quantity` int(40) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`order_id`, `product_id`, `quantity`) VALUES
(4, 7, 1),
(4, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(40) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(40) DEFAULT NULL,
  `product_details` text,
  `product_price` decimal(40,0) NOT NULL,
  `product_img_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_type`, `product_details`, `product_price`, `product_img_address`) VALUES
(4, 'Mesh stitching knit tube top', 'Cloth', 'Length 55cm\r\nBust 72cm is flexible', '20', 'girlscloth1.png'),
(6, 'One-neck blouse Lace-up short skirt two-piece suit', 'Cloth', 'Length 30 CM Bust 65 CM stretch\r\nSkirt Waist 68CM Skirt Length 41CM', '33', 'girlscloth2.jpg'),
(7, 'French niche ins holiday dress open back irregular skirt', 'Cloth', 'This vintage court dress combines solid color with clever new off-the-shoulder irregular cuts to showcase the designer\'s bold and avant-garde style. At the same time, the short and long irregular skirt is a beautiful polka print. Breathable and romantic design elements travel vacation beach wear is simply beautiful ~', '30', 'girlscloth3.jpg'),
(9, 'Sexy Deerskin Halter Halo Tube Top Strap Cross Bandage Cutout Dress', 'Cloth', 'Fabric: Deer Velvet Elastic\r\n\r\nThe rope is elastic, so don\'t worry about what it is.\r\n\r\nS: Bust: 76 Waist: 65 Hips: 90 Length: 15.5 Skirt Length: 38\r\n\r\nM: Bust: 80 Waist: 69 Hips: 94 Length: 16 Skirt Length: 39\r\n\r\n\r\nL: Bust: 84 Waist: 73 Hips: 98 Length: 16.5 Dress Length: 40\r\n\r\nBecause the fabric is elastic and the width of the strap is adjustable.\r\n\r\nSo don\'t worry too much about hips\r\n\r\nMainly the waist is suitable, the bust is suitable\r\n\r\nThe bust of the owner is 86 Waist: 68 Hips: 96 The picture is worn by S\r\n\r\nGive everyone a reference\r\n', '15', 'girlscloth4.jpg'),
(10, 'Gradient Crystal Sling Sling Top Feather Crystal Mesh Half Skirt Set', 'Cloth', 'I want to talk about this dress, the whole body is a gradient color hot sling, and then the skirt fabric is really expensive, so the skirt is also very expensive, all handmade hot diamonds handmade beaded plus ostrich hair, 200 pieces of fabric One meter, scared and scared me to a skirt with a material of 1 meter and 8 without making a fee.', '25', 'girlscloth5.jpg'),
(11, 'Mermaid shallow change fishtail s925 sterling silver freshwater pearl super flash two earrings', 'Earring', 'Material: s925 Sterling Silver Needle, natural shell pearl', '15', 'earring1.jpg'),
(12, 'Japanese sweetheart girl retro cute wild small red love heart earrings earrings ear clips', 'Earring', 'There have been quite a few imitations recently.\r\n\r\nBut it’s really impossible to compare\r\n\r\nThe materials used are also workmanship color and thickness.\r\n\r\nIt seems that the overall texture is different.\r\n\r\nThe material used in the imitation version is very unreal.\r\n\r\nThe materials used look cheap.\r\n\r\nThere is also a thin layer of thickness that is also cut corners.\r\n\r\nNot full enough', '5', 'earring2.jpg'),
(13, 'Handmade pearl bow ribbon stud earrings', 'Earring', 'Material: resin clay, titanium ear needle, alloy ear clip\r\n\r\nSize: about 1.5cm\r\n\r\n \r\n\r\nSmall and cute pearl-colored bow ribbon earrings, one of which has a small roll of ribbon bow extension, the asymmetric design is a selling point!\r\n\r\nThe bows are made by hand with resin clay, which will inevitably produce hand-made traces of small flaws, such as not very balanced, a little other fiber attachment, etc., mind carefully shot.\r\n\r\nIn addition, although the ribbon extended by the bow has a certain elasticity, it should be handled with care and gentleness when using it. It should not be rude, or it will rot! !', '8', 'earring3.jpg'),
(14, 'Star moon pearl earrings', 'Earring', 'Material: Alloy / Silver Plated / Gold Plated', '4', 'earring4.jpg'),
(15, 'BlahBlahBlah heart sound series translucent bubble dialog earrings', 'Earring', 'Material: Silver', '80', 'earring5.jpg'),
(16, 'Li Wumei, the year of the fall, the female and the European mixed-race network red contact lens', 'Lens', 'Brand Name: maylofi', '12', 'lenses2.jpg'),
(18, 'Net red with the same pink beauty mixed blood size diameter year throw female natural contact lens Merlot', 'Lens', 'Brand Name: maylofi', '12', 'lenses1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` bigint(40) UNSIGNED NOT NULL,
  `product_id` bigint(40) UNSIGNED NOT NULL,
  `client_id` bigint(40) UNSIGNED NOT NULL,
  `review_title` text NOT NULL,
  `review_text` text NOT NULL,
  `suggest` tinyint(1) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `product_id`, `client_id`, `review_title`, `review_text`, `suggest`, `last_modified`) VALUES
(1, 7, 102, 'test', 'testText', 1, '2019-04-30 20:36:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` bigint(40) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` bigint(40) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(40) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(40) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` bigint(40) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `orders_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `orders_products_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
