<?php

function do_page_prerequisites()
{
  session_start();
}

function output_html5_header($title, 
  $css = array(), $js = array())
{
  do_page_prerequisites();
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

function output_html5_footer()
{
  echo <<<ZZEOF
</body>
</html>
ZZEOF;
}

function output_page_header()
{
  echo <<<ZZEOF
<div id="header">HEADER</div>
ZZEOF;
}

function output_page_menu()
{
  $login = array();
  if (is_user_logged_in())
  {
    $login['url'] = 'logout.php';
    $login['label'] = 'Logout';
  }
  else
  {
    $login['url'] = 'login.php';
    $login['label'] = 'Login';
  }

  echo <<<ZZEOF
<div id="menu">MENU
  <ul>
    <li><a href="main.php">Home</a></li>
    <li><a href="{$login['url']}">{$login['label']}</a></li>
    <li><a href="contactus.php">Contact Us</a></li>
    <li><a href="aboutus.php">About Us</a></li>
  </ul>
</div>
ZZEOF;
}

function output_home_page_content()
{
  echo <<<ZZEOF
<div id="content">HOME PAGE CONTENT</div>
ZZEOF;
}

function output_login_page_content()
{
  echo <<<ZZEOF
<div id="content">LOGIN PAGE CONTENT
ZZEOF;

  if (isset($_SESSION['login.php-errormsg']))
  {
    $html_msg = $_SESSION['login.php-errormsg'];
    echo <<<ZZEOF
<div id="login-error">$html_msg</div>
ZZEOF;
  }

  echo <<<ZZEOF
<form action="trylogin.php" method="POST">
  <fieldset>
    <label>UserID: <input type="text" name="userid" /></label><br />
    <label>Password: <input type="password" name="pass" /></label><br />
    <input type="submit" value="Login" />
  </fieldset>
</form>
</div>
ZZEOF;
}

function output_page_content()
{
  echo <<<ZZEOF
<div id="content">CONTENT</div>
ZZEOF;
}

function output_page_footer()
{
  echo <<<ZZEOF
<div id="footer">footer</div>
ZZEOF;
}

function is_valid_user_and_pass($userid, $pass)
{
  if ($userid == 'admin' && $pass == 'abc123')
    return TRUE;
  else
    return FALSE;
}


function is_user_logged_in()
{
  return isset($_SESSION['logged_in_user']);
}

function user_logged_in()
{
  if (isset($_SESSION['logged_in_user']))
    return $_SESSION['logged_in_user'];
  else
    return FALSE;
}

function log_user_in($userid)
{
  $_SESSION['logged_in_user'] = $userid;
  unset($_SESSION['login.php-errormsg']);
}

function logout_user()
{
  unset($_SESSION['logged_in_user']);
  unset($_SESSION['login.php-errormsg']);
}

function send_user_to_user_homepage()
{
  $url = 'main.php';

  header('Location: '.$url);

  output_html5_header(
    'Login Successful',
    array( "css/common.php")
  );

  output_page_header();

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

  output_page_header();

echo <<<ZZEOF
  <div id="content-message-only">
    <p>Click <a href="$url">here</a> to continue.</p>
  </div>
ZZEOF;

  output_page_footer();

  output_html5_footer();
  exit(0);
}


?>
