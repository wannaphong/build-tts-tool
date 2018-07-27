<?php
require_once 'template.php';
include("setting.php");
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idcorpus=$_GET["id"];
require("db.php");
$data_c = $database->select("corpus","*",array('AND' =>array('id[=]' =>$idcorpus,'id_user[=]'=>$iduser)));
$datas = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));
$listall='
<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">หน้าหลัก</a>
        </li>
        <li class="breadcrumb-item"><a href="corpus.php">คลังข้อมูล</a></li>
        <li class="breadcrumb-item active">รายการคลังข้อมูล
        </li>
</ol>
';
  if($data_c[0]!="")$listall.='
    <a href="addtxt.php">เพิ่มข้อมูลลงคลัง</a>';
    $listall.='
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
 <td><a href="tt.php?id='.$data["id"].'">คลิก</a></td>
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
$tpl->set('name', 'รายการคลังข้อมูล');
$tpl->set('web', $web);
$tpl->set('content', $listall);
$tpl->set('menu-1',$menu1);
$tpl->set('login-out',$menulogout);
$tpl->set('head',$head);
// Set {header} as a header.tpl file
//$tpl->set('header', $tpl->getFile('header.tpl'));

// Render the template
$tpl->render();
?>