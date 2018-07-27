<?php

require_once 'template.php';
include("setting.php");

// Initialize object
$tpl = new template('index.tp');

$tpl->set('name', 'เกี่ยวกับโครงการ');
$tpl->set('web', $web);
$tpl->set('head',$head);
$tpl->set('content', '<div class="container-fluid"><h1>เกี่ยวกับ'.$web.'</h1><hr><br><p>โครงการนี้เกิดขึ้นมาเพื่อสร้างคลังข้อมูลเสียงภาษาไทย เพื่อนำไปใช้สร้าง TTS และให้นักภาษาศาสตร์ที่สนใจสามารถนำข้อมูลไปใช้งานได้</p></div>');
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