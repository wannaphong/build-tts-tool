<?php
require('block_not_login.php');
$name="user";
setcookie($name, "", time() - 3600, '/');
unset($_COOKIE[$name]);
// empty value and expiration one hour before
header("Location: index.php"); /* Redirect browser */
exit();
?>