<?php
require_once 'template.php';
include("setting.php");

require('block_not_login.php');
require("db.php");
$datas = $database->select("corpus","*");


// Initialize object
$tpl = new template('index.tp');

$listall='
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">หน้าหลัก</a>
        </li>
        <li class="breadcrumb-item active">คลังข้อมูล</li>
</ol>
<a href="newcorpus.php">เพิ่มคลังข้อมูล</a><br>
<table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
<tr>
    <th>NAME</th>
    <th>TEXT</th>
    <th>อัดเสียง</th>
    <th>ไฟล์กำกับ</th>
    <th>ไฟล์เสียง</th>
  </tr>
';
foreach($datas as $data) {
  $listall.= '
<tr>
 <td>'.$data["name"].'</td>
 <td>'.$data["txt"].'</td>
 <td><a href="listtext.php?id='.$data["id"].'">คลิก</a></td>
 <td><a href="download.php?id='.$data["id"].'">โหลดไฟล์</a></br></td>
 <td><a href="downloadvoice.php?id='.$data["id"].'">โหลดไฟล์</a></br></td>
</tr>';}
$listall.='</table>';
$tpl->set('head',$head);
$tpl->set('name', 'คลังข้อมูล');
$tpl->set('web', $web);
$tpl->set('content', $listall);
$tpl->set('menu-1',$menu1);
$tpl->set('login-out',$menulogout);

// Set {header} as a header.tpl file
//$tpl->set('header', $tpl->getFile('header.tpl'));

// Render the template
$tpl->render();

/*
*/
?>