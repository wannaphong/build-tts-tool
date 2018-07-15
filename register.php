<?php
require('db.php');
require_once('settimezone.php');
require_once("keyhash.php");

$name = $_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$password = $_POST['password'] = isset($_POST['password']) ? $_POST['password'] : '';
$email = $_POST['email'] = isset($_POST['email']) ? $_POST['email'] : '';
$address = $_POST['address'] = isset($_POST['address']) ? $_POST['address'] : '';
$phone =  $_POST['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
if($name!=''&&$password!=''&&$email!=''){
    $database->insert('member', [
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