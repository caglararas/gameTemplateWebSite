<?php

function getOyun() {
    include "ayar.php";

    $query = "SELECT * from oyunlar";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getOyunRand() {
    include "ayar.php";
    $rand = rand(0,14);
    $query = "SELECT * from oyunlar where oyun_id = $rand";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getSistem($x){
    include "ayar.php";
    $query = "SELECT dil,isletim_sistemi,ekran_kart,islemci,directx,ram,depolama from gereksinimler where oyun_id = $x";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getFoto($x){
    include "ayar.php";
    $query = "SELECT foto from fotolar where oyun_id = $x";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result; 
}
function getOyunAna() {
    include "ayar.php";

    $query = "SELECT *,concat(left(ozet,300),'...') from oyunlar";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getOyunKategorileri($id) {
    include "ayar.php";

    $query = "SELECT k.kategori_id,k.kat_ismi from  kategoriler k INNER JOIN oyunlar o on k.kategori_id= o.kat_id  WHERE oyun_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getKategoriler() {
    include "ayar.php";

    $query = "SELECT * from kategoriler";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function control_input($data) {
    $data = htmlspecialchars($data);
    $data = stripslashes($data); 
    return $data;
}
function fotoKaydet($dosya) {
    $mesaj = "";
    $tamamlandi = 1;
    $fileTempPath = $dosya["tmp_name"];
    $fileName = $dosya["name"];
    $fileSize = $dosya["size"];
    $maxfileSize = ((1024 * 1024) * 10);
    $dosyaUzantilari = array("jpg","jpeg","png");
    $uploadFolder = "./Photos/";

    if($fileSize > $maxfileSize) {
        $mesaj = "Dosya boyutu fazla.<br>";
        $tamamlandi = 0;
    }

    $dosyaAdi_Arr = explode(".", $fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
    $dosyaUzantisi = $dosyaAdi_Arr[1];

    if(!in_array($dosyaUzantisi, $dosyaUzantilari)) {
        $mesaj .= "dosya uzantısı kabul edilmiyor.<br>";
        $mesaj .= "kabul edilen dosya uzantıları : ".implode(", ", $dosyaUzantilari)."<br>";
        $tamamlandi = 0;
    }

    $yeniDosyaAdi = md5(time().$dosyaAdi_uzantisiz).'.'.$dosyaUzantisi;
    $dest_path = $uploadFolder.$yeniDosyaAdi;

    if($tamamlandi == 0) {
        $mesaj .= "Dosya yüklenemedi.<br>";
    } else {
        if(move_uploaded_file($fileTempPath, $dest_path)) {
            $mesaj .="dosya yüklendi.<br>";
        }
    }

    return array(
        "isSuccess" => $tamamlandi,
        "message" => $mesaj,
        "image" => $yeniDosyaAdi
    );
}
function editOyun(int $id, string $isim, string $ozet, string $frame,string $anapp,string $url,int $katid,string $imageurl) {
    include "ayar.php";
    $query = "UPDATE oyunlar SET oyun_ismi='$isim',frame='$frame', ozet='$ozet',anapp='$anapp', url='$url',kat_id = $katid,anapp = '$imageurl' WHERE oyun_id=$id";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);
    return $result;
}
function getOyunId(int $oyunId) {
    include "ayar.php";
    $query = "SELECT * from oyunlar WHERE oyun_id='$oyunId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}
function oyunSil(int $id) {
    include "ayar.php";
    $query = "DELETE FROM oyunlar WHERE oyun_id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}
function oyunEkle(int $id,string $isim,string $frame, string $ozet, string $anapp,string $url,string $yuklenme,int $katid) {
    include "ayar.php";
 
    $query = "INSERT INTO oyunlar(oyun_id,oyun_ismi, frame, ozet, anapp, url,yuklenme,kat_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection,$query);
 
    mysqli_stmt_bind_param($result, 'issssssi', $id,$isim,$frame,$ozet,$anapp,$url,$yuklenme,$katid);
    mysqli_stmt_execute($result);
    mysqli_close($connection);
    return $result;
 }

 function sistemEkle(int $id,string $dil,string $isletim, string $ekran, string $islemci,string $x,string $ram,string $hdd,int $oyunid) {
    include "ayar.php";
 
    $query = "INSERT INTO gereksinimler(ger_id,dil, isletim_sistemi, ekran_kart, islemci, directx,ram,depolama,oyun_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = mysqli_prepare($connection,$query);
 
    mysqli_stmt_bind_param($result, 'isssssssi', $id,$dil,$isletim,$ekran,$islemci,$x,$ram,$hdd,$oyunid);
    mysqli_stmt_execute($result);
    mysqli_close($connection);
    return $result;
 }
 function fotoEkle(string $foto1,string $foto2,string $foto3,string $foto4,string $foto5,int $oyunid){
    include "ayar.php";
        $query = "INSERT INTO fotolar(foto,oyun_id) VALUES ('$foto1', $oyunid);";
        $query .= "INSERT INTO fotolar(foto,oyun_id) VALUES ('$foto2', $oyunid);";
        $query .= "INSERT INTO fotolar(foto,oyun_id) VALUES ('$foto3', $oyunid);";
        $query .= "INSERT INTO fotolar(foto,oyun_id) VALUES ('$foto4', $oyunid);";
        $query .= "INSERT INTO fotolar(foto,oyun_id) VALUES ('$foto5', $oyunid);";
  
    $result = mysqli_multi_query($connection,$query);
    mysqli_close($connection);
    return $result;
 }
 function getOyunFiltresi($kategoriid,$klavye, $page) {
    include "ayar.php";

    $pageCount = 4;
    $offset = ($page-1) * $pageCount; 
    $query = "";

    if(!empty($kategoriid)) {
        $query = "from oyunlar  WHERE kat_id=$kategoriid ";
    } else {
        $query = "from oyunlar ";
    }

    if(!empty($klavye)) {
        $query .= " where oyun_ismi LIKE '%$klavye%'";
    }

    $total_sql = "SELECT COUNT(*) ".$query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount);

    $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result
    );
}
function kisaAciklama($aciklama, $limit) {
    if (strlen($aciklama) > $limit) {
        echo substr($aciklama,0,$limit)."...";
    } else {
        echo $aciklama;
    };
}



?>