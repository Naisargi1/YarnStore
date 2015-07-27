<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

  if (array_key_exists('loggedin', $_SESSION))
  {
	db_connect();
    $user_id= db_get_user_id($_SESSION['loggedin']);

	$product = db_get_product_by_id($_POST['product']);
	$product_id = $product['item#'];
	
	$qtd = user_has_in_the_cart($user_id, $product_id);
	if($qtd>0){
		$qtd=$qtd+$_POST['qtd'];
		db_update_cart($user_id, $product_id, $qtd);		
	}else{
		db_add_to_cart($user_id, $product_id, $_POST['qtd']);
	}
	header("Location: cart_page.php");
  }
  else
  {
output_html5_header(
  'Edit Product',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);
		message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
		output_page_footer();
		output_html5_footer();
  }
?>