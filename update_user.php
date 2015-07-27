<?php
require_once('lib/dblibs.php');
require_once('lib/lib.php');

output_html5_header(
  'Edit User',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){

if(count($_POST) == 5 &&
  array_key_exists('firstName', $_POST) &&
  array_key_exists('lastName', $_POST) &&
  array_key_exists('email', $_POST) &&
  array_key_exists('oldpass', $_POST) &&
  array_key_exists('newpass', $_POST)
  ){
	$fName = htmlspecialchars(trim($_POST['firstName']));
	$lName = htmlspecialchars(trim($_POST['lastName']));
	$email = htmlspecialchars(trim($_POST['email']));
	$oldpass = htmlspecialchars(trim($_POST['oldpass']));
	$newpass = htmlspecialchars(trim($_POST['newpass']));
	
	$errorFN = false;
	$errorLN = false;
	
	if (!check_words($fName)){
		$errorFN = true;
	}
	if (!check_words($lName)){
		$errorLN = true;
	}
	
	if (!$errorFN && !$errorLN){
		$sql = 'UPDATE Users SET email=:email, ';
	
		$user_array = array(':firstName'=>$fName, ':lastName'=>$lName, ':email'=>$email, ':email'=>$email);
	
		db_connect();
	
		if (strcmp($oldpass, "") != 0){
			if (strcmp($newpass, "") != 0){
				$newpassA = md5($newpass);
			
				if (db_check_user($email, $oldpass)){
					$sql .= 'password=:password, ';
					$user_array[':password'] = $newpassA;
				}
				else {
					$problemCode = 0;
					$_SESSION['fName'] = $fName;
					$_SESSION['lName'] = $lName;
					$_SESSION['problem'] = $problemCode;

					message("bad", " Incorrect password. Try again. <a href=\"edit_user.php\">Go Back.</a>");
					exit(0);
				}
			}
		}
	
		$sql .= 'firstName=:firstName, lastName=:lastName WHERE email=:email';
				
		db_edit_entry($user_array, $sql);

		message("good", " Successfully updated your information! <a href=\"my_page.php\">Continue</a>");
	}
	else{
		$problemCode = 0;
		if ($errorFN)
			$problemCode +=1;
		if ($errorLN)
			$problemCode +=2;
			
		$_SESSION['fName'] = $fName;
		$_SESSION['lName'] = $lName;
		$_SESSION['problem'] = $problemCode;
		header('Location: edit_user.php');
		
		exit(0);
	}
}
  else{
	die('Error editing user');	
  }
  
} else {
		message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
}	
  
output_page_footer();
output_html5_footer();
 
 ?>