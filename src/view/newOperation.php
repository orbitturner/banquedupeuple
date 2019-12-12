<?php
    require_once '../Model/db.php';

        $idUser= $_SESSION['idUser'];
        global $db;
        $req = "SELECT * FROM compte where etat=1";
        
        $lesComptes = $db->query($req)->fetchAll(PDO::FETCH_ASSOC);
 
        if (isset($_GET['numCompteSelect'])) {
            echo '<tag id="compteImport" forceselect="'.$_GET['numCompteSelect'].'" hidden></tag>';
        }
  
?>
<div class="container" id="userData" idUser="<?= $idUser;?>">
    <section class="animated zoomInUp">
        <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-default-tab" data-toggle="pill" href="#v-pills-default" role="tab"
                aria-controls="v-pills-default" aria-selected="true" style="font-weight: 400">NOUVELLE OPERATION</a>
            <a class="nav-link" id="v-pills-depotRetrait-tab" data-toggle="pill" href="#v-pills-depotRetrait" role="tab"
                aria-controls="v-pills-depotRetrait" aria-selected="true">
                <i class="far fa-arrow-alt-circle-right" style="padding-left: 5px; padding-right: 5px;"></i> Depot/Retrait</a>
            <a class="nav-link" id="v-pills-virement-tab" data-toggle="pill" href="#v-pills-virement" role="tab"
                aria-controls="v-pills-virement" aria-selected="false">
                <i class="far fa-arrow-alt-circle-right" style="padding-left: 5px; padding-right: 5px;"></i> Virement</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-default" role="tabpanel" aria-labelledby="v-pills-default-tab">
                    <div class="jumbotron" style="background-image: url(<?= getProjectPath() ?>img/content/oper.gif);">
                        <div class="text-white text-center py-5 px-4 my-5">
                            <div>
                            <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Choisissez l'Opération que vous Souhaitez Effectuer</strong></h2>
                            <p class="mx-5 mb-5">Veuillez-vous assurer avant de soumettre les formulaires que le client est conforme aux normes de sécurité
                                et que tout les champs sont bien remplis. Mais aussi vérifier bien la somme qui vous est remise.
                            </p>
                            <a href="?page=gOperation" class="btn btn-outline-white btn-md"><i class="fas fa-clone left"></i>
                                 Voir la Liste des Opérations</a>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- =======================================| DEPOT - RETRAIT |======================================= -->
                <div class="tab-pane fade animated lightSpeedIn" id="v-pills-depotRetrait" role="tabpanel" aria-labelledby="v-pills-depotRetrait-tab">
                    
                        <!-- Material form register -->
                        <div class="card">

                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>DEPOT - RETRAIT</strong>
                        </h5>

                        <!--Card content-->
                        <div class="card-body px-lg-5 pt-0">

                            <!-- Form -->
                            <form class="text-center" style="color: #757575;" method="post" id="newdepotretraitform" action="<?= getProjectPath() ?>controller/operationController.php" >
                                 <br>
                                <!-- == Type OP ==  -->
                                <span>= Type Opération =</span>
                                <select class="browser-default custom-select mb-4" name="typeOp" id="choixOp">
                                    <option value="" disabled>Faites un Choix</option>
                                    <option value="DEPOT" selected>Effectuer un Dépot</option>
                                    <option value="RETRAIT">Effectuer un Retrait</option>
                                </select>

                                <!-- ==| Numero du Compte |== -->
                                <div class="form-row">
                                    <div class="col">
                                            <span>= Numéro du Compte =</span>                               
                                            <select class="mdb-select md-form colorful-select dropdown-info mt-0 forceSelect" id="numeroCompte" name="numeroCompte" searchable="Rechercher un compte...">
                                                <option value="" disabled selected>Choisissez un Compte</option>
                                                <?php
                                                    foreach ($lesComptes as $row) {
                                                        
                                                        echo '<option value="'.$row['numero'].'" idCli="'.$row['idCli'].'" alt="'.$row['id'].'" solde="'.$row['solde'].'">'.$row['numero'].'</option>';
                                                    }
                                                ?>

                                            </select>
                                            <!-- <label class="mdb-main-label">Numéro du Compte</label> -->
                                    </div>
                                </div>

                                <!-- Numero Operation & Montant -->
                                <div class="form-row">
                                    <div class="col">
                                        <!-- IdCOmpte -->
                                        <div class="md-form">
                                            <input type="text" id="idCompte" placeholder="Choisissez un Compte" name="idCompte" value="" class="form-control" required readonly>
                                            <label for="idCompte">ID du Compte</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- Montant Depot - Retrait -->
                                        <div class="md-form">
                                            <input type="number" id="materialRegisterFormMontant" name="montantOper" class="form-control" min="500" >
                                            <label for="materialRegisterFormMontant">Montant</label>
                                        </div>
                                    </div>
                                </div>

                               
                                <!-- VERIFICATION - Le Client est en régle et -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="depRetContrat" name="depRetContrat" required> 
                                    <label class="form-check-label" for="depRetContrat">
                                        Le Client est en régle et les normes sont respectées
                                    </label>
                                </div>

                                <!-- Submit button -->
                                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect  z-depth-0 animated rubberBand" style="border-radius: 25px;" type="submit" id="btnDepRetForm" name="newdepotretraitform">
                                    <i class="fas fa-hand-holding-usd pr-3"></i>
                                    Valider Opération
                                </button>

                                <!-- Social register -->
                                <!-- <p>or sign up with:</p>

                                <a type="button" class="btn-floating btn-fb btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a type="button" class="btn-floating btn-tw btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a type="button" class="btn-floating btn-li btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a type="button" class="btn-floating btn-git btn-sm">
                                    <i class="fab fa-github"></i>
                                </a> -->

                                <hr>

                                <!-- Terms of service -->
                                <p>Assurez-vous
                                    que tout les <em>champs</em> soit <em>Correct.</em><br> Souhaitez-vous
                                    <a href="javascript:document.getElementById('newdepotretraitform').reset();"> Reprendre à Zéro?</a>

                            </form>
                            <!-- Form -->

                        </div>

                        </div>
                        <!-- Material form register -->
                </div>

                <!-- =======================================[ V I R E M E N T]======================================= -->
                <div class="tab-pane fade animated jackInTheBox" id="v-pills-virement" role="tabpanel" aria-labelledby="v-pills-virement-tab">
                    <!-- Material form register -->
                    <div class="card">

                    <h5 class="card-header peach-gradient white-text text-center py-4">
                        <strong>VIREMENT</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">
                                                <!-- Form -->
                    <form class="text-center" style="color: #757575;" method="post" id="newVirement" action="<?= getProjectPath() ?>controller/operationController.php" >
                        <div class="form-row">
                            <div class="col">
                                <!-- ==| Numero de Compte Debit |== -->
                                <span>= Numéro du Compte à Débiter =</span>                               
                                <select class="mdb-select md-form colorful-select dropdown-warning mt-0 forceSelect" id="numeroCompteDebit" name="numeroCompteDebit" searchable="Rechercher un compte...">
                                    <option value="" disabled selected>Entrer le Numéro</option>
                                    <?php
                                        foreach ($lesComptes as $row) {
                                            
                                            echo '<option value="'.$row['numero'].'" idCli="'.$row['idCli'].'" alt="'.$row['id'].'" solde="'.$row['solde'].'">'.$row['numero'].'</option>';
                                        }
                                    ?>

                                </select>
                            </div>

                            <div class="col">
                                <!-- ==| Numero de Compte Credit |== -->
                                <span>= Numéro du Compte à Créditer =</span>                               
                                <select class="mdb-select md-form colorful-select dropdown-success mt-0" id="numeroCompteCredit" name="numeroCompteCredit" searchable="Rechercher un compte...">
                                    <option value="" disabled selected>Entrer le Numéro</option>
                                    <?php
                                        foreach ($lesComptes as $row) {
                                            
                                            echo '<option value="'.$row['numero'].'" alt="'.$row['id'].'" solde="'.$row['solde'].'">'.$row['numero'].'</option>';
                                        }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <!-- ID COMPTE DEBIT ET COMPTE CREDIT -->
                        <div class="form-row">
                            <div class="col">
                                <!-- ID DEBIT -->
                                <div class="md-form">
                                    <input type="text" id="idCompteDebit" placeholder="Choisissez un Compte" name="idCompteDebit" value="" class="form-control" required readonly>
                                    <label for="idCompteDebit">ID du Compte de Débit</label>
                                </div>
                            </div>
                            <div class="col">
                                <!-- ID CREDIT -->
                                <div class="md-form">
                                    <input type="text" id="idCompteCredit" placeholder="Choisissez un Compte" name="idCompteCredit" value="" class="form-control" required readonly>
                                    <label for="idCompteCredit">ID du Compte de Crédit</label>
                                </div>
                            </div>
                        </div>
                            
                        <!-- Montant Virement -->
                        <div class="md-form">
                            <input type="number" id="montantVir" name="montantVir" class="form-control" min="500">
                            <label for="montantVir">Montant à Virer</label>
                        </div>

                        <!-- VERIFICATION - Le Client est en régle et -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="VirementContrat" name="VirementContrat" required> 
                            <label class="form-check-label" for="VirementContrat">
                                Le Client est en régle et les normes sont respectées
                            </label>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-warning btn-rounded waves-effect my-4 animated swing" style="border-radius: 25px;" type="submit" id="btnNewVirement" name="newVirement">
                            <i class="fas fa-exchange-alt pr-3"></i>
                            Valider Virement
                        </button>

                        <!-- Social register -->
                        <!-- <p>or sign up with:</p>

                        <a type="button" class="btn-floating btn-fb btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a type="button" class="btn-floating btn-tw btn-sm">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a type="button" class="btn-floating btn-li btn-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a type="button" class="btn-floating btn-git btn-sm">
                            <i class="fab fa-github"></i>
                        </a> -->

                        <hr>

                        <!-- Terms of service -->
                        <p>Assurez-vous
                            que tout les <em>champs</em> soit <em>Correct.</em><br> Souhaitez-vous
                            <a href="javascript:document.getElementById('newVirement').reset();"> Reprendre à Zéro?</a>

                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
        </div>
    </section>
        <div class="progress md-progress primary-color-dark">
            <div class="indeterminate"></div>
        </div>
</div>
