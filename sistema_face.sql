-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2018 at 01:44 PM
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
-- Table structure for table `tbl_contas`
--

DROP TABLE IF EXISTS `tbl_contas`;
CREATE TABLE IF NOT EXISTS `tbl_contas` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nome_unidade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_conta`),
  UNIQUE KEY `account_id` (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_contas`
--

INSERT INTO `tbl_contas` (`id_conta`, `account_id`, `nome_unidade`) VALUES
(40, 'ss', 'sss');

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
  `spend` decimal(10,1) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_final` date NOT NULL,
  `data_insercao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cadastro`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
