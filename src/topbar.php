<?php
include "header.php";

?>

<div id="topbar">
  <ul>
    <!-- <i class="fas fa-square"></i> -->
    <li><a href="<?=getProjectRoot()?>home"><img src="<?= getProjectPath() ?>img/logo.png" width="200px" height="65px" alt="THE DTS BANK LOGO" /></a></li>
    <!-- <i class="fas fa-square"></i> -->
  </ul>
</div>

<!--Navbar -->
<nav class="mb-1 navbar sticky-top scrolling-navbar navbar-expand-lg navbar-dark" style="  background: linear-gradient(-135deg, #c850c0, #4158d0); transition: all 0.8s ease-in-out;">
  <a class="navbar-brand" href="<?=getProjectRoot()?>home" style="text-transform: uppercase; font-family: 'Dubai'; font-size: 14px;">
    <i class="fas fa-user-tag"> </i>
    <?php echo $_SESSION['profil'] ?>
    <i class="fas fa-burn"> </i>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if ($_GET['page'] == 'accueil') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?=getProjectRoot()?>home">Accueil
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item <?php if ($_GET['page'] == 'gCompte') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?=getProjectRoot()?>comptes" <?php if ($_SESSION['profil'] == 'caissier') {
                                                    echo "hidden";
                                                  }
                                                  ?>>Gestion Compte</a>
      </li>
      <li class="nav-item <?php if ($_GET['page'] == 'gClient') {
                            echo 'active';
                          } ?>">
        <a class="nav-link" href="<?=getProjectRoot()?>clients" <?php if ($_SESSION['profil'] == 'caissier') {
                                                    echo "hidden";
                                                  } ?>>Gestion Client</a>
      </li>
      <li class="nav-item dropdown <?php if ($_GET['page'] == 'gOperation') {
                                      echo 'active';
                                    } ?>">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="location.href = '<?=getProjectRoot()?>operation';">Gestion Opération
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="<?=getProjectRoot()?>operation">Liste des Opérations</a>
          <a class="dropdown-item" href="<?=getProjectRoot()?>newoperation">Nouvelle Opération</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#modalPoll-1">
          <i class="fas fa-phone"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light" data-toggle="modal" data-target="#timeModeright" onclick="date_time('date'); date_time('time');">
          <i class="far fa-clock"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"> <span id="usercallname"> <?php echo $_SESSION['nomComplet'] ?></span></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#">Infos Compte</a>
          <a class="dropdown-item" href="#">Préférences</a>
          <a class="dropdown-item" href="#">Confidentialité</a>
          <div class="dropdown-divider"></div>
          <button type="button" class="btn btn-gradient young-passion-gradient" data-toggle="modal" data-target="#modalConfirmExit">
            <i class="fas fa-power-off" id="deconnex"></i> Déconnexion</button>

        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
<!--Modal: modalConfirmExit-->
<div class="modal fade" id="modalConfirmExit" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Voulez-vous Vraiment Partir?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-door-open fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="<?= getProjectPath() ?>controller/userController.php?logout=1" class="btn  btn-outline-danger">Oui😢</a>
        <a type="button" class="btn  btn-danger waves-effect animated pulse infinite" data-dismiss="modal">Non, Je Reste!</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmExit-->

<!-- Modal: modalPoll -->
<div class="modal fade right" id="modalPoll-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Nous Contacter | Orbit Modals Test
        </p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i>
          <p>
            <strong>Votre avis compte</strong>
          </p>
          <p>Avez-vous des idées pour améliorer nos services?
            <strong>Donnez-nous vos commentaires.</strong>
          </p>
        </div>

        <hr>

        <!-- Radio -->
        <p class="text-center">
          <strong>Notez Nous!</strong>
        </p>
        <div class="form-check mb-4">
          <input class="form-check-input" name="group1" type="radio" id="radio-179" value="option1" checked>
          <label class="form-check-label" for="radio-179">Excellent</label>
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" name="group1" type="radio" id="radio-279" value="option2">
          <label class="form-check-label" for="radio-279">Bien</label>
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" name="group1" type="radio" id="radio-379" value="option3">
          <label class="form-check-label" for="radio-379">Médiocre</label>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" name="group1" type="radio" id="radio-479" value="option4">
          <label class="form-check-label" for="radio-479">Mauvais</label>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" name="group1" type="radio" id="radio-579" value="option5">
          <label class="form-check-label" for="radio-579">Très mauvais</label>
        </div>
        <!-- Radio -->

        <p class="text-center">
          <strong>Que pourrions-nous améliorer?</strong>
        </p>
        <!--Basic textarea-->
        <div class="md-form">
          <textarea type="text" id="form79textarea" class="md-textarea form-control" rows="3"></textarea>
          <label for="form79textarea">Votre message</label>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary waves-effect waves-light">Envoyer
          <i class="fa fa-paper-plane ml-1"></i>
        </a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Annuler</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal: modalPoll -->

<!-- Side Time & Date Modal Top Right -->

<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade right" id="timeModeright" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side modal-top-right" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Heure & Date</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Card -->
        <div class="card card-cascade wider">

          <!-- Card image -->
          <div class="view view-cascade gradient-card-header peach-gradient">

            <!-- Title -->
            <h2 class="card-header-title mb-3" id="time"></h2>
            <!-- Text -->
            <i class="fas fa-calendar mr-2"></i>
            <p class="mb-0" id="date"></p>

          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Text -->
            <p class="card-text">SALUT <?= $_SESSION['nomComplet'];?> </br> THE DTS BANQUE VOUS SOUHAITE UNE AGREABLE JOURNEE!</p>
            <!-- Link -->
            <a href="http://orbitturner.yj.fr/" target="_blank" class="orange-text d-flex flex-row-reverse p-2">
              <h5 class="waves-effect waves-light">En Savoir Plus<i class="fas fa-angle-double-right ml-2"></i></h5>
            </a>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Side Time & Date Modal Top Right -->
<!-- <script type="text/javascript">window.onload = date_time('date_time');</script> -->