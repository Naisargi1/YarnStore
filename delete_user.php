<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Delete User',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION)){

	global $db_connection_handle;

	
	db_connect();
	
	has_carts($_GET['id']);
	
	$sql = "DELETE FROM Users WHERE `user#`='".$_GET['id']."'";

	$getcart = $db_connection_handle->prepare($sql);

	$getcart->execute();
	
	header('Location:logout.php');
	
} else {
	message("bad", " You must be logged in to see this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();

?>