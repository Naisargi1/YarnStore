<?php
require_once('lib/lib.php');
require_once('lib/dblibs.php');

output_html5_header(
  'Contact Us',
  array( "bootstrap/css/bootstrap.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js",
  "js/tinymce/tinymce.min.js", "js/tinymce/test.js" )
);

if (count($_POST) == 3 &&
	array_key_exists('name', $_POST) &&
	array_key_exists('email', $_POST) &&
	array_key_exists('message', $_POST)){

output_page_menu();


    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $from = 'Yarn Store'; 
    $to = $EMAIL; 
    $subject = 'Contact Form';
	$headers = 'Content-Type: multipart/alternative';
    
	$body = "<html><p>From: $name</p> <p>E-Mail: $email> <p>Message:</p> $message";
		
    if (mail ($to, $subject, $body, $from, $header)) { 
	    echo '<div class="alert alert-success"><strong>Well done!</strong> Your message has been sent! <a href="index.php">Continue</a></div>';
	} else { 
	    echo '<div class="alert alert-danger"><strong>Sorry.</strong> Something went wrong, go back and try again! <a href="contact.php">Back</a></div>'; 
	} 
} else {
	header('Location: contact.php');
}

output_page_footer();
output_html5_footer();
?>