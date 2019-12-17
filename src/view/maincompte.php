<!-- ===================================[ MAINCOMPTE - GESTION COMPTE ]==================================-->
<?php
require_once '../Model/db.php';

//==================|RECUPERATION DE LA LISTE DES COMPTES|==================    
function getAccountList()
{
  global $db;
  $requete = "SELECT compte.id, numero, datCreation, solde, idCli, idUser, nom, prenom, etat FROM compte, client WHERE idCli = Client.id";
  //Chaque ROW as an ARRAY
  return $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);
  //fetch() est une requete qui ne retourne qu'un seul résultat
}

?>
<section class="animated slideInLeft slow">
  <!-- Table with panel -->
  <div class="card card-cascade narrower">

    <!--Card image-->
    <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

      <div>
        <button onclick="location.href = 'newcompte'" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
          <i class="fas fa-user-tie"> </i> Nouveau Compte
        </button>
        <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
          <i class="fas fa-th-large mt-0"></i>
        </button>
        <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
          <i class="fas fa-columns mt-0"></i>
        </button>
      </div>

      <a href="" class="white-text mx-3">Liste des Comptes</a>

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

    <div class="px-4">

      <div class="table-wrapper">
        <!--Table-->
        <table id="dtBasicExample" class="table table-hover mb-0">

          <!--Table head-->
          <thead>
            <tr>
              <th class="th-xs">
                N°
              </th>
              <th class="th-lg">
                Numero du Compte
              </th>
              <th class="th-lg">
                Date de Création
              </th>
              <th class="th-lg">
                Infos Client
              </th>
              <th class="th-lg">
                Solde
              </th>
              <th class="th-lg">
                Actions <i class="fas fa-ellipsis-h pl-2"> </i>
              </th>
            </tr>
          </thead>
          <!--Table head-->

          <!--Table body-->
          <tbody>
            <?php
            $listeCompte = getAccountList();
            // var_dump($listeCompte);
            // 0 => 
            // array (size=11)
            //   'id' => string '19' (length=2)
            //   'numero' => string '1532564' (length=7)
            //   'datCreation' => string '06-04-2019' (length=10)
            //   'solde' => string '38000' (length=5)
            //   'idCli' => string '19' (length=2)
            //   'idUser' => string '3' (length=1)
            //   'cni' => string '1850250065' (length=10)
            //   'nom' => string 'SECK' (length=4)
            //   'prenom' => string 'Seydou' (length=6)
            //   'adresse' => string 'Sipres Man DOu ay Foooo' (length=23)
            //   'tel' => string '778612398' (length=9)

            $i = 0;
            foreach ($listeCompte as $row) {
              $i++;
              if ($row['etat'] == '1') {
                echo '
                    
                    <tr>
                      <!-- Numero -->
                      <td>' . $i . '</td>
                      <!-- Numero du Compte -->
                      <td>' . $row['numero'] . '</td>
                      <!-- Date de Création -->
                      <td>' . $row['datCreation'] . '</td>
                      <!-- Infos Client -->
                      <td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>
                      <!-- Solde -->
                      <td>' . $row['solde'] . '</td>
                      <!-- Action -->
                      <td style="text-align: center;">
                      <button type="button" numCpteB="' . $row['numero'] . '" idCompt="' . $row['id'] . '" class="btn btn-danger btn-sm btnCompte"><i class="fas fa-ban pr-2"></i> Bloquer</button>
                      <button soldeCpteB="' . $row['solde'] . '" numCpteB="' . $row['numero'] . '" idCompt="' . $row['id'] . '" class="btn btn-indigo btn-sm newOperBtn" data-toggle="modal" data-target="#modalNewOperation"><i class="fas fa-plus pr-2"></i>Effectuer Operation</button>
                      </td>
                    </tr>
                ';
              } else {
                echo '
                    <tr>
                      <!-- Numero -->
                      <td>' . $i . '</td>
                      <!-- Numero du Compte -->
                      <td>' . $row['numero'] . '</td>
                      <!-- Date de Création -->
                      <td>' . $row['datCreation'] . '</td>
                      <!-- Infos Client -->
                      <td>' . $row['nom'] . ' ' . $row['prenom'] . '</td>
                      <!-- Solde -->
                      <td>' . $row['solde'] . '</td>
                      <!-- Action -->
                      <td style="text-align: center;">
                      <button type="button" numCpteD="' . $row['numero'] . '" idComptD="' . $row['id'] . '" class="btn btn-success btn-sm btnCompteD"><i class="fas fa-ban pr-2"></i> Débloquer</button>
                    </tr>
                ';
              }
            }


            ?>

          </tbody>
          <!--Table body-->
        </table>
        <!--Table-->
      </div>

    </div>

  </div>
  <!-- Table with panel -->
