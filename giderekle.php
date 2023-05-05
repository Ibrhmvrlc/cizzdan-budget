<?php
require_once("baglan.php");

if(isset($_SESSION["Kullanici"])){
$giderGirdisininAdi         = "Gider Adı";
$giderGirdisininAciklamasi  = "Gider Açıklama Alanı";

  $ekleSorgu            = $database->prepare("INSERT INTO " . $_SESSION['Kullanici'] . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values ($gelenAySecimi, '$giderGirdisininAdi', 0, '$giderGirdisininAciklamasi')");
  $ekleSorgu->execute();
  $ekleKontrolSayisi    = $ekleSorgu->rowCount();

  if($ekleKontrolSayisi>0){
    header("Location:index.php");
    exit();
  }else{
    echo "HATA<br />";
    echo "İşlem sırasında beklenmeyen bir sorun oluştu. Daha sonra tekrar deneyiniz.<br/>";
    echo "Ana Sayfaya geri dönmek için lütfen <a href='index.php'>Buraya Tıklayınız</a>";
  }
}else{
  header("Location:girissayfasi.php");
}
$database = null;
?>