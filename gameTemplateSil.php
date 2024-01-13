<?php

   
    require "libs/functions.php";

    $id = $_GET["id"];

    if (oyunSil($id)) {
        $_SESSION['message'] = $id." id numaralı oyun silindi.";
        $_SESSION['type'] = "danger";
    
        header('Location: gameTemplateAdmin.php');
    } else {
        echo "hata";
    } 



?>