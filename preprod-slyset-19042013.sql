SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Adresse`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Adresse` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `numero_adresse` VARCHAR(20) NULL ,
  `voie_adresse` VARCHAR(255) NULL ,
  `ville` VARCHAR(255) NULL ,
  `code_postal` VARCHAR(10) NULL ,
  `pays` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Communaute`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Communaute` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `type` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Communaute_artiste_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Utilisateur`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Utilisateur` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `type` INT NULL ,
  `nom` VARCHAR(125) NULL ,
  `prenom` VARCHAR(125) NULL ,
  `login` VARCHAR(125) NULL ,
  `password` VARCHAR(45) NULL ,
  `mail` VARCHAR(45) NULL ,
  `date_naissance` DATE NULL ,
  `Adresse_id` INT NOT NULL ,
  `nationalite` VARCHAR(125) NULL ,
  `genre` INT NULL ,
  `Communaute_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Utilisateur_Adresse1_idx` (`Adresse_id` ASC) ,
  INDEX `fk_Utilisateur_Communaute1_idx` (`Communaute_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Albums`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Albums` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `nom` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `date` TIMESTAMP NULL ,
  `participants` TEXT NULL ,
  `producteur` VARCHAR(125) NULL ,
  `publie` INT NULL ,
  `livret_path` TEXT NULL ,
  `prix` FLOAT(5,2) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Albums_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Videos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Videos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `nom` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `date` DATE NULL ,
  `Adresse_id` INT NOT NULL ,
  `like_total` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Videos_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Videos_Adresse1_idx` (`Adresse_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Morceaux`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Morceaux` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Albums_id` INT NOT NULL ,
  `Utilisateur_id` INT NOT NULL ,
  `nom` VARCHAR(45) NULL ,
  `duree` TIMESTAMP NULL ,
  `nombre_lectures` INT NULL ,
  `prix` FLOAT(5,2) NULL ,
  `Videos_id` INT NOT NULL ,
  `like_total` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Morceaux_Albums1_idx` (`Albums_id` ASC) ,
  INDEX `fk_Morceaux_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Morceaux_Videos1_idx` (`Videos_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Concerts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Concerts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `Adresse_id` INT NOT NULL ,
  `titre` VARCHAR(255) NULL ,
  `date` TIMESTAMP NULL ,
  PRIMARY KEY (`id`, `Utilisateur_id`) ,
  INDEX `fk_Concerts_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Concerts_Adresse1_idx` (`Adresse_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Concerts_activite`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Concerts_activite` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `Concerts_id` INT NOT NULL ,
  `participation` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Concerts_activite_Concerts1_idx` (`Concerts_id` ASC) ,
  INDEX `fk_Concerts_activite_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Documents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Documents` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Morceaux_id` INT NOT NULL ,
  `path` TEXT NULL ,
  `type_document` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Partitions_Morceaux1_idx` (`Morceaux_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Statistiques`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Statistiques` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `stats_visites` INT NULL ,
  `stats_hommes` INT NULL ,
  `stats_femmes` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Statistiques_musiques_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Photos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Photos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `Adresse_id` INT NOT NULL ,
  `nom` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `date` DATE NULL ,
  `like_total` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Photos_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Photos_Adresse1_idx` (`Adresse_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Album_media`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Album_media` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(255) NULL ,
  `like_total` INT NULL ,
  `Videos_id` INT NOT NULL ,
  `Photos_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Album_media_Videos1_idx` (`Videos_id` ASC) ,
  INDEX `fk_Album_media_Photos1_idx` (`Photos_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Like`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Like` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `like_value` INT NULL ,
  `Photos_id` INT NOT NULL ,
  `Videos_id` INT NOT NULL ,
  `Morceaux_id` INT NOT NULL ,
  `Utilisateur_id` INT NOT NULL ,
  `Album_media_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Like_Photos1_idx` (`Photos_id` ASC) ,
  INDEX `fk_Like_Videos1_idx` (`Videos_id` ASC) ,
  INDEX `fk_Like_Morceaux1_idx` (`Morceaux_id` ASC) ,
  INDEX `fk_Like_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Like_Album_media1_idx` (`Album_media_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Wall`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Wall` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `wallto_utilisateur_id` INT NULL ,
  `markup_message` VARCHAR(45) NULL ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Wall_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Playlists`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Playlists` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `Morceaux_id` INT NOT NULL ,
  `nom` VARCHAR(125) NULL ,
  `date_creation` DATE NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Playlists_Utilisateur1_idx` (`Utilisateur_id` ASC) ,
  INDEX `fk_Playlists_Morceaux1_idx` (`Morceaux_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Page_personnalise`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Page_personnalise` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `banniere` VARCHAR(45) NULL ,
  `couleur1` VARCHAR(45) NULL ,
  `couleur2` VARCHAR(45) NULL ,
  `couleur3` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Page_personnalise_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Commande`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Commande` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `date` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Achats_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Commentaires`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Commentaires` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Wall_id` INT NOT NULL ,
  `comment` TEXT NULL ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Commentaires_Wall1_idx` (`Wall_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Articles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Articles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Utilisateur_id` INT NOT NULL ,
  `titre` VARCHAR(255) NULL ,
  `article` TEXT NULL ,
  `image` VARCHAR(255) NULL ,
  `created` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Articles_Utilisateur1_idx` (`Utilisateur_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `preprod-slyset`.`Infos_commande`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `preprod-slyset`.`Infos_commande` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Commande_id` INT NOT NULL ,
  `Albums_id` INT NOT NULL ,
  `titre` VARCHAR(255) NULL ,
  `prix` FLOAT(5,2) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Infos_commande_Commande1_idx` (`Commande_id` ASC) ,
  INDEX `fk_Infos_commande_Albums1_idx` (`Albums_id` ASC) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
