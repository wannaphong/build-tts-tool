<?php
require('settimezone.php');
if(isset($_COOKIE['user'])){
    //print_r($_FILES); //this will print out the received name, temp name, type, size, etc.
    if (is_uploaded_file($_FILES['audio_data']['tmp_name'])) {
        require('db.php');
        require_once('cryptor.php');
        $id_txt= explode( '.', $_FILES['audio_data']['name'])[0];
        $id= Cryptor::doDecrypt($_COOKIE['user']);
        $input = $_FILES['audio_data']['tmp_name']; //get the temporary name that PHP gave to the uploaded file
        $target_dir = __DIR__.'/voice/';
        $file_name1=$id.'_'.date("Y_m_d_H_i_s").'.wav';
        $newfile=$target_dir.$file_name1;
        if (move_uploaded_file($input,$newfile )) {
            echo "The file ".  " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }       
        $database->insert('voice', [
            'id_user'=>$id,
            'path'=>$file_name1,
            'id_txt' => $id_txt,
            'date_save' => date("Y-m-d H:i:s"),
            'is_use'=>0
        ]);
    }
    else{
        echo 'error';
        }
}
?>