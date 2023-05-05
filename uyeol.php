<?php
require_once("baglan.php");
if(isset($_SESSION["Kullanici"])){
    header("Location:index.php");
}else{
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
                      <h3 class="mb-4">Cızzdan Üyesi ol</h3>
                    </div>
                  </div>
                  <form action="uyeolsonuc.php" class="signin-form" method="POST">
                    <div class="form-group mt-3">
                      <input type="text" class="form-control" name="kullaniciadi" required>
                      <label class="form-control-placeholder" for="username">Kullanıcı Adı</label>
                    </div>
                    <div class="form-group">
                      <input id="password-field" type="password" class="form-control" name="sifre" required>
                      <label class="form-control-placeholder" for="password">Şifre</label>
                    </div>
                    <div class="form-group mt-3">
                      <input type="text" class="form-control" name="adisoyadi" required>
                      <label class="form-control-placeholder" for="namesurname">Adı Soyadı</label>
                    </div>
                    <div class="form-group mt-3">
                      <input type="email" class="form-control" name="emailadresi" required>
                      <label class="form-control-placeholder" for="username">E-posta Adresi</label>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="form-control btn btn-primary rounded submit px-3">Üye Ol</button>
                    </div>
                  </form>
                  <p class="text-center"><a data-toggle="tab" href="girissayfasi.php">Cızzdan</a><br />Gelir-Gider düzenleme uygulamasıdır.<br />Bakkal defteri gibi düşünün :)</p>
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