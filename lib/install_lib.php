<?php
function create_tables(){
	create_users_table();
	create_inventory_table();
	create_cart_table();
}
function populate_tables(){
	populate_users_table();
	populate_inventory_table();
}

function create_users_table() {
	global $db_connection_handle;
			try {

				$sql = <<< ZZEOF
					CREATE TABLE IF NOT EXISTS `Users` (
					  `user#` int(11) NOT NULL AUTO_INCREMENT,
					  `email` varchar(32) NOT NULL,
					  `password` char(32) NOT NULL,
					  `firstName` varchar(32) NOT NULL,
					  `lastName` varchar(32) NOT NULL,
					  `admin` tinyint(1) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`user#`),
					  UNIQUE KEY `email` (`email`)
					) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;
ZZEOF;
				$result = $db_connection_handle->exec($sql);
				echo "<p>CREATE TABLE: Users created.</p>";
			}
			catch (PDOException $e) {
				echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
			}
		}

function create_inventory_table() {
global $db_connection_handle;
	try {

		$sql = <<< ZZEOF
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
		  `image` varchar(1000) NOT NULL DEFAULT '../private_html/img/noimage.png',
		  PRIMARY KEY (`item#`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
ZZEOF;
		$result = $db_connection_handle->exec($sql);
		echo "<p>CREATE TABLE: Inventory created.</p>";
	}
	catch (PDOException $e) {
		echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
	}
}

function create_cart_table() {
global $db_connection_handle;
	try {

		$sql = <<< ZZEOF
		CREATE TABLE IF NOT EXISTS `Cart` (
			`user#` int(11) NOT NULL,
			`item#` int(11) NOT NULL,
			`quantity` int(11) NOT NULL,
			PRIMARY KEY (`user#`,`item#`),
			KEY `item#` (`item#`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ZZEOF;
		$result = $db_connection_handle->exec($sql);
		echo "<p>CREATE TABLE: Cart created.</p>";
	}
	catch (PDOException $e) {
		echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
	}
}



function populate_users_table() {
global $db_connection_handle;
	try {

		$sql = <<< ZZEOF
		INSERT INTO `Users` (`user#`, `email`, `password`, `firstName`, `lastName`, `admin`) VALUES
		(1, 'admin@mystore.com', 'e99a18c428cb38d5f260853678922e03', 'Jane', 'Doe', 1),
		(2, 'johndoe@mymail.com', 'a029d0df84eb5549c641e04a9ef389e5', 'John', 'Doe', 0),
		(3, 'amy@mail.ca', '94240f91f0875a05c02a14ed2ed8c920', 'Amy', 'Person', 0);
ZZEOF;
		$result = $db_connection_handle->exec($sql);
		echo "<p>POPULATE TABLE: Users done.</p>";
	}
	catch (PDOException $e) {
		echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
	}
}


function populate_inventory_table() {
global $db_connection_handle;
	try {

		$sql = <<< ZZEOF
		INSERT INTO `Inventory` (`item#`, `brand`, `name`, `quantity`, `price`, `colourway`, `weight`, `yards`, `unitWeight`, `fiber`, `description`, `image`) VALUES
		(1, 'Naisargi', 'Handicrafter', 4, 2, 'Orange & Cream', 'worsted', 68, 42, '100% cotton', 'A classic, sturdy cotton yarn. Perfect for dishcloths, placemats, and market bags.', '../private_html/img/orangecream.png'),
		(2, 'Bernat', 'Satin', 4, 5, 'Blue Lagoon', 'aran', 200, 100, '100% acrylic', 'A very soft, shiny yarn. Machine washable. Excellent for blankets, garments, and toys.', '../private_html/img/bluelagoon.png'),
		(3, 'Caron', 'Simply Soft', 2, 7, 'Green Sage', 'aran', 315, 170, '100% acrylic', 'Shiny, soft acrylic yarn. This popular American yarn has finally made it''s way North of the border! Ideal for garments, blankets, toys, and more. Machine washable.', 'http://334b.medlerj.myweb.cs.uwindsor.ca/private_html/img/greensage.png'),
		(4, 'Caron', 'Simply Soft', 8, 7, 'Autumn Red', 'aran', 315, 170, '100% acrylic', 'Shiny, soft acrylic yarn. This popular American yarn has finally made it''s way North of the border! Ideal for garments, blankets, toys, and more. Machine washable.', '../private_html/img/autumnred.png'),
		(5, 'Red Heart', 'Heart & Sole', 10, 8, 'Green Envy', 'fingering', 213, 50, '70% wool, 30% nylon', 'A great choice of yarn to make socks out of. The nylon content adds strength, durability, and makes it machine washable. Also contains aloe, a bonus while knitting and wearing!', '../private_html/img/greenenvy.png'),
		(6, 'Red Heart', 'Shimmer', 3, 5, 'Black', 'worsted', 280, 100, '97% acrylic, 3% metallic', 'Soft, shimmery yarn. Great for hats, scarves, toys, accessories, and adding some sparkle to larger projects. Machine washable.', '../private_html/img/rhshimmerblack.png');
ZZEOF;
		$result = $db_connection_handle->exec($sql);
		echo "<p>POPULATE TABLE: Inventory done.</p>";
	}
	catch (PDOException $e) {
		echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
	}
}
?>