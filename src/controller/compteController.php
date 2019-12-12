<?php 
session_start();
    require_once '../routes/dir.php';
    require_once('../Model/modelCompte.php');
    // var_dump($_POST);
    // extract($_POST);
    // if ($numeroClient == "") {
    //     echo '<h1>HELLO THERE</h1>';
    // }
        // ===================[NOUVEAU COMPTE & NEW CLIENT]===================
    if (isset($_POST['ajoutCompte']) && ($_POST['solde']!="" && $_POST['nom']!=NULL && $_POST['prenom']!="" && $_POST['cni']!="")) {
        extract($_POST);

        $idCli = insererClient($cni,strtoupper($nom), $prenom, $adresse, $tel);
        $idUser = $_SESSION['idUser'];
        $row = ajouterCompte($solde, $idCli, $idUser);
        
        header('location:'.getProjectRoot().'comptes');
        // ===================[NOUVEAU COMPTE POUR CLIENT EXISTANT]===================
    }elseif (isset($_POST['newAccount']) && ($_POST['SoldCliNew']!="" && $_POST['idCliNew']!=NULL)) {
        extract($_POST);
        var_dump($_POST);

        $idUser = $_SESSION['idUser'];
        $row = ajouterCompte($SoldCliNew, $idCliNew, $idUser);

        header('location:'.getProjectRoot().'comptes');
    }else {
        echo "<h1 align='center'>ERREUR FORMULAIRE! </h1>";
        echo "<h1 align='center'>ACCES REFUSE! </h1>";
        echo "<h2 align='center'>Contactez Votre ADMIN </h2>";
        echo '<script>window.setTimeout("location=(\'http://localhost'.getProjectRoot().'home\');",5000);</script>';
        echo '<p align="center">Vous serez redirigé dans 5s...</p>';
    }

    // array (size=8)
    // 'solde' => string '520000' (length=6)
    // 'cni' => string '4764514367' (length=10)
    // 'nom' => string 'Ertyuj' (length=6)
    // 'prenom' => string 'sfghyujkl' (length=9)
    // 'adresse' => string 'edfolpmù' (length=9)
    // 'tel' => string '85258258' (length=8)
    // 'clientPremium' => string 'on' (length=2)
    // 'ajoutCompte' => string '' (length=0)
?>