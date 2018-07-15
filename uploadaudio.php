<?php
require('settimezone.php');
if(isset($_COOKIE['user'])){
    // Upload and Rename File
    //print_r($_FILES); //this will print out the received name, temp name, type, size, etc.
    if (is_uploaded_file($_FILES['audio_data']['tmp_name'])) {
        require('db.php');
        require_once('cryptor.php');
        $id= Cryptor::doDecrypt($_COOKIE['user']);
        $input = $_FILES['audio_data']['tmp_name']; //get the temporary name that PHP gave to the uploaded file
        //$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea 
        //move the file from temp name to local folder using $output name
        $target_dir = __DIR__.'/voice/';
        $newfile=$target_dir.$id.'_'.date("Y_m_d_H_i_s").'.wav';
        if (move_uploaded_file($input,$newfile )) {
            echo "The file ".  " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }       
        $database->insert('corpus', [
            'id_user'=>$id,
            'path'=>$target_dir.$output,
            //'id_txt' => $license,
            'date_save' => date("Y-m-d H:i:s"),
            'is_use'=>0
        ]);
    }
    else{
        echo 'error';
        }
}
?>