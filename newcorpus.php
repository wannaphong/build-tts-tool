<?php
require('block_not_login.php');
require('db.php');
require_once 'template.php';
include("setting.php");
$name= $_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';
$text = $_POST['text'] = isset($_POST['text']) ? $_POST['text'] : '';
$license = $_POST['license'] = isset($_POST['license']) ? $_POST['license'] : '';
$author=$_POST['author'] = isset($_POST['author']) ? $_POST['author'] : '';
$url=$_POST['url'] = isset($_POST['url']) ? $_POST['url'] : '';
$language=$_POST['language'] = isset($_POST['language']) ? $_POST['language'] : '';

$tpl = new template('index.tp');
$tpl->set('name', 'เพิ่มคลังข้อมูล');
$tpl->set('web', $web);

$tpl->set('menu-1',$menu1);
$tpl->set('login-out','<i class="fa fa-fw fa-sign-out"></i><a href="logout.php" class="pure-menu-link">ลงชื่อออก</a>');
$listall="";
if($text!=''){
    require_once('cryptor.php');
    $id= Cryptor::doDecrypt($_COOKIE['user']);
    $database->insert('corpus', [
        'name'=>$name,
        'txt'=>$text,
        'license' => $license,
        'author' => $author,
        'url'=>$url,
        'language'=>$language,
        'id_user'=>$id
    ]);
    $listall.="<h2>เรียบร้อย</h2><br>";
}
    $listall.='
<form action="newcorpus.php" method="post">
name: <input type="text" name="name"><br>
text: <input type="text" name="text"><br>
license: <input type="text" name="license"><br>
author: <input type="text" name="author"><br>
url: <input type="text" name="url"><br>
language: <input type="text" name="language"><br>
<input type="submit">
<input type="reset">
</form>';
$tpl->set('content', $listall);
$tpl->render();