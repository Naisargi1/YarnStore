<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Process Transaction',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){

if(count($_POST) == 8 &&
  array_key_exists('name', $_POST) &&
  array_key_exists('cardNum', $_POST) &&
  array_key_exists('cvc', $_POST) &&
  array_key_exists('expM', $_POST) &&
  array_key_exists('expY', $_POST)
){
	$name = htmlspecialchars(trim($_POST['name']));
	$cardNum = htmlspecialchars(trim($_POST['cardNum']));
	$cvc = htmlspecialchars(trim($_POST['cvc']));
	$expM = htmlspecialchars(trim($_POST['expM']));
	$expY = htmlspecialchars(trim($_POST['expY']));
	
	$errorCVC = false;
	$errorMY = false;
	$errorDate = false;
	
	if (!check_number($cvc)){
		$errorCVC = true;
		$_SESSION['errorCVC'] = true;
	}
	if (!check_number($expM) && !check_number($expY)){
		$errorMY = true;
		$_SESSION['errorMY'] = true;
	} else {
		date_default_timezone_set('America/Toronto'); 
		$year = date('Y');
		$month = date('m');
		if ($expY <= $year){
			if ($expM <= $month){
				$errorDate = true;
				$_SESSION['errorDate'] = true;
			}
		}
	}

		
	db_connect();
	$user_id = db_get_user_id($_SESSION['loggedin']);
	
	if ( $errorCVC || $errorMY || $errorDate ){
		$_SESSION['name'] = $name;
		$_SESSION['cardNum'] = $cardNum;
		$_SESSION['cvc'] = $cvc;
		$_SESSION['expM'] = $expM;
		$_SESSION['expY'] = $expY;
		header('Location: payment.php?user_id='.$user_id);
		
		exit(0);
	}
	
	$cart = get_cart($user_id);

	foreach($cart as $prod){
		$product = $prod['item#'];
		$quantity = intval($prod['quantity']);
		$oldQuant = intval(db_get_current_amt($product));
		$newQuant = $oldQuant-$quantity;
		$item_array = array(':quantity' => $newQuant, ':item' => $product);
		$sql = 'UPDATE Inventory SET quantity=:quantity WHERE `item#`=:item';	
		db_edit_entry($item_array, $sql);
	}

	message("good", " You have placed your purchase! Thank you for your patronage. <a href=\"my_page.php\">Continue</a>");
	
  }else{
	die('Error processing');	
  }
} else {
		message("bad", " You must be logged in to see this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();
 
 ?>