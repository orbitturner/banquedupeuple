<!-- ===================================[ MAINCOMPTE - GESTION CLIENT ]==================================-->
<?php
require_once '../Model/db.php';

//==================|RECUPERATION DE LA LISTE DES COMPTES|==================    
function getClientList()
{
    global $db;
    $requete = "SELECT client.id, cni, nom, prenom, adresse, tel, numero, datCreation, solde, idCli, idUser FROM client, compte WHERE Client.id = idCli";
    //Chaque ROW as an ARRAY
    return $db->query($requete)->fetchAll(PDO::FETCH_ASSOC);
    //fetch() est une requete qui ne retourne qu'un seul résultat
}
$req = "SELECT * from compte";
$lesComptes = $db->query($req)->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="animated zoomInRight slow">
    <!--Card image-->
    <div class="view view-cascade gradient-card-header young-passion-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

        <div>
            <button onclick="location.href = 'newcompte';" type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-user-plus"></i> Nouveau Client
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-th-large mt-0"></i>
            </button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2">
                <i class="fas fa-columns mt-0"></i>
            </button>
        </div>

        <a href="" class="white-text mx-3"><b>Liste des Clients</b></a>

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
        <thead class="young-passion-gradient text-white">
            <tr>
                <th class="th-xs">N°
                </th>
                <th class="th-sm">ID
                </th>
                <th class="th-sm">Nom
                </th>
                <th class="th-sm">Prenom
                </th>
                <th class="th-sm">N°IN / CNI
                </th>
                <th class="th-sm">Téléphone
                </th>
                <th class="th-sm">Adresse
                </th>
                <th class="th-sm">Options
                    <i class="fas fa-ellipsis-h pl-2">
                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            $listeClient = getClientList();
            // var_dump($listeClient[2]['id']);
            // 0 => 
            // array (size=11)
            //   'id' => string '12' (length=2)
            //   'cni' => string '1850250065' (length=10)
            //   'nom' => string 'SECK' (length=4)
            //   'prenom' => string 'Seydou' (length=6)
            //   'adresse' => string 'Sipres Man DOu ay Foooo' (length=23)
            //   'tel' => string '778612398' (length=9)
            //   'numero' => string '1532564' (length=7)
            //   'datCreation' => string '06-04-2019' (length=10)
            //   'solde' => string '38000' (length=5)
            //   'idCli' => string '19' (length=2)
            //   'idUser' => string '3' (length=1)
            $i = 0;

            foreach ($listeClient as $row) {
                $i++;
                echo '
                        <tr>
                            <td>' . $i . '</td>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['nom'] . '</td>
                            <td>' . $row['prenom'] . '</td>
                            <td>' . $row['cni'] . '</td>
                            <td>' . $row['tel'] . '</td>
                            <td>' . $row['adresse'] . '</td>
                            <td align="center"><button class="btn peach-gradient btn-rounded clientBtn" data-toggle="modal" data-target="#modalClient" nomClient="' . $row['prenom'] . ' ' . $row['nom'] . '" idCpte="' . $row['id'] . '" nCpte="' . $row['numero'] . '" slde="' . $row['solde'] . '" cni="' . $row['cni'] . '" dCreat_Adrss="' . $row['datCreation'] . ' • ' . $row['adresse'] . '">Détails</button></td>
                        </tr>
                    ';
            }
            ?>


        </tbody>

        <tfoot>
            <tr>
                <th>N°
                </th>
                <th>ID
                </th>
                <th>Nom
                </th>
                <th>Prenom
                </th>
                <th>N°IN / CNI
                </th>
                <th>Téléphone
                </th>
                <th>Adresse
                </th>
                <th>Options
                    <i class="fas fa-ellipsis-h pl-2">
                </th>
            </tr>
        </tfoot>
    </table>


