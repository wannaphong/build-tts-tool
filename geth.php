<?php
require_once("keyhash.php");
$text = $_POST['text'] = isset($_POST['text']) ? $_POST['text'] : '';
?>
<html>
<body>
<?php
if($text!=''){
    echo gotopass($text);
    echo '<br>';
}
?>
<form action="geth.php" method="post">
text: <input type="text" name="text"><br>
<input type="submit">
</form>
</body>
</html> 