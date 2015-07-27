<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Register',
  array( "bootstrap/css/bootstrap.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);
 
if (
  count($_POST) == 4 &&
  array_key_exists('email', $_POST) &&
  array_key_exists('pass', $_POST) &&
  array_key_exists('firstName', $_POST) &&
  array_key_exists('lastName', $_POST) 
)
{
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['pass']));
  $firstName = htmlspecialchars(trim($_POST['firstName']));
  $lastName = htmlspecialchars(trim($_POST['lastName']));
  
  $errorE = false;
  $errorFN = false;
  $errorLN = false;
    
  if (!check_email($email)){
	$errorE = true;
  }
  if (!check_words($firstName)){
	$errorFN = true;
  }
  if (!check_words($lastName)){
	$errorLN = true;
  }
    
  if (!$errorE && !$errorFN && !$errorLN){
	db_connect();
	if (db_check_email($email))
	{
		message("bad", " User already registred. Try again.<a onclick='history.go(-1);'> Go back. </a>");
	}
	else
	{
		db_add_new_user($email, $password, $firstName, $lastName);
		message("good", " Successfully registered! <a href=\"my_page.php\">Continue</a>");
		$_SESSION['loggedin'] = $email;
	}
  }
  else
  {
	unset($_SESSION['loggedin']);
  
  	$problemCode = 0;
	if ($errorE)
		$problemCode += 1;
	if ($errorFN)
		$problemCode += 2;
	if ($errorLN)
		$problemCode += 4;
	
	$_SESSION['email'] = $email;
	$_SESSION['fName'] = $firstName;
	$_SESSION['lName'] = $lastName;
	$_SESSION['problem'] = $problemCode;
	header('Location: registerform.php');
  
	exit(0);
  }
}
else
{
  unset($_SESSION['loggedin']);
  header('Location: registerform.php');
  exit(0);
}

output_html5_footer();

?>
