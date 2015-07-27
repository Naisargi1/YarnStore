<?php
require_once('lib/lib.php');

output_html5_header(
  'Edit User',
  array( "bootstrap/css/bootstrap.css", "bootstrap/css/bootstrap-theme.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

if (array_key_exists('loggedin', $_SESSION)){

output_page_menu();

$resub = false;

if (array_key_exists('fName', $_SESSION) &&
	array_key_exists('lName', $_SESSION) &&
	array_key_exists('problem', $_SESSION))
{
	$resub = true;
	$problem = $_SESSION['problem'];
	unset($_SESSION['problem']);

	$fName = $_SESSION['fName'];
	unset($_SESSION['fName']);

	$lName = $_SESSION['lName'];
	unset($_SESSION['lName']);

}

$user_info = populate_edit_user_form($_SESSION['loggedin']);


?>

<h1>Edit User</h1>
<form class="form-horizontal" action="update_user.php" method="POST">
  <fieldset>
    <div class="form-group">
    <label class="col-md-4 control-label" for="firstname">First Name</label>
    <div class="col-md-4"> <input id="firstname" name="firstName" type="text" placeholder="First Name" class="form-control input-md" required="" 
				<?php if (!$resub)
					echo 'value="'.$user_info['firstname'].'"></div>';
				else{
					echo 'value="'.$fName.'"></div>';
					if ($problem == 1 || $problem == 3){
							echo '<span class="error">! invalid name</span>';
						}
					}
				?>
		</div>
    <div class="form-group">
    <label class="col-md-4 control-label" for="lastname">Last Name</label>
    <div class="col-md-4"> <input id="lastname" name="lastName" type="text" placeholder="Last Name" class="form-control input-md" required="" 
				<?php if (!$resub)
					echo 'value="'.$user_info['lastname'].'"></div>';
				else{
					echo 'value="'.$lName.'"></div>';
					if ($problem == 2 || $problem == 3){
							echo '<span class="error">! invalid name</span>';
						}
					}
				?>
		</div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email</label>
      <div class="col-md-4">
        <input id="email" name="email" type="email" placeholder="example@example.ca" class="form-control input-md" required="" <?php echo ' value="'.$user_info['email'].'"'; ?> readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Current Password</label>
      <div class="col-md-4">
        <input id="oldpassword" name="oldpass" type="password" placeholder="Type your current password" class="form-control input-md">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">New Password</label>
      <div class="col-md-4">
        <input id="newpassword" name="newpass" type="password" placeholder="Type your new password" class="form-control input-md">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-8"> <a href="my_page.php" class="btn btn-default">Cancel</a>
        <button type="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </fieldset>
</form>
<?php
}
else {
	message("bad", " You must be logged in to do this! <a href=\"login.php\">Log in</a>");
}	

output_page_footer();
output_html5_footer();

?>