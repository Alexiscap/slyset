-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 17 Juillet 2013 à 11:05
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
  `phone_number` varchar(15) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `adresse`
--

INSERT INTO `adresse` (`id`, `numero_adresse`, `voie_adresse`, `ville`, `code_postal`, `pays`, `phone_number`, `website`) VALUES
(1, '168', 'Avenue Willy Brandt', 'Lille', '59777', 'France', '03 20 13 50 00', 'http://www.aeronef-spectacles.com/'),
(2, NULL, NULL, 'Lille', NULL, NULL, NULL, NULL),
(3, NULL, NULL, 'Tourcoing', NULL, NULL, NULL, NULL),
(4, NULL, NULL, 'Lille', NULL, NULL, NULL, NULL),
(5, NULL, NULL, 'Lille', NULL, NULL, NULL, NULL);

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
  `annee` year(4) DEFAULT NULL,
  `img_cover` varchar(100) DEFAULT NULL,
  `format` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Albums_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`id`, `Utilisateur_id`, `nom`, `description`, `date`, `participants`, `producteur`, `publie`, `livret_path`, `prix`, `annee`, `img_cover`, `format`) VALUES
(1, 30, 'album one', 'premier album pour test partition', '2013-07-08 23:36:37', NULL, NULL, NULL, NULL, NULL, NULL, 'album_top.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `album_media`
--

CREATE TABLE IF NOT EXISTS `album_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) DEFAULT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `like_total` int(11) NOT NULL DEFAULT '0',
  `Videos_id` int(11) NOT NULL,
  `Photos_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_Album_media_Videos1_idx` (`Videos_id`),
  KEY `fk_Album_media_Photos1_idx` (`Photos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `album_media`
--

INSERT INTO `album_media` (`id`, `file_name`, `Utilisateur_id`, `nom`, `like_total`, `Videos_id`, `Photos_id`, `date`) VALUES
(1, 'album1', 1, 'album1', 0, 0, 2, '2013-07-11 00:18:54'),
(2, 'album1', 1, 'album1', 0, 0, 4, '2013-07-11 09:27:48'),
(3, NULL, 30, 'album video', 0, 3, 0, '2013-07-11 12:30:20');

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
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Articles_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `Utilisateur_id`, `titre`, `article`, `image`, `created`, `updated`) VALUES
(18, 1, 'Article avec une vidéo', '<p>test2&lt;iframe width="560" height="315" src="//www.youtube.com/embed/Ek0SgwWmF9w" frameborder="0" allowfullscreen=""&gt;&lt;/iframe></p>', NULL, '2013-06-14 05:50:15', '2013-07-04 21:55:25'),
(19, 1, 'Article avec une image', '<p>fdgfdgf<br><br>Now, on affiche une image juste en dessous en la centrant!!</p><p><ol><li><img src="http://media-cache-ec0.pinimg.com/avatars/slyset_1360335642_600.jpg" alt=""  15px; line-height: 1.45em; float: none;"><br></li></ol></p>', NULL, '2013-06-14 05:50:22', '2013-06-15 13:40:45'),
(21, 1, 'Une douzaine d’Of Montreal', '<p><img src="http://www.lesinrocks.com/wp-content/thumbnails/uploads/2012/08/ofmontreal604-tt-width-604-height-400-attachment_id-283161.jpg" ><br></p><p><span 24px;="" color:="" rgb(0,="" 0,="" 0);="" font-weight:="" bold;="" line-height:="" 30px;"=""><br></span><b>A peine un an après “Paralytic Stalks”, les Américains menés par le doux dingue Kevin Barnes seront de retour avec un nouvel album à la rentrée.</b></p><p><span 15px;="" line-height:="" 1.45em;"="">On n’ose même plus employer le terme prolifique à ce niveau-là : auteurs d’un onzième album aussi déconstruit que pénible l’an dernier, les Américains d’Of Montreal reviendront à l’automne avec un douzième disque répondant au doux nom de lousy with sylvianbriar.</span></p><p><span  15px; line-height: 1.45em;">Le successeur de Paralytic Stalks arrivera le 8 octobre et s’annonce plusold school que ses prédécesseurs si l’on en croit la tête pensante (et cinglée) de la troupe : “je savais que je voulais m’aligner sur la façon dont on enregistrait les albums dans les années 60 et 70” a expliqué Kevin Barnes à Pitchfork à propos de ce nouveau né crée à la maison sur un 24 pistes analogique.</span></p><p><span  15px; line-height: 1.45em;">Grande joie, un premier morceau, Fugitive Air, est déjà en écoute ci-dessous, et ô bonheur, il semble, après quelques écoutes, plus cohérent et jouissif que les derniers titres du groupe.</span></p><br><p></p>', NULL, '2013-07-11 09:22:45', '2013-07-11 09:24:07');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `status` char(1) NOT NULL COMMENT 'Valeur : P : panier, V Valider',
  PRIMARY KEY (`id`),
  KEY `fk_Achats_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `Utilisateur_id`, `date`, `status`) VALUES
(1, 30, '2013-07-06 22:00:00', 'V'),
(2, 30, '2013-07-16 22:00:00', 'V'),
(3, 30, '2013-07-10 22:00:00', 'V'),
(4, 30, NULL, 'V'),
(5, 30, NULL, 'V'),
(6, 30, NULL, 'V'),
(7, 30, NULL, 'P');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `photos_id` int(5) DEFAULT NULL,
  `album_media_file_name` varchar(100) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `Wall_id` int(11) DEFAULT NULL,
  `comment` text,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Commentaires_Wall1_idx` (`Wall_id`),
  KEY `Utilisateur_id` (`Utilisateur_id`),
  KEY `Utilisateur_id_2` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`photos_id`, `album_media_file_name`, `video_id`, `id`, `Utilisateur_id`, `Wall_id`, `comment`, `created`) VALUES
