<?php
require_once('lib/lib.php');

session_unset();
session_destroy();
send_user_to_user_homepage();
?>
