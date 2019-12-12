<?php
session_start();
require_once '../routes/dir.php';
require_once '../Model/userModel.php';
//connexion
if (isset($_POST['connexion']) && $_POST['email']!=NULL || $_POST['email']!=" " || $_POST['pwd']!="")
{
	extract($_POST);
	$utilisateur = verifierConnexion($email,$pwd);
	if ($utilisateur != NULL) 
	{
		$_SESSION['profil']=$utilisateur['profil'];
		$_SESSION['idUser'] = $utilisateur['id'];
		$_SESSION['nomComplet'] = $utilisateur['nom'].' '.$utilisateur['prenom'];
		// $val = getProjectPath();
		header("location:".getProjectRoot()."home");
		
	}else{
		
		header("location:".getProjectRoot()."login?connexion=0");
		
	     }
	     

}
//deconnexion
if (isset($_GET['logout']) && ($_GET['logout']==1))
 {
	session_unset();
	$_SESSION= array();
	header("location:".getProjectRoot()."login?log=1");
 }

?>