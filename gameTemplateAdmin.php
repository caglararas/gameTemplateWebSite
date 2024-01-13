<?php
include "views/_header.php";
require "libs/functions.php";
?>
<div class="container my-3">

    <div class="row">

        <div class="col-12">

            <div class="card1 mb-1">
                <div class="card-body">
                    <a href="gameTemplateKayıt-ekle.php" class="btn btn-outline-danger">Yeni Oyun</a>
                </div>
            </div>

            <table class="table table-bordered foot text-light">
                <thead>
                    <tr>
                        <th style="width: 80px;">Ana Fotoğraf</th>
                        <th>Oyun İsmi</th>
                        <th>Yüklenme Tarihi</th>
                        <th>Kategori</th>
                        <th style="width: 130px;"></th>
                        <th style="width: 150px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $result = getOyun();  while($oyun = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <img src="Photos/<?php echo $oyun["anapp"]?>" alt="" class="img-fluid">
                            </td>
                            <td><?php echo $oyun["oyun_ismi"]?></td>
                            <td><?php echo $oyun["yuklenme"]?></td>
                            <td>
                                
                                <?php 
                                    echo "<ul>";

                                        $sonuc = getOyunKategorileri($oyun["oyun_id"]);

                                        if (mysqli_num_rows($sonuc) > 0) {
                                            while($kategori = mysqli_fetch_assoc($sonuc)) {
                                                echo "<li>".$kategori["kat_ismi"]."</li>";
                                            }
                                        } else {
                                            echo "<li>kategori seçilmedi.</li>";
                                        }

                                    echo "</ul>";                                
                                ?>              
                            
                            </td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="gameTemplateDüzenle.php?id=<?php echo $oyun["oyun_id"]?>">Düzenle</a>
                                <a class="btn btn-outline-danger btn-sm" href="gameTemplateSil.php?id=<?php echo $oyun["oyun_id"]?>">Sil</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary btn-sm" href="gameTemplateSistem.php?id=<?php echo $oyun["oyun_id"]?>">Sistem </a>
                                <a class="btn btn-outline-danger btn-sm my-2" href="gameTemplateFotolar.php?id=<?php echo $oyun["oyun_id"]?>">Fotoğraf</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            

        </div>    
    
    </div>

</div>
<?php
include "views/_footer.php";
?>