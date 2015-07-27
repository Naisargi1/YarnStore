<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Edit Product',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){
	if (is_admin($_SESSION['loggedin'])){

if(count($_POST) == 11 &&
  array_key_exists('item', $_POST) &&
  array_key_exists('name', $_POST) &&
  array_key_exists('brand', $_POST) &&
  array_key_exists('price', $_POST) &&
  array_key_exists('quantity', $_POST) &&
  array_key_exists('colourway', $_POST) &&
  array_key_exists('weight', $_POST) &&
  array_key_exists('yards', $_POST) &&
  array_key_exists('unitWeight', $_POST) &&
  array_key_exists('fiber', $_POST) &&
  array_key_exists('description', $_POST) &&
  array_key_exists('image', $_FILES)
  ){
	$item = htmlspecialchars(trim($_POST['item']));
	$name = htmlspecialchars(trim($_POST['name']));
	$brand = htmlspecialchars(trim($_POST['brand']));
	$price = htmlspecialchars(trim($_POST['price']));
	$quantity = htmlspecialchars(trim($_POST['quantity']));
	$colourway = htmlspecialchars(trim($_POST['colourway']));
	$weight = htmlspecialchars(trim($_POST['weight']));
	$yards = htmlspecialchars(trim($_POST['yards']));
	$unitWeight = htmlspecialchars(trim($_POST['unitWeight']));
	$fiber = htmlspecialchars(trim($_POST['fiber']));
	$description = htmlspecialchars(trim($_POST['description']));
	
	$errorP = false;
	$errorQ = false;
	$errorY = false;
	$errorUW = false;
	
	if (!check_number($price)){
		$errorP = true;
		$_SESSION['errorP'] = true;
	}
	if (!check_number($quantity)){
		$errorQ = true;
		$_SESSION['errorQ'] = true;
	}
	if (!check_number($yards)){
		$errorY = true;
		$_SESSION['errorY'] = true;
	}
	if (!check_number($unitWeight)){
		$errorUW = true;
		$_SESSION['errorUW'] = true;
	}
	
	if ($errorP || $errorQ || $errorY || $errorUW ){
		$_SESSION['name'] = $name;
		$_SESSION['brand'] = $brand;
		$_SESSION['price'] = $price;
		$_SESSION['quantity'] = $quantity;
		$_SESSION['colourway'] = $colourway;
		$_SESSION['weight'] = $weight;
		$_SESSION['yards'] = $yards;
		$_SESSION['unitWeight'] = $unitWeight;
		$_SESSION['fiber'] = $fiber;
		$_SESSION['description'] = $description;
		header('Location: edit_product.php?id='.$item);
		
		exit(0);
	}
	
	db_connect();
	
	if (!empty($_FILES['image']['name'])){
		$dir = '../private_html/img/';
		$tmpName = $_FILES['image']['tmp_name'];
		$nameImg = $_FILES['image']['name'];
		$image = $dir.$nameImg;
		
		if (!db_image_exists($image)){
			if( move_uploaded_file( $tmpName, $dir . $nameImg ) ) {	
						
			} else {
				$_SESSION['name'] = $name;
				$_SESSION['brand'] = $brand;
				$_SESSION['price'] = $price;
				$_SESSION['quantity'] = $quantity;
				$_SESSION['colourway'] = $colourway;
				$_SESSION['weight'] = $weight;
				$_SESSION['yards'] = $yards;
				$_SESSION['unitWeight'] = $unitWeight;
				$_SESSION['fiber'] = $fiber;
				$_SESSION['description'] = $description;

				message("bad", " Error uploading file. No updates made. <a href=\"edit_product.php?id=".$item."\">Go back.</a>");	
				exit(0);
			}
		} else {
			$_SESSION['name'] = $name;
			$_SESSION['brand'] = $brand;
			$_SESSION['price'] = $price;
			$_SESSION['quantity'] = $quantity;
			$_SESSION['colourway'] = $colourway;
			$_SESSION['weight'] = $weight;
			$_SESSION['yards'] = $yards;
			$_SESSION['unitWeight'] = $unitWeight;
			$_SESSION['fiber'] = $fiber;
			$_SESSION['description'] = $description;

			message("bad", " Error uploading file: image name already exists. Product has not been updated. <a href=\"edit_product.php?id=".$item."\">Go back.</a>");	
			exit(0);
		}
			
		$item_array = array(':name'=>$name, ':brand'=>$brand, ':price'=>$price,':quantity'=>$quantity, ':colourway'=>$colourway, ':weight'=>$weight,
	':yards'=>$yards, ':unitWeight'=>$unitWeight, ':fiber'=>$fiber, ':description'=>$description, ':image'=>$image, ':item'=>$item);
	
		$sql = 'UPDATE Inventory SET name=:name, brand=:brand, price=:price, quantity=:quantity, colourway=:colourway, weight=:weight, yards=:yards, unitWeight=:unitWeight, fiber=:fiber, description=:description, image=:image WHERE `item#`=:item';
		
		db_edit_entry($item_array, $sql);
	}
	else{
		
		$item_array = array(':name' => $name, ':brand' => $brand, ':price' => $price,':quantity'=>$quantity, ':colourway'=>$colourway, ':weight'=>$weight,
	':yards'=>$yards, ':unitWeight'=>$unitWeight, ':fiber'=>$fiber, ':description'=>$description, ':item'=>$item);
	
		$sql = 'UPDATE Inventory SET name=:name, brand=:brand, price=:price, quantity=:quantity, colourway=:colourway, weight=:weight, yards=:yards, unitWeight=:unitWeight, fiber=:fiber, description=:description WHERE `item#`=:item';
		
		db_edit_entry($item_array, $sql);
	}

	message("good", " Successfully updated! <a href=\"product.php?id=".$item."\">Continue</a>");
	
  }else{
	die('Error editing product');	
  }
} else {
	message("bad", "You do not have permission to view this page. <a href=\"index.php\">Go Home</a>");
}

} else {
		message("bad", " You must be a logged in administrator to do this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();
 
 ?>