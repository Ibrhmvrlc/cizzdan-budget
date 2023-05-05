<?php
require_once("baglan.php");
if(isset($_POST["emailadresi"])){
  $gelenEmailAdresi  = filtrele($_POST["emailadresi"]);
}else{
  $gelenEmailAdresi  = "";
}

if(isset($_POST["sifre"])){
    $gelenSifre         = filtrele($_POST["sifre"]);
}else{
    $gelenSifre  = "";
}

$kontrolSorgusu         =  $database->prepare("SELECT * from uyeler WHERE emailadresi=? AND sifre=?");
$kontrolSorgusu->execute([$gelenEmailAdresi, $gelenSifre]);
$kontrolSayisi          = $kontrolSorgusu->rowCount();
$kontrolSorgusuKayiti   = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

if($kontrolSayisi>0){
    $_SESSION["Kullanici"] = $kontrolSorgusuKayiti["kullaniciadi"];
    header("Location:parabirimi.php");
    exit();
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
                      <h3 class="mb-4">Ups..</h3>
                      <p>Girilen bilgiler ile eşleşen kullanıcı bulunamadı.</p>
                    </div>
                  </div>
                  <p class="text-center">Ana Sayfaya dönmek için lütfen <a data-toggle="tab" href="girissayfasi.php">buraya tıklayınız.</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </body>
</html>
<?php
}
$database = null;
?>
