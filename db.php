<?php
require('Medoo.php');
use Medoo\Medoo;
$database = new Medoo([
        'database_type' => 'mysql',
        'database_name' => 'tts',
        'server' => 'localhost',
        'username' => 'root',
        'password' => '',
        "charset" => "utf8"
    ]);
?>