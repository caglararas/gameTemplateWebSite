   <?php

   require "views/_header.php";
  include "libs/functions.php";

   ?>
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
              
              <?php
              $result = getOyunRand();
              $oyun = mysqli_fetch_assoc($result);
              ?>
            <img src="Photos/<?php echo $oyun["anapp"];?>" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $oyun["oyun_ismi"];?></h5>
              <a href="gameTemplateoyun.php?id=<?php echo $oyun["oyun_id"];?>" class="neon-button btn-lg mt-2">
                <span></span>
                <span></span>
                <span></span>
                <span></span>İnceleme</a>
            </div>
          </div>
          <?php $x=0; ?>
          <?php while($x<=3): ?>
          <?php
          $result = getOyunRand();
          $oyun = mysqli_fetch_assoc($result); ?>
          <div class="carousel-item">
            <img src="Photos/<?php echo $oyun["anapp"];?>" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $oyun["oyun_ismi"];?></h5>
              <a href="gameTemplateoyun.php?id=<?php echo $oyun["oyun_id"];?>" class="neon-button btn-lg mt-2">
                <span></span>
                <span></span>
                <span></span>
                <span></span>İnceleme</a>
            </div>
          </div>
          <?php $x++;?>
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
    
      <main class="ana-sayfa mx-auto">  
        <div class="container mt-2 ">
            <div class="row">
                <div class="col-md-8">

                <?php 
                include "views/_oyun-listele.php";

                ?>  
                 </div>
                <div class="col-md-4">
                    <div id="katogori" class="card1 sagcol">
                        <div class="card-header">
                            <h5>Arama</h5>
                        </div>
                        <div class="card-body">
                            <form action="gameTemplate.php" method="GET">
                            <div class="input-group">
                                <input type="text" placeholder="Arama..." name="q" class="form-control bg-dark text-white"><span class="input-group-btn"><button
                                 type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>
                                </button></span>
                            </div></form>
                        </div>
                    </div>
                    <div class="card1 sagcol my-2">
                        <div class="card-header"><h5>Katogoriler</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <ul class="list-unstyled">
                                    <?php
                                    $sql = 'Select * from kategoriler where kategori_id<=5';
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result))
                                 echo'<li><a class="text-white" title="'.$row['kat_ismi'].'" href="gameTemplate.php?categoryid='.$row["kategori_id"].'">'.$row['kat_ismi'].'</a></li>'
                                        ?>
                                    </ul> 
                                </div>
                                
                                <div class="col">
                                    <ul class="list-unstyled">
                                    <?php
                                    $sql = 'Select * from kategoriler where kategori_id>5';
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result))
                                 echo'<li><a class="text-white" title="'.$row['kat_ismi'].'" href="gameTemplate.php?categoryid='.$row["kategori_id"].'">'.$row['kat_ismi'].'</a></li>'
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card1 sagcol">
                        <div class="card-header"><h5>Rastgele Oyunlar</h5></div>
                        <div class="card-body">
                            <?php $x=0; ?>
                            <?php while($x<=6): ?>
                            <?php $result = getOyunRand();
                                  $oyun = mysqli_fetch_assoc($result); ?>
                            <img src="Photos/<?php echo $oyun["anapp"]; ?>" class="img-thumbnail card-img-bottom" ><br><br>
                            <h6><?php echo $oyun["oyun_ismi"]; ?></h6>
                            <a class="text-white new" title="<?php echo $oyun["oyun_ismi"]; ?>" href="gameTemplateoyun.php?id=<?php echo $oyun["oyun_id"]?>">Sayfaya git</a><hr>
                            <?php $x++;?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require "views/_login_modal.php";
            ?>


      </main>
<?php
require "views/_footer.php";
?>