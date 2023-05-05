<?php
require_once("baglan.php");

if(isset($_SESSION["Kullanici"])){
$silinecekGelirIDsi = filtrele($_GET["id"]);

if(isset($silinecekGelirIDsi)){
  $gelirSil               = $database->prepare("DELETE FROM " . $_SESSION['Kullanici'] . "_gelirler WHERE id=? LIMIT 1");
  $gelirSil->execute([$silinecekGelirIDsi]);
  $gelirSilKontrolSayisi  = $gelirSil->rowCount();

  if($gelirSilKontrolSayisi<1){
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