<?php
session_start(); ob_start();

try{
  $database = new PDO("mysql:host=localhost;dbname=deneme;charset=UTF8", "root", "");
}catch(PDOException $hata){
  echo "Bağlantı Hatası.<br />" . $hata->getMessage();
  die();
}

function filtrele($deger){
  $bir    = trim($deger);
  $iki    = strip_tags($bir);
  $uc     = htmlspecialchars($iki, ENT_QUOTES);
  $sonuc  = $uc;
  return $sonuc;
}

function filtreleKullaniciAdi($deger) {
  $bir    = trim($deger);
  $iki    = strip_tags($bir);
  $uc     = htmlspecialchars($iki, ENT_QUOTES);
  $dort  = strtolower($uc);
  $sonuc = $dort;
  return $sonuc;
}

$zamanDamgasi = time();

if(isset($_SESSION["Kullanici"])){
  $uyelerSorgusu          =  $database->prepare("SELECT * from uyeler WHERE kullaniciadi=?");
  $uyelerSorgusu->execute([$_SESSION["Kullanici"]]);
  $uyelerKayitSayisi      = $uyelerSorgusu->rowCount();
  $uyelerKayit            = $uyelerSorgusu->fetch(PDO::FETCH_ASSOC);

  if($uyelerKayitSayisi>0){
     $uyeninAdiSoyadi = $uyelerKayit["adisoyadi"];
  }else{
      $uyeninAdiSoyadi = "";
  }
}

//gelenAySecimi değişkenini tüm sayfalarda gösterebilmek için
if(isset($_SESSION["AyID"])){
  $gelenAySecimi = $_SESSION["AyID"];
}else{
  $gelenAySecimi = 1;
}

if(isset($_SESSION["PBDegeri"])){
  $GelenPBDegeri = round($_SESSION["PBDegeri"]);
}else{
  $GelenPBDegeri = 1;
}
?>