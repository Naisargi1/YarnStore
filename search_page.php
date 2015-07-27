<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');
require_once('lib/search.php');

output_html5_header(
  'Search',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

output_page_menu();
?>

<h1>Products</h1>

<?php
if (array_key_exists('search', $_GET)){
	if (array_key_exists('max', $_GET)){
		search($_GET['search'], '*',$_GET['max']);
	}else{
		search($_GET['search'], '*',12);
	}
}
else {
	header('Location: search_page.php?search=');
}
?>

<?php
output_page_footer();
output_html5_footer();
?>