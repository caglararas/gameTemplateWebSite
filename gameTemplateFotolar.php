<?php
    require "libs/functions.php";  

    
    $foto1_err = $foto2_err = $foto3_err = $foto4_err = $foto5_err = "";
    $id = $_GET["id"];
    $result = getOyunId($id);
    $secilioyun = mysqli_fetch_assoc($result);
   
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $oyunid = $_POST["id"];  
        if (empty($_FILES["foto1"]["name"])) {
            $foto1_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["foto1"]);

            if($result["isSuccess"] == 0) {
                $foto1_err = $result["message"];
            } else {
                $image1 = $result["image"];
            }
        }

        if (empty($_FILES["foto2"]["name"])) {
            $foto2_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["foto2"]);

            if($result["isSuccess"] == 0) {
                $foto2_err = $result["message"];
            } else {
                $image2 = $result["image"];
            }
        }

        if (empty($_FILES["foto3"]["name"])) {
            $foto3_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["foto3"]);

            if($result["isSuccess"] == 0) {
                $foto3_err = $result["message"];
            } else {
                $image3 = $result["image"];
            }
        }
        if (empty($_FILES["foto4"]["name"])) {
            $foto4_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["foto4"]);

            if($result["isSuccess"] == 0) {
                $foto4_err = $result["message"];
            } else {
                $image4 = $result["image"];
            }
        }
        if (empty($_FILES["foto5"]["name"])) {
            $foto5_err = "dosya seçiniz";
        } else {
            $result = fotoKaydet($_FILES["foto5"]);

            if($result["isSuccess"] == 0) {
                $foto5_err = $result["message"];
            } else {
                $image5 = $result["image"];
            }
        }
            if (fotoEkle( $image1,$image2,$image3,$image4,$image5,$oyunid)) {
                
                header('Location: gameTemplateAdmin.php');
            } else {
                echo "hata";
            }
        }      
     
    
    include "views/_header.php";
?>


<div class="container my-3">

    <div class="row">
        
        <div class="col-12">

           <div class="card1 text-light">
           
                <div class="card-body">
                    <form  method="POST" enctype="multipart/form-data">
  


                        <div class="mb-3">
                            <label for="foto1" class="form-label">Slider 1 Foroğraf</label>
                            <input type="file"  name="foto1" id="foto1" class="form-control bg-dark text-light <?php echo (!empty($foto1_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $foto1_err?></span>
                        </div>
                        <div class="mb-3">
                            <label for="foto2" class="form-label">Slider 2 Foroğraf</label>
                            <input type="file"  name="foto2" id="foto2" class="form-control bg-dark text-light <?php echo (!empty($foto2_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $foto2_err?></span>
                        </div>        
                        <div class="mb-3">
                            <label for="foto3" class="form-label">Slider 3 Foroğraf</label>
                            <input type="file"  name="foto3" id="foto3" class="form-control bg-dark text-light <?php echo (!empty($foto3_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $foto3_err?></span>
                        </div>        
                        <div class="mb-3">
                            <label for="foto4" class="form-label">Slider 4 Foroğraf</label>
                            <input type="file"  name="foto4" id="foto4" class="form-control bg-dark text-light <?php echo (!empty($foto4_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $foto4_err?></span>
                        </div>        
                        <div class="mb-3">
                            <label for="foto5" class="form-label">Slider 5 Foroğraf</label>
                            <input type="file"  name="foto5" id="foto5" class="form-control bg-dark text-light <?php echo (!empty($foto5_err)) ? 'is-invalid':'' ?>" >
                            <span class="invalid-feedback"><?php echo $foto5_err?></span>
                        </div> 
                        <div class="mb-3">
                            <label for="id" class="form-label">İd</label>
                            <input type="text" class="form-control bg-dark text-light" value="<?php echo $secilioyun["oyun_id"]?>" name="id" id="id">
                        </div>                                       

                        <input type="submit" value="Submit" class="btn btn-outline-danger">
                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>


<?php include "views/_footer.php" ?>

