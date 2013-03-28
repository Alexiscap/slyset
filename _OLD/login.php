<?php
  if (isset($_POST['login']))
  {
    $login = $_POST['login'];
  }
  else
  {
    $login='';
  }

  if (isset($_POST['mdp']))
    {
      $mdp = $_POST['mdp'];
   }
   else
    {
      $mdp='';
    }

  include 'connexion.php';
  $table = "NOMTABLE";
  $requete = "SELECT login, mdp FROM ".$table." WHERE login=".$login;
  $resultat = mysql_query($requete) or die('Erreur SQL !'.mysql_error());
  $data = mysql_fetch_array($resultat);
  if ($login==$data['login'] && $mdp==$data['mdp')
  {
    $log=true;
  }
  else
  {
    $log=false;
  }
/* NOMTABLE A REMPLIR + FICHIER A TESTER */
/* Pour la connexion include ce fichier + tester la variable log (true = connecté /// false=erreur) */
?>
