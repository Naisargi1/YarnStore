<?php

require_once('lib/lib.php');
do_page_prerequisites();

if (!(
  count($_POST) == 2
  && array_key_exists('userid', $_POST)
  && array_key_exists('pass', $_POST)
))
{
  do_http_redirect('login.php');
  exit(0);
}

$userid = trim($_POST['userid']);
$pass = trim($_POST['pass']);

if (is_valid_user_and_pass($userid, $pass))
{
  log_user_in($userid);
  send_user_to_user_homepage();
}
else
{
  logout_user();
  send_user_to_login_page(
    "Invalid user name and/or password."
  );
}

?>
