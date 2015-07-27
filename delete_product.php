<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Delete Product',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js")
);

if (array_key_exists('loggedin', $_SESSION)){
	if (is_admin($_SESSION['loggedin'])){

output_page_menu();

global $db_connection_handle;

	db_connect();
		
	$result=is_in_carts($_GET['id']);
	if($result == 1){
		message("bad", 'Product has been bought. You cannot delete this product. <a onclick="history.go(-2);"> Go back. </a>');
		
	}else{
	
	$sql = "DELETE FROM Inventory WHERE `item#`='".$_GET['id']."'";
	echo $sql;

	$getcart = $db_connection_handle->prepare($sql);

	$getcart->execute();

	message("good", "Successfully deleted product! <a href=\"search.php?=\">Continue</a>");
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