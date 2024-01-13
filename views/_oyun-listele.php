<?php  

    $kategoriid = "";
    $klavye = "";
    $page = 1;

    if(isset($_GET["categoryid"]) && is_numeric($_GET["categoryid"])) $kategoriid = $_GET["categoryid"];
    if(isset($_GET["q"])) $klavye = $_GET["q"];
    if(isset($_GET["page"]) && is_numeric($_GET["page"])) $page = $_GET["page"];

    $result = getOyunFiltresi($kategoriid, $klavye, $page);
    
?>

<?php if (mysqli_num_rows($result["data"]) > 0): ?>

    <?php while($oyun = mysqli_fetch_assoc($result["data"])): ?>
                    
                    <div class="card1 solcol  mb-4">
                        <img src="Photos/<?php echo $oyun["anapp"]?>"  class="img-thumbnail card-img-top"  alt="<?php echo $oyun["oyun_ismi"]?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $oyun["oyun_ismi"]?></h4>
                            <p class="card-text"><?php echo kisaAciklama($oyun['ozet'],300);?></p>
                            <a href="gameTemplateoyun.php?id=<?php echo $oyun["oyun_id"]?>" class="btn btn-secondary">Daha Fazlası...</a>
                        </div>
                        <div class="card-footer text-muted">Yüklenme tarihi <?php echo $oyun["yuklenme"]?></div>
                    </div>
                    <?php endwhile; ?>



<?php else: ?>

    <div class="alert alert-danger">
        Kategoriye ait olan oyun bulunamadı.
    </div>

<?php endif; ?>

<?php if ($result["total_pages"] > 1): ?>

<nav aria-label="Page navigation example">
  <div class="btn-group">
    <?php for ($x = 1; $x <= $result["total_pages"]; $x++): ?>
       <a class="btn btn-danger <?php if($x == $page) echo "active" ?>" href="
        
            <?php
                $url = "?page=".$x;

                if(!empty($kategoriid)) {
                    $url .= "&categoryid=".$kategoriid;
                }

                if(!empty($klavye)) {
                    $url .= "&q=".$klavye;
                }          
                echo $url;
            
            ?>
        
        
        
        
        "><?php echo $x;?></a>
    <?php endfor; ?>    
            </div>
</nav>

<?php endif; ?>