<?php
    
    require "libs/functions.php";  

    $id = $_GET["id"];
    $result = getOyunId($id);
    $secilioyun = mysqli_fetch_assoc($result);    

    $kategoriler = getkategoriler();
    $secilmisKategoriler = getOyunKategorileri($id);

    if ($_SERVER["REQUEST_METHOD"]=="POST") {

        $isim = $_POST["title"];
        $frame = control_input($_POST["frame"]);
        $ozet = control_input($_POST["ozet"]);
        $pp = $_POST["anapp"];
        $url = $_POST["url"];
        $kategoriler = $_POST["kategoriler"];

        if (!empty($_FILES["anapp"]["name"])) {
            $result = fotoKaydet($_FILES["anapp"]);

            if($result["isSuccess"] == 1) {
                $imageUrl = $result["image"];
            }
        }

        if (editOyun($id, $isim, $ozet,$frame, $pp, $url,$kategoriler,$imageUrl)) {
            
            $_SESSION['message'] = $isim." isimli oyun güncellendi.";
            $_SESSION['type'] = "success";

            header('Location: gameTemplateAdmin.php');
        } else {
            echo "hata";
        }
    
    }
?>

<?php include "views/_header.php" ?>


<div class="container my-3">

    <div class="card1 text-light">
           
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    
                    <div class="col-9">

                        <div id="edit-form">

                                <div class="mb-3">
                                    <label for="title" class="form-label">Oyun İsmi</label>
                                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $secilioyun["oyun_ismi"]?>">
                                </div>

                                <div class="mb-3">
                                    <label for="frame" class="form-label">Frame</label>
                                    <textarea name="frame" id="frame" class="form-control"><?php echo $secilioyun["frame"]?></textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="ozet" class="form-label">Özet</label>
                                    <textarea name="ozet" cols="30" rows="10" id="ozet" class="form-control"><?php echo $secilioyun["ozet"]?></textarea>
                                </div>
     
                                <div class="mb-3">
                                    <label for="anapp" class="form-label">Ana Fotoğraf</label>
                                    <input type="file"  name="anapp" id="anapp" class="form-control" >
                                </div>

                                <div class="mb-3">
                                    <label for="url" class="form-label">url</label>
                                    <input type="text" class="form-control" name="url" id="url" value="<?php echo $secilioyun["url"]?>">
                                </div> 

                                <input type="submit" value="Düzenle" class="btn btn-outline-primary">

                            
                        </div>

                    </div>   

                    <div class="col-3">
                                    
                        <?php foreach ($kategoriler as $k): ?>
                            <div class="form-check">
                                <label for="category_<?php echo $k["kategori_id"]?>"><?php echo $k["kat_ismi"]?></label>
                                <input type="radio" name="kategoriler"
                                id="category_<?php echo $k["kategori_id"]?>" 
                                class="form-check-input" 
                                value="<?php echo $k["kategori_id"]?>" 
                                
                                    <?php
                                        $isChecked = false;

                                        foreach ($secilmisKategoriler as $s) {
                                            if ($s["kategori_id"] == $k["kategori_id"]) {
                                                $isChecked = true;
                                            }
                                        }

                                        if($isChecked) {
                                            echo "checked";
                                        }                                
                                    
                                    ?>
                                
                                
                                
                                >
                            </div>
                        <?php endforeach; ?>

                        <hr>
  

                        <hr>
                        <input type="hidden" name="anapp" value="<?php echo $secilioyun["anapp"]?>">
                        <img class="img-fluid" src="photos/<?php echo $secilioyun["anapp"]?>" alt="">
                                            
                    </div> 
                
                </div>
            </form>

        </div>
    </div>
</div>


<?php include "views/_footer.php" ?>