</section>


<!--Modal: modalConfirmBlock-->
<div class="modal fade" id="modalConfirmBlock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading font-weight-normal">VOULEZ-VOUS VRAIMENT BLOQUER LE COMPTE?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-ban fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <button id="compteBlocker" class="btn  btn-outline-danger">Oui</button>
        <a type="button" class="btn  btn-danger waves-effect animated pulse infinite" data-dismiss="modal">NON</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmBlock-->


<!--Modal: modalPushDeblock-->
<div class="modal fade" id="modalPushDeblock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading font-weight-normal">VOULEZ-VOUS VRAIMENT DEBLOQUER LE COMPTE?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="far fa-check-circle fa-4x animated rotateIn mb-4"></i>

        <p>L'Etat du compte sera mis à (1) et sera donc débloqué et opérationnel.</p>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <button id="compteDeblocker" class="btn btn-info">Oui</button>
        <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Non</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalPushDeblock-->



<!--Modal: modalNewOperation-->
<div class="modal fade" id="modalNewOperation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header light-blue darken-3 white-text">
        <h4 class="title"><i class="fas fa-users"></i> EFFECTUER UNE OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body mb-0 text-center">


            <!-- Card -->
            <div class="card gradient-card">

              <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg)">

                <!-- Content -->
                <a href="#!">
                  <div class="text-white d-flex h-100 mask blue-gradient-rgba">
                    <div class="first-content align-self-center p-3">
                      <h3 class="card-title">LISTE DES OPERATIONS DU COMPTE</h3>
                      <p class="lead mb-0">Cliquer pour voir Plus</p>
                    </div>
                    <div class="second-content align-self-center mx-auto text-center">
                      <i class="far fa-money-bill-alt fa-3x"></i>
                    </div>
                  </div>
                </a>

              </div>

              <!-- Data -->
              <div class="third-content ml-auto mr-4 mb-2">
                <p class="text-uppercase text-muted">Liste des Opérations</p>
                <h4 class="font-weight-bold float-right compteInfo">---</h4>
              </div>

              <!-- Content -->
              <div class="card-body white">
                <div class="progress md-progress">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-muted">Limite Plafond (25%)</p>
                <h4 class="text-uppercase font-weight-bold my-4">COMMING SOON</h4>
                <p class="text-muted" align="justify">A GENERER AVEC JS </p>
              </div>

            </div>
            <!-- Card -->


         

            <!-- Card -->
            <div class="card gradient-card">

              <div class="card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Horizontal/Work/4-col/img%20%2814%29.jpg);">

                <!-- Content -->
                <a href="#!">
                  <div class="text-white d-flex h-100 mask purple-gradient-rgba">
                    <div class="first-content align-self-center p-3">
                      <h3 class="card-title">AJOUTER UNE OPERATION</h3>
                      <p class="lead mb-0">Cliquer pour voir Plus</p>
                    </div>
                    <div class="second-content  align-self-center mx-auto text-center">
                      <i class="fas fa-chart-line fa-3x"></i>
                    </div>
                  </div>
                </a>

              </div>

              <!-- Data -->
              <div class="third-content  ml-auto mr-4 mb-2">
                <p class="text-uppercase text-muted">Ajouter une Opération</p>
                <h4 class="font-weight-bold float-right compteInfo">---</h4>
              </div>

              <!-- Content -->
              <div class="card-body white">
                <div class="progress md-progress">
                  <div class="progress-bar purple lighten-2" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="text-muted">Limite Plafond (25%)</p>
                <h4 class="text-uppercase font-weight-bold my-4 compteInfoSolde">COMMING SOON</h4>
                <a type="button" id="newOperCptBtn" href="" class="btn-floating btn-lg blue-gradient animated swing slow infinite"><i class="fas fa-external-link-alt" aria-hidden="true"></i></a>
                <p>Cliquer sur le Bouton</p>
              </div>

            </div>
            <!-- Card -->
      


      </div>

    </div>
    <!--/.Content-->

  </div>
</div>
<!--Modal: modalNewOperation-->