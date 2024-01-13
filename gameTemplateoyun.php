<?php

    
    include "libs/functions.php";  
    $id = $_GET["id"];
    if(!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
        header('Location: gameTemplate.php');
    }

    $result = getOyunId($_GET["id"]);
    $oyun = mysqli_fetch_assoc($result);
    $result2 = getSistem($id);
    $sistem = mysqli_fetch_assoc($result2);
    $k = getOyunKategorileri($id);
    $kat = mysqli_fetch_assoc($k);
    $result3 = getFoto($id);
    if(!$oyun) {
        header('Location: gameTemplate.php');
    }

?>
<?php

require 'views/_header.php';

?>

    <div class="container">
        <div class="card1">
        <h2 class="text-center mb-5 pt-5" style="color: white;"><?php echo $oyun["oyun_ismi"];?></h2>
    </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card1 mt-3">
                        <div class="card-header">
                    <h5 class="text-white">MİNİMUM SİSTEM GEREKSİNİMLERİ</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li class="text-white">
                            <strong>Oyun Dili: &#160</strong><?php echo $sistem["dil"];?>
                        </li>
                        <li class="text-white">
                            <strong>Oyun Türü: &#160</strong><?php echo $kat["kat_ismi"];?>
                        </li>
                        <li class="text-white">
                            <strong>İşletim Sistemi: &#160</strong> <?php echo $sistem["isletim_sistemi"];?>
                        </li>
                        <li class="text-white">
                           <strong>Ekran Kartı: &#160</strong><?php echo $sistem["ekran_kart"];?>
                        </li>
                        <li class="text-white">
                            <strong>İşlemci: &#160</strong><?php echo $sistem["islemci"];?>
                        </li>
                        <li class="text-white">
                          <strong>DirectX: &#160</strong><?php echo $sistem["directx"];?>
                        </li>
                        <li class="text-white">
                          <strong>RAM: &#160</strong><?php echo $sistem["ram"];?>
                        </li>
                        <li class="text-white">
                            <strong>HDD: &#160</strong><?php echo $sistem["depolama"];?>
                        </li>
                    </ul>
                </div>
                </div>
                    <div class="card1 mt-3 py-3">
                        <iframe class="m-auto" width="400" height="280" src="<?php echo $oyun["frame"];?> " title="YouTube video player " frameborder="0 " allow="accelerometer; autoplay; clipboard-write; encrypted-media;gyroscope; picture-in-picture " allowfullscreen></iframe>
                        <hr>
                    </div>
                </div>
                <hr class="d-sm-none ">
                <div class="col-lg-7 ">
                    <div class="card1 mt-3">
                        <div class="card-header">
                    <h4 style="color:white; display: inline;">OYUN HİKAYESİ</h4>
                </div>
                <div class="card-body">
                    <p> <?php echo $oyun["ozet"];?></p>
                        <h5 class="text-white text-center">Oyun İçi Görüntüler</h5>
                        <div id="carouselExampleCaptions" class="carousel slide slider-w mx-auto" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <?php $foto1 = mysqli_fetch_assoc($result3); ?>
                                <img src="Photos/<?php echo $foto1["foto"]; ?>" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                              </div>
                              <?php $x=0; ?>
                              <?php while($foto = mysqli_fetch_assoc($result3)): ?>
                              <div class="carousel-item">
                                <img src="Photos/<?php echo $foto["foto"]; ?>" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block">
                                </div>
                              </div>
                              <?php $x++;
                              if($x==3){
                              break;
                              }?>
                              <?php endwhile; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                </div>
               
            </div>
        </div>
        <hr class="bg-light">
</div>
</div>
           <?php
           require 'views/_footer.php';
           ?>
                        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/3798988652.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>