-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 02:26 PM
-- Server version: 5.5.9-log
-- PHP Version: 5.4.26

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `desai112_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE IF NOT EXISTS `Inventory` (
  `item#` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(5) NOT NULL,
  `colourway` varchar(32) NOT NULL,
  `weight` varchar(32) NOT NULL,
  `yards` int(11) NOT NULL,
  `unitWeight` int(11) NOT NULL,
  `fiber` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(1000) NOT NULL DEFAULT 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/noimage.png',
  PRIMARY KEY (`item#`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`item#`, `brand`, `name`, `quantity`, `price`, `colourway`, `weight`, `yards`, `unitWeight`, `fiber`, `description`, `image`) VALUES
(1, 'Naisargi', 'Handicrafter', 4, 2, 'Orange & Cream', 'worsted', 68, 42, '100% cotton', 'A classic, sturdy cotton yarn. Perfect for dishcloths, placemats, and market bags.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/orangecream.png'),
(2, 'Bernat', 'Satin', 4, 5, 'Blue Lagoon', 'aran', 200, 100, '100% acrylic', 'A very soft, shiny yarn. Machine washable. Excellent for blankets, garments, and toys.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/bluelagoon.png'),
(3, 'Caron', 'Simply Soft', 2, 7, 'Green Sage', 'aran', 315, 170, '100% acrylic', 'Shiny, soft acrylic yarn. This popular American yarn has finally made it''s way North of the border! Ideal for garments, blankets, toys, and more. Machine washable.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/greensage.png'),
(4, 'Caron', 'Simply Soft', 8, 7, 'Autumn Red', 'aran', 315, 170, '100% acrylic', 'Shiny, soft acrylic yarn. This popular American yarn has finally made it''s way North of the border! Ideal for garments, blankets, toys, and more. Machine washable.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/autumnred.png'),
(5, 'Red Heart', 'Heart & Sole', 10, 8, 'Green Envy', 'fingering', 213, 50, '70% wool, 30% nylon', 'A great choice of yarn to make socks out of. The nylon content adds strength, durability, and makes it machine washable. Also contains aloe, a bonus while knitting and wearing!', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/greenenvy.png'),
(6, 'Red Heart', 'Shimmer', 3, 5, 'Black', 'worsted', 280, 100, '97% acrylic, 3% metallic', 'Soft, shimmery yarn. Great for hats, scarves, toys, accessories, and adding some sparkle to larger projects. Machine washable.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/rhshimmerblack.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
