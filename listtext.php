<?php
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idcorpus=$_GET["id"];
require("db.php");
$datas = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));
?>
<a href="addtxt.php">เพิ่มข้อมูลลงคลัง</a>
<table border="1">
<tr>
    <th>TEXT</th>
    <th>READ</th>
    <th>อัดเสียง</th>
    <th>สถานะ</th>
  </tr>
<?php
foreach($datas as $data) {
?>
<tr>
 <td><?php echo $data["txt"]; ?></td>
 <td><?php echo $data["txt_read"]; ?></td>
 <td><a href="savevoice.php?id=<?php echo $data["id"]; ?>">คลิก</a></td>
 <td><?php $datas0 = $database->select("voice","*",array('AND' => array('id_user[=]' =>$iduser,'is_use[=]'=>true, 'id_txt[=]'=>$data["id"])));
 if($datas0){
     echo "เรียบร้อย";
 }
 else{
     echo "ยังไม่ดำเนินการ";
 }
 ?></td>
</tr>
<?php
}
?>
</table>