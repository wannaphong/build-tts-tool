<?php
require("db.php");
$datas = $database->select("corpus","*");
?>
<table border="1">
<tr>
    <th>ID</th>
    <th>NAME</th>
    <th>TEXT</th>
    <th>อัดเสียง</th>
  </tr>
<?php
foreach($datas as $data) {
?>
<tr>
 <td><?php echo $data["id"]; ?></td>
 <td><?php echo $data["name"]; ?></td>
 <td><?php echo $data["txt"]; ?></td>
 <td><a href="listtext.php?id=<?php echo $data["id"]; ?>">คลิก</a></td>
</tr>
<?php
}
?>
</table>