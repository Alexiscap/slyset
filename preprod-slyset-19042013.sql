-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 20 Avril 2013 à 20:40
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
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_adresse` varchar(20) DEFAULT NULL,
  `voie_adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `code_postal` varchar(10) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `date` timestamp NULL DEFAULT NULL,
  `participants` text,
  `producteur` varchar(125) DEFAULT NULL,
  `publie` int(11) DEFAULT NULL,
  `livret_path` text,
  `prix` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Albums_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `album_media`
--

CREATE TABLE IF NOT EXISTS `album_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `like_total` int(11) DEFAULT NULL,
  `Videos_id` int(11) NOT NULL,
  `Photos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Album_media_Videos1_idx` (`Videos_id`),
  KEY `fk_Album_media_Photos1_idx` (`Photos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `article` text,
  `image` varchar(255) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Articles_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Achats_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Wall_id` int(11) NOT NULL,
  `comment` text,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Commentaires_Wall1_idx` (`Wall_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `communaute`
--

CREATE TABLE IF NOT EXISTS `communaute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Communaute_artiste_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`,`Utilisateur_id`),
  KEY `fk_Concerts_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Concerts_Adresse1_idx` (`Adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `concerts_activite`
--

CREATE TABLE IF NOT EXISTS `concerts_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `Concerts_id` int(11) NOT NULL,
  `participation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Concerts_activite_Concerts1_idx` (`Concerts_id`),
  KEY `fk_Concerts_activite_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Morceaux_id` int(11) NOT NULL,
  `path` text,
  `type_document` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Partitions_Morceaux1_idx` (`Morceaux_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `infos_commande`
--

CREATE TABLE IF NOT EXISTS `infos_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Commande_id` int(11) NOT NULL,
  `Albums_id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `prix` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Infos_commande_Commande1_idx` (`Commande_id`),
  KEY `fk_Infos_commande_Albums1_idx` (`Albums_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like_value` int(11) DEFAULT NULL,
  `Photos_id` int(11) NOT NULL,
  `Videos_id` int(11) NOT NULL,
  `Morceaux_id` int(11) NOT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `Album_media_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Like_Photos1_idx` (`Photos_id`),
  KEY `fk_Like_Videos1_idx` (`Videos_id`),
  KEY `fk_Like_Morceaux1_idx` (`Morceaux_id`),
  KEY `fk_Like_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Like_Album_media1_idx` (`Album_media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `morceaux`
--

CREATE TABLE IF NOT EXISTS `morceaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Albums_id` int(11) NOT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `duree` timestamp NULL DEFAULT NULL,
  `nombre_lectures` int(11) DEFAULT NULL,
  `prix` float(5,2) DEFAULT NULL,
  `Videos_id` int(11) NOT NULL,
  `like_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Morceaux_Albums1_idx` (`Albums_id`),
  KEY `fk_Morceaux_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Morceaux_Videos1_idx` (`Videos_id`)
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
-- Structure de la table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `Adresse_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `like_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Photos_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Photos_Adresse1_idx` (`Adresse_id`)
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
  `Utilisateur_id` int(11) NOT NULL,
  `stats_visites` int(11) DEFAULT NULL,
  `stats_hommes` int(11) DEFAULT NULL,
  `stats_femmes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
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
  `Adresse_id` int(11) NOT NULL,
  `nationalite` varchar(125) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `Communaute_id` int(11) NOT NULL,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Utilisateur_Adresse1_idx` (`Adresse_id`),
  KEY `fk_Utilisateur_Communaute1_idx` (`Communaute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `Adresse_id` int(11) NOT NULL,
  `like_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Videos_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Videos_Adresse1_idx` (`Adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wall`
--

CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `wallto_utilisateur_id` int(11) DEFAULT NULL,
  `markup_message` varchar(45) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Wall_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
