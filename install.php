<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');
require_once('lib/install_lib.php');

output_html5_header(
  'Install',
  array("css/style.css")
);

	db_connect();
	create_tables();
	populate_tables();
	
	echo '<a href="index.php">Go to the Home Page</a>';

?>