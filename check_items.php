<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Process Transaction',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){

  if(count($_GET) == 1 &&
    array_key_exists('user_id', $_GET)){
	$user_id = htmlspecialchars(trim($_GET['user_id']));
		
	db_connect();
	
	$cart = get_cart($user_id);
	
		foreach($cart as $prod){
			$product = $prod['item#'];
			$quantity = intval($prod['quantity']);
			$current = intval(db_get_current_amt($product));
		
			if ($quantity > $current){
				message("bad", " You cannot proceed with checkout because you have exceeded our current stock! <a href=\"cart_page.php\">Go back</a>");
				exit(0);
			}
		}
		
	header('Location: checkout.php?user_id='.$user_id);

  }else{
	die('Error processing');	
  }
} else {
		message("bad", " You must be logged in to see this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();
 
 ?>