(NULL, NULL, NULL, 1, 1, 20, 'testdu 20', '2013-05-20 14:45:03'),
(NULL, NULL, NULL, 2, 1, 21, 'olool', '2013-05-23 17:49:35'),
(NULL, NULL, NULL, 3, 1, 21, 'okay t''es le meilleur !!', '2013-05-23 17:56:13'),
(NULL, NULL, NULL, 4, 1, 21, 'lol', '2013-05-23 17:56:38'),
(NULL, NULL, NULL, 5, 1, 21, 'lollooo', '2013-05-23 17:56:40'),
(NULL, NULL, NULL, 7, 1, 21, 'ouiii', '2013-05-23 17:57:20'),
(NULL, NULL, NULL, 8, 1, 21, 'ouiiilol', '2013-05-23 17:57:23'),
(NULL, NULL, NULL, 9, 1, 21, 'okkk', '2013-05-23 18:00:27'),
(NULL, NULL, NULL, 10, 1, 21, 'okkk', '2013-05-23 18:01:00'),
(NULL, NULL, NULL, 11, 1, 21, 'okkk', '2013-05-23 18:01:11'),
(NULL, NULL, NULL, 12, 1, 21, 'lool', '2013-05-23 18:01:56'),
(NULL, NULL, NULL, 13, 1, 21, 'lool', '2013-05-23 18:02:22'),
(NULL, NULL, NULL, 14, 1, 21, 'lool', '2013-05-23 18:02:23'),
(NULL, NULL, NULL, 17, 1, 21, 'dac', '2013-05-23 19:04:11'),
(NULL, NULL, NULL, 18, 1, 21, 'okkkkkk', '2013-05-23 19:06:46'),
(NULL, NULL, NULL, 19, 1, 21, 'dacodac', '2013-05-23 19:09:42'),
(NULL, NULL, NULL, 20, 1, 21, 'thanks le 21', '2013-05-23 19:53:24'),
(NULL, NULL, NULL, 21, 1, 21, 'thanks le 21', '2013-05-23 19:53:32'),
(NULL, NULL, NULL, 22, 1, 22, 'test', '2013-05-24 08:34:59'),
(NULL, NULL, NULL, 23, 1, 22, 'test', '2013-05-24 08:35:02'),
(NULL, NULL, NULL, 24, 1, 22, 'test', '2013-05-24 08:36:25'),
(NULL, NULL, NULL, 25, 1, 22, 'ok', '2013-05-24 08:36:29'),
(NULL, NULL, NULL, 26, 1, 22, 'tt', '2013-05-24 08:36:41'),
(NULL, NULL, NULL, 28, 1, 22, 'tt', '2013-05-24 08:37:36'),
(NULL, NULL, NULL, 29, 1, 22, 'ok', '2013-05-24 08:37:42'),
(NULL, NULL, NULL, 30, 1, 22, 'ok', '2013-05-24 08:38:07'),
(NULL, NULL, NULL, 32, 1, 22, 'ok', '2013-05-24 08:38:17'),
(NULL, NULL, NULL, 33, 1, 22, 'ok', '2013-05-24 08:38:21'),
(NULL, NULL, NULL, 34, 1, 22, 'oktt', '2013-05-24 08:38:29'),
(NULL, NULL, NULL, 35, 1, 22, 'oktt', '2013-05-24 08:38:48'),
(NULL, NULL, NULL, 36, 1, 22, 'tt', '2013-05-24 08:39:10'),
(NULL, NULL, NULL, 37, 1, 22, 'tt', '2013-05-24 08:39:12'),
(NULL, NULL, NULL, 38, 1, 22, 'tt', '2013-05-24 08:39:23'),
(NULL, NULL, NULL, 40, 1, 20, 'tt', '2013-05-24 08:39:41'),
(NULL, NULL, NULL, 41, 1, 9, 'tt', '2013-05-24 08:41:44'),
(NULL, NULL, NULL, 42, 1, 9, 'tt', '2013-05-24 08:41:47'),
(NULL, NULL, NULL, 43, 1, 9, 'tt', '2013-05-24 08:42:14'),
(NULL, NULL, NULL, 44, 1, 9, 'tt', '2013-05-24 08:42:18'),
(NULL, NULL, NULL, 45, 1, 9, 'tt', '2013-05-24 08:42:22'),
(NULL, NULL, NULL, 46, 1, 9, 'tt', '2013-05-24 08:42:48'),
(NULL, NULL, NULL, 47, 1, 8, 'tt', '2013-05-24 08:42:56'),
(NULL, NULL, NULL, 48, 1, 8, 'tt', '2013-05-24 08:44:30'),
(NULL, NULL, NULL, 49, 1, 7, 'tt', '2013-05-24 08:47:07'),
(NULL, NULL, NULL, 50, 1, 7, 'tt', '2013-05-24 08:47:17'),
(NULL, NULL, NULL, 51, 1, 21, 'tt', '2013-05-24 08:47:34'),
(NULL, NULL, NULL, 52, 1, 21, 'tt', '2013-05-24 08:50:50'),
(NULL, NULL, NULL, 53, 1, 21, 'tt', '2013-05-24 08:58:25'),
(NULL, NULL, NULL, 54, 1, 21, 'tt', '2013-05-24 08:59:22'),
(NULL, NULL, NULL, 55, 1, 21, 'tt', '2013-05-24 08:59:29'),
(NULL, NULL, NULL, 56, 1, 21, 'tt', '2013-05-24 09:02:44'),
(NULL, NULL, NULL, 57, 1, 21, 'ttlo', '2013-05-24 09:02:49'),
(NULL, NULL, NULL, 58, 1, 22, 'tttttt', '2013-05-24 09:03:13'),
(NULL, NULL, NULL, 59, 1, 22, 'tt', '2013-05-24 09:06:29'),
(NULL, NULL, NULL, 60, 1, 22, 'HY', '2013-05-24 09:07:02'),
(NULL, NULL, NULL, 61, 1, 22, 'tt', '2013-05-24 09:07:32'),
(NULL, NULL, NULL, 62, 1, 22, 'testeuhhh', '2013-05-24 09:10:09'),
(NULL, NULL, NULL, 63, 1, 22, 'testeuhhh', '2013-05-24 09:10:20'),
(NULL, NULL, NULL, 64, 1, 20, 'pok', '2013-05-24 09:10:29'),
(NULL, NULL, NULL, 65, 1, 20, 'testeuh', '2013-05-24 09:10:48'),
(NULL, NULL, NULL, 66, 1, 20, 'tt', '2013-05-24 09:47:58'),
(NULL, NULL, NULL, 67, 1, 20, 'tt', '2013-05-24 09:48:32'),
(NULL, NULL, NULL, 68, 1, 21, 'tes', '2013-05-24 09:49:15'),
(NULL, NULL, NULL, 69, 1, 21, 'loooooooooooooooool', '2013-05-24 09:49:30'),
(NULL, NULL, NULL, 71, 1, 22, 'lol', '2013-05-24 09:51:44'),
(NULL, NULL, NULL, 72, 1, 22, 'ok', '2013-05-24 09:52:48'),
(NULL, NULL, NULL, 73, 1, 22, 'kkk', '2013-05-24 09:53:48'),
(NULL, NULL, NULL, 74, 1, 22, 'tessssssst', '2013-05-24 09:56:36'),
(NULL, NULL, NULL, 75, 1, 22, 'test', '2013-05-24 09:58:59'),
(NULL, NULL, NULL, 76, 1, 22, 'dafok ?', '2013-05-24 09:59:58'),
(NULL, NULL, NULL, 77, 1, 22, 'mdr', '2013-05-24 10:00:50'),
(NULL, NULL, NULL, 78, 1, 22, 'tt', '2013-05-24 17:51:10'),
(NULL, NULL, NULL, 80, 1, 22, 'tt', '2013-05-24 18:13:22'),
(NULL, NULL, NULL, 81, 1, 22, 'coucou', '2013-05-24 19:04:31'),
(NULL, NULL, NULL, 82, 1, 24, 'Test', '2013-05-24 19:54:01'),
(NULL, NULL, NULL, 83, 1, 24, 'Testoiii :)', '2013-05-24 19:54:09'),
(NULL, NULL, NULL, 85, 1, 24, 'tt', '2013-05-24 19:56:06'),
(NULL, NULL, NULL, 86, 1, 24, 'tt', '2013-05-24 19:57:05'),
(NULL, NULL, NULL, 88, 1, 24, 'tt', '2013-05-24 19:57:59'),
(NULL, NULL, NULL, 89, 1, 24, 'tt', '2013-05-24 19:59:11'),
(NULL, NULL, NULL, 90, 1, 24, 'tt', '2013-05-24 19:59:35'),
(NULL, NULL, NULL, 91, 1, 28, 'rép', '2013-05-27 05:11:54'),
(NULL, NULL, NULL, 92, 1, 28, 'réptest', '2013-05-27 05:11:57'),
(NULL, NULL, NULL, 93, 1, 28, 'Test', '2013-05-27 06:41:18'),
(NULL, NULL, NULL, 95, 1, 1, 'Test', '2013-05-27 11:02:56'),
(NULL, NULL, NULL, 96, 0, 1, 'retest', '2013-05-27 11:48:49'),
(NULL, NULL, NULL, 97, 0, 1, 'Retest', '2013-05-27 12:38:03'),
(NULL, NULL, NULL, 98, 0, 25, 'Yo !!', '2013-05-28 05:49:33'),
(NULL, NULL, NULL, 99, 0, 53, 'Test du commentaire sur la page de francislalane ! j''aime ton profilll', '2013-05-28 05:54:01'),
(NULL, NULL, NULL, 103, 1, 53, 'Hey c''est un commentaire pour toi francis <3 !', '2013-05-28 06:03:30'),
(NULL, NULL, NULL, 105, 1, 48, 'test', '2013-05-28 07:11:48'),
(NULL, NULL, NULL, 106, 1, 48, 'test', '2013-05-28 07:12:02'),
(NULL, NULL, NULL, 107, 1, 48, 'test', '2013-05-28 07:14:11'),
(NULL, NULL, NULL, 112, 1, 48, 'tt', '2013-05-28 07:21:50'),
(NULL, NULL, NULL, 113, 1, 48, 'ajout', '2013-05-28 07:22:22'),
(NULL, NULL, NULL, 114, 1, 48, 'tt', '2013-05-28 07:24:39'),
(NULL, NULL, NULL, 115, 1, 48, 'tt', '2013-05-28 07:29:10'),
(NULL, NULL, NULL, 116, 1, 48, 'tt', '2013-05-28 07:29:32'),
(NULL, NULL, NULL, 117, 1, 48, 'tt', '2013-05-28 07:40:38'),
(NULL, NULL, NULL, 119, 1, 48, 'coucou', '2013-05-28 07:42:02'),
(NULL, NULL, NULL, 120, 1, 54, 'retest', '2013-05-29 09:55:54'),
(NULL, NULL, NULL, 121, 1, 54, 'retesttest', '2013-05-29 09:55:58'),
(NULL, NULL, NULL, 122, 1, 38, 'coucou', '2013-05-30 05:49:19'),
(NULL, NULL, NULL, 123, 1, 38, 'beurk', '2013-05-30 05:49:27'),
(NULL, NULL, NULL, 124, 1, 38, 'beurk', '2013-05-30 05:49:35'),
(NULL, NULL, NULL, 125, 1, 48, 'test', '2013-05-30 06:15:15'),
(NULL, NULL, NULL, 126, 1, 48, 'test', '2013-05-30 06:17:01'),
(NULL, NULL, NULL, 127, 1, 48, 'test', '2013-05-30 06:17:16'),
(NULL, NULL, NULL, 128, 1, 48, 'test', '2013-05-30 06:18:47'),
(NULL, NULL, NULL, 129, 1, 48, 'test', '2013-05-30 06:18:59'),
(NULL, NULL, NULL, 130, 1, 36, 'ttt', '2013-05-30 10:45:00'),
(NULL, NULL, NULL, 131, 1, 35, 'bou', '2013-05-30 10:45:14'),
(NULL, NULL, NULL, 132, 1, 35, 'bou', '2013-05-30 10:45:15'),
(NULL, NULL, NULL, 133, 1, 35, 'bou', '2013-05-30 10:45:15'),
(NULL, NULL, NULL, 134, 1, 35, 'bou', '2013-05-30 10:45:16'),
(NULL, NULL, NULL, 135, 1, 35, 'bou', '2013-05-30 10:45:16'),
(NULL, NULL, NULL, 136, 1, 35, 'bub', '2013-05-30 10:45:17'),
(NULL, NULL, NULL, 137, 1, 35, 'obubou', '2013-05-30 10:45:18'),
(NULL, NULL, NULL, 138, 1, 35, 'bou', '2013-05-30 10:45:18'),
(NULL, NULL, NULL, 139, 1, 35, 'boub', '2013-05-30 10:45:19'),
(NULL, NULL, NULL, 140, 1, 35, 'ubou', '2013-05-30 10:45:20'),
(NULL, NULL, NULL, 141, 1, 35, 'bou', '2013-05-30 10:45:21'),
(NULL, NULL, NULL, 142, 1, 57, 'coucou30', '2013-06-16 09:55:29'),
(NULL, NULL, NULL, 143, 1, 58, 'coucou1', '2013-06-16 09:55:42'),
(5, NULL, NULL, 144, 1, NULL, 'Commentaire', '2013-07-11 09:38:47'),
(7, NULL, NULL, 147, 30, NULL, 'hhgh', '2013-07-11 10:27:34'),
(NULL, NULL, NULL, 148, 1, 59, 'commentaire', '2013-07-11 12:36:20'),
(8, NULL, NULL, 149, 1, NULL, 'commentaire photo', '2013-07-11 12:37:21'),
(NULL, NULL, NULL, 150, 30, 62, 'Comment', '2013-07-13 08:11:45');

