<!DOCTYPE HTML>
<html lang="fr">
<head>
  <title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="<?php echo $description; ?>" />
  <meta name="keywords" content="<?php echo $keywords; ?>" />

	<link type="text/css" rel="stylesheet" href="<?php echo css_url('reset') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_header-footer') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo css_url('tpl_sidebar-left') ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo css_url('slyset') ?>" />
	<!--[if IE]>
		<link type="text/css" rel="stylesheet" href="<?php echo css_url('corrections-ie') ?>" />
	<![endif]-->
</head>
<body>
	<header>
		<div id="header">
			<img id="logo" src="<?php echo img_url('/header/logo.png') ?>" alt="Logo Slyset"/>
			<div id="ico_menu">
				<a href="portail.php" id="accueil"><span>Accueil</span></a>
				<a href="#" id="explorer"><span>Explorer</span></a>
				<a href="#" id="inscrire"><span>S'inscrire</span></a>
			</div>
			<div id="connexion">
				<div id="recherche">
					<form>
						<input type="text" value="Chercher un artiste ..." onfocus="javascript:this.value=''" onblur="if (this.value==''){this.value='Chercher un artiste ...';}" name="recherche" />
						<input src="<?php echo img_url('/header/loupe.png') ?>" type="image" value="submit" align="middle"/>
					</form>
				</div>
			<a href="#">Se connecter</a>
			</div>
		</div>
	</header>