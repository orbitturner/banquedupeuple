<?php
require_once "../../Model/db.php";


    global $db;
    // =========================[BLOCKING ACCOUNT]=========================
    if (isset($_GET['idBlock'])) {
        $sql = "UPDATE compte SET etat = 0 WHERE id = '".$_GET['idBlock']."'";
    
        $result = $db->exec($sql);
        echo $result;


    // =========================[BLOCKING ACCOUNT]=========================
    }elseif (isset($_GET['idUnBlock'])) {
        $sql = "UPDATE compte SET etat = 1 WHERE id = '".$_GET['idUnBlock']."'";
        
        $result = $db->exec($sql);
        echo $result;
    }elseif (isset($_GET['idDelete'])) {
        $sql = "UPDATE operation SET etatOper = 0 where id='".$_GET['idDelete']."'";
        $mt = (int)$_GET['mtOp'];
        $process = $db->exec($sql);

        if($_GET['typeOp'] == 'DEPOT'){
            $req = "UPDATE compte SET solde  = solde-".$mt." WHERE id = '".$_GET['idCptUpdate']."'";
            $result = $db->exec($req);
            echo $result;

        }elseif ($_GET['typeOp'] == 'RETRAIT'){
            $req = "UPDATE compte SET solde  = solde+".$mt." WHERE id = '".$_GET['idCptUpdate']."'";
            $result = $db->exec($req);
            echo $result;

        }else{
            $req = "UPDATE compte SET solde  = solde+".$mt." WHERE id = '".$_GET['idCptUpdate']."'";
            $result = $db->exec($req);
            echo $result;

        }
        
    }else {
        echo "<h1 align='center'>ERREUR ACCES! </h1>";
        echo "<h1 align='center'>ACCES REFUSE! </h1>";
        echo "<h2 align='center'>Contactez Votre ADMIN </h2>";
        echo '<script>window.setTimeout("location=(\'http://localhost'.getProjectRoot().'comptes\');",5000);</script>';
        echo '<p align="center">Vous serez redirigé dans 5s...</p>';
    }