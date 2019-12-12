<?php
    require_once '../Model/modelCompte.php';

        $numCompte = accountNumGen();
?>
<!-- =======================|NOUVEAU COMPTE|======================= -->
<form class="border border-light p-5 animated bounceInUp slow" action="<?= getProjectPath() ?>controller/compteController.php" method="post" id="formNouveaucpt">

    <p class="h4 mb-4 text-center">Créer Un Compte</p>
	<div class="container">
		<div class="row">
			<div class="col">
				<!-- name=numero -->
				<label for="numeroClient">Numero du Futur Compte</label>
				<input type="text" id="numeroClient" class="form-control mb-4" value="<?= $numCompte; ?>" disabled>
			</div>
			<div class="col">	
				<label for="defaultLoginFormSolde">Solde</label>
				<input type="number" name="solde" id="defaultLoginFormSolde" class="form-control mb-4" min="2000" max="100000000" 
				placeholder="Entrer un solde compris entre 2000 et 100 000 000" required>
			</div>
		</div>
	</div>
			<hr>
			<h4 class="h4" align="center">INFOS CLIENTS</h4>
			<hr>
	<div class="container">
		<div class="row">
			<div class="col">
				<label for="cni">CNI:</label>
				<input type="text" name="cni" id="cni" class="form-control mb-4" placeholder="Entrer le Numéro de la Carte Nationale d'Identité du Yencli" required>
			</div>
			<div class="col">	
				<label for="defaultLoginFormNom">NOM:</label>
				<input type="text" name="nom" id="defaultLoginFormNom" class="form-control mb-4" placeholder="Entrer le Nom de Famille duu Yencli" required>
			</div>		
		</div>
		<div class="row">
			<div class="col">				
				<label for="defaultLoginFormPrenom">PRENOM:</label>
				<input type="text" name="prenom" id="defaultLoginFormPrenom" class="form-control mb-4" placeholder="Entrer Son Prenom" required>
			</div>
			<div class="col">		
				<label for="defaultLoginFormAdresse">ADRESSE:</label>
				<input type="text" name="adresse" id="defaultLoginFormAdresse" class="form-control mb-4" placeholder="Client bi Foumou deuk?" required>
			</div>
			<div class="col">	
				<label for="defaultLoginFormTel">TELEPHONE:</label>
				<input type="tel" name="tel" id="defaultLoginFormTel" class="form-control mb-4" placeholder="Entrer le Numero de Telephone du client" required>
			</div>
		</div>
	</div>
    <div class="d-flex justify-content-center">
        <div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="clientPremium" id="defaultLoginFormPremium">
                <label class="custom-control-label" for="defaultLoginFormPremium">Est-ce un Client Premium?</label>
            </div>
        </div>
    </div>

    <button class="btn btn-info btn-block my-4" type="submit" name="ajoutCompte">VALIDER</button>

    <div class="text-center">
        <p>Vous vous êtes trompé?
			<a href="javascript:document.getElementById('formNouveaucpt').reset();">Tout effacer?</a>
		</p>
	</div>
	<div class="progress md-progress warning-color-dark">
		<div class="indeterminate"></div>
	</div>
</form>
