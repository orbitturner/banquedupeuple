<!-- ===================================[ MAINCOMPTE - GESTION OPERATION ]==================================-->
<?php
require_once '../Model/db.php';

//==================|RECUPERATION DE LA LISTE DES COMPTES|==================    
function getOperationList(){
    global $db;
    $requete = "SELECT operation.id as opId, compte.id as cpteId, utilisateur.id as usrId, numOperation, datOp, montant, typeOp, idCompte, operation.idUser as opIdUsr, compte.idUser as cpteIdUsr, details, numero, datCreation, solde, idCli, etat, nom, prenom FROM operation, compte, utilisateur WHERE idCompte = compte.id AND operation.idUser=utilisateur.id AND etatOper=1";
    //Chaque ROW as an ARRAY
    return $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);
    //fetch() est une requete qui ne retourne qu'un seul résultat
}

?>
<section class="animated rotateInUpRight">
    <!--Card image-->
    <div class="view view-cascade gradient-card-header secondary-color-dark blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

        <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="modal" data-target="#modalLRForm" onclick="location.href = 'newoperation';">
                <i class="fas fa-file-invoice-dollar"></i> Nouvelle Opération
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-th-large mt-0"></i>
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-columns mt-0"></i>
            </button>
        </div>

        <a href="" class="white-text mx-3"><b>Liste des Opérations</b></a>

        <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-pencil-alt mt-0"></i>
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="far fa-trash-alt mt-0"></i>
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-info-circle mt-0"></i>
            </button>
        </div>

    </div>
    <!--/Card image-->

    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead class="blue-gradient text-white">
            <tr>
                <th class="th-xs">N°
                </th>
                <th class="th-sm">Numéro Opération
                </th>
                <th class="th-sm">Date Opération
                </th>
                <th class="th-sm">Numéro Compte
                </th>
                <th class="th-sm">Type d'Opération
                </th>
                <th class="th-sm">Montant
                </th>
                <th class="th-sm">Nom & Prénom Responsable
                </th>
                <th class="th-sm">Actions <i class="fas fa-ellipsis-h pl-2">
                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            $listOper = getOperationList();
            // array (size=19)
            // 0 => 
            //   array (size=18)
            //     'opId' => string '3' (length=1)
            //     'cpteId' => string '9' (length=1)
            //     'usrId' => string '1' (length=1)
            //     'numOperation' => string 'opd1ef119' (length=9)
            //     'datOp' => string '18-03-2019' (length=10)
            //     'montant' => string '15000' (length=5)
            //     'typeOp' => string 'depot' (length=5)
            //     'idCompte' => string '9' (length=1)
            //     'opIdUsr' => string '1' (length=1)
            //     'cpteIdUsr' => string '1' (length=1)
            //     'details' => null
            //     'numero' => string 'DTSB-032019-9' (length=13)
            //     'datCreation' => string '18-03-2019' (length=10)
            //     'solde' => string '20000' (length=5)
            //     'idCli' => string '16' (length=2)
            //     'etat' => string '1' (length=1)
            //     'nom' => string 'Sene' (length=4)
            //     'prenom' => string 'Sonhibou ' (length=9)
            // Le probleme avec les virement c la table Operation elle meme
            $i = 0;

            foreach ($listOper as $row) {
                $i++;
                echo '
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $row['numOperation'] . '</td>
                            <td>' . $row['datOp'] . '</td>
                            <td>' . $row['numero'] . '</td>
                            <td>' . $row['typeOp'] . '</td>
                            <td>' . $row['montant'] . '</td>
                            <td>' . $row['prenom'] . ' ' . $row['nom'] . '</td>
                            <td align="center"><button idOperDel="'.$row['opId'].'" idCpteUpd="'.$row['idCompte'].'" mtCpteUpd="'.$row['montant'].'" typeOperDel="'.$row['typeOp'].'" numOperDel="'.$row['numOperation'].'"  type="button" class="btn btn-outline-danger btn-rounded waves-effect btnDelCompte"><i class="far fa-trash-alt pr-2" aria-hidden="true"></i>Supprimer</button></td>
                            
                        </tr>
                    ';
            }
            ?>

        </tbody>

        <tfoot>
            <tr>
                <th>N°
                </th>
                <th>Numéro Opération
                </th>
                <th>Date Opération
                </th>
                <th>Numéro Compte
                </th>
                <th>Type d'Opération
                </th>
                <th>Montant
                </th>
                <th>Nom & Prénom Responsable
                </th>
                <th>Actions <i class="fas fa-ellipsis-h pl-2">
                </th>
        </tfoot>
    </table>
</section>
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDelete" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading font-weight-normal">VOULEZ-VOUS VRAIMENT SUPPRIMER L'OPERATION?</p>
      </div>

      <!--Body-->
      <div class="modal-body">
          <i class="far fa-trash-alt fa-4x animated rotateIn"></i>
          <p class="pt-4 font-weight-bold">L'action que vous allez éxécutée en appuyant sur 'OUI' est <b class="text-danger">IRREVERSIBLE</b></p>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <button id="compteDeleter" class="btn  btn-outline-danger">Oui <i class="fas fa-exclamation-triangle pl-2"></i></button>
        <a type="button" class="btn  btn-danger waves-effect animated heartBeat infinite" data-dismiss="modal">NON</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->