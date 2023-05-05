<?php
require_once("baglan.php");

if(isset($_SESSION["Kullanici"])){
  
$temizlenecekID = filtrele($_GET["id"]);

if(isset($temizlenecekID)){
  $temizle               = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdi=0 WHERE id='$temizlenecekID' LIMIT 1");
  $temizle->execute();
  $temizleKontrolSayisi  = $temizle->rowCount();

  if($temizleKontrolSayisi<1){
    echo "HATA<br />";
    echo "İşlem sırasında beklenmeyen bir sorun oluştu. Daha sonra tekrar deneyiniz.<br/>";
    echo "Ana Sayfaya geri dönmek için lütfen <a href='index.php'>Buraya Tıklayınız</a>";    
  }
  header("Location:index.php");
  }else{
    echo "HATA<br />";
    echo "Ana Sayfaya geri dönmek için lütfen <a href='index.php'>Buraya Tıklayınız</a>";
  }
  }else{
    header("Location:girissayfasi.php");
  }
$database = null;
?>