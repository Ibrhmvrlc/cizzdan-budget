<?php
require_once("baglan.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
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
<?php
if(isset($_POST["kullaniciadi"])){
    $gelenKullaniciAdi  = filtreleKullaniciAdi($_POST["kullaniciadi"]);
}else{
    $gelenKullaniciAdi  = "";
}

if(isset($_POST["sifre"])){
    $gelenSifre         = filtrele($_POST["sifre"]);
}else{
    $gelenSifre  = "";
}

if(isset($_POST["adisoyadi"])){
  $gelenAdSoyad  = filtrele($_POST["adisoyadi"]);
}else{
  $gelenAdSoyad  = "";
}

if(isset($_POST["emailadresi"])){
  $gelenEmailAdresi  = filtrele($_POST["emailadresi"]);
}else{
  $gelenEmailAdresi  = "";
}

$kontrolSorgusu     =  $database->prepare("SELECT * from uyeler WHERE kullaniciadi=? OR emailadresi=?");
$kontrolSorgusu->execute([$gelenKullaniciAdi, $gelenEmailAdresi]);
$kontrolSayisi      = $kontrolSorgusu->rowCount();

if($kontrolSayisi>0){
?>
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
                        <h3 class="mb-4">Bir terslik var..?</h3>
                        <p>Bir baktık da, galiba daha önce üye olmuşsun..?</p>
                        <p>Kullanıcı adı veya e-Mail adresi kullanılmış.</p>
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
<?php }else{
  $kayitEkle    =  $database->prepare("INSERT INTO uyeler (kullaniciadi, sifre, adisoyadi, emailadresi, kayittarihi) values (? ,?, ?, ?, ?)");
  $kayitEkle->execute([$gelenKullaniciAdi, $gelenSifre, $gelenAdSoyad, $gelenEmailAdresi, $zamanDamgasi]);
  $kayitKontrol = $kayitEkle->rowCount();
  
//Ay Tablosunu oluşturma alani
  if($kayitKontrol>0){
  $ayTablosuOlus      = "CREATE TABLE IF NOT EXISTS " . $gelenKullaniciAdi . "_aylar (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ayismi char(8) NOT NULL,
    net int(11))";
  $database->exec($ayTablosuOlus);

//Ay tablosun ilk verileri ekleme alani
  $tabloyaOcakEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaOcakEkle->execute(["OCAK", 0]);

  $tabloyaSubatEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaSubatEkle->execute(["SUBAT", 0]);

  $tabloyaMartEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaMartEkle->execute(["MART", 0]);

  $tabloyaNisanEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaNisanEkle->execute(["NISAN", 0]);

  $tabloyaMayisEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaMayisEkle->execute(["MAYIS", 0]);

  $tabloyaHaziranEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaHaziranEkle->execute(["HAZIRAN", 0]);

  $tabloyaTemmuzEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaTemmuzEkle->execute(["TEMMUZ", 0]);

  $tabloyaAgustosEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaAgustosEkle->execute(["AGUSTOS", 0]);

  $tabloyaEylulEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaEylulEkle->execute(["EYLUL", 0]);

  $tabloyaEkimEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaEkimEkle->execute(["EKIM", 0]);

  $tabloyaKasimEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaKasimEkle->execute(["KASIM", 0]);

  $tabloyaAralikEkle         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_aylar (ayismi, net) values (?, ?)");
  $tabloyaAralikEkle->execute(["ARALIK", 0]);
  

//Giderler Tablosunu oluşturma alani
  $gidertablosuOlus      = "CREATE TABLE IF NOT EXISTS " . $gelenKullaniciAdi . "_giderler (
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ustid int(10) UNSIGNED NOT NULL,
    gidergirdiadi varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
    gidergirdi int(10),
    gideraciklama text CHARACTER SET utf8 COLLATE utf8_general_ci
    )";
  $database->exec($gidertablosuOlus);

  //Giderler TablosunA ilk verileri ekleme alani
  $tabloyaGiderEkle1         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle1->execute([1, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle1   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle1->execute([1, "Ocak ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle2         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle2->execute([2, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle2   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle2->execute([2, "Şubat ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle3         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle3->execute([3, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle3   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle3->execute([3, "Mart ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle4         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle4->execute([4, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle4   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle4->execute([4, "Nisan ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle5         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle5->execute([5, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle5   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle5->execute([5, "Mayıs ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle6         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle6->execute([6, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle6   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle6->execute([6, "Haziran ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle7         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle7->execute([7, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle7   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle7->execute([7, "Temmuz ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle8         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle8->execute([8, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle8   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle8->execute([8, "Ağustos ayı Toplamı", 0, ""]);
  
  $tabloyaGiderEkle9         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle9->execute([9, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle9   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle9->execute([9, "Eylül ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle10         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle10->execute([10, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle10   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle10->execute([10, "Ekim ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle11         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle11->execute([11, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle11   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle11->execute([11, "Kasım ayı Toplamı", 0, ""]);

  $tabloyaGiderEkle12         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaGiderEkle12->execute([12, "Gider Adı", 0, "Gider Açıklama"]);

  $tabloyaToplamGiderEkle12   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_giderler (ustid, gidergirdiadi, gidergirdi, gideraciklama) values (?, ?, ?, ?)");
  $tabloyaToplamGiderEkle12->execute([12, "Aralık ayı Toplamı", 0, ""]);
  


//Gelirler Tablosunu oluşturma alani
$gelirtablosuOlus      = "CREATE TABLE IF NOT EXISTS " . $gelenKullaniciAdi . "_gelirler (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ustid int(10) UNSIGNED NOT NULL,
  gelirgirdiadi varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  gelirgirdi int(10),
  geliraciklama text CHARACTER SET utf8 COLLATE utf8_general_ci
  )";
$database->exec($gelirtablosuOlus);

//Giderler TablosunA ilk verileri ekleme alani
$tabloyaGelirEkle1         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle1->execute([1, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle1   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle1->execute([1, "Ocak ayı Toplamı", 0, ""]);

$tabloyaGelirEkle2         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle2->execute([2, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle2   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle2->execute([2, "Şubat ayı Toplamı", 0, ""]);

$tabloyaGelirEkle3         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle3->execute([3, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle3   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle3->execute([3, "Mart ayı Toplamı", 0, ""]);

$tabloyaGelirEkle4         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle4->execute([4, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle4   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle4->execute([4, "Nisan ayı Toplamı", 0, ""]);

$tabloyaGelirEkle5         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle5->execute([5, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle5   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle5->execute([5, "Mayis ayı Toplamı", 0, ""]);

$tabloyaGelirEkle6         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle6->execute([6, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle6   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle6->execute([6, "Haziran ayı Toplamı", 0, ""]);

$tabloyaGelirEkle7         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle7->execute([7, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle7   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle7->execute([7, "Temmuz ayı Toplamı", 0, ""]);

$tabloyaGelirEkle8         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle8->execute([8, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle8   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle8->execute([8, "Ağustos ayı Toplamı", 0, ""]);

$tabloyaGelirEkle9         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle9->execute([9, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle9   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle9->execute([9, "Eylül ayı Toplamı", 0, ""]);

$tabloyaGelirEkle10         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle10->execute([10, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle10   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle10->execute([10, "Ekim ayı Toplamı", 0, ""]);

$tabloyaGelirEkle11         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle11->execute([11, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle11   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle11->execute([11, "Kasım ayı Toplamı", 0, ""]);

$tabloyaGelirEkle12         = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaGelirEkle12->execute([12, "Gelir Adı", 0, "Gelir Açıklama"]);

$tabloyaToplamGelirEkle12   = $database->prepare("INSERT INTO " . $gelenKullaniciAdi . "_gelirler (ustid, gelirgirdiadi, gelirgirdi, geliraciklama) values (?, ?, ?, ?)");
$tabloyaToplamGelirEkle12->execute([12, "Aralık ayı Toplamı", 0, ""]);


    //Kayit olunduğunda bildirim maili gönderme alanidir.
    $gelenKonu  ="Yeni Uyelik";
    $gelenMesaj = $gelenKullaniciAdi;

    $mailGonder = new PHPMailer(true);
    try{
      //Sunucu Ayarlari
      $mailGonder->SMTPDebug      = 0; // Debug Çıktısı (0->kapalı 2->detaylı)
      $mailGonder->isSMTP(); //
      $mailGonder->Host           = 'mail.cizzdan.com';
      $mailGonder->SMTPAuth       = true;
      $mailGonder->CharSet        = 'UTF-8';
      $mailGonder->Username       = 'admin@cizzdan.com';
      $mailGonder->Password       = '(Kyrie22)';
      $mailGonder->SMTPSecure     = 'tls';
      $mailGonder->Port           = 587;
      $mailGonder->SMTPOptions    = array(
                                      'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                        )
                                        );
    $mailGonder->setFrom($gelenEmailAdresi, $gelenAdSoyad);
    $mailGonder->addAddress('admin@cizzdan.com', 'Admin');
    $mailGonder->addReplyTO($gelenEmailAdresi, $gelenAdSoyad);
    $mailGonder->isHTML(true);
    $mailGonder->Subject        = $gelenKonu;
    $mailGonder->MsgHTML($gelenMesaj);
    //$MailGonder->Body = 'Mailin Gövdesi';
    //$MailGonder->AltBody = 'Mailin Gövdesi(HTML mail kabul etmeyen sunucular için)';
    $mailGonder->send();
    }catch(Exception $e){
      echo 'Mail Gönderim Hatası<br />Hata Açıklaması : ', $mailGonder->ErrorInfo;
    }
  ?>
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
                        <h3 class="mb-4">Tebrikler!</h3>
                        <p>Artık senin de bir Cızzdan'ın var. <br />Hadi Nereden ne gelmiş Nereye ne gidiyor öğren!</p>
                      </div>
                    </div>
                    <p class="text-center">Giriş yapmak için lütfen <a data-toggle="tab" href="girissayfasi.php">buraya tıklayınız.</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    <?php
}else{
    ?>
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
                          <h3 class="mb-4">Haydaa!!!</h3>
                          <p>Ne olduğunu inan anlamadık. Ama bir problem olduğu kesin..!</p>
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
    <?php
    }
  } 
?>
    </body>
  </html>
<?php
  $database = null;
?>