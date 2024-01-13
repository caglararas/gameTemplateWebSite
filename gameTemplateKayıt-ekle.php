<?php
    require "libs/functions.php";  

    $isim = $ozet = $kategori = $anapp = "";
    $isim_err = $ozet_err = $kategori_err = $anapp_err = "";

    $kategoriler = getKategoriler();

    if ($_SERVER["REQUEST_METHOD"]=="POST") {


        $input_isim = trim($_POST["isim"]);

        if(empty($input_isim)) {
            $title_err = "Oyun İsmi boş geçilemez.";
        } else if (strlen($input_isim) > 150) {
            $title_err = "Oyun ismi için çok fazla karakter girdiniz.";
        }
        else {
            $isim = control_input($input_isim);
        }


        $input_ozet = trim($_POST["ozet"]);

        if(empty($input_ozet)) {
            $ozet_err = "Özet boş geçilemez.";
        } else if (strlen($input_ozet) < 10) {
            $ozet_err = "Özet için çok az karakter girdiniz.";
        }
        else {
            $ozet = control_input($input_ozet);
        }

        if (empty($_FILES["anapp"]["name"])) {
            $image_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["anapp"]);

            if($result["isSuccess"] == 0) {
                $image_err = $result["message"];
            } else {
                $image = $result["image"];
            }
        }


        $id = $_POST["id"];
        $frame = $_POST["frame"];
        $url = $_POST["url"];
        $yuklenme = $_POST["yukle"];
        $kategoriler = $_POST["kategoriler"];
        if(empty($isim_err) && empty($ozet_err)) {
            if (oyunEkle($id,$isim,$frame , $ozet, $image, $url,$yuklenme,$kategoriler)) {
                $_SESSION['message'] = $isim." isimli oyun eklendi";
                $_SESSION['type'] = "success";
                
                header('Location: gameTemplateAdmin.php');
            } else {
                echo "hata";
            }
        }      
     
    }
    include "views/_header.php";
?>


<div class="container my-3">

    <div class="row">
        
        <div class="col-12">

           <div class="card1 text-light">
           
                <div class="card-body">
                    <form action="gameTemplateKayıt-ekle.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                            <label for="id" class="form-label">İd</label>
                            <input type="text" class="form-control bg-dark text-light" name="id" id="id">
                        </div>
                        <div class="mb-3">
                            <label for="isim" class="form-label">Oyun İsmi</label>
                            <input type="text" name="isim" id="isim" class="form-control bg-dark text-light <?php echo (!empty($isim_err)) ? 'is-invalid':'' ?>" value="<?php echo $isim;?>">
                            <span class="invalid-feedback"><?php echo $isim_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="frame" class="form-label">Frame</label>
                            <textarea name="frame" id="frame" class="form-control bg-dark text-light"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="ozet" class="form-label">Özet</label>
                            <textarea name="ozet" id="ozet" class="form-control bg-dark text-light <?php echo (!empty($ozet_err)) ? 'is-invalid':'' ?>"><?php echo $ozet;?></textarea>
                            <span class="invalid-feedback"><?php echo $ozet_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="anapp" class="form-label">Ana Foroğraf</label>
                            <input type="file"  name="anapp" id="anapp" class="form-control bg-dark text-light <?php echo (!empty($anapp_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $anapp_err?></span>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">url</label>
                            <input type="text" class="form-control bg-dark text-light" name="url" id="url">
                        </div>  
                        <div class="mb-3">
                            <label for="yukle" class="form-label">Yüklenme Tarihi</label>
                            <input type="text" class="form-control bg-dark text-light" name="yukle" id="yukle">
                        </div> 
                        <?php foreach ($kategoriler as $k): ?>
                            <div class="form-check">
                                <label for="category_<?php echo $k["kategori_id"]?>"><?php echo $k["kat_ismi"]?></label>
                                <input type="radio" name="kategoriler"
                                id="category_<?php echo $k["kategori_id"]?>" 
                                class="form-check-input" 
                                value="<?php echo $k["kategori_id"]?>">       
                            </div>

                        <?php endforeach; ?>                                             

                        <input type="submit" value="Submit" class="btn btn-outline-danger">
                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>


<?php include "views/_footer.php" ?>

