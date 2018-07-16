<?php
require('block_not_login.php');
require("db.php");
$datas = $database->select("corpus","*");
?>
<table border="1">
<tr>
    <th>ID</th>
    <th>NAME</th>
    <th>TEXT</th>
    <th>อัดเสียง</th>
    <th>ไฟล์กำกับ</th>
    <th>ไฟล์เสียง</th>
  </tr>
<?php
foreach($datas as $data) {
?>
<tr>
 <td><?php echo $data["id"]; ?></td>
 <td><?php echo $data["name"]; ?></td>
 <td><?php echo $data["txt"]; ?></td>
 <td><a href="listtext.php?id=<?php echo $data["id"]; ?>">คลิก</a></td>
 <td><a href="download.php?id=<?php echo $data["id"]; ?>">โหลดไฟล์</a></br></td>
 <td><a href="downloadvoice.php?id=<?php echo $data["id"]; ?>">โหลดไฟล์</a></br></td>
</tr>
<?php
}
?>
</table>