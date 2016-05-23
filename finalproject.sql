-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 May 2016, 05:01:28
-- Sunucu sürümü: 5.7.9
-- PHP Sürümü: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `finalproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Url` varchar(750) NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `I_UserID` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`ID`, `Name`, `Url`, `ImageName`, `Description`, `UserID`) VALUES
(1, 'Python', 'https://www.python.org/', '21.jpg', 'Python, nesne yÃ¶nelimli, yorumlamalÄ±, birimsel (modÃ¼ler) ve etkileÅŸimli yÃ¼ksek seviyeli bir programlama dilidir. Girintilere dayalÄ± basit sÃ¶zdizimi, dilin Ã¶ÄŸrenilmesini ve akÄ±lda kalmasÄ±nÄ± kolaylaÅŸtÄ±rÄ±r. Bu da ona sÃ¶z diziminin ayrÄ±ntÄ±larÄ± ile vakit yitirmeden programlama yapÄ±lmaya baÅŸlanabilen bir dil olma Ã¶zelliÄŸi kazandÄ±rÄ±r. ModÃ¼ler yapÄ±sÄ±, sÄ±nÄ±f dizgesini (sistem) ve her tÃ¼rlÃ¼ veri alanÄ± giriÅŸini destekler. Hemen hemen her tÃ¼rlÃ¼ platformda Ã§alÄ±ÅŸabilir. (Unix , Linux, Mac, Windows, Amiga, Symbian). Python ile sistem programlama, kullanÄ±cÄ± arabirimi programlama, aÄŸ programlama, uygulama ve veritabanÄ± yazÄ±lÄ±mÄ± programlama gibi birÃ§ok alanda yazÄ±lÄ±m geliÅŸtirebilirsiniz. BÃ¼yÃ¼k yazÄ±lÄ±mlarÄ±n hÄ±zlÄ± bir ÅŸekilde prototiplerinin Ã¼retilmesi ve denenmesi gerektiÄŸi durumlarda da C ya da C++ gibi dillere tercih edilir.', 2),
(4, 'C++', 'https://tr.wikipedia.org/wiki/C++', '6.jpg', 'C++ (TÃ¼rkÃ§e okunuÅŸu: ce artÄ± artÄ±, Ä°ngilizce okunuÅŸu: si plas plas), Bell LaboratuvarlarÄ±ndan Bjarne Stroustrup tarafÄ±ndan 1979 yÄ±lÄ±ndan itibaren geliÅŸtirilmeye baÅŸlanmÄ±ÅŸ, C''yi kapsayan ve Ã§ok paradigmalÄ±, yaygÄ±n olarak kullanÄ±lan, genel amaÃ§lÄ± bir programlama dilidir. Ä°lk olarak C With Classes (SÄ±nÄ±flarla C) olarak adlandÄ±rÄ±lmÄ±ÅŸ, 1983 yÄ±lÄ±nda ismi C++ olarak deÄŸiÅŸtirilmiÅŸtir.', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `reference`
--

DROP TABLE IF EXISTS `reference`;
CREATE TABLE IF NOT EXISTS `reference` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `ImageName` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `reference`
--

INSERT INTO `reference` (`ID`, `Name`, `ImageName`) VALUES
(1, 'Aksa Sigorta', 'axa_sigorta_logo.gif');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(250) NOT NULL,
  `Username` varchar(150) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`ID`, `Email`, `Username`, `Password`) VALUES
(2, 'a@a.c', 'alelade', '123123'),
(3, 'a@a.c', 'admin', 'Admin123');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
