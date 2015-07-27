<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Edit Product',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){
	if (count($_GET) == 2 && array_key_exists('user_id', $_GET) && array_key_exists('product_id', $_GET)){

	global $db_connection_handle;
	db_connect();
	$sql = "DELETE FROM Cart WHERE `user#`= '".$_GET['user_id']."'&& `item#`='".$_GET['product_id']."'";
	$getcart = $db_connection_handle->prepare($sql);
	$getcart->execute();
	header('Location: cart_page.php');

} else {
	header('Location: index.php');
}
} else {
	message("bad", " You must be logged to do this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();

?>