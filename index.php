<?php
require_once('lib/lib.php');
require_once('lib/search.php');
require_once('lib/carousel.php');

output_html5_header(
  'Home',
  array( "bootstrap/css/bootstrap.css","bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js", "js/carousel.js", "js/reveal.js", "js/ajax.js")
);

output_page_menu();
carousel();
?>

	
	<div class="container_prod">
<?php
	 search('', '*',10);
?>
	</div>
	<br/><br/>
<?php
output_page_footer();
output_html5_footer();
?>

