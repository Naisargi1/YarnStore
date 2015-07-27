<?php
require_once('lib/dblibs.php');

session_start();

function output_html5_header($title, 
  $css = array(), $js = array())
{
  header('Content-Type: text/html');

  $title = htmlspecialchars($title);

  $link = '';
  foreach ($css as $cssFile)
    $link .= '<link rel="stylesheet" type="text/css" href="'.$cssFile.'" />';
  
  $script = '';
  foreach ($js as $jsFile)
    $script .= '<script type="application/javascript" src="'.$jsFile.'"></script>';

  echo <<<ZZEOF
<!DOCTYPE html>
<html>
<head>
  <title>$title</title>
  $link
  $script
</head>
<body>
ZZEOF;
}

function output_popup(){

	echo '<div id="myModal" class="reveal-modal">';
	
	$xmlFile = new DOMDocument();
	$xmlFile->load('myfile.xml');

	$xslFile = new DOMDocument();
	$xslFile->load('eg.xsl');

	$proc = new XSLTProcessor();
	$proc->importStylesheet($xslFile);
	echo $proc->transformToXML($xmlFile);
	echo '<a class="close-reveal-modal">&#215;</a>';
	echo '</div>';

}

function output_html5_footer()
{
  echo <<<ZZEOF
</body>
</html>
ZZEOF;
}

function output_page_menu()
{
  $login = array();
  if (array_key_exists('loggedin', $_SESSION))
  {
    $login['label'] = 'Logout';
  }
  else
  {
    $login['label'] = 'Login';
  }

  echo <<<ZZEOF
<div class="navbar navbar-fixed-top navbar-default">
  <div class="navbar-header"><a class="navbar-brand" href="index.php">Yarn Store</a><a class="navbar-toggle"
        data-toggle="collapse" data-target=".navbar-collapse"><span class="glyphicon glyphicon-align-justify"></span> </a> </div>
  <div class="container">
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><i class="glyphicon glyphicon-home icon-white"></i> Home</a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
          <ul class="dropdown-menu">
			<li><a href="search_page.php?search=">All Products</a></li>
ZZEOF;
            db_select_brands_for_menu();
            
  echo <<<ZZEOF
	  </ul>
        </li>
ZZEOF;
		output_popup();
  echo <<<ZZEOF
		<li><a href="#" class="big-link" data-reveal-id="myModal" data-animation="none">Weight Conversion</a> </li>
		<li><a href="contact.php">Contact Us</a> </li>
		<li class="mob"><a href="login_logout.php">Login</a> </li>
		<li class="mob"><a href="cart_page.php">My Cart</a> </li>
		<div class="col-md-6"> </div>
      </ul>
	  
      <ul class="nav pull-right navbar-nav">
	  
      <li class="desk"><a href="login.php">{$login['label']}</a> </li>
	  <li class="desk"><a href="cart_page.php" class="cart_button" ><i class="glyphicon glyphicon-shopping-cart"></i></a></li>
	  <li class="desk"><a href="my_page.php" class="cart_button" ><i class="glyphicon glyphicon-user"></i></a></li>

      </ul>
	  
	  <form class="navbar-form" role="search" action="search_page.php" method="GET">
        <div class="input-group">
			<input type="text" class="form-control input-md" placeholder="Search" name="search" id="search" >
			<div class="input-group-btn">
				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>			
        </div>
		</form>
    </div>
  </div>
</div>

ZZEOF;
}


function output_page_footer()
{
  echo <<<ZZEOF
<div id="footer">
	<div class="col-md-12">
		<p>334 Project - Group 11</p>
	</div>
</div>
ZZEOF;
}

function send_user_to_user_homepage()
{
  $url = 'index.php';

  header('Location: '.$url);

  output_html5_header(
    'Login Successful',
    array( "css/common.php")
  );

echo <<<ZZEOF
  <div id="content-message-only">
    <p>Click <a href="$url">here</a> to continue.</p>
  </div>
ZZEOF;

  output_page_footer();

  output_html5_footer();
  exit(0);
}

function send_user_to_login_page($html_msg)
{
  $url = 'login.php';

  header('Location: '.$url);

  $_SESSION['login.php-errormsg'] = $html_msg;

  output_html5_header(
    'Login Unsuccessful',
    array( "css/common.php")
  );

echo <<<ZZEOF
  <div id="content-message-only">
    <p>Click <a href="$url">here</a> to continue.</p>
  </div>
ZZEOF;

  output_page_footer();

  output_html5_footer();
  exit(0);
}

function message($nature, $message){
	if ($nature=="good")
		echo '<div class="alert alert-success"><strong>Well done!</strong>'.$message.'</div>';
	else if ($nature=="bad")
		echo '<div class="alert alert-danger"><strong>Sorry.</strong>'.$message.'</div>';
}

function check_words($string){
	$regex = '/\A([A-Za-z]{1,32})\z/';
	if (preg_match($regex, $string) == 1)
		return TRUE;
	else
		return FALSE;
}

function check_email($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function html_special_chars($string){
	$patterns = array();
	$patterns[0] = '/&amp;/';
	$patterns[1] = '/&quot;/';
	$patterns[2] = '/&lt;/';
	$patterns[3] = '/&gt;/';
	$patterns[4] = '/&apos;/';
	
	$replace = array();
	$replace[0] = '&';
	$replace[1] = '"';
	$replace[2] = '<';
	$replace[3] = '>';
	$replace[4] = '\'';
	
	$new = preg_replace($patterns, $replace, $string);

	return $new;
}

function check_number($value){
	$regex = '/\A([0-9]{1,5})\z/';
	if (preg_match($regex, $value) == 1)
		return TRUE;
	else
		return FALSE;
}

function total($cart){
	
	$subtotal=0;
	  
	foreach ($cart as $prod){	
		$product = db_get_product_by_id($prod['item#']);
		$quantity = $prod['quantity'];
		$subtotal = $subtotal  + ($product['price']* $quantity);
	}
	
	return $subtotal;
}

?>
