<?php
require_once "../../Model/modelOperation.php";
require_once '../../routes/dir.php';


if (isset($_GET['typeOp'])) {
    if ($_GET['typeOp'] == 'DEPOT') {
        $numOp = opNumGen('DEP');
    }elseif ($_GET['typeOp'] == 'RETRAIT') {
        $numOp = opNumGen('RET');
    }else {
        $numOp = opNumGen('VIR');
    }

    echo $numOp;


// =========================[...]=========================
}else {
    echo "<h1 align='center'>ERREUR ACCES! </h1>";
    echo "<h1 align='center'>ACCES REFUSE! </h1>";
    echo "<h2 align='center'>Contactez Votre ADMIN </h2>";
    echo '<script>window.setTimeout("location=(\'http://localhost/Banque.sn/view/mainindex.php?page=accueil\');",5000);</script>';
    echo '<p align="center">Vous serez redirigé dans 5s...</p>';
}