-- --------------------------------------------------------

--
-- Structure de la table `communaute`
--

CREATE TABLE IF NOT EXISTS `communaute` (
  `Follower_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Communaute_artiste_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `communaute`
--

INSERT INTO `communaute` (`Follower_id`, `id`, `Utilisateur_id`, `type`) VALUES
(1, 8, 30, 0),
(1, 9, 37, 0),
(29, 10, 30, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `concerts`
--

INSERT INTO `concerts` (`id`, `Utilisateur_id`, `Adresse_id`, `titre`, `date`, `seconde_partie`, `salle`, `prix`) VALUES
(1, 1, 1, 'Beach House', '2013-05-02 20:00:00', 'Lower Dens', 'L''aeronef', 12),
(2, 2, 1, 'Bob Dylan', '2013-05-21 20:00:00', 'Jim Morrison', 'La fleche d''or', 14),
(3, 30, 2, 'Joe', '2013-07-12 18:00:00', NULL, 'Zenith', 20),
(4, 1, 3, 'slyset', '2014-06-25 21:00:00', NULL, 'Le Grand Mix', 21),
(5, 30, 4, 'Joe', '2013-07-19 18:02:00', NULL, 'Zenith', 20),
(6, 30, 5, 'Joe', '2013-07-19 19:30:00', NULL, 'L''aeronef', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `concerts_activite`
--

INSERT INTO `concerts_activite` (`id`, `Utilisateur_id`, `Concerts_id`, `participation`) VALUES
(2, 1, 3, NULL),
(6, 30, 5, NULL),
(7, 1, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `coverflow`
--

CREATE TABLE IF NOT EXISTS `coverflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artiste_1` varchar(255) DEFAULT NULL,
  `artiste_2` varchar(255) DEFAULT NULL,
  `artiste_3` varchar(255) DEFAULT NULL,
  `artiste_4` varchar(255) DEFAULT NULL,
  `artiste_5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `coverflow`
--

INSERT INTO `coverflow` (`id`, `artiste_1`, `artiste_2`, `artiste_3`, `artiste_4`, `artiste_5`) VALUES
(2, 'Joe', 'rrrrr', 'ttt', 'Joe', 'ttt');

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `format` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Morceaux_id` int(11) NOT NULL,
  `path` text,
  `type_document` varchar(45) DEFAULT NULL,
  `Albums_id` int(11) DEFAULT NULL,
  `Utilisateur_id` int(11) NOT NULL,
  `date_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `prix` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Partitions_Morceaux1_idx` (`Morceaux_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `documents`
--

INSERT INTO `documents` (`format`, `id`, `Morceaux_id`, `path`, `type_document`, `Albums_id`, `Utilisateur_id`, `date_insert`, `prix`) VALUES
('pdf', 1, 0, 'Charte_Ethique_Utilisation_du_fichier_clients_Oxylane_V2_FR.pdf', 'paroles', NULL, 1, '2013-07-11 09:02:39', NULL),
('pdf', 2, 1, 'Charte_Ethique_Utilisation_du_fichier_clients_Oxylane_V2_FR1.pdf', 'paroles', 1, 30, '2013-07-11 09:07:18', 12);

-- --------------------------------------------------------

--
-- Structure de la table `ilike`
--

CREATE TABLE IF NOT EXISTS `ilike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like_value` int(11) DEFAULT NULL,
  `Photos_id` int(11) DEFAULT NULL,
  `Videos_id` int(11) DEFAULT NULL,
  `Morceaux_id` int(11) DEFAULT NULL,
  `Utilisateur_id` int(11) DEFAULT NULL,
  `Album_media_file_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Like_Photos1_idx` (`Photos_id`),
  KEY `fk_Like_Videos1_idx` (`Videos_id`),
  KEY `fk_Like_Morceaux1_idx` (`Morceaux_id`),
  KEY `fk_Like_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Like_Album_media1_idx` (`Album_media_file_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `ilike`
--

INSERT INTO `ilike` (`id`, `like_value`, `Photos_id`, `Videos_id`, `Morceaux_id`, `Utilisateur_id`, `Album_media_file_name`) VALUES
(1, 0, 1, NULL, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, NULL),
(3, 0, 3, NULL, NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL, NULL),
(5, 4, 5, NULL, NULL, NULL, NULL),
(6, 2, 6, NULL, NULL, NULL, NULL),
(7, 1, 7, NULL, NULL, NULL, NULL),
(8, 1, 8, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `infos_commande`
--

CREATE TABLE IF NOT EXISTS `infos_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Commande_id` int(11) NOT NULL,
  `Albums_id` int(11) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `prix` float(5,2) DEFAULT NULL,
  `Morceaux_id` int(11) DEFAULT NULL,
  `Documents_id` int(11) DEFAULT NULL,
  `format` varchar(45) DEFAULT NULL COMMENT 'a completer uniquement si commande à V',
  PRIMARY KEY (`id`),
  KEY `fk_Infos_commande_Commande1_idx` (`Commande_id`),
  KEY `fk_Infos_commande_Albums1_idx` (`Albums_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `infos_commande`
--

INSERT INTO `infos_commande` (`id`, `Commande_id`, `Albums_id`, `titre`, `prix`, `Morceaux_id`, `Documents_id`, `format`) VALUES
(2, 2, NULL, '4', 0.99, 1, NULL, NULL),
(3, 1, NULL, '4', 4.00, 1, NULL, NULL),
(4, 3, 1, '', 4.05, 2, NULL, NULL),
(5, 4, NULL, '5', 12.00, NULL, 2, NULL),
(6, 5, NULL, '6', 12.00, NULL, 2, NULL),
(7, 6, NULL, '7', 12.00, NULL, 2, NULL),
(8, 7, NULL, NULL, 12.00, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `like_activity_pav`
--

CREATE TABLE IF NOT EXISTS `like_activity_pav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `Photo_id` int(11) DEFAULT NULL,
  `Album_media_file_name` varchar(100) DEFAULT NULL,
  `Video_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `like_activity_pav`
--

INSERT INTO `like_activity_pav` (`id`, `Utilisateur_id`, `Photo_id`, `Album_media_file_name`, `Video_id`) VALUES
(2, 1, 5, NULL, NULL),
(6, 30, 7, NULL, NULL),
(7, 1, 2, NULL, NULL),
(8, 1, 4, NULL, NULL),
(9, 1, 8, NULL, NULL);

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
  `format` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Morceaux_Albums1_idx` (`Albums_id`),
  KEY `fk_Morceaux_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Morceaux_Videos1_idx` (`Videos_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `morceaux`
--

INSERT INTO `morceaux` (`id`, `Albums_id`, `Utilisateur_id`, `nom`, `duree`, `nombre_lectures`, `prix`, `Videos_id`, `like_total`, `format`) VALUES
(1, 1, 30, 'Get People', '2013-07-08 23:28:00', 5, 50.00, 0, 5, 'flac'),
(2, 0, 30, 'nicemorceau', '2013-07-08 23:28:00', 5, 28.99, 0, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `page_personnalise`
--

CREATE TABLE IF NOT EXISTS `page_personnalise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `theme_css` varchar(255) DEFAULT 'custom-user-css',
  `background` text,
  `repeat` varchar(10) DEFAULT NULL,
  `couleur1` varchar(7) DEFAULT NULL,
  `couleur2` varchar(7) DEFAULT NULL,
  `couleur3` varchar(7) DEFAULT NULL,
  `couleur4` varchar(7) DEFAULT NULL,
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
  `Adresse_id` int(11) DEFAULT NULL,
  `file_name` varchar(100) NOT NULL,
  `nom` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `like_total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Photos_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Photos_Adresse1_idx` (`Adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`id`, `Utilisateur_id`, `Adresse_id`, `file_name`, `nom`, `date`, `like_total`) VALUES
(1, 30, NULL, 'cover.gif', 'Test album photo', '2013-06-30 10:04:56', 0),
(2, 1, NULL, 'cover.jpg', 'Album de préprod.', '2013-07-11 00:18:54', 0),
(3, 1, NULL, 'album_top1.jpg', 'Ok', '2013-07-11 08:41:33', 0),
(4, 1, NULL, 'album_top.jpg', 'Album 1', '2013-07-11 09:27:48', 1),
(5, 1, NULL, 'washed-out1.jpg', 'Photo 2', '2013-07-11 09:34:27', 4),
(6, 1, NULL, 'avatar1.png', 'Photo 3', '2013-07-11 09:34:49', 2),
(7, 30, NULL, 'Alison-Mosshart---photo.jpg', 'hello', '2013-07-11 10:25:48', 1),
(8, 30, NULL, 'Victoria-Legrand---photo.jpg', 'hello', '2013-07-11 12:29:19', 1);

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
  `facebook_id` bigint(20) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `nom` varchar(125) DEFAULT NULL,
  `prenom` varchar(125) DEFAULT NULL,
  `login` varchar(125) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `date_naissance` varchar(10) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `nationalite` varchar(125) DEFAULT NULL,
  `genre` varchar(25) DEFAULT NULL,
  `style_ecoute` text,
  `style_joue` text,
  `instrument` text,
  `description` text,
  `googleplus` text,
  `facebook` text,
  `twitter` text,
  `siteweb` text,
  `Communaute_id` int(11) NOT NULL,
  `cover` varchar(255) NOT NULL DEFAULT 'default-photo-cover.png',
  `thumb` text NOT NULL,
  `coverflow` int(1) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `updated` date DEFAULT NULL,
  `suspendu` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Utilisateur_Communaute1_idx` (`Communaute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `facebook_id`, `type`, `nom`, `prenom`, `login`, `password`, `mail`, `date_naissance`, `ville`, `nationalite`, `genre`, `style_ecoute`, `style_joue`, `instrument`, `description`, `googleplus`, `facebook`, `twitter`, `siteweb`, `Communaute_id`, `cover`, `thumb`, `coverflow`, `created`, `updated`, `suspendu`) VALUES
(1, 0, 0, '', '', 'slyset', '2fdfced6f416f8a893cf3951e738622151f6b796', 'alexiscap@gmail.com', '', 'Lille', 'France', '', 'pop, rock, folk, garage', 'pop, rock, folk', 'guitare, basse, batterie', 'Ma super description de musicien admin.', NULL, 'http://www.monfacebookslyset.fr/', 'http://www.montwitterslyset.fr/', 'http://www.monsiteslyset.fr/', 0, 'default-photo-cover.png', 'thumb-slyset.png', NULL, '2013-05-08', '2013-06-01', 0),
(29, 0, 1, '', '', 'FrancisLalane', '1fb3381f4a67bfc2b7766213d411e29c8fca277c', 'francis.lalane@gmail.com', '', '', '', '', 'pop, rock, folk', '', '', NULL, NULL, NULL, NULL, NULL, 0, 'default-photo-cover.png', 'thumb-slyset.png', NULL, '2013-05-08', NULL, 0),
(30, 0, 2, 'Cooker', 'Joe', 'Joe', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@slyset.com', '', '', '', '', 'pop, rock, classique2', 'garage', 'piano', 'Mon nom est Joe, je kiffe la musique Boogie Woogie !', NULL, NULL, NULL, NULL, 0, 'default-photo-cover.png', 'thumb-slyset.png', NULL, '2013-05-15', '2013-07-11', 0),
(32, 0, 1, '', '', 'test', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'alexis@dd.com', '', '', '', '', 'classique3', '', '', NULL, NULL, NULL, NULL, NULL, 0, 'vimeo1.png', 'thumb-slyset.png', NULL, '2013-05-16', NULL, 0),
(33, 0, 2, '', '', 'rrrrr', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'heyoh@heyoh.com', '', '', '', '', 'classique2', 'pop', 'trompette', NULL, NULL, NULL, NULL, NULL, 0, 'vimeo3.png', '0', NULL, '2013-05-16', NULL, 0),
(34, 0, 1, '', '', 'teeeest', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'alexis@dd.cc', '', '', '', '', 'pop', '', '', NULL, NULL, NULL, NULL, NULL, 0, 'titre_objectifs51.png', 'thumb-slyset.png', NULL, '2013-05-16', NULL, 0),
(35, 0, 1, '', '', 'alexistruc', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'alexistruc@test.com', '', '', '', '', 'pop', '', '', NULL, NULL, NULL, NULL, NULL, 0, 'default-photo-cover.png', 'thumb-slyset.png', NULL, '2013-05-16', NULL, 0),
(36, 0, 2, '', '', 'Encoreuntest', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'alexis@textsub.com', '', '', '', '', 'pop, folk, garage', 'pop, classique2', 'guitare, flute, trompette', NULL, NULL, NULL, NULL, NULL, 0, 'titre_objectifs51.png', 'test-thumb.jpg', NULL, '2013-05-30', NULL, 0),
(37, 0, 2, '', '', 'ttt', '7a85f4764bbd6daf1c3545efbbf0f279a6dc0beb', 'alexiscap@gail.co', '', '', '', '', 'pop, garage', 'pop, classique2', 'guitare, flute', NULL, NULL, NULL, NULL, NULL, 0, 'default-photo-cover1.png', 'test-thumb.jpg', NULL, '2013-05-30', NULL, 0),
(38, 0, 2, '', '', 'Preprod', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'alexis@test.fr', '', '', '', '', 'pop, classique1, classique2', 'pop, classique1, classique3', 'guitare, flute, trompette', NULL, NULL, NULL, NULL, NULL, 0, 'default-photo-cover2.png', 'Noah-and-the-Whale-0011.jpg', NULL, '2013-07-11', '2013-07-11', 0),
(40, 0, 2, '', '', 'vlegrand', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@yopmail.fr', '', '', '', '', 'pop', 'pop', 'guitare, voix, piano', NULL, '', '', 'http://www.montwitterslyset.fr/', '', 0, 'Victoria-Legrand---ban.jpg', 'Victoria-Legrand---photo.jpg', NULL, '2013-07-11', '2013-07-11', 0),
(41, 0, 2, '', '', 'Vlegran', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test@yopmail.com', '', '', '', '', 'pop', 'pop', 'guitare, voix, piano', NULL, NULL, NULL, NULL, NULL, 0, 'Alison-Mosshart---ban.jpg', 'Alex-Turner---photo.jpg', NULL, '2013-07-11', '2013-07-11', 0);

-- --------------------------------------------------------

--
-- Structure de la table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Adresse_id` int(11) DEFAULT NULL,
  `like_total` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_Videos_Utilisateur1_idx` (`Utilisateur_id`),
  KEY `fk_Videos_Adresse1_idx` (`Adresse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `videos`
--

INSERT INTO `videos` (`id`, `Utilisateur_id`, `nom`, `description`, `date`, `Adresse_id`, `like_total`) VALUES
(1, 1, 'FGLCESkr9cM', 'DJ Jams !', '2013-07-11 09:41:06', NULL, 0),
(2, 1, 'fhWaJi1Hsfo', 'Live Android', '2013-07-11 09:41:58', NULL, 0),
(3, 30, 'FGLCESkr9cM', 'video youtube', '2013-07-11 12:30:20', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `wall`
--

CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `wallto_utilisateur_id` int(11) DEFAULT NULL,
  `markup_message` text,
  `photo` text,
  `video` text,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Wall_Utilisateur1_idx` (`Utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `wall`
--

INSERT INTO `wall` (`id`, `Utilisateur_id`, `wallto_utilisateur_id`, `markup_message`, `photo`, `video`, `created`) VALUES
(1, 0, 0, 'Voici ma superimage, bienvenue les mecs !', 'baseline1.png', '', '2013-05-17 22:00:00'),
(3, 1, 1, 'Et si on test avec une vidéo ??', '', 'http://www.youtube.com/watch?v=DGIgXP9SvB8', '2013-05-17 22:00:00'),
(4, 1, 1, 'Bienvenue sur mon espace Slyset ! Découvrez mes derniers morceaux, mes prochains concerts, mes dernières actualités et photos !', '', '', '2013-05-18 22:00:00'),
(7, 1, 1, 'Bienvenue sur mon espace Slyset ! Découvrez mes derniers morceaux, mes prochains concerts, mes dernières actualités et photos !', '', '', '2013-05-18 22:00:00'),
(8, 1, 1, 'Bienvenue sur mon espace Slyset ! Découvrez mes derniers morceaux, mes prochains concerts, mes dernières actualités et photos !', '', '', '2013-05-18 22:00:00'),
(9, 1, 1, 'Bienvenue sur mon espace Slyset ! Découvrez mes derniers morceaux, mes prochains concerts, mes dernières actualités et photos !', '', '', '2013-05-18 22:00:00'),
(10, 1, 1, 'Bienvenue sur mon espace Slyset ! Découvrez mes derniers morceaux, mes prochains concerts, mes dernières actualités et photos !', '', '', '2013-05-18 22:00:00'),
(20, 1, 1, 'Okkkkkkkkk', '', '', '2013-05-20 15:08:33'),
(21, 1, 1, 'COucou les gens !', '', '', '2013-05-21 09:22:24'),
(22, 1, 1, 'Envoi d''un nouveau message, on teste si les commentaires s''affichent aussi au refresh', '', '', '2013-05-23 19:55:18'),
(24, 1, 1, 'Coucou de ma vidéo trop cool !', '', 'http://www.youtube.com/watch?v=gG_dA32oH44', '2013-05-24 19:08:49'),
(25, 1, 1, 'Test', 'baseline5.png', '', '2013-05-24 19:24:18'),
(26, 1, 1, 'Testt', '20120903_134421.jpg', '', '2013-05-24 19:28:31'),
(27, 1, 1, 'Retest', '20120903_134344.jpg', '', '2013-05-24 19:29:53'),
(28, 1, 1, 'Coucou', '', '', '2013-05-27 05:11:49'),
(29, 1, 1, 'Hi', '', '', '2013-05-27 07:26:39'),
(30, 1, 1, 'Hi', '', '', '2013-05-27 07:31:41'),
(31, 1, 1, 'Hi', '', '', '2013-05-27 07:32:26'),
(32, 1, 1, 'Hi', '', '', '2013-05-27 07:32:39'),
(33, 1, 1, 'Tee', '', '', '2013-05-27 07:37:19'),
(34, 1, 1, 'Test', '', '', '2013-05-27 07:39:27'),
(35, 1, 1, 'Test', '', '', '2013-05-27 07:41:05'),
(36, 1, 1, 'Test', '', '', '2013-05-27 07:50:17'),
(37, 1, 1, 'Test', '', '', '2013-05-27 07:52:16'),
(38, 1, 1, 'Tt', '', '', '2013-05-27 07:52:34'),
(48, 1, 1, 'J''ai posté un message sur francislalanne', '', '', '2013-05-27 08:22:20'),
(50, 1, NULL, 'Test de slyset qui poste sur slyset', '', '', '2013-05-27 10:30:52'),
(51, 1, NULL, 'Test de slyset qui poste sur slyset !', '', '', '2013-05-27 10:33:15'),
(52, 1, NULL, 'Test de slyset qui poste sur slyset !', '', '', '2013-05-27 10:36:23'),
(53, 1, 29, 'Test', '', '', '2013-05-27 10:49:02'),
(54, 1, 1, 'Hello', '', '', '2013-06-16 09:46:49'),
(55, 1, 1, 'Hello2', '', '', '2013-06-16 09:47:23'),
(56, 1, NULL, 'Test 30', '', '', '2013-06-16 09:52:30'),
(57, 1, 30, 'Test30', '', '', '2013-06-16 09:55:01'),
(58, 1, 1, 'Test1', '', '', '2013-06-16 09:55:16'),
(59, 30, 30, 'Message de Joe', '', '', '2013-07-11 12:15:53'),
(60, 1, 1, 'Test', '', '', '2013-07-13 08:04:30'),
(61, 30, 30, 'Test', '', '', '2013-07-13 08:04:52'),
(62, 30, 30, 'Test img', 'Victoria-Legrand---photo.jpg', '', '2013-07-13 08:09:17'),
(63, 30, 30, 'Redirection', 'Matt-Bastard---photo.jpg', '', '2013-07-13 08:11:12'),
(64, 1, 1, 'Magnifique', 'Alison-Mosshart---photo.jpg', '', '2013-07-13 18:29:59');

-- --------------------------------------------------------

--
-- Structure de la table `wall_melo_component`
--

CREATE TABLE IF NOT EXISTS `wall_melo_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Utilisateur_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('MU','ME') NOT NULL,
  `photos_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `videos_id` int(11) DEFAULT NULL,
  `morceaux_id` int(11) DEFAULT NULL,
  `concerts_id` int(11) DEFAULT NULL,
  `documents_id` int(11) DEFAULT NULL,
  `Following_id` int(11) DEFAULT NULL,
  `albums_media_file_name` varchar(250) DEFAULT NULL,
  `albums_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=412 ;

--
-- Contenu de la table `wall_melo_component`
--

INSERT INTO `wall_melo_component` (`id`, `Utilisateur_id`, `date`, `type`, `photos_id`, `message_id`, `videos_id`, `morceaux_id`, `concerts_id`, `documents_id`, `Following_id`, `albums_media_file_name`, `albums_id`) VALUES
(295, 1, '2013-07-06 21:23:58', 'MU', 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(299, 1, '2013-07-06 21:40:33', 'MU', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(307, 1, '2013-07-06 22:15:05', 'MU', NULL, NULL, NULL, NULL, 22, NULL, NULL, NULL, NULL),
(313, 1, '2013-07-06 23:29:41', 'MU', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(317, 1, '2013-07-06 23:43:18', 'MU', 20, NULL, NULL, NULL, NULL, NULL, NULL, 'New_slyset', NULL),
(318, 1, '2013-07-06 23:50:18', 'MU', 21, NULL, NULL, NULL, NULL, NULL, NULL, 'New_slyset', NULL),
(319, 1, '2013-07-06 23:52:12', 'MU', 23, NULL, NULL, NULL, NULL, NULL, NULL, 'New_slyset', NULL),
(328, 30, '2013-07-07 22:54:40', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 112, NULL, NULL),
(348, 30, '2013-07-08 08:11:07', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 128, NULL, NULL),
(350, 30, '2013-07-08 09:14:42', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 129, NULL, NULL),
(351, 30, '2013-07-08 09:14:48', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 130, NULL, NULL),
(365, 30, '2013-07-08 10:01:51', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 131, NULL, NULL),
(367, 30, '2013-07-09 22:58:39', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL),
(368, 30, '2013-07-09 23:00:16', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL),
(370, 1, '2013-07-10 07:33:06', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL),
(371, 1, '2013-07-10 07:33:20', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL),
(372, 29, '2013-07-10 08:57:36', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL),
(374, 30, '2013-07-10 15:37:14', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL),
(377, 30, '2013-07-10 15:37:17', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL),
(378, 1, '2013-07-11 00:18:54', 'MU', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'album1', NULL),
(379, 1, '2013-07-11 08:41:33', 'MU', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(382, 30, '2013-07-11 09:18:11', 'MU', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL),
(383, 1, '2013-07-11 09:27:48', 'MU', 4, NULL, NULL, NULL, NULL, NULL, NULL, 'album1', NULL),
(384, 1, '2013-07-11 09:34:27', 'MU', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(385, 1, '2013-07-11 09:34:49', 'MU', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(386, 1, '2013-07-11 09:38:31', 'ME', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(390, 1, '2013-07-11 09:41:06', 'MU', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(391, 1, '2013-07-11 09:41:06', 'MU', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(392, 1, '2013-07-11 09:41:58', 'MU', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(393, 1, '2013-07-11 09:41:58', 'MU', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(394, 1, '2013-07-11 09:43:34', 'MU', NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, NULL),
(396, 1, '2013-07-11 09:52:25', 'ME', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL),
(397, 30, '2013-07-11 10:23:14', 'MU', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL),
(400, 30, '2013-07-11 10:25:48', 'MU', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(402, 30, '2013-07-11 10:27:30', 'ME', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(403, 30, '2013-07-11 11:00:33', 'ME', NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL),
(404, 1, '2013-07-11 11:13:20', 'ME', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(405, 1, '2013-07-11 11:13:26', 'ME', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(406, 30, '2013-07-11 12:22:49', 'MU', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL),
(407, 30, '2013-07-11 12:29:19', 'MU', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(408, 30, '2013-07-11 12:30:20', 'MU', NULL, NULL, 3, NULL, NULL, NULL, NULL, 'album video', NULL),
(409, 30, '2013-07-11 12:30:20', 'MU', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(410, 1, '2013-07-11 12:36:54', 'ME', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL),
(411, 1, '2013-07-11 12:37:05', 'ME', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
