<?php
setcookie("user", "", time() - 3600);
unset ($_COOKIE['user']);
?>
<?php
if(count($_COOKIE) > 0) {
    echo "Cookies are enabled.";
} else {
    echo "Cookies are disabled.";
}
?>