</section>
<!--Modal: modalClient-->
<div class="modal fade" id="modalClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Informations sur le Client
                </p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <i class="far fa-address-card fa-4x animated rotateIn mb-4"></i>

                <!-- Card -->
                <div class="card chart-card">

                    <!-- Card content -->
                    <div class="card-body pb-0">

                        <!-- Title -->
                        <h4 class="card-title font-weight-bold">
                            <!-- FILLED WITH JQUERY -->
                        </h4>
                        <!-- Text -->
                        <p class="card-text mb-4"></p>
                        <div class="d-flex justify-content-between">
                            <!-- FILLED WITH JQUERY -->
                            <p class="display-4 align-self-end sold"></p>
                            <!-- FILLED WITH JQUERY -->
                            <p class="align-self-end pb-2 cniC"></p>
                        </div>

                    </div>

                    <!-- Classic tabs -->
                    <div class="classic-tabs">

                        <!-- Nav tabs -->
                        <ul class="nav tabs-white nav-fill" role="tablist">
                            <li class="nav-item ml-0">
                                <a class="nav-link waves-light active" data-toggle="tab" href="#panel1001" role="tab">Infos Comptes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link waves-light" data-toggle="tab" href="#panel1002" role="tab">Liste Opérations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link waves-light" data-toggle="tab" href="#panel1003" role="tab">Ajouter un Nouveau Compte</a>
                            </li>
                        </ul>

                        <div class="tab-content rounded-bottom">
                            <!--Panel 1-->
                            <div class="tab-pane fade in show active" id="panel1001" role="tabpanel">

                                <!-- FILLED WITH JQUERY -->

                            </div>
                            <!--/.Panel 1-->
                            <!--Panel 2-->
                            <div class="tab-pane fade" id="panel1002" role="tabpanel">

                                <!-- FILLED WITH JQUERY -->

                            </div>
                            <!--/.Panel 2-->
                            <!--Panel 3-->
                            <div class="tab-pane fade" id="panel1003" role="tabpanel">
                                <!--Section: Live preview-->
                                <section class="form-dark">

                                    <!--Form without header-->
                                    <div class="card card-image" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/pricing-table7.jpg'); width: 100%;">
                                        <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                                            <!--Header-->
                                            <div class="text-center">
                                                <h3 class="white-text mb-5 mt-4 font-weight-bold"><strong>Créer un Nouveau</strong> <a class="green-text font-weight-bold"><strong> COMPTE</strong></a></h3>
                                            </div>
                                            <form action="<?= getProjectPath() ?>controller/compteController.php" method="post">
<!-- solde idCli  -->
                                                <!--Body-->
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="md-form">
                                                            <input type="text" id="idCliNew" name="idCliNew" value="" placeholder="AUTO" class="form-control white-text" readonly>
                                                            <label for="idCliNew">Votre ID: </label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="md-form">
                                                            <input type="text" id="SoldCliNew" name="SoldCliNew" value="" class="form-control white-text"  min="5000" required>
                                                            <label for="SoldCliNew">Solde Initial: </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <div class="form-check my-4">
                                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck17" required>
                                                            <label class="form-check-label white-text" for="defaultCheck17">Toutes les<a href="#" class="purple-text font-weight-bold"> normes</a> ont était <b>respectées</b></label>
                                                        </div>

                                                <!--Grid row-->
                                                <div class="row d-flex align-items-center mb-4">

                                                    <!--Grid column-->
                                                    <div class="text-center mb-3 col-md-12">
                                                        <button type="submit" id="validateNewAcc" name="newAccount" class="btn btn-success btn-block btn-rounded z-depth-1">Enregistrer<i class="fas fa-check pl-2"></i></button>
                                                    </div>
                                                    <!--Grid column-->
                                                </div>
                                                <!--Grid row-->

                                                <!--Grid column-->
                                                <div class="col-md-12">
                                                    <p class="font-small white-text d-flex justify-content-end">Nouveau Client? <a href="<?= getProjectRoot() ?>newcompte" class="purple-text ml-1 font-weight-bold"> CREER</a></p>
                                                </div>
                                                <!--Grid column-->
                                            </form>
                                        </div>
                                    </div>
                                    <!--/Form without header-->

                                </section>
                                <!--Section: Live preview-->
                            </div>
                            <!--/.Panel 3-->
                        </div>

                    </div>
                    <!-- Classic tabs -->

                </div>
                <!-- Card -->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <!-- <a href="" id="newAccountwithClient" class="btn btn-info">Ajouter un Nouveau Compte</a> -->
                <a type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">FERMER</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalClient-->
