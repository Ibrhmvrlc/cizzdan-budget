<?php
        require_once("baglan.php");
        if(isset($_SESSION["Kullanici"])){
            
        $zamanDamgasipb = time();

        $link = "https://www.tcmb.gov.tr/kurlar/today.xml";
        $icerik = simplexml_load_file($link);

        $USD_Birim          = $icerik->Currency[0]->Unit;
        $USD_Adi            = $icerik->Currency[0]->Isim;
        $USD_KısaAdi        = $icerik->Currency[0]["CurrencyCode"];
        $USD_Alis           = $icerik->Currency[0]->ForexBuying;
        $USD_Satis          = $icerik->Currency[0]->ForexSelling;
        $USD_EfektifAlis    = $icerik->Currency[0]->BanknoteBuying;
        $USD_EfektifSatis   = $icerik->Currency[0]->BanknoteSelling;

        $USDGuncelle        = $database->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $USDGuncelle->execute([$USD_Adi, $USD_Birim, $USD_Alis, $USD_Satis, $USD_EfektifAlis, $USD_EfektifSatis, $zamanDamgasipb, $USD_KısaAdi]);
        $USDEtkilenenSayi   = $USDGuncelle->rowCount();
            if($USDEtkilenenSayi<1){
                echo "USD Güncelleme işleminde hata oluştu.";
                die();
            }
        

        $EUR_Birim          = $icerik->Currency[3]->Unit;
        $EUR_Adi            = $icerik->Currency[3]->Isim;
        $EUR_KısaAdi        = $icerik->Currency[3]["CurrencyCode"];
        $EUR_Alis           = $icerik->Currency[3]->ForexBuying;
        $EUR_Satis          = $icerik->Currency[3]->ForexSelling;
        $EUR_EfektifAlis    = $icerik->Currency[3]->BanknoteBuying;
        $EUR_EfektifSatis   = $icerik->Currency[3]->BanknoteSelling;

        $EURGuncelle        = $database->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $EURGuncelle->execute([$EUR_Adi, $EUR_Birim, $EUR_Alis, $EUR_Satis, $EUR_EfektifAlis, $EUR_EfektifSatis, $zamanDamgasipb, $EUR_KısaAdi]);
        $EUREtkilenenSayi   = $EURGuncelle->rowCount();
            if($EUREtkilenenSayi<1){
                echo "EUR Güncelleme işleminde hata oluştu.";
                die();
            }

        /*
        $AUD_Birim          = $icerik->Currency[1]->Unit;
        $AUD_Adi            = $icerik->Currency[1]->Isim;
        $AUD_KısaAdi        = $icerik->Currency[1]["CurrencyCode"];
        $AUD_Alis           = $icerik->Currency[1]->ForexBuying;
        $AUD_Satis          = $icerik->Currency[1]->ForexSelling;
        $AUD_EfektifAlis    = $icerik->Currency[1]->BanknoteBuying;
        $AUD_EfektifSatis   = $icerik->Currency[1]->BanknoteSelling;

        $AUDGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $AUDGuncelle->execute([$AUD_Adi, $AUD_Birim, $AUD_Alis, $AUD_Satis, $AUD_EfektifAlis, $AUD_EfektifSatis, $zamanDamgasi, $AUD_KısaAdi]);
        $AUDEtkilenenSayi   = $AUDGuncelle->rowCount();
            if($AUDEtkilenenSayi<1){
                echo "AUD Güncelleme işleminde hata oluştu.";
                die();
            }

        $DKK_Birim          = $icerik->Currency[2]->Unit;
        $DKK_Adi            = $icerik->Currency[2]->Isim;
        $DKK_KısaAdi        = $icerik->Currency[2]["CurrencyCode"];
        $DKK_Alis           = $icerik->Currency[2]->ForexBuying;
        $DKK_Satis          = $icerik->Currency[2]->ForexSelling;
        $DKK_EfektifAlis    = $icerik->Currency[2]->BanknoteBuying;
        $DKK_EfektifSatis   = $icerik->Currency[2]->BanknoteSelling;

        $DKKGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $DKKGuncelle->execute([$DKK_Adi, $DKK_Birim, $DKK_Alis, $DKK_Satis, $DKK_EfektifAlis, $DKK_EfektifSatis, $zamanDamgasi, $DKK_KısaAdi]);
        $DKKEtkilenenSayi   = $DKKGuncelle->rowCount();
            if($DKKEtkilenenSayi<1){
                echo "DKK Güncelleme işleminde hata oluştu.";
                die();
            }
        $GBP_Birim          = $icerik->Currency[4]->Unit;
        $GBP_Adi            = $icerik->Currency[4]->Isim;
        $GBP_KısaAdi        = $icerik->Currency[4]["CurrencyCode"];
        $GBP_Alis           = $icerik->Currency[4]->ForexBuying;
        $GBP_Satis          = $icerik->Currency[4]->ForexSelling;
        $GBP_EfektifAlis    = $icerik->Currency[4]->BanknoteBuying;
        $GBP_EfektifSatis   = $icerik->Currency[4]->BanknoteSelling;

        $GBPGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $GBPGuncelle->execute([$GBP_Adi, $GBP_Birim, $GBP_Alis, $GBP_Satis, $GBP_EfektifAlis, $GBP_EfektifSatis, $zamanDamgasi, $GBP_KısaAdi]);
        $GBPEtkilenenSayi   = $GBPGuncelle->rowCount();
            if($GBPEtkilenenSayi<1){
                echo "GBP Güncelleme işleminde hata oluştu.";
                die();
            }

        $CHF_Birim          = $icerik->Currency[5]->Unit;
        $CHF_Adi            = $icerik->Currency[5]->Isim;
        $CHF_KısaAdi        = $icerik->Currency[5]["CurrencyCode"];
        $CHF_Alis           = $icerik->Currency[5]->ForexBuying;
        $CHF_Satis          = $icerik->Currency[5]->ForexSelling;
        $CHF_EfektifAlis    = $icerik->Currency[5]->BanknoteBuying;
        $CHF_EfektifSatis   = $icerik->Currency[5]->BanknoteSelling;

        $CHFGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $CHFGuncelle->execute([$CHF_Adi, $CHF_Birim, $CHF_Alis, $CHF_Satis, $CHF_EfektifAlis, $CHF_EfektifSatis, $zamanDamgasi, $CHF_KısaAdi]);
        $CHFEtkilenenSayi   = $CHFGuncelle->rowCount();
            if($CHFEtkilenenSayi<1){
                echo "CHF Güncelleme işleminde hata oluştu.";
                die();
            }

        $SEK_Birim          = $icerik->Currency[6]->Unit;
        $SEK_Adi            = $icerik->Currency[6]->Isim;
        $SEK_KısaAdi        = $icerik->Currency[6]["CurrencyCode"];
        $SEK_Alis           = $icerik->Currency[6]->ForexBuying;
        $SEK_Satis          = $icerik->Currency[6]->ForexSelling;
        $SEK_EfektifAlis    = $icerik->Currency[6]->BanknoteBuying;
        $SEK_EfektifSatis   = $icerik->Currency[6]->BanknoteSelling;

        $SEKGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $SEKGuncelle->execute([$SEK_Adi, $SEK_Birim, $SEK_Alis, $SEK_Satis, $SEK_EfektifAlis, $SEK_EfektifSatis, $zamanDamgasi, $SEK_KısaAdi]);
        $SEKEtkilenenSayi   = $SEKGuncelle->rowCount();
            if($SEKEtkilenenSayi<1){
                echo "SEK Güncelleme işleminde hata oluştu.";
                die();
            }

        $CAD_Birim          = $icerik->Currency[7]->Unit;
        $CAD_Adi            = $icerik->Currency[7]->Isim;
        $CAD_KısaAdi        = $icerik->Currency[7]["CurrencyCode"];
        $CAD_Alis           = $icerik->Currency[7]->ForexBuying;
        $CAD_Satis          = $icerik->Currency[7]->ForexSelling;
        $CAD_EfektifAlis    = $icerik->Currency[7]->BanknoteBuying;
        $CAD_EfektifSatis   = $icerik->Currency[7]->BanknoteSelling;

        $CADGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $CADGuncelle->execute([$CAD_Adi, $CAD_Birim, $CAD_Alis, $CAD_Satis, $CAD_EfektifAlis, $CAD_EfektifSatis, $zamanDamgasi, $CAD_KısaAdi]);
        $CADEtkilenenSayi   = $CADGuncelle->rowCount();
            if($CADEtkilenenSayi<1){
                echo "CAD Güncelleme işleminde hata oluştu.";
                die();
            }

        $KWD_Birim          = $icerik->Currency[8]->Unit;
        $KWD_Adi            = $icerik->Currency[8]->Isim;
        $KWD_KısaAdi        = $icerik->Currency[8]["CurrencyCode"];
        $KWD_Alis           = $icerik->Currency[8]->ForexBuying;
        $KWD_Satis          = $icerik->Currency[8]->ForexSelling;
        $KWD_EfektifAlis    = $icerik->Currency[8]->BanknoteBuying;
        $KWD_EfektifSatis   = $icerik->Currency[8]->BanknoteSelling;

        $KWDGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $KWDGuncelle->execute([$KWD_Adi, $KWD_Birim, $KWD_Alis, $KWD_Satis, $KWD_EfektifAlis, $KWD_EfektifSatis, $zamanDamgasi, $KWD_KısaAdi]);
        $KWDEtkilenenSayi   = $KWDGuncelle->rowCount();
            if($KWDEtkilenenSayi<1){
                echo "KWD Güncelleme işleminde hata oluştu.";
                die();
            }

        $NOK_Birim          = $icerik->Currency[9]->Unit;
        $NOK_Adi            = $icerik->Currency[9]->Isim;
        $NOK_KısaAdi        = $icerik->Currency[9]["CurrencyCode"];
        $NOK_Alis           = $icerik->Currency[9]->ForexBuying;
        $NOK_Satis          = $icerik->Currency[9]->ForexSelling;
        $NOK_EfektifAlis    = $icerik->Currency[9]->BanknoteBuying;
        $NOK_EfektifSatis   = $icerik->Currency[9]->BanknoteSelling;

        $NOKGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $NOKGuncelle->execute([$NOK_Adi, $NOK_Birim, $NOK_Alis, $NOK_Satis, $NOK_EfektifAlis, $NOK_EfektifSatis, $zamanDamgasi, $NOK_KısaAdi]);
        $NOKEtkilenenSayi   = $NOKGuncelle->rowCount();
            if($NOKEtkilenenSayi<1){
                echo "NOK Güncelleme işleminde hata oluştu.";
                die();
            }

        $SAR_Birim          = $icerik->Currency[10]->Unit;
        $SAR_Adi            = $icerik->Currency[10]->Isim;
        $SAR_KısaAdi        = $icerik->Currency[10]["CurrencyCode"];
        $SAR_Alis           = $icerik->Currency[10]->ForexBuying;
        $SAR_Satis          = $icerik->Currency[10]->ForexSelling;
        $SAR_EfektifAlis    = $icerik->Currency[10]->BanknoteBuying;
        $SAR_EfektifSatis   = $icerik->Currency[10]->BanknoteSelling;

        $SARGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $SARGuncelle->execute([$SAR_Adi, $SAR_Birim, $SAR_Alis, $SAR_Satis, $SAR_EfektifAlis, $SAR_EfektifSatis, $zamanDamgasi, $SAR_KısaAdi]);
        $SAREtkilenenSayi   = $SARGuncelle->rowCount();
            if($SAREtkilenenSayi<1){
                echo "SAR Güncelleme işleminde hata oluştu.";
                die();
            }

        $JPY_Birim          = $icerik->Currency[11]->Unit;
        $JPY_Adi            = $icerik->Currency[11]->Isim;
        $JPY_KısaAdi        = $icerik->Currency[11]["CurrencyCode"];
        $JPY_Alis           = $icerik->Currency[11]->ForexBuying;
        $JPY_Satis          = $icerik->Currency[11]->ForexSelling;
        $JPY_EfektifAlis    = $icerik->Currency[11]->BanknoteBuying;
        $JPY_EfektifSatis   = $icerik->Currency[11]->BanknoteSelling;

        $JPYGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $JPYGuncelle->execute([$JPY_Adi, $JPY_Birim, $JPY_Alis, $JPY_Satis, $JPY_EfektifAlis, $JPY_EfektifSatis, $zamanDamgasi, $JPY_KısaAdi]);
        $JPYEtkilenenSayi   = $JPYGuncelle->rowCount();
            if($JPYEtkilenenSayi<1){
                echo "JPY Güncelleme işleminde hata oluştu.";
                die();
            }

        $BGN_Birim          = $icerik->Currency[12]->Unit;
        $BGN_Adi            = $icerik->Currency[12]->Isim;
        $BGN_KısaAdi        = $icerik->Currency[12]["CurrencyCode"];
        $BGN_Alis           = $icerik->Currency[12]->ForexBuying;
        $BGN_Satis          = $icerik->Currency[12]->ForexSelling;
        $BGN_EfektifAlis    = $icerik->Currency[12]->BanknoteBuying;
        $BGN_EfektifSatis   = $icerik->Currency[12]->BanknoteSelling;

        $BGNGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $BGNGuncelle->execute([$BGN_Adi, $BGN_Birim, $BGN_Alis, $BGN_Satis, $BGN_EfektifAlis, $BGN_EfektifSatis, $zamanDamgasi, $BGN_KısaAdi]);
        $BGNEtkilenenSayi   = $BGNGuncelle->rowCount();
            if($BGNEtkilenenSayi<1){
                echo "BGN Güncelleme işleminde hata oluştu.";
                die();
            }

        $RON_Birim          = $icerik->Currency[13]->Unit;
        $RON_Adi            = $icerik->Currency[13]->Isim;
        $RON_KısaAdi        = $icerik->Currency[13]["CurrencyCode"];
        $RON_Alis           = $icerik->Currency[13]->ForexBuying;
        $RON_Satis          = $icerik->Currency[13]->ForexSelling;
        $RON_EfektifAlis    = $icerik->Currency[13]->BanknoteBuying;
        $RON_EfektifSatis   = $icerik->Currency[13]->BanknoteSelling;

        $RONGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $RONGuncelle->execute([$RON_Adi, $RON_Birim, $RON_Alis, $RON_Satis, $RON_EfektifAlis, $RON_EfektifSatis, $zamanDamgasi, $RON_KısaAdi]);
        $RONEtkilenenSayi   = $RONGuncelle->rowCount();
            if($RONEtkilenenSayi<1){
                echo "RON Güncelleme işleminde hata oluştu.";
                die();
            }

        $RUB_Birim          = $icerik->Currency[14]->Unit;
        $RUB_Adi            = $icerik->Currency[14]->Isim;
        $RUB_KısaAdi        = $icerik->Currency[14]["CurrencyCode"];
        $RUB_Alis           = $icerik->Currency[14]->ForexBuying;
        $RUB_Satis          = $icerik->Currency[14]->ForexSelling;
        $RUB_EfektifAlis    = $icerik->Currency[14]->BanknoteBuying;
        $RUB_EfektifSatis   = $icerik->Currency[14]->BanknoteSelling;

        $RUBGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $RUBGuncelle->execute([$RUB_Adi, $RUB_Birim, $RUB_Alis, $RUB_Satis, $RUB_EfektifAlis, $RUB_EfektifSatis, $zamanDamgasi, $RUB_KısaAdi]);
        $RUBEtkilenenSayi   = $RUBGuncelle->rowCount();
            if($RUBEtkilenenSayi<1){
                echo "RUB Güncelleme işleminde hata oluştu.";
                die();
            }

        $IRR_Birim          = $icerik->Currency[15]->Unit;
        $IRR_Adi            = $icerik->Currency[15]->Isim;
        $IRR_KısaAdi        = $icerik->Currency[15]["CurrencyCode"];
        $IRR_Alis           = $icerik->Currency[15]->ForexBuying;
        $IRR_Satis          = $icerik->Currency[15]->ForexSelling;
        $IRR_EfektifAlis    = $icerik->Currency[15]->BanknoteBuying;
        $IRR_EfektifSatis   = $icerik->Currency[15]->BanknoteSelling;

        $IRRGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $IRRGuncelle->execute([$IRR_Adi, $IRR_Birim, $IRR_Alis, $IRR_Satis, $IRR_EfektifAlis, $IRR_EfektifSatis, $zamanDamgasi, $IRR_KısaAdi]);
        $IRREtkilenenSayi   = $IRRGuncelle->rowCount();
            if($IRREtkilenenSayi<1){
                echo "IRR Güncelleme işleminde hata oluştu.";
                die();
            }

        $CNY_Birim          = $icerik->Currency[16]->Unit;
        $CNY_Adi            = $icerik->Currency[16]->Isim;
        $CNY_KısaAdi        = $icerik->Currency[16]["CurrencyCode"];
        $CNY_Alis           = $icerik->Currency[16]->ForexBuying;
        $CNY_Satis          = $icerik->Currency[16]->ForexSelling;
        $CNY_EfektifAlis    = $icerik->Currency[16]->BanknoteBuying;
        $CNY_EfektifSatis   = $icerik->Currency[16]->BanknoteSelling;

        $CNYGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $CNYGuncelle->execute([$CNY_Adi, $CNY_Birim, $CNY_Alis, $CNY_Satis, $CNY_EfektifAlis, $CNY_EfektifSatis, $zamanDamgasi, $CNY_KısaAdi]);
        $CNYEtkilenenSayi   = $CNYGuncelle->rowCount();
            if($CNYEtkilenenSayi<1){
                echo "CNY Güncelleme işleminde hata oluştu.";
                die();
            }

        $QAR_Birim          = $icerik->Currency[17]->Unit;
        $QAR_Adi            = $icerik->Currency[17]->Isim;
        $QAR_KısaAdi        = $icerik->Currency[17]["CurrencyCode"];
        $QAR_Alis           = $icerik->Currency[17]->ForexBuying;
        $QAR_Satis          = $icerik->Currency[17]->ForexSelling;
        $QAR_EfektifAlis    = $icerik->Currency[17]->BanknoteBuying;
        $QAR_EfektifSatis   = $icerik->Currency[17]->BanknoteSelling;

        $QARGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $QARGuncelle->execute([$QAR_Adi, $QAR_Birim, $QAR_Alis, $QAR_Satis, $QAR_EfektifAlis, $QAR_EfektifSatis, $zamanDamgasi, $QAR_KısaAdi]);
        $QAREtkilenenSayi   = $QARGuncelle->rowCount();
            if($QAREtkilenenSayi<1){
                echo "x Güncelleme işleminde hata oluştu.";
                die();
            }

        $KRW_Birim          = $icerik->Currency[18]->Unit;
        $KRW_Adi            = $icerik->Currency[18]->Isim;
        $KRW_KısaAdi        = $icerik->Currency[18]["CurrencyCode"];
        $KRW_Alis           = $icerik->Currency[18]->ForexBuying;
        $KRW_Satis          = $icerik->Currency[18]->ForexSelling;
        $KRW_EfektifAlis    = $icerik->Currency[18]->BanknoteBuying;
        $KRW_EfektifSatis   = $icerik->Currency[18]->BanknoteSelling;

        $KRWGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $KRWGuncelle->execute([$KRW_Adi, $KRW_Birim, $KRW_Alis, $KRW_Satis, $KRW_EfektifAlis, $KRW_EfektifSatis, $zamanDamgasi, $KRW_KısaAdi]);
        $KRWEtkilenenSayi   = $KRWGuncelle->rowCount();
            if($KRWEtkilenenSayi<1){
                echo "KRW Güncelleme işleminde hata oluştu.";
                die();
            }

        $AZN_Birim          = $icerik->Currency[19]->Unit;
        $AZN_Adi            = $icerik->Currency[19]->Isim;
        $AZN_KısaAdi        = $icerik->Currency[19]["CurrencyCode"];
        $AZN_Alis           = $icerik->Currency[19]->ForexBuying;
        $AZN_Satis          = $icerik->Currency[19]->ForexSelling;
        $AZN_EfektifAlis    = $icerik->Currency[19]->BanknoteBuying;
        $AZN_EfektifSatis   = $icerik->Currency[19]->BanknoteSelling;

        $AZNGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $AZNGuncelle->execute([$AZN_Adi, $AZN_Birim, $AZN_Alis, $AZN_Satis, $AZN_EfektifAlis, $AZN_EfektifSatis, $zamanDamgasi, $AZN_KısaAdi]);
        $AZNEtkilenenSayi   = $USDGuncelle->rowCount();
            if($AZNEtkilenenSayi<1){
                echo "AZN Güncelleme işleminde hata oluştu.";
                die();
            }

        $AED_Birim          = $icerik->Currency[20]->Unit;
        $AED_Adi            = $icerik->Currency[20]->Isim;
        $AED_KısaAdi        = $icerik->Currency[20]["CurrencyCode"];
        $AED_Alis           = $icerik->Currency[20]->ForexBuying;
        $AED_Satis          = $icerik->Currency[20]->ForexSelling;
        $AED_EfektifAlis    = $icerik->Currency[20]->BanknoteBuying;
        $AED_EfektifSatis   = $icerik->Currency[20]->BanknoteSelling;

        $AEDGuncelle        = $veritabaniBaglantisi->prepare("UPDATE dovizkurlari SET adi = ?, birim = ?, alis = ?, satis = ?, efektifalis = ?, efektifsatis = ?, guncellemezamani = ? WHERE kod = ?");
        $AEDGuncelle->execute([$AED_Adi, $AED_Birim, $AED_Alis, $AED_Satis, $AED_EfektifAlis, $AED_EfektifSatis, $zamanDamgasi, $AED_KısaAdi]);
        $AEDEtkilenenSayi   = $AEDGuncelle->rowCount();
            if($AEDEtkilenenSayi<1){
                echo "AED Güncelleme işleminde hata oluştu.";
                die();
            }
        */
        header("Location:index.php");
    }else{
        header("Location:girissayfasi.php");
      }
      $database = null;
      ?>
       