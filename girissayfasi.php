<?php
require_once("baglan.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cızzdan'ım</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <?php if(isset($_SESSION["Kullanici"])){ 
    header("Location:index.php");
  }else{
  ?>
  <body>
    <main>
      <section class="ftco-section">
        <div class="container">
          <div class="row justify-content-center">
          </div>
          <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
              <div class="wrap">
                <div class="img" style="background-image: url(images/cizzdan.gif);"></div>
                <div class="login-wrap p-4 p-md-5">
                  <div class="d-flex">
                    <div class="w-100">
                      <h3 class="mb-4">Cızzdan Giris</h3>
                    </div>
                    <div class="w-100">
                      <p class="social-media d-flex justify-content-end">
                        <a href="https://www.instagram.com/cizzdan/" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-instagram"></span></a>
                        <a href="https://twitter.com/ibrhmvrlc" class="social-icon d-flex align-items-center justify-content-center" target="_blank"><span class="fa fa-twitter"></span></a>
                      </p>
                    </div>
                  </div>
                  <form action="uyegiris.php" class="signin-form" method="POST">
                    <div class="form-group mt-3">
                      <input type="email" class="form-control" name="emailadresi" required>
                      <label class="form-control-placeholder" for="username">E-posta Adresi</label>
                    </div>
                    <div class="form-group">
                      <input id="password-field" type="password" class="form-control" name="sifre" required>
                      <label class="form-control-placeholder" for="password">Şifre</label>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="form-control btn btn-primary rounded submit px-3">Giriş Yap</button>
                    </div>
                    <div class="form-group d-md-flex">
                      <div class="w-50 text-left">
                        <label class="checkbox-wrap checkbox-primary mb-0">Beni Hatırla
                        <input type="checkbox" disabled>
                        <span class="checkmark"></span>
                        </label>
                      </div>
                      <div class="w-50 text-md-right">
                        <a href="sori.php">Şifremi Unuttum</a>
                      </div>
                    </div>
                  </form>
                  <p class="text-center">BETA SÜRÜMÜDÜR. <br />Hala Cızzdan'ınız yok mu? <br />Hadi her şeyi düzenleyelim <br /> <a data-toggle="tab" href="uyeol.php">Cızzdan'ım olsun!</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
  <?php } ?>
</html>
<?php $database = null;?>