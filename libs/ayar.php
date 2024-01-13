<?php

$connection = mysqli_connect('localhost','root','','GameTemplate');
if(!$connection){
    die("Bağlantı Hatası : ".mysqli_connect_errno());
}

?>