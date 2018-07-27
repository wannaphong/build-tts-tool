<?php

require_once 'template.php';
include("setting.php");

// Initialize object
$tpl = new template('index.tp');

$tpl->set('name', 'หน้าหลัก');
$tpl->set('web', $web);
$tpl->set('head',$head);
$tpl->set('content', '<div class="container-fluid"><h1>'.$web.'</h1><hr></div>');
if(isset($_COOKIE['user'])){
    $tpl->set('menu-1',$menu1);
    $tpl->set('login-out',$menulogout);
}
else{
    $tpl->set('menu-1','');
    $tpl->set('login-out','<i class="fa fa-fw fa-sign-in"></i><a href="login.html" class="pure-menu-link">เข้าสู่ระบบ</a>');
}
// Set {header} as a header.tpl file
//$tpl->set('header', $tpl->getFile('header.tpl'));

// Render the template
$tpl->render();
?>