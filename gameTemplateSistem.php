<?php
    require "libs/functions.php";  

    
    $id = $_GET["id"];
    $result = getOyunId($id);
    $secilioyun = mysqli_fetch_assoc($result);   
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        

        $id = $_POST["id"];
        $dil = $_POST["dil"];
        $isletim = $_POST["isletim"];
        $ekran = $_POST["ekran"];
        $islemci = $_POST["islemci"];
        $x = $_POST["x"];
        $ram = $_POST["ram"];
        $hdd = $_POST["hdd"];
        $oyunid = $_POST["oyun"];
            if (sistemEkle($id,$dil,$isletim , $ekran, $islemci, $x,$ram,$hdd,$oyunid)) {
                $_SESSION['message'] = $oyunid." İdli oyuna sistem gereksinimleri eklendi";
                $_SESSION['type'] = "success";
                
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
                            <label for="id" class="form-label">İd</label>
                            <input type="text" class="form-control bg-dark text-light" name="id" id="id">
                        </div>
                        <div class="mb-3">
                            <label for="dil" class="form-label">Dil</label>
                            <input type="text" class="form-control bg-dark text-light" name="dil" id="dil">
                        </div>
                        <div class="mb-3">
                            <label for="isletim" class="form-label">İşletim Sistemi</label>
                            <input type="text" class="form-control bg-dark text-light" name="isletim" id="isletim">
                        </div>  
                        <div class="mb-3">
                            <label for="ekran" class="form-label">Ekran Kartı</label>
                            <input type="text" class="form-control bg-dark text-light" name="ekran" id="ekran">
                        </div> 
                        <div class="mb-3">
                            <label for="islemci" class="form-label">İşlemci</label>
                            <input type="text" class="form-control bg-dark text-light" name="islemci" id="islemci">
                        </div> 
                        <div class="mb-3">
                            <label for="x" class="form-label">Dirext x</label>
                            <input type="text" class="form-control bg-dark text-light" name="x" id="x">
                        </div> 
                        <div class="mb-3">
                            <label for="ram" class="form-label">RAM</label>
                            <input type="text" class="form-control bg-dark text-light" name="ram" id="ram">
                        </div> 
                        <div class="mb-3">
                            <label for="hdd" class="form-label">Depolama</label>
                            <input type="text" class="form-control bg-dark text-light" name="hdd" id="hdd">
                        </div>
                        <div class="mb-3">
                            <label for="oyun" class="form-label">Oyun İd</label>
                            <input type="text" class="form-control bg-dark text-light"  name="oyun" id="oyun" value="<?php echo $secilioyun["oyun_id"]; ?>">
                        </div>  
                                  

                        <input type="submit" value="Submit" class="btn btn-outline-danger">
                    
                    </form>
                </div>
            </div>

        </div>    
    
    </div>

</div>


<?php include "views/_footer.php" ?>

