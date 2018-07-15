<?php
require_once('check_login.php');
if(check_login()){

}
else{
    header( "location: index.php" );
    exit(0);
}
?>