<?php
require_once("baglan.php");
if(isset($_SESSION["Kullanici"])){
?>
<!DOCTYPE html>
<html lang="tr-TR">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="tr">
    <title>Cızzdan'ım</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <main>
      <section>
        <h1></h1>
        <div class="mobile-container">
                <div class="topnav">
                  <a href="index.php" class="cizzdan">Anasayfa</a>
                    <div id="myLinks">
                      <a href="bilgi.php">Nedir bu Cızzdan?</a>
                      <a href="yenilikler.php">Yenilikler</a>
                      <a href="hakkimizda.php">Hakkımızda</a>
                      <a href="ayarlar.php">Ayarlar</a>
                      <a href="cikis.php">Çıkış</a>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                      <i class="fa fa-bars"></i>
                    </a>
                </div>
        </div>
        <script>
          function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
              x.style.display = "none";
            } else {
              x.style.display = "block";
            }
          }
        </script>
        <div class="table-wrap">
        <table>
        <caption>
          <caption style="margin: 0 0 0 39%;">Yakında!</caption>
            <tbody>
            </tbody>
          </caption>
          </table>
          <p class="aciklama">Henüz Bu modül Aktif edilmemiştir.<br /><br />Takipte kalın yakında buralar şenlenecek ;)<br /><br />Şimdilik sizi şöyle alalım <a href="index.php" style="text-decoration: none;">Ana sayfa</a></p>
        </div>
      </section>
      <p class="aciklama">
        Beta sürümüdür.<br />
        Gelişim aşamasında olduğumuzdan sistem yavaş çalışmaktadır.<br />
        Anlayışınız için teşekkür ederiz.
      </p>
    </main>
  </body>
  <div class="se-pre-con"></div>
</html>
<?php 
}else{header("Location:girissayfasi.php");}
$database = null;?>