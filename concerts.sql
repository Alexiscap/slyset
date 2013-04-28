-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 28 Avril 2013 à 23:26
-- Version du serveur: 5.6.10
-- Version de PHP: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `preprod-slyset`
--

-- --------------------------------------------------------

--
-- Structure de la table `concerts`
--

CREATE TABLE IF NOT EXISTS `concerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `lieu` varchar(45) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL,
  `snd_partie` varchar(40) DEFAULT NULL,
  `website_salle` varchar(45) DEFAULT NULL,
  `phone_salle` varchar(17) DEFAULT NULL,
  `adress_salle` varchar(100) DEFAULT NULL,
  `cp_ville` int(5) DEFAULT NULL,
  `prix` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`Artiste_id`),
  KEY `fk_Concert_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `concerts`
--

INSERT INTO `concerts` (`id`, `Artiste_id`, `titre`, `lieu`, `date`, `ville`, `snd_partie`, `website_salle`, `phone_salle`, `adress_salle`, `cp_ville`, `prix`) VALUES
(1, 2, 'Bob Dylan', 'L''Aeronef', '2013-11-28 19:30:00', 'Lille', '', '', '', '', 0, 0),
(2, 2, 'Beach House', 'Aeronef', '2013-04-04 22:00:00', '', '', '', '', '', 0, 0),
(3, 3, 'Grizzly Bear', NULL, NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 0, 0),
(4, 2, 'Grizlly Bear', 'Le Grand Mix', NULL, 'Lille', 'Lower Dens', 'NULL', 'NULL', 'NULL', 0, 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 134217728 bytes exhausted (tried to allocate 8456596 bytes) in <b>Unknown</b> on line <b>0</b><br />
