
<?php
	require_once ($_SERVER["DOCUMENT_ROOT"].'/banquedupeuple/src/routes/dir.php');
	$host = 'localhost';
	$dbName = 'banque';
	$user = 'root';
	$password = '@Shadowtech1064997';

	try {
		$db = new PDO('mysql:host='.$host.';dbname='.$dbName, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		/*
		// echo '
		// 	<link href="<?= getProjectPath() ?>assets/MDB-Free_4.7.4/css/bootstrap.min.css" rel="stylesheet">
		// 	<link href="<?= getProjectPath() ?>assets/MDB-Free_4.7.4/css/mdb.min.css" rel="stylesheet">
		// 	<div class="jumbotron">
		// 		<h2 class="display-4">Hello, world! Vous n\'êtes pas censé voir Cette Page!</h2>
		// 		<p class="lead">La Connexion à la base de donnée à était effectué avec succés ou La derniére Requête à était Valider.</p>
		// 		<hr class="my-4">
		// 		<p>En attente de Requête Utilisateur pour Poursuivre. <br>Contacter OrbitTurner@outlook.com si vous êtes Bloqué à cette page.</p>
		// 		<a class="btn btn-primary btn-lg" onClick="javascript:history.go(-1)" role="button">Retour à la Page Précédente</a>
		// 	</div>';*/

	} catch (Exception $e) {
		echo '
		<link href="'.getProjectPath().'"assets/MDB-Free_4.7.4/css/bootstrap.min.css" rel="stylesheet">
		<link href="'.getProjectPath().'assets/MDB-Free_4.7.4/css/mdb.min.css" rel="stylesheet">
		<div class="jumbotron">
			<div class="alert alert-danger" role="alert">
			<h2 class="display-4">Ooh ZUUT! Vous n\'êtes pas censé voir Cette Page!</h2></div>
			<p class="lead"><b>Erreur de connexion de Connexion à la base de Donnée.</b></p>
			<hr class="my-4">
			<p>Une Erreur s\'est produite lors de la tentative de connexion à la Base. <br>Contacter L\'admin(OrbitTurner) en lui communiquant l\'erreur ci-dessous.</p>
			<a class="btn btn-primary btn-lg" onClick="javascript:history.go(-1)" role="button">Retour à la Page Précédente</a>
		</div>';
		die("<b>ERREUR RETOURNE: </b> ".$e->getMessage());

	}
?>