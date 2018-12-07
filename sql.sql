-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2018 at 06:09 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_face`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configs`
--

DROP TABLE IF EXISTS `tbl_configs`;
CREATE TABLE IF NOT EXISTS `tbl_configs` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokken_app` text COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_configs`
--

INSERT INTO `tbl_configs` (`id_config`, `app_id`, `app_secret`, `tokken_app`, `base_url`) VALUES
(1, '1818982511557330', 'af193b7076a831de36ff3e49926bf6fe', 'EAAZA2Wt50OtIBAC7Ao34WnXvMHhdD3APXl0ZBZClIY9LJV83Lr0xFzzwjhC11NWtCfxzhWnqgOGnzEOj45tXsxCgxuxixr1MntyhSNPVc92AnFv0NHVPyGGStgfwUoZC3drJBXgkegWYB1agWcyA3bJeYUUhVCxfb2CpCJsxZBZBjSmztAoQqdZAVD8rzzNbRkZD', 'http://localhost/faceads/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contas`
--

DROP TABLE IF EXISTS `tbl_contas`;
CREATE TABLE IF NOT EXISTS `tbl_contas` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_unidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_conta`),
  UNIQUE KEY `account_id` (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_contas`
--

INSERT INTO `tbl_contas` (`id_conta`, `account_id`, `nome_unidade`) VALUES
(56, '258725951253917', 'IEB - Canoas'),
(57, '258732684586577', 'IEB - Caratinga'),
(58, '397835654009612', 'IEB - Ipatinga Cidade Nobre'),
(59, '245101059283073', 'IEB Fabriciano'),
(60, '397773917349119', 'IEB GV Centro'),
(92, '119376858185358', 'IEB Ipatinga'),
(62, '258725724587273', 'IEB Manhuaçu'),
(63, '1835299670106341', 'IEB Uberaba'),
(64, '386043968522114', 'IEB Vitória'),
(65, '258603304599515', 'OralDents - BH - Venda Nova'),
(66, '254028701723642', 'OralDents - Cachoeirinha'),
(67, '303422163450962', 'OralDents - Divinópolis'),
(68, '302942113498967', 'OralDents - Macaé'),
(69, '2285788971463150', 'oraldents sete lagoas'),
(70, '253989805060865', 'OralDents - Nova Friburgo'),
(71, '420720064941578', 'OralDents - Timoteo'),
(72, '628798633997740', 'OralDents Caratinga'),
(73, '315704132222765', 'OralDents Colatina'),
(74, '155030075004767', 'OralDents Fabriciano'),
(75, '155030355004739', 'OralDents Valadares'),
(76, '378016222658222', 'Oraldents - Barra de São Francisco'),
(77, '274471316346047', 'Oraldents - Bom Jardim'),
(78, '302940913499087', 'Oraldents - Itaperuna'),
(79, '254029148390264', 'Oraldents - Salvador'),
(80, '442910196112844', 'Oraldents - Serra - ES'),
(81, '628798783997725', 'Oraldents - Sete Lagoas'),
(82, '374893772970467', 'Oraldents - Teófilo Otoni'),
(83, '297333507393161', 'Oraldents - Tijuca'),
(84, '435223586937485', 'Oraldents Campos'),
(85, '435223006937543', 'Oraldents Cariacica'),
(86, '2163542860592097', 'Oraldents Conselheiro Lafaiete'),
(87, '299619287317651', 'Oraldents Conselheiro Pena'),
(88, '380225029104008', 'Oraldents Ipatinga Canaã'),
(89, '1828279840562908', 'Oraldents Lagoa Santa'),
(90, '1658484804262035', 'Oraldents Nova Venecia'),
(91, '380942285698949', 'Oraldents Ponte Nova');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nome_user` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `email_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha_user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_user`, `nome_user`, `email_user`, `senha_user`) VALUES
(1, 'italo', 'email@email.com', '$2y$10$L.MvUE8ZDDMDFMX04rqGf.wxPg3TOs8vnWZAOGu/eHhb2zAr/ofs2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_ads`
--

DROP TABLE IF EXISTS `tbl_log_ads`;
CREATE TABLE IF NOT EXISTS `tbl_log_ads` (
  `id_cadastro` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_name` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `reach` decimal(10,0) NOT NULL,
  `spend` decimal(10,2) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_final` date NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cadastro`),
  UNIQUE KEY `campaign_id` (`campaign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
