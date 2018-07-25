<?php
require_once 'template.php';
include("setting.php");
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idcorpus=$_GET["id"];
require("db.php");
$datas = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));
$listall='
    <a href="addtxt.php">เพิ่มข้อมูลลงคลัง</a>
    <table class="table table-bordered dataTable" id="dataTable" role="grid" aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
    <tr>
    <th>TEXT</th>
    <th>READ</th>
    <th>อัดเสียง</th>
    <th>สถานะ</th>
  </tr>';
foreach($datas as $data) {
    $listall.='<td>'.$data["txt"].'</td>
 <td>'.$data["txt_read"].'</td>
 <td><a href="savevoice.php?id='.$data["id"].'">คลิก</a></td>
 <td>';
 $datas0 = $database->select("voice","*",array('AND' => array('id_user[=]' =>$iduser,'is_use[=]'=>true, 'id_txt[=]'=>$data["id"])));
 if($datas0){
    $listall.="เรียบร้อย";
 }
 else{
    $listall.="ยังไม่ดำเนินการ";
 }
 $listall.='</td>
</tr>';
}
$listall.='</table>';
$tpl = new template('index.tp');
$tpl->set('name', 'คลังข้อมูล');
$tpl->set('web', $web);
$tpl->set('content', $listall);
$tpl->set('menu-1',$menu1);
$tpl->set('login-out','<i class="fa fa-fw fa-sign-out"></i><a href="logout.php" class="pure-menu-link">ลงชื่อออก</a>');

// Set {header} as a header.tpl file
//$tpl->set('header', $tpl->getFile('header.tpl'));

// Render the template
$tpl->render();