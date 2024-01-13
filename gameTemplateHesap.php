<?php

require "views/_header.php";


?>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card1">
                <div class="card-body">
                <h2 class="text-light">Profil Fotoğrafınız</h2>
                <img src="/GameTemplate/Photos/backoyun.jpeg" class="img-thumbnail mb-3" alt="Profil Fotoğrafı">
                <h4 class="text-light">Toplam İnceleme : 3 </h4>
                
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card1">
                <div class="card-header"><h2 class="text-light">Kullanıcı Bilgileri</h2></div>
                <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4 class="text-light">Kullanıcı Adı : </h4>
                    </div>
                    <div class="col-8">
                        <h4 class="text-danger"><?php echo $_SESSION["username"]?></h4>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<?php
require "views/_footer.php";
?>