<?php
    $username =  $password = "";
    $username_err = $password_err = $login_err= "";

    if (isset($_POST["giris"])) {
      include "libs/ayar.php";
        if(empty(trim($_POST["username"]))) {
            $username_err = "Kullanıcı Adı girmelisiniz.";
        } else {
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))) {
            $password_err = "Şifre girmelisiniz.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)) {
            $sql = "SELECT id, k_ad, sifre,rol FROM kullanicilar WHERE k_ad = ?";

            if($stmt = mysqli_prepare($connection, $sql)) {
                $param_username =  $username;
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password,$rol);
                        if(mysqli_stmt_fetch($stmt)) {
                            if(password_verify($password, $hashed_password)) {

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["rol"] = $rol;

                                header("location: gameTemplateHesap.php");
                            } else {
                                $login_err = "yanlış şifre girdiniz";
                            }
                        } 
                    } else {
                        $login_err = "yanlış kullanıcı adı girdiniz";
                    }
                } else {
                    $login_err = "bilinmeyen bir hata oluştu.";
                }
                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($connection);
    }

?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="mymodal-content text-white">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Giriş Yap</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="../gameTemplate/gameTemplate.php" method="POST">
                      <div class="mb-3">
                        <label for="K_adi" class="col-form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control bg-dark text-white  <?php echo (!empty($username_err)) ? 'is-invalid': ''?>" value="<?php echo $username; ?>" id="username" name="username">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                      </div>
                      <div class="mb-3">
                        <label for="sifre" class="col-form-label">Şifre</label>
                        <input type="password" class="form-control bg-dark text-white" id="password" name="password"></input>
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                      </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-outline-danger" name="giris" >Giriş Yap</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
