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
        <div class="select-wrap">
        <div class="aysecimalani">
          <form action='' method='post'>
            <select onchange="this.form.submit()" name="selectaysecimi" class="aysecimi" id="selekt">
              <option value="">-Aylar-</option> 
              <?php
              $aySorgusu = $database->prepare("SELECT ayismi FROM " . $_SESSION['Kullanici'] . "_aylar");
              $aySorgusu->execute();
              $aySorguSayi       = $aySorgusu->rowCount();
              $aySorguKayitlari  = $aySorgusu->fetchAll(PDO::FETCH_ASSOC);
              if($aySorguSayi>0){
                foreach($aySorguKayitlari as $kayitlar){
                  $ayAdi  = $kayitlar["ayismi"];
                  $ayID   = $kayitlar["id"];
                  ?>
                  <option value='<?php echo $ayAdi ?>' <?php if(isset($_SESSION["AyID"]) && $_SESSION["Ay"] == $ayAdi){?> selected="selected" <?php } ?>><?php echo strtoupper($ayAdi) ?></option>
                  <?php
                }
              }
              ?>
            </select>
          </form>
          </div>
          <div class="aysecimalani">
            <form action="" method="post">
              <select onchange="this.form.submit()" name="selectpb" class="pbsecimalani" id="pbselekt">
                <option value="">-Para Birimi-</option>
                <?php 
                $PBSorgusu        = $database->prepare("SELECT * FROM dovizkurlari");
                $PBSorgusu->execute();
                $PBSorguSayisi    = $PBSorgusu->rowCount();
                $PBSorguKayitlari = $PBSorgusu->fetchAll(PDO::FETCH_ASSOC);
                if($PBSorguSayisi>0){
                  foreach($PBSorguKayitlari as $kayitlarpb){
                    $PBAdi    = $kayitlarpb["kod"];
                    $PBDegeri = round($kayitlarpb["efektifalis"],3);
                  ?>
                    <option value='<?php echo @$PBAdi ?>' <?php if(isset($_SESSION["PBDegeri"]) && $_SESSION["PBAdi"] == @$PBAdi){?> selected="selected" <?php } ?>><?php echo @$PBAdi; ?></option>
                  <?php
                  }
                }
                ?>
                <option disabled>BTC</option>
                <option disabled>ETH</option>
                <option disabled>Pi Coin</option>
              </select>
            </form>
          </div>
          <?php
          if(empty($_SESSION["PBDegeri"])){
            $_SESSION["PBDegeri"] = "1";
            $_SESSION["PBAdi"] = "TL";
          }else{
          $PBKontrolSorgusu   = $database->prepare("SELECT * FROM dovizkurlari WHERE kod = ?");
          $PBKontrolSorgusu->execute([filtrele(@$_POST['selectpb'])]);
          $PBKontrolSayisi     = $PBKontrolSorgusu->rowCount();
          $PBKontrolKaydi     = $PBKontrolSorgusu->fetch(PDO::FETCH_ASSOC);
          if($PBKontrolSayisi>0){
            $_SESSION["PBAdi"]       = $PBKontrolKaydi["kod"];
            $_SESSION["PBDegeri"]    = round($PBKontrolKaydi["efektifalis"],3);
            echo "<meta http-equiv='refresh' content='0'>";
          }
          }
          ?>
          </div>
          <div class="table-wrap">
            <?php
            $ayKontrolSorgusu   = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_aylar WHERE ayismi=?");
            $ayKontrolSorgusu->execute([filtrele(@$_POST['selectaysecimi'])]);
            $ayKontrolSayisi    = $ayKontrolSorgusu->rowCount();
            $ayKontrolKaydi     = $ayKontrolSorgusu->fetch(PDO::FETCH_ASSOC);
            if($ayKontrolSayisi>0){
              $_SESSION["Ay"]   = $ayKontrolKaydi["ayismi"];
              $_SESSION["AyID"] = $ayKontrolKaydi["id"];
              echo "<meta http-equiv='refresh' content='0'>";
            }
            

          $gelenGiderDegeri = "";         
          $giderTopla = 0;
          function GiderYaz() {
            global $gelenAySecimi;
            global $database;
            global $giderTopla;
            global $gelenGiderDegeri;
            $girdiSorgu           = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_giderler WHERE ustid = ? AND gideraciklama!=''");
            $girdiSorgu->execute([$gelenAySecimi]);
            $girdiSorguSayi       = $girdiSorgu->rowCount();
            $girdiSorguKayitlari  = $girdiSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($girdiSorguSayi>0){
              foreach($girdiSorguKayitlari as $kayitlar){
                $girdiID        = $kayitlar["id"];
                $girdiUstID     = $kayitlar["ustid"];
                $girdiGirdiAdi  = $kayitlar["gidergirdiadi"];
                $giderTutar     = $kayitlar["gidergirdi"];
                $giderAciklama  = $kayitlar["gideraciklama"];
                echo "<tr class='data'>
                      <th><form action='' method='POST'>
                      <input onchange='this.form.submit()' type='text' id='giderAdiAlani' value='" . $girdiGirdiAdi . "' name='gideradi" . $girdiID . "' required>
                      <script type='text/javascript'>
                      $('#giderAdiAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script>
                      </form>";
                      if(@filtrele($_POST["gideradi" . $girdiID])!=""){
                        $giderAdiSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gidergirdiadi='". @filtrele($_POST["gideradi" . $girdiID]) . "' WHERE id='$girdiID'");
                        $giderAdiSorgusu->execute();
                        echo "<meta http-equiv='refresh' content='0'>";
                      }else{
                        $giderAdiSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gidergirdiadi='$girdiGirdiAdi' WHERE id='$girdiID'");
                        $giderAdiSorgusu->execute();
                      }

                echo  "<form action='index.php' method='POST'>
                      <span class='description'><textarea onchange='this.form.submit()' id='giderAciklamaAlani' cols='60' rows='1' name='aciklama" . $girdiID . "'>" . $giderAciklama . "</textarea>
                      <script src='autosize.js'></script>
                      <script>
                      autosize(document.querySelectorAll('textarea'));
                      </script>
                      <script type='text/javascript'>
                      $('#giderAciklamaAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script>
                      </span>
                      </form>
                      </th> ";
                      if(@filtrele($_POST["aciklama" . $girdiID])!=""){
                        $giderAciklamasiSorgusuDoluysa = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gideraciklama='" .  @filtrele($_POST["aciklama" . $girdiID]) . "' WHERE id = '$girdiID'");
                        $giderAciklamasiSorgusuDoluysa->execute();
                        echo "<meta http-equiv='refresh' content='0'>";
                       }else{
                        $giderAciklamasiSorgusuDoluysa = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gideraciklama='$giderAciklama' WHERE id = '$girdiID'");
                        $giderAciklamasiSorgusuDoluysa->execute();
                       }

                echo  "<form name='giderTutarFormu' action='' method='post'>
                      <td class='current'>
                      <div class='gidersildivi'><a class='sil' href='gidersil.php?id=". $girdiID ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash'
                      viewBox='0 0 16 16'>
                      <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                      <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                      </svg></a></div>
                      <div class='temizledivi'><a class='temizle' href='temizlegider.php?id=". $girdiID ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-counterclockwise' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z'/>
                      <path d='M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z'/>
                      </svg></a></div>
                      <input onchange='this.form.submit()' type='number' id='giderGirdiAlani' value='" . round(($giderTutar/$_SESSION["PBDegeri"]),2) . "' name='gider" . $girdiID . "' class='deger' required='required'>
                      <script type='text/javascript'>
                      $('#giderGirdiAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script>
                      </td>
                      </tr>
                      </form>
                      ";
                      if(isset($_POST["gider" . $girdiID])){
                        $gelenGiderDegeri = filtrele($_POST["gider" . $girdiID]);
                      }else{
                        $gelenGiderDegeri = "";
                      }

                      if(@filtrele($_POST["gider" . $girdiID])!=""){
                        $giderYazSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gidergirdi=('" . round($gelenGiderDegeri*$_SESSION["PBDegeri"]) . "') WHERE id = '$girdiID'");
                        $giderYazSorgusu->execute();
                        $giderTopla += $giderTutar;
                        $giderToplamSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gidergirdi=('" . $giderTopla . "') WHERE ustid= ? AND gideraciklama = ?");
                        $giderToplamSorgusu->execute([$gelenAySecimi, ""]);
                        echo "<meta http-equiv='refresh' content='0'>";
                      }else{
                        $giderTopla += $giderTutar;
                        $giderToplamSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_giderler SET gidergirdi=('" . $giderTopla . "') WHERE ustid= ? AND gideraciklama = ?");
                        $giderToplamSorgusu->execute([$gelenAySecimi, ""]);
                        }
                  }
                }
              }

          $gelirTopla = 0;
          function GelirYaz() {
            global $gelenAySecimi;
            global $database;
            global $gelirTopla;
            $girdiSorgu           = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_gelirler WHERE ustid = ? AND geliraciklama!=''");
            $girdiSorgu->execute([$gelenAySecimi]);
            $girdiSorguSayi       = $girdiSorgu->rowCount();
            $girdiSorguKayitlari  = $girdiSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($girdiSorguSayi>0){
              foreach($girdiSorguKayitlari as $kayitlar){
                $girdiID          = $kayitlar["id"];
                $girdiUstID       = $kayitlar["ustid"];
                $girdiGirdiAdi    = $kayitlar["gelirgirdiadi"];
                $gelirTutar       = $kayitlar["gelirgirdi"];
                $gelirAciklamasi  = $kayitlar["geliraciklama"];
                echo "<tr class='data'>
                      <th><form action='' method='post'>
                      <input onchange='this.form.submit()' type='text' id='gelirAdiAlani' value='" . $girdiGirdiAdi . "' name='geliradi" . $girdiID . "'>
                      <script type='text/javascript'>
                      $('#gelirAdiAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script>
                      </form>";
                      if(@filtrele($_POST["geliradi" . $girdiID])!=""){
                        $gelirAdiSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdiadi='". @filtrele($_POST["geliradi" . $girdiID]) . "' WHERE id='$girdiID'");
                        $gelirAdiSorgusu->execute();
                        echo "<meta http-equiv='refresh' content='0'>";
                      }else{
                        $gelirAdiSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdiadi='$girdiGirdiAdi' WHERE id='$girdiID'");
                        $gelirAdiSorgusu->execute();
                      }

                echo  "<form action='' method='post'>
                      <span class='description'><textarea onchange='this.form.submit()' id='gelirAciklamaAlani' cols='60' rows='1' name='aciklama" . $girdiID . "'>" . $gelirAciklamasi . "</textarea>
                      <script src='autosize.js'></script>
                      <script>
                      autosize(document.querySelectorAll('textarea'));
                      </script>
                      <script type='text/javascript'>
                      $('#gelirAciklamaAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script></span>
                      </form>
                      </th>";
                      if(@filtrele($_POST["aciklama" . $girdiID])!=""){
                        $gelirAciklamasiSorgusuDoluysa = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET geliraciklama='" .  @filtrele($_POST["aciklama" . $girdiID]) . "' WHERE id = '$girdiID'");
                        $gelirAciklamasiSorgusuDoluysa->execute();
                        echo "<meta http-equiv='refresh' content='0'>";
                       }else{
                        $gelirAciklamasiSorgusuDoluysa = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET geliraciklama='$gelirAciklamasi' WHERE id = '$girdiID'");
                        $gelirAciklamasiSorgusuDoluysa->execute();
                       }

                echo  "<form action='' method='post'>
                      <td class='current'>
                      <div class='gelirsildivi'><a class='sil' href='gelirsil.php?id=". $girdiID ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash'
                      viewBox='0 0 16 16'>
                      <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                      <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                      </svg></a></div>
                      <div class='temizledivi'><a class='temizle' href='temizlegelir.php?id=". $girdiID ."'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-counterclockwise' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z'/>
                      <path d='M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z'/>
                      </svg></a></div>
                      <input onchange='this.form.submit()' type='number' id='gelirGirdiAlani' value='" . round(($gelirTutar/$_SESSION["PBDegeri"]),2) . "' name='gelir" . $girdiID . "' class='deger'>
                      <script type='text/javascript'>
                      $('#gelirGirdiAlani').focus( function() {
                        $(this).addClass('focus');
                      }).blur( function() {
                        $(this).removeClass('focus');
                      });
                      </script></td>
                      </tr>
                      </form>";
                      if(@filtrele($_POST["gelir" . $girdiID])!=""){
                        $gelirYazSorgusu     = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdi=" . filtrele($_POST["gelir" . $girdiID])*$_SESSION["PBDegeri"] . " WHERE id = '$girdiID'");
                        $gelirYazSorgusu->execute();
                        $gelirTopla = $gelirTopla + $gelirTutar;
                        $gelirToplamSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdi=('" . $gelirTopla . "') WHERE ustid = ? AND geliraciklama = ?");
                        $gelirToplamSorgusu->execute([$gelenAySecimi, ""]);
                        echo "<meta http-equiv='refresh' content='0'>";
                      }else{
                        $gelirTopla += $gelirTutar;
                        $gelirToplamSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_gelirler SET gelirgirdi=('" . $gelirTopla . "') WHERE ustid = ? AND geliraciklama = ?");
                        $gelirToplamSorgusu->execute([$gelenAySecimi, ""]);
                      }
                }
              }
            }
          
          $netIcinGider = 0;
          function GiderToplamYaz() {
            global $database;
            global $netIcinGider;
            global $gelenAySecimi;
            $girdiSorgu           = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_giderler WHERE ustid = ? AND gideraciklama = ?");
            $girdiSorgu->execute([$gelenAySecimi, ""]);
            $girdiSorguSayi       = $girdiSorgu->rowCount();
            $girdiSorguKayitlari  = $girdiSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($girdiSorguSayi>0){
              foreach($girdiSorguKayitlari as $kayitlar){
                $girdiGirdiAdi        = $kayitlar["gidergirdiadi"];
                $giderToplamTutar     = $kayitlar["gidergirdi"];
                echo " <tr class='total'>
                        <th>" . $girdiGirdiAdi . " <span class='sr-only'>Giderler</span></th>
                        <td class='current'>-" . round($giderToplamTutar/$_SESSION["PBDegeri"],2)  . "</td>
                       </tr>";
                       }
                }
                $netIcinGider = $giderToplamTutar;
              }

          $netIcinGelir = 0;
          function GelirToplamYaz() {
            global $database;
            global $netIcinGelir;
            global $gelenAySecimi;
            $girdiSorgu           = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_gelirler WHERE ustid = ? AND geliraciklama = ? LIMIT 1");
            $girdiSorgu->execute([$gelenAySecimi, ""]);
            $girdiSorguSayi       = $girdiSorgu->rowCount();
            $girdiSorguKayitlari  = $girdiSorgu->fetchAll(PDO::FETCH_ASSOC);
            if($girdiSorguSayi>0){
              foreach($girdiSorguKayitlari as $kayitlar){
                $girdiGirdiAdi        = $kayitlar["gelirgirdiadi"];
                $gelirToplamTutar     = $kayitlar["gelirgirdi"];
                echo " <tr class='total'>
                        <th>" . $girdiGirdiAdi . " <span class='sr-only'>Giderler</span></th>
                        <td class='current'>" . round($gelirToplamTutar/$_SESSION["PBDegeri"],2) . "</td>
                       </tr>";
                } 
              }
              $netIcinGelir = $gelirToplamTutar;
            }
                  
          function NetYaz() {
            global $gelenAySecimi;
            global $database;
            global $netIcinGelir;
            global $netIcinGider;
            $net = ($netIcinGelir-$netIcinGider);
            $girdiSorgu           = $database->prepare("SELECT * FROM " . $_SESSION['Kullanici'] . "_aylar WHERE id = ?");
            $girdiSorgu->execute([$gelenAySecimi]);
            $girdiSorguSayi       = $girdiSorgu->rowCount();
            $girdiSorguKayitlari  = $girdiSorgu->fetchAll(PDO::FETCH_ASSOC);
            $netSorgusu = $database->prepare("UPDATE " . $_SESSION['Kullanici'] . "_aylar SET net=('$net') WHERE id = ?");
            $netSorgusu->execute([$gelenAySecimi]);
            if($girdiSorguSayi>0){
              foreach($girdiSorguKayitlari as $kayitlar){
                $netTutar       = $kayitlar["net"];
                echo "<div class='net'> $" . round($netTutar/$_SESSION["PBDegeri"],2) . "</div>";
                      if($net!=$netTutar){
                        echo "<meta http-equiv='refresh' content='0'>";
                      }
            } 
              }
                  }
          ?>
          <table>
          <caption>
          <caption>Giderler</caption>
          <a class='ekle' href='giderekle.php'>
            <div class='giderekledivi'>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </div>
          </a>
          </caption>
            <thead>
              <tr>
              <td></td>
              <th><span class="sr-only">Tutar</span></th>
              </tr>
            </thead>
            <tbody>
              <?php GiderYaz(); ?>
              <?php GiderToplamYaz(); ?>
            </tbody>
          </table>
          <table>
            <caption>
            <caption>Gelirler</caption>
            <a class='ekle' href='gelirekle.php'>
              <div class='gelirekledivi'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
              </div>
              </a>
            </caption>
            <br /><br />
            <thead>
              <tr>
              <td></td>
              <th><span class="sr-only">Tutar</span></th>
              </tr>
            </thead>
            <tbody>
            <?php GelirYaz(); ?>
            <?php GelirToplamYaz(); ?>
            </tbody>
          </table>
          <br />
          <table>
            <caption><caption>Net Kalan</caption></caption>
            <thead>
              <tr>
              <td></td>
              <th><span class="sr-only">Tutar</span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            <?php NetYaz(); ?>
          </table>
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
}else{
  header("Location:girissayfasi.php");
}
$database = null;
?>