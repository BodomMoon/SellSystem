-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2017 年 08 月 17 日 14:17
-- 伺服器版本: 5.6.15-log
-- PHP 版本： 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `pay2go`
--

-- --------------------------------------------------------

--
-- 資料表結構 `nexon`
--

CREATE TABLE IF NOT EXISTS `nexon` (
  `cardNum` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `cardPrice` varchar(10) COLLATE utf8_unicode_520_ci NOT NULL,
  `isSell` int(1) DEFAULT '0',
  `buyMan` varchar(10) COLLATE utf8_unicode_520_ci DEFAULT NULL,
  `buyID` int(11) DEFAULT NULL,
  `ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `nexon`
--

INSERT INTO `nexon` (`cardNum`, `cardPrice`, `isSell`, `buyMan`, `buyID`, `ID`) VALUES
('MLPFK-NEGRP-KNCJP-OWM', '155', 0, NULL, NULL, 1),
('MEVCB-NEGRP-MICPJ-OWM', '155', 0, NULL, NULL, 2),
('MLPFK-KAWIJ-LOJQJ-UTJ', '300', 1, '邊緣人', 3, 3),
('MICPJ-BQOAR-URNQL-QGI', '300', 1, '邊緣人', 3, 4),
('MICPJ-BQOAR-AEPEN-OWR', '300', 0, NULL, NULL, 5),
('AEPEN-BQOAR-URNQL-OWR', '155', 0, NULL, NULL, 6),
('EVCEV-KCGIP-KHOTQ-FWV', '155', 0, NULL, NULL, 7),
('EVCEV-ENBBL-AEPEN-CHN', '300', 0, NULL, NULL, 8),
('ENBBL-KCGIP-AEPEN-KHO', '155', 0, NULL, NULL, 9),
('SFQAA-LKOHF-KSQQB-PQO', '300', 0, NULL, NULL, 10),
('SFQAA-NNWQI-MIGRR-BHF', '155', 0, NULL, NULL, 11),
('PQOEH-JUWUN-KSQQB-LKO', '300', 0, NULL, NULL, 12);

-- --------------------------------------------------------

--
-- 資料表結構 `pay2go`
--

CREATE TABLE IF NOT EXISTS `pay2go` (
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(100) COLLATE utf8_unicode_520_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_520_ci NOT NULL,
  `phoneNum` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_520_ci NOT NULL,
  `sellCode` varchar(100) COLLATE utf8_unicode_520_ci NOT NULL,
  `total` int(11) NOT NULL,
  `ID` int(11) NOT NULL DEFAULT '0',
  `isPay` int(11) NOT NULL DEFAULT '0',
  `itemOut` int(11) NOT NULL DEFAULT '0',
  `payDate` date NOT NULL,
  `sellDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `pay2go`
--

INSERT INTO `pay2go` (`price`, `amount`, `payment`, `Name`, `phoneNum`, `email`, `sellCode`, `total`, `ID`, `isPay`, `itemOut`, `payDate`, `sellDate`) VALUES
(155, 1, 'ATM', '洨應', '0800-092-000', 'C8763@gmail.com', '1969 0432 732', 155, 1, 0, 0, '0000-00-00', '0000-00-00'),
(155, 2, 'familyMarket', '虞臺文', '1995', 'CPE.com', 'LCB60611241119', 310, 2, 1, 0, '2016-06-11', '0000-00-00'),
(300, 2, 'familyMarket', '邊緣人', '', 'sideman@gmail.com', 'LCB60611243690', 600, 3, 1, 1, '2016-06-11', '0000-00-00'),
(155, 1, 'familyMarket', '2', '2', '2', '', 155, 4, 0, 0, '0000-00-00', '0000-00-00'),
(155, 1, 'familyMarket', '2', '2', '2', '', 155, 5, 0, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- 資料表結構 `pay2gobd`
--

CREATE TABLE IF NOT EXISTS `pay2gobd` (
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(100) COLLATE utf8_unicode_520_ci NOT NULL,
  `Name` varchar(10) COLLATE utf8_unicode_520_ci NOT NULL,
  `phoneNum` varchar(15) COLLATE utf8_unicode_520_ci NOT NULL,
  `Account` varchar(16) COLLATE utf8_unicode_520_ci NOT NULL,
  `Password` varchar(16) COLLATE utf8_unicode_520_ci NOT NULL,
  `sellCode` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `total` int(11) NOT NULL,
  `ID` int(11) NOT NULL DEFAULT '0',
  `isPay` int(11) NOT NULL DEFAULT '0',
  `itemOut` int(11) NOT NULL DEFAULT '0',
  `payDate` date NOT NULL,
  `sellDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `pay2gobd`
--

INSERT INTO `pay2gobd` (`price`, `amount`, `payment`, `Name`, `phoneNum`, `Account`, `Password`, `sellCode`, `total`, `ID`, `isPay`, `itemOut`, `payDate`, `sellDate`) VALUES
(315, 10, 'familyMarket', '謝時銘', '0204', 'Neko%%', 'Neko%me', 'LCB60611245413 ', 3150, 1, 1, 1, '2016-06-11', '2016-06-11'),
(315, 2, 'ATM', '狗大濕', '3.14159', 'Math_Hero', 'Doge', '1969 0432 732', 630, 2, 0, 0, '0000-00-00', '0000-00-00'),
(315, 3, 'ATM', 'WinDoge7', '', 'MoreDoge', 'DogePower', '1969 0432 732', 945, 3, 0, 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- 資料表結構 `pay2gosdne`
--

CREATE TABLE IF NOT EXISTS `pay2gosdne` (
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment` varchar(21) COLLATE utf8_unicode_520_ci NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `phoneNum` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `gameID` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `sellCode` varchar(21) COLLATE utf8_unicode_520_ci NOT NULL,
  `total` int(11) NOT NULL,
  `ID` int(11) NOT NULL DEFAULT '0',
  `isPay` int(11) NOT NULL DEFAULT '0',
  `itemOut` int(11) NOT NULL DEFAULT '0',
  `payDate` date NOT NULL,
  `sellDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `pay2gosdne`
--

INSERT INTO `pay2gosdne` (`price`, `amount`, `payment`, `Name`, `phoneNum`, `gameID`, `sellCode`, `total`, `ID`, `isPay`, `itemOut`, `payDate`, `sellDate`) VALUES
(300, 3, 'ATM', '45612', '456', '789', '1969 0432 732', 900, 1, 1, 1, '2016-06-10', '2016-06-11'),
(300, 2, 'ATM', '123', '456', '789', '1969 0432 732', 600, 2, 1, 1, '2016-06-10', '2016-06-11');

-- --------------------------------------------------------

--
-- 資料表結構 `paycode`
--

CREATE TABLE IF NOT EXISTS `paycode` (
  `sellCode` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `paycode`
--

INSERT INTO `paycode` (`sellCode`, `price`, `amount`) VALUES
('LCB60611241035', 155, 1),
('LCB60611241119 ', 155, 2),
('LCB60611242415 ', 300, 1),
('LCB60611243690', 300, 2),
('LCB60611245406', 160, 1),
('LCB60611245413 ', 315, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `Account` int(10) NOT NULL,
  `Password` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL,
  `Name` varchar(20) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- 資料表的匯出資料 `seller`
--

INSERT INTO `seller` (`Account`, `Password`, `Name`) VALUES
(410306131, 'cftred850727', 'BodomMoon任');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
