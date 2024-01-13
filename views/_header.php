<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    include "libs/_vars.php";
    include "libs/_profile.php";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Template</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="gameTemplate.css">
</head>
<body class="body1">
  <nav class="navbar navbar-expand-md navbar-dark foot fixed-top navpos">
    <a href="gameTemplate.php" class="navbar-brand d-flex px-5 d-inline text-nowrap"><i class="fas fa-dice-d20"></i>&#160 Game Template</a>
        <button class="navbar-toggler sagayasla" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button>         
        <div id="navbarCollapse" class="collapse navbar-collapse">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a href="gameTemplate.php" class=" nav-link mx-1 text-nowrap">Ana Sayfa</a>
      </li>
      <a class="nav-link dropdown-toggle mx-1" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Katogoriler
      </a>
      <ul class="dropdown-menu foot" aria-labelledby="navbarDropdown">
        <?php
        $sql = 'select * from kategoriler';
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
        echo'<li><a class="dropdown-item text-white"href="gameTemplate.php?categoryid='.$row["kategori_id"].'">'.$row['kat_ismi'].'</a></li>';
        }
        ?>
      </ul>
    </li>
      <li class="nav-item ">
        <a href="gameTemplateHakkında.php" class="nav-link mx-1">Hakkında</a>
      </li>
      <?php if (isLoggedin()): ?>
        
        <li class="nav-item ">
        <a href="gameTemplateHesap.php" class="nav-link mx-1"><i class="fas fa-solid fa-user"></i>&#160<?php echo $_SESSION["username"]?></a>
        </li>
        <li class="nav-item ">
        <a href="logout.php" class="nav-link mx-1"><i class="fa-solid fa-right-to-bracket"></i> Çıkış Yap</a>
        </li>
      <?php else: ?>
        <li class="nav-item ">
        <a href="gameTemplateKayıt.php" class="nav-link mx-1">Kaydol</a>
      </li>
      <li class="nav-item ">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" class="nav-link mx-1 text-nowrap ">Oturum Aç</a>
      </li>
      <?php endif; ?>   
  </ul>
</div>
</div>
</nav>
<div class="jumbotron mb-2 pt-4 card1">
            <h1 class="text-white text-center"><i class="fas fa-dice-d20"></i>&#160 Game Template</h1>
            <hr class="bg-light">
        </div>