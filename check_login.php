<?php
function check_login(){
    if(isset($_COOKIE['user'])){
        return true;
    }
    else{
        return false;
    }
}
?>