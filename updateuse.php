<?php
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idpost=$_GET["id"];
$id_use=$_GET["idpost"];
require('db.php');
$datas = $database->update("voice",array("is_use"=>0),array('AND' => array('id_user[=]' =>$iduser, 'id_txt[=]'=> $idpost)));
$datas1 = $database->update("voice",array("is_use"=>1),array('AND' => array('id_user[=]' =>$iduser, 'id_txt[=]'=> $idpost,'id[=]'=>$id_use)));
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit(0);
?>