<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Login',
  array( "bootstrap/css/bootstrap.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);
output_page_menu();

if (
  count($_POST) == 2 &&
  array_key_exists('login', $_POST) &&
  array_key_exists('pass', $_POST)
)
{
  $login = htmlspecialchars(trim($_POST['login']));
  $pass = htmlspecialchars(trim($_POST['pass']));
    
  if (check_email($login)){
	db_connect();
	if (db_check_user($login, $pass))
	{
		$_SESSION['loggedin'] = $login;
		header('Location: my_page.php');
		exit(0);
	}
	else
	{
		unset($_SESSION['loggedin']);
		message("bad", " Email or password incorrect. Try again.<a href='login.php?email=".$login."'> Go back. </a>");
		exit(0); 
	}
  }
  else{
	unset($_SESSION['loggedin']);
	message("bad", " Invalid email address. Try again.<a href='login.php?email=".$login."'> Go back. </a>");
	exit(0);
  }
}
else
{
  unset($_SESSION['loggedin']);
  header('Location: login.php');
  exit(0);
}

output_page_footer();
output_html5_footer();
?>
