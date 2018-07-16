<?php
//require_once('block_not_login.php');
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
require('db.php');
$text = $_POST['text'] = isset($_POST['text']) ? $_POST['text'] : '';
$text_read = $_POST['text_read'] = isset($_POST['text_read']) ? $_POST['text_read'] : '';
$id=$_POST['id'] = isset($_POST['id']) ? $_POST['id'] : '';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
</head>
<body>
<?php
if($text!=''){
    $database->insert('textcorpus', [
        'txt'=>$text,
        'txt_read' => $text_read,
        'idcorpus' => $id
    ]);
    echo $text;
    echo '<br>';
}
?>
<form action="addtxt.php" method="post">
text: <input type="text" name="text"><br>
คำอ่าน: <input type="text" name="text_read"><br>
คลังข้อมูล: <select name="id">
<?php
$data = $database->select("corpus",'*');
foreach ($data as $value) {
    if($iduser==$value['id_user']){
        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
    }
}
?>
</select><br>
<input type="submit">
<input type="reset">
</form>
</body>
</html>