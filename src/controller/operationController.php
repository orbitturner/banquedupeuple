<?php
    session_start();
    require_once '../routes/dir.php';
    require_once '../Model/modelOperation.php';
    // var_dump($_POST);
        // array (size=6)
        // 'typeOp' => string 'RETRAIT' (length=7)
        // 'numeroCompte' => string 'DTSB-042019-12' (length=14)
        // 'idCompte' => string '12' (length=2)
        // 'montantOper' => string '1500' (length=4)
        // 'depRetContrat' => string 'on' (length=2)
        // 'newdepotretraitform' => string '' (length=0)

    if (isset($_POST['newdepotretraitform']) && $_POST['montantOper']!="" && $_POST['idCompte']!=NULL && $_POST['depRetContrat']=='on') {
        extract($_POST);
        $idUser = $_SESSION['idUser'];

        //Verifie est ce que tu as l'idCompte
        if ($_POST['typeOp'] == 'DEPOT') {
            $row = depot($montantOper, $type='DEPOT', $idCompte, $idUser);
            
        }else if ($_POST['typeOp'] == 'RETRAIT'){
            $row = retrait($montantOper, $type='RETRAIT', $idCompte, $idUser);
        }
        header('location:'.getProjectRoot().'operation');

    }elseif (isset($_POST['newVirement']) && $_POST['VirementContrat']=='on' && $_POST['idCompteCredit']!=NULL && $_POST['idCompteCredit']!="Choisissez un Compte") {
        extract($_POST);
        $idUser = $_SESSION['idUser'];

        $row = virement($idCompteDebit, $idCompteCredit, $montantVir, $type='VIREMENT', $idUser);
        if ($row >= 1) {
            header('location:'.getProjectRoot().'operation');
        }else {
            echo "<h1 align='center'>ERREUR FORMULAIRE! </h1>";
        }


    }else{
        echo "<h1 align='center'>ERREUR FORMULAIRE! </h1>";
        echo "<h1 align='center'>ACCES REFUSE! </h1>";
        echo "<h2 align='center'>Contactez Votre ADMIN </h2>";
        echo '<script>window.setTimeout("location=(\'http://localhost'.getProjectRoot().'operation\');",5000);</script>';
        echo '<p align="center">Vous serez redirigé dans 5s...</p>';
    }
    // C:\wamp64\www\Banque.sn\controller\operationController.php:4:
    // array (size=7)
    //   'numeroCompteDebit' => string 'DTSB-042019-12' (length=14)
    //   'numeroCompteCredit' => string 'DTSB-042019-11' (length=14)
    //   'idCompteDebit' => string '12' (length=2)
    //   'idCompteCredit' => string '11' (length=2)
    //   'montantVir' => string '100000' (length=6)
    //   'VirementContrat' => string 'on' (length=2)
    //   'newVirement' => string '' (length=0)
  
 
?>
