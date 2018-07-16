<?php
require('block_not_login.php');
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
$idcorpus=$_GET["id"];
require("db.php");

$txtall = $database->select("textcorpus","*",array('idcorpus[=]' =>$idcorpus));
$files=array();
foreach ($txtall as $line ) {
    $datas0 = $database->select("voice","*",array('AND' => array('id_user[=]' =>$iduser,'is_use[=]'=>true, 'id_txt[=]'=>$line["id"])));
    if($datas0){
        array_push($files,'voice/'.$datas0[0]['path']);
    }
    
}
# create new zip opbject
$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach($files as $file){
    # download file
    $download_file = file_get_contents($file);
    #add it to the zip
    $zip->addFromString(basename($file),$download_file);

}
# close zip
$zip->close();

# send the file to the browser as a download
header('Content-disposition: attachment; filename='.$idcorpus.'.zip');
header('Content-type: application/zip');
readfile($tmp_file);
?>