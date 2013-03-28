<?php
/* Fichier connexion Php/MySQL */

  $serveur = "ADRESSE SERVER";
  $nom_base = "NOM BDD";
  $login = "LOGIN";
  $motdepasse = "MDP";

  mysql_connect ($serveur,$login,$pwd) or die ('Connexion server impossible'.mysql_error());
  mysql_select_db ($nom_base) or die ('Connexion base impossible ou base inexistante'.mysql_error());

/* Fichier a include pour chaque connexion a la BDD */
/* COMPLETER CE FICHIER AVEC LES INFOS MYSQL */
?>
