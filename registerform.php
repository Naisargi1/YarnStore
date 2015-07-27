<?php
require_once('lib/lib.php');

output_html5_header(
  'Register',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

	$errors = false;

output_page_menu();

if (array_key_exists('email', $_SESSION) &&
	array_key_exists('fName', $_SESSION) &&
	array_key_exists('lName', $_SESSION) &&
	array_key_exists('problem', $_SESSION))
{
	$errors = true;
	$problem = $_SESSION['problem'];
	unset($_SESSION['problem']);

	$email = $_SESSION['email'];
	unset($_SESSION['email']);

	$fName = $_SESSION['fName'];
	unset($_SESSION['fName']);

	$lName = $_SESSION['lName'];
	unset($_SESSION['lName']);

}

?>

<h1>Register</h1>
<form class="form-horizontal" action="registration.php" method="POST">
  <fieldset>
    <div class="form-group">
    <label class="col-md-4 control-label" for="firstname">First Name</label>
    <div class="col-md-4"> <input id="firstname" name="firstName" type="text" placeholder="First Name" class="form-control input-md" required=""
				<?php
					if ($errors){
						echo ' value="'.$fName.'"></div>';
						if ($problem == 2 || $problem == 3 || $problem == 6 || $problem == 7){
							echo '<span class="error">! invalid name</span>';
						}
					}
					else
						echo '></div>';
				?>
		</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="lastname">Last Name</label>
    <div class="col-md-4"> <input id="lastname" name="lastName" type="text" placeholder="Last Name" class="form-control input-md" required=""
				<?php
					if ($errors){
						echo ' value="'.$lName.'"></div>';
						if ($problem == 4 || $problem == 5 || $problem == 6 || $problem == 7){
							echo '<span class="error">! invalid name</span>';
						}
					}
					else
						echo '></div>';
				?>
		</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="email">Email</label>
    <div class="col-md-4"> <input id="email" name="email" type="email" placeholder="example@example.ca" class="form-control input-md" required=""
				<?php
					if ($errors){
						echo ' value="'.$email.'"></div>';
						if ($problem == 1 || $problem == 3 || $problem == 5 || $problem == 7){
							echo '<span class="error">! invalid email</span>';
						}
					}
					else
						echo '></div>';
				?>		
		</div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Password</label>
      <div class="col-md-4">
        <input id="password" name="pass" type="password" placeholder="Insert your password" class="form-control input-md" required="">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8">
        <button onclick="history.go(-2);" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </fieldset>
</form>
<?php
output_page_footer();
output_html5_footer();
?>