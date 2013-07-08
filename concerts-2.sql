-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 02 Mai 2013 à 09:28
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
  `Utilisateur_id` int(11) NOT NULL,
  `Adresse_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `seconde_partie` varchar(200) DEFAULT NULL,
  `salle` varchar(30) DEFAULT NULL,
  `prix` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`,`Utilisateur_id`),
  KEY `fk_Concerts_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Concerts_Adresse1_idx` (`Adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `concerts`
--

INSERT INTO `concerts` (`id`, `Utilisateur_id`, `Adresse_id`, `titre`, `date`, `seconde_partie`, `salle`, `prix`) VALUES
(1, 1, 1, 'Beach House', '2013-05-02 22:00:00', 'Lower Dens', 'L''aeronef', 12),
(2, 2, 1, 'Bob Dylan', '2013-05-21 22:00:00', 'Jim Morrison', 'La fleche d''or', 14);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
<br />
<b>Fatal error</b>:  Allowed memory size of 134217728 bytes exhausted (tried to allocate 8398887 bytes) in <b>Unknown</b> on line <b>0</b><br />
