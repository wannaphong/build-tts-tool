<?php
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idcorpus=$_GET["id"];
require("db.php");

$txtall = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="'.$idcorpus.'.csv"');

$fp = fopen('php://output', 'w');
foreach ($txtall as $line ) {
    $datas0 = $database->select("voice","*",array('AND' => array('id_user[=]' =>$iduser,'is_use[=]'=>true, 'id_txt[=]'=>$line["id"])));
    if($datas0){
        fputcsv($fp, array($datas0[0]['path'],$line['txt'],$line['txt_read']));
    }
}
fclose($fp);
?>