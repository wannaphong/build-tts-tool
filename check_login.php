<?php
require('db.php');
function check_login() {
if(isset($_COOKIE['user'])){
    require_once('cryptor.php');
    $id= Cryptor::doDecrypt($_COOKIE['user']);
    $data = $database->select("member",array("name","id"),array('id[=]' =>$id));
    if($data){
        return true;
    }
    else{
        return false;
    }
}
else{
    return false;
}
}
?>