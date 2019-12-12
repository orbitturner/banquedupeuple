<?php
require_once 'db.php';


if (isset($_GET['id'])) {
//==================|RECUPERATION DE LA LISTE DES COMPTES|==================    
    $sql = "SELECT * from compte";
    $comptes = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // ==========================
    $idSelect = $_GET['id'];
    echo '<div class="card-deck">';
    for ($i=0; $i < sizeof($comptes); $i++) { 
        if ($comptes[$i]['idCli'] == $idSelect) {
            if ($comptes[$i]['etat'] == '1') {
                $etat = '<b class="text-success">ACTIF</b>';
            }else {
                $etat = '<b class="text-danger">BLOQUE</b>';
            }
            echo '
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">'.$comptes[$i]['numero'].'</h5>
                        <p class="card-text">Compte Créé le: '.$comptes[$i]['datCreation'].'</p>
                        <p class="card-text">Solde dans le Compte: '.$comptes[$i]['solde'].' Fcfa</p>
                    </div>
                <div class="card-footer">
                    <small class="text-muted">Etat du Compte('.$comptes[$i]['etat'].'): '.$etat.'</small>
                </div>
            </div>
          ';
        }
    }
    echo '</div>';
}elseif (isset($_GET['idC'])) {
    $idSelect = $_GET['idC'];
    //==================|RECUPERATION DE LA LISTE DES OPERATIONS|==================    
    $sql1 = "SELECT numOperation, datOp, typeOp, montant from operation where idCompte IN (SELECT DISTINCT compte.id from compte, client where idCli=$idSelect) AND etatOper=1";
    $operation = $db->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
    // ==========================
    echo '
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Numero</th>
                    <th scope="col">Date Opération</th>
                    <th scope="col">Type</th>
                    <th scope="col">Montant</th>
                </tr>
            </thead>
            <tbody>
    ';
    $j=1;
    foreach ($operation as $line) {
        echo '
            <tr>
                <th scope="row">'.$j.'</th>
                <td>'.$line['numOperation'].'</td>
                <td>'.$line['datOp'].'</td>
                <td>'.$line['typeOp'].'</td>
                <td>'.$line['montant'].'</td>
            </tr>
        ';
        $j++;
    }
    echo '
        </tbody>
        </table>
    ';
}
?>