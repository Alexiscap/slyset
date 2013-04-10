-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 10 Avril 2013 à 10:38
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

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
-- Structure de la table `achats`
--

CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Morceaux_id` int(11) NOT NULL,
  `Albums_id` int(11) NOT NULL,
  `Melomane_id` int(11) NOT NULL,
  `Artiste_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Achats_Morceaux1_idx` (`Morceaux_id`),
  KEY `fk_Achats_Albums1_idx` (`Albums_id`),
  KEY `fk_Achats_Melomane1_idx` (`Melomane_id`),
  KEY `fk_Achats_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `annee` year(4) DEFAULT NULL,
  `participants` text,
  `producteur` varchar(125) DEFAULT NULL,
  `publie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Albums_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE IF NOT EXISTS `artiste` (
  `id` int(11) NOT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Artiste_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `communaute_artiste`
--

CREATE TABLE IF NOT EXISTS `communaute_artiste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Melomane_id` int(11) NOT NULL,
  `Artiste_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Communaute_artiste_Melomane1_idx` (`Melomane_id`),
  KEY `fk_Communaute_artiste_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `communaute_melomane`
--

CREATE TABLE IF NOT EXISTS `communaute_melomane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Melomane_id` int(11) NOT NULL,
  `Artiste_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Communaute_artiste_Melomane1_idx` (`Melomane_id`),
  KEY `fk_Communaute_artiste_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`,`Artiste_id`),
  KEY `fk_Concert_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `concerts_activite`
--

CREATE TABLE IF NOT EXISTS `concerts_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Concerts_id` int(11) NOT NULL,
  `Concerts_Artiste_id` int(11) NOT NULL,
  `Melomane_id` int(11) NOT NULL,
  `participation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Concerts_activite_Concerts1_idx` (`Concerts_id`,`Concerts_Artiste_id`),
  KEY `fk_Concerts_activite_Melomane1_idx` (`Melomane_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `livrets`
--

CREATE TABLE IF NOT EXISTS `livrets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Albums_id` int(11) NOT NULL,
  `path` text,
  PRIMARY KEY (`id`),
  KEY `fk_Livrets_Albums1_idx` (`Albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `melomane`
--

CREATE TABLE IF NOT EXISTS `melomane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Melomane_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `morceaux`
--

CREATE TABLE IF NOT EXISTS `morceaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `Albums_id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `duree` timestamp NULL DEFAULT NULL,
  `nombre_lectures` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Musique_Artiste_idx` (`Artiste_id`),
  KEY `fk_Morceaux_Albums1_idx` (`Albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `page_personnalise`
--

CREATE TABLE IF NOT EXISTS `page_personnalise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `banniere` varchar(45) DEFAULT NULL,
  `couleur1` varchar(45) DEFAULT NULL,
  `couleur2` varchar(45) DEFAULT NULL,
  `couleur3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Page_personnalise_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `partitions`
--

CREATE TABLE IF NOT EXISTS `partitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Albums_id` int(11) NOT NULL,
  `path` text,
  PRIMARY KEY (`id`),
  KEY `fk_Partitions_Albums1_idx` (`Albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Photos_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `playlists`
--

CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `Morceaux_id` int(11) NOT NULL,
  `nom` varchar(125) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Playlists_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Playlists_Morceaux1_idx` (`Morceaux_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `statistiques`
--

CREATE TABLE IF NOT EXISTS `statistiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `stats_visites` int(11) DEFAULT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `stats_hommes` int(11) DEFAULT NULL,
  `stats_femmes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Statistiques_musiques_Artiste1_idx` (`Artiste_id`),
  KEY `fk_Statistiques_musiques_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `nom` varchar(125) DEFAULT NULL,
  `prenom` varchar(125) DEFAULT NULL,
  `login` varchar(125) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `ville` varchar(125) DEFAULT NULL,
  `pays` varchar(45) DEFAULT NULL,
  `genre` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Artiste_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `lieu` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Videos_Artiste1_idx` (`Artiste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wall_artiste`
--

CREATE TABLE IF NOT EXISTS `wall_artiste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wall_melomane`
--

CREATE TABLE IF NOT EXISTS `wall_melomane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
