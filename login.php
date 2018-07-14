<?php
require_once("settimezone.php");
require('db.php');
require_once('keyhash.php');
require_once('cryptor.php');
$password = $_POST['password'] = isset($_POST['password']) ? $_POST['password'] : '';
$email = $_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';
if($email!=''&&$password!=''){
    $password=gotopass($password);
    $data = $database->select("member",array("email","name","id"),array('AND' => array('email[=]' =>$email, 'password[=]'=> $password)));
    //());
   // print $database->last_query();
     //$get= json_encode($data);
        if($data){
            $encrypted_txt    = Cryptor::doEncrypt($data[0]['id']);
           $cookie_name = "user";
            $cookie_value = $encrypted_txt;
        // echo $data[0]['id'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day*/
            echo "<br>OK<br>";
           // echo Cryptor::doDecrypt($encrypted_txt);
        }
        else{
            echo "error";
        }
}
?>