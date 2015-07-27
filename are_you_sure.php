<?php

function are_you_sure($type, $string, $id, $subject){

	$url = $type.'_'.$subject.'.php?id='.$id;
	

echo <<<ZZEOT
<h1>Attention</h1>
<p>Are you sure you want $type $string? </p>
<div class="col-sm-offset-4 col-sm-8">
<button onclick="history.go(-1);" class="btn btn-default">Cancel</button>
<button onclick="location.href='$url';" class="btn btn-success">Go ahead</button>
</div>
ZZEOT;
}

require_once('lib/lib.php');
require_once('lib/dblibs.php');


output_html5_header(
  "Are you sure?",
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css","css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){

output_page_menu();

are_you_sure($_GET['type'],$_GET['string'], $_GET['id'], $_GET['subject'] );

	} else {
		message("bad", "You do not have permission to view this page. <a href=\"index.php\">Go Home</a>");
	}
 	

output_page_footer();
output_html5_footer();
?>