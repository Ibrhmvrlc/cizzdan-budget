<?php
require_once("baglan.php");

if(isset($_SESSION["Kullanici"])){
$gelirGirdisininAdi         = "Gelir Adı";
$gelirGirdisininAciklamasi  = "Gelir Açıklama Alanı";

  $gelirEkleSorgu                 = $database->prepare("INSERT INTO " . $_SESSION['Kullanici'] . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values ($gelenAySecimi, '$gelirGirdisininAdi', 0, '$gelirGirdisininAciklamasi')");
  $gelirEkleSorgu->execute();
  $gelirEkleKontrolSayisi         = $gelirEkleSorgu->rowCount();

  if($gelirEkleKontrolSayisi>0){
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