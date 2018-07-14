<?php
require('Medoo.php');
require_once('settimezone.php');
require_once("keyhash.php");
use Medoo\Medoo;
#$user = $_POST['user'] = isset($_POST['user']) ? $_POST['user'] : '';
$name = $_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$password = $_POST['password'] = isset($_POST['password']) ? $_POST['password'] : '';
$email = $_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';
$address = $_POST['address'] = isset($_POST['address']) ? $_POST['address'] : '';
$phone =  $_POST['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
if($name!=''&&$password!=''&&$email!=''){
    $database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'tts',
        'server' => 'localhost',
        'username' => 'root',
        'password' => ''
    ]);
    $database->insert('member', [
       # 'user' => $user,
        'password'=>gotopass($password),
        'email'=>$email,
        'name' => $name,
        'email' => $email,
        'address'=>$address,
        'phone'=>$phone,
        'dateregister'=>date("Y-m-d H:i:s")
    ]);
}
else{
    echo 'Error<br>';
    echo date("Y-m-d H:i:s");
}
?>