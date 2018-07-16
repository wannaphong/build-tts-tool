<?php
$name="user";
setcookie ($name, "", 1);
setcookie ($name, false);
unset($_COOKIE[$name]);
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
?>