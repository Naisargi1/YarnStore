<?php
require_once('lib/lib.php');

  if (!array_key_exists('loggedin', $_SESSION))
  {
output_html5_header(
  'Login',
  array( "bootstrap/css/bootstrap.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

output_page_menu();
?>

<div class="omb_login">
  <h3 class="omb_authTitle">Login or <a href="registerform.php">Sign up</a></h3>
  <div class="row omb_row-sm-offset-3">
    <div class="col-xs-12 col-sm-6">
      <form class="omb_loginForm" action="trylogin.php" autocomplete="off" method="POST">
        <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <input type="text" class="form-control" name="login" placeholder="Email Address" 	
						<?php
							if (count($_GET) > 0 && array_key_exists('email', $_GET)){
								$preEmail = $_GET['email'];
								$email = html_special_chars($preEmail);
								echo ' value="'.$email.'"></div>';
							}
							else
								echo '></div>';
						?>
					<span class="help-block"></span>
        <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input  type="password" class="form-control" name="pass" placeholder="Password">
        </div>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php
}else{

output_html5_header(
  'Logout',
  array( "bootstrap/css/bootstrap.css", "css/style.css"),
  array( "js/jquery.min.js", "bootstrap/js/bootstrap.min.js" )
);

output_page_menu();
?>
<h1>Logout</h1>
<p>Are you sure you want to log out? </p>
<div class="col-sm-offset-4 col-sm-8"> <a href="index.php" class="btn btn-default">Cancel</a>
  <button onclick="location.href='logout.php';" class="btn btn-success">Log out</button>
</div>
<?php
}
output_page_footer();
output_html5_footer();
?>
