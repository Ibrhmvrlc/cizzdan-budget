-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 07 May 2023, 20:04:23
-- Sunucu sürümü: 8.0.32-cll-lve
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cizzdanc_cizzdan`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dovizkurlari`
--

CREATE TABLE `dovizkurlari` (
  `id` int UNSIGNED NOT NULL,
  `adi` varchar(100) NOT NULL,
  `kod` varchar(10) NOT NULL,
  `birim` int UNSIGNED NOT NULL,
  `alis` double NOT NULL,
  `satis` double NOT NULL,
  `efektifalis` double NOT NULL,
  `efektifsatis` double NOT NULL,
  `guncellemezamani` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `dovizkurlari`
--

INSERT INTO `dovizkurlari` (`id`, `adi`, `kod`, `birim`, `alis`, `satis`, `efektifalis`, `efektifsatis`, `guncellemezamani`) VALUES
(1, 'TURK LIRASI', 'TRY', 1, 1, 1, 1, 1, ''),
(2, 'ABD DOLARI', 'USD', 1, 19.4647, 19.4998, 19.4511, 19.529, '1683272365'),
(3, 'EURO', 'EUR', 1, 21.5293, 21.5681, 21.5142, 21.6004, '1683272365');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ibrhmvrlc_aylar`
--

CREATE TABLE `ibrhmvrlc_aylar` (
  `id` int UNSIGNED NOT NULL,
  `ayismi` char(8) NOT NULL,
  `net` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `ibrhmvrlc_aylar`
--

INSERT INTO `ibrhmvrlc_aylar` (`id`, `ayismi`, `net`) VALUES
(1, 'OCAK', 0),
(2, 'SUBAT', 0),
(3, 'MART', -6464),
(4, 'NISAN', -17720),
(5, 'MAYIS', -6658),
(6, 'HAZIRAN', 0),
(7, 'TEMMUZ', 0),
(8, 'AGUSTOS', 0),
(9, 'EYLUL', 0),
(10, 'EKIM', 0),
(11, 'KASIM', 0),
(12, 'ARALIK', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ibrhmvrlc_gelirler`
--

CREATE TABLE `ibrhmvrlc_gelirler` (
  `id` int UNSIGNED NOT NULL,
  `ustid` int UNSIGNED NOT NULL,
  `gelirgirdiadi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gelirgirdi` int DEFAULT NULL,
  `geliraciklama` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `ibrhmvrlc_gelirler`
--

INSERT INTO `ibrhmvrlc_gelirler` (`id`, `ustid`, `gelirgirdiadi`, `gelirgirdi`, `geliraciklama`) VALUES
(1, 1, 'Gelir Adı', 0, 'Gelir Açıklama'),
(2, 1, 'Ocak ayı Toplamı', 0, ''),
(4, 2, 'Şubat ayı Toplamı', 16726, ''),
(6, 3, 'Mart ayı Toplamı', 0, ''),
(8, 4, 'Nisan ayı Toplamı', 0, ''),
(9, 5, 'Gelir Adı', 0, 'Gelir Açıklama'),
(10, 5, 'Mayis ayı Toplamı', 0, ''),
(11, 6, 'Gelir Adı', 0, 'Gelir Açıklama'),
(12, 6, 'Haziran ayı Toplamı', 0, ''),
(13, 7, 'Gelir Adı', 0, 'Gelir Açıklama'),
(14, 7, 'Temmuz ayı Toplamı', 0, ''),
(15, 8, 'Gelir Adı', 0, 'Gelir Açıklama'),
(16, 8, 'Ağustos ayı Toplamı', 0, ''),
(17, 9, 'Gelir Adı', 0, 'Gelir Açıklama'),
(18, 9, 'Eylül ayı Toplamı', 0, ''),
(19, 10, 'Gelir Adı', 0, 'Gelir Açıklama'),
(20, 10, 'Ekim ayı Toplamı', 0, ''),
(21, 11, 'Gelir Adı', 0, 'Gelir Açıklama'),
(22, 11, 'Kasım ayı Toplamı', 0, ''),
(23, 12, 'Gelir Adı', 0, 'Gelir Açıklama'),
(24, 12, 'Aralık ayı Toplamı', 0, ''),
(27, 2, 'Maaş', 15000, '5i ile 10&#039;u arasında'),
(28, 2, 'Yatırım Hesabı', 1726, 'Giderlerden kalan borcu dengelemek için çekilecek tutar'),
(29, 3, 'Gelir Adı', 0, 'Gelir Açıklama Alanı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ibrhmvrlc_giderler`
--

CREATE TABLE `ibrhmvrlc_giderler` (
  `id` int UNSIGNED NOT NULL,
  `ustid` int UNSIGNED NOT NULL,
  `gidergirdiadi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `gidergirdi` int DEFAULT NULL,
  `gideraciklama` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `ibrhmvrlc_giderler`
--

INSERT INTO `ibrhmvrlc_giderler` (`id`, `ustid`, `gidergirdiadi`, `gidergirdi`, `gideraciklama`) VALUES
(1, 1, 'Gider Adı', 0, 'Gider Açıklama'),
(2, 1, 'Ocak ayı Toplamı', 0, ''),
(3, 2, 'Garanti 3k&#039;lık kredi', 551, '28&#039;inde 6/3.taksit ödemesi.'),
(4, 2, 'Şubat ayı Toplamı', 16726, ''),
(6, 3, 'Mart ayı Toplamı', 6464, ''),
(8, 4, 'Nisan ayı Toplamı', 17720, ''),
(9, 5, 'Garanti Kredi Kartı', 2200, 'Gider Açıklama'),
(10, 5, 'Mayıs ayı Toplamı', 6658, ''),
(11, 6, 'Gider Adı', 0, 'Gider Açıklama'),
(12, 6, 'Haziran ayı Toplamı', 0, ''),
(13, 7, 'Gider Adı', 0, 'Gider Açıklama'),
(14, 7, 'Temmuz ayı Toplamı', 0, ''),
(15, 8, 'Gider Adı', 0, 'Gider Açıklama'),
(16, 8, 'Ağustos ayı Toplamı', 0, ''),
(17, 9, 'Gider Adı', 0, 'Gider Açıklama'),
(18, 9, 'Eylül ayı Toplamı', 0, ''),
(19, 10, 'Gider Adı', 0, 'Gider Açıklama'),
(20, 10, 'Ekim ayı Toplamı', 0, ''),
(21, 11, 'Gider Adı', 0, 'Gider Açıklama'),
(22, 11, 'Kasım ayı Toplamı', 0, ''),
(23, 12, 'Gider Adı', 0, 'Gider Açıklama'),
(24, 12, 'Aralık ayı Toplamı', 0, ''),
(28, 2, 'Garanti 5k&#039;lık kredi', 495, 'Giderlerden kalan borcu dengelemek için çekilecek tutar'),
(29, 2, 'Garanti 7.5k&#039;lık kredi', 2206, '10&#039;unda 4/3.taksit ödemesi'),
(30, 2, 'Garanti kredi kartı', 3500, '4&#039;ünde Kredi kartı borcunun(13.725) Minimum ödemesi. 14&#039;ü son ödeme.'),
(31, 2, 'Akbank Kredi kartı', 798, '1&#039;inde. Minimum borç ödendi. Kalan mebla gideri.'),
(32, 2, 'Akbank Artı para', 1018, 'Kredi kartı min borcu ödemek için kullanılmıştı.'),
(33, 2, 'QNB Ek Hesap', 390, '1&#039;inde son son ödeme.'),
(34, 2, 'QNB Kredi Kartı', 2431, '13&#039;ü ekstre kesim'),
(35, 2, 'Bedelli Askerlik ödemesi', 5337, '10&#039;unda'),
(48, 3, 'Garanti Kredi kartı', 2747, 'Gider Açıklama Alanı'),
(49, 3, 'Garanti Kredi', 552, 'Gider Açıklama Alanı'),
(52, 3, 'Akbank Artı Para', 1994, 'Gider Açıklama Alanı'),
(53, 3, 'Akbank Kredi Kartı', 1171, 'Gider Açıklama Alanı'),
(54, 4, 'Garanti Kredi Kartı', 2560, 'Gider Açıklama Alanı'),
(55, 4, 'Garanti Kredi', 551, 'Gider Açıklama Alanı'),
(56, 4, 'Garanti Kredi', 495, 'Gider Açıklama Alanı'),
(57, 4, 'QNB Kredi Kartı', 2265, 'Gider Açıklama Alanı'),
(58, 4, 'QNB Kredi', 1090, 'Gider Açıklama Alanı'),
(59, 4, 'Akbank Kredi Kartı', 159, 'Gider Açıklama Alanı'),
(60, 4, 'Nisan Ayı bedelli Taksiti', 5300, 'Gider Açıklama Alanı'),
(61, 4, 'Mayıs Ayı bedelli Taksiti', 5300, 'Gider Açıklama Alanı'),
(62, 5, 'Garanti Kredi', 551, 'Gider Açıklama Alanı'),
(63, 5, 'Garanti Kredi', 495, 'Gider Açıklama Alanı'),
(64, 5, 'QNB Kredi Kartı', 2163, 'Gider Açıklama Alanı'),
(65, 5, 'QNB Kredi', 1090, 'Gider Açıklama Alanı'),
(66, 5, 'Akbank Kredi Kartı', 159, 'Gider Açıklama Alanı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int UNSIGNED NOT NULL,
  `kullaniciadi` varchar(50) NOT NULL,
  `sifre` varchar(50) NOT NULL,
  `adisoyadi` varchar(100) NOT NULL,
  `emailadresi` varchar(100) NOT NULL,
  `kayittarihi` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kullaniciadi`, `sifre`, `adisoyadi`, `emailadresi`, `kayittarihi`) VALUES
(1, 'ibrhmvrlc', '9150090', 'İbrahim VARELCİ', 'varelci.i@gmail.com', 1674675885);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `dovizkurlari`
--
ALTER TABLE `dovizkurlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ibrhmvrlc_aylar`
--
ALTER TABLE `ibrhmvrlc_aylar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ibrhmvrlc_gelirler`
--
ALTER TABLE `ibrhmvrlc_gelirler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ibrhmvrlc_giderler`
--
ALTER TABLE `ibrhmvrlc_giderler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `dovizkurlari`
--
ALTER TABLE `dovizkurlari`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ibrhmvrlc_aylar`
--
ALTER TABLE `ibrhmvrlc_aylar`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `ibrhmvrlc_gelirler`
--
ALTER TABLE `ibrhmvrlc_gelirler`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `ibrhmvrlc_giderler`
--
ALTER TABLE `ibrhmvrlc_giderler`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
