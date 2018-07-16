<?php
if(isset($_COOKIE['user'])){

}
else{
    header( "location: index.php" );
    exit(0);
}
?>