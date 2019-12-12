<?php
	require_once 'db.php';

	function verifierConnexion ($login, $password){
		global $db;
		$requete = "SELECT * FROM utilisateur WHERE login='$login' AND password='$password'";
		return $db->query($requete)->fetch();
		//fetch() est une requete qui ne retourne qu'un seul résultat
		
	}