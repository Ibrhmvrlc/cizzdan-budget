<?php
require_once("baglan.php");

if(isset($_SESSION["Kullanici"])){
$silinecekGiderIDsi = filtrele($_GET["id"]);

if(isset($silinecekGiderIDsi)){
  $giderSil               = $database->prepare("DELETE FROM " . $_SESSION['Kullanici'] . "_giderler WHERE id=? LIMIT 1");
  $giderSil->execute([$silinecekGiderIDsi]);
  $giderSilKontrolSayisi  = $giderSil->rowCount();

  if($giderSilKontrolSayisi<1){
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