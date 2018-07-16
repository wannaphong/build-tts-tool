<?php
$idcorpus=$_GET["id"];
require("db.php");
$datas = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));
?>
<table border="1">
<tr>
    <th>ID</th>
    <th>TEXT</th>
    <th>READ</th>
    <th>อัดเสียง</th>
  </tr>
<?php
foreach($datas as $data) {
?>
<tr>
 <td><?php echo $data["id"]; ?></td>
 <td><?php echo $data["txt"]; ?></td>
 <td><?php echo $data["txt_read"]; ?></td>
 <td><a href="savevoice.php?id=<?php echo $data["id"]; ?>">คลิก</a></td>
</tr>
<?php
}
?>
</table>