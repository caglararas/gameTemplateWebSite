<?php
$kullanici1 = $email = $password = $confirm_password = "";
    $kullanici1_err = $email_err = $password_err = $confirm_password_err = "";

    include "libs/ayar.php";
    if (isset($_POST["kaydol"])) {

        // validate username
        if(empty(trim($_POST["kullanici1"]))) {
            $kullanici1_err = "Kullanıcı adı girmelisiniz.";
        } elseif (strlen(trim($_POST["kullanici1"])) < 5 or strlen(trim($_POST["kullanici1"])) > 25) {
            $kullanici1_err = "Kullanıcı adı 5-25 karakter arasında olmalıdır.";
        } elseif (!preg_match('/^[a-z\d_]{5,20}$/i', $_POST["kullanici1"])) {
            $kullanici1_err = "Kullanıcı adı sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
        } else {

            $sql = "SELECT id FROM kullanicilar WHERE k_ad = ?";

            if($stmt = mysqli_prepare($connection, $sql)) {
                $param_username = trim($_POST["kullanici1"]);
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "Kullanıcı ismi daha önce alınmış.";
                    } else {
                        $kullanici1 = $_POST["kullanici1"];
                    }
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }
            }

            
        }

        // validate email
        if(empty(trim($_POST["email"]))) {
            $email_err = "email girmelisiniz.";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email_err = "hatalı email girdiniz.";
        } else {
            $sql = "SELECT id FROM kullanicilar WHERE email = ?";

            if($stmt = mysqli_prepare($connection, $sql)) {
                $param_email = trim($_POST["email"]);
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $email_err = "email daha önce alınmış.";
                    } else {
                        $email = $_POST["email"];
                    }
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }
            }
        }

        // validate password
        if(empty(trim($_POST["password"]))) {
            $password_err = "Şifre girmelisiniz.";
        } elseif (strlen($_POST["password"]) < 6) {
            $password_err = "Şifre min. 6 karakter olmalıdır.";
        } else {
            $password = $_POST["password"];
        }

        // validate confirm password
        if(empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Şifre Tekrar girmelisiniz.";
        } else {
            $confirm_password = $_POST["confirm_password"];
            if(empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Şifreler eşleşmiyor.";
            }
        }


       if(empty($kullanici1_err) && empty($email_err) && empty($password_err)) {
           $sql = "INSERT INTO kullanicilar (k_ad, email, sifre) VALUES (?,?,?)";

           if($stmt = mysqli_prepare($connection, $sql)) {
               
                $param_username = $kullanici1;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION["loggedin"] = true;
                    header("location: gameTemplate.php");
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }
           }
       }

      
    }

?>
<?php
require "views/_header.php";

?>
        <div class="conteiner w-50 mx-auto">
            <div class="card1 h-3">
                <div class="card-header text-white"><h2>HEMEN KAYIT OL!</h2></div>
                <div class="card-body  text-white">
                        <div class="mb-3">
                            <form action="gameTemplateKayıt.php" method="POST">
                                <div class="form-group">
                                    <label for="text">Kullanıcı Adı</label>
                                    <input type="text" class="form-control mb-2 bg-dark text-light" placeholder="Kullanıcı Adı Giriniz" id="name" name="kullanici1" >
                                    <span class="invalid-feedback"><?php echo $kullanici1_err; ?></span>
                                    <label for="email">Email Adresiniz</label>
                                    <input type="email" class="form-control mb-2 bg-dark text-light" name="email" placeholder="E-posta Adresi Giriniz..." id="email" >
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>                  
                                    <label for="password" class="form-label">Şifre</label>
                                    <input type="password" name="password" placeholder="Şifre Giriniz..." id="password" class="form-control bg-dark text-light <?php echo (!empty($password_err)) ? 'is-invalid': ''?>" value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    <label for="confirm_password" class="form-label">Şifre Tekrar</label>
                                    <input type="password" placeholder="Şifre Tekrar Giriniz..." name="confirm_password" id="confirm_password" class="form-control bg-dark text-light <?php echo (!empty($confirm_password_err)) ? 'is-invalid': ''?>" value="<?php echo $confirm_password; ?>">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
                                    <label class="form-check-label">
                            <input class="form-check-input bg-danger" type="checkbox" name="remember" required><a href="#"
                             class="text-decoration-none text-danger"> Kullanım koşullarını </a> okudum onaylıyorum.
                        </label><br>
                        <label class="form-check-label">
                            <input class="form-check-input bg-danger" type="checkbox" name="remember"> E-posta ile bilgilendirme almak istiyorum.(İsteğe Bağlı)
                        </label>   
                             <div class="card-footer">
                            <button class="btn btn-outline-danger px-4 float-end" name="kaydol"  id="sub" type="submit">Giriş</button></div></form>
                        </div>
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