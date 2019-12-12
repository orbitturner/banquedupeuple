//
// +======================={PROJECT - PRESENTATION}======================+
// |                                                                     |
// |Project Name    : THE DTS BANK                                       |
// |Categorie       : Dynamic Website                                    |
// |FrameWorks      : MDBootstrap                                        |
// |Author          : OrbitTurner                                        |
// |Official Name   : Mohamed GUEYE                                      |
// |Version         : v.1.2                                              |
// |Created         : 03-Mars-2019                                       |
// |Last update     : 25-Juin-2019                                       |
// |Partie          : CUSTOM JS                                          |
// |LANGAGE UTILISE : ANGLAIS - FRANCAIS                                 |
// +=====================================================================+
//
//=====| BLOCK CONTEXT MENU |=====
// if (document.addEventListener) { // IE >= 9; other browsers
// 	document.addEventListener('contextmenu', function(e) {
// 		alert("You've tried to open context menu"); //here you draw your own menu
// 		e.preventDefault();
// 	}, false);
// } else { // IE < 9
// 	document.attachEvent('oncontextmenu', function() {
// 		alert("You've tried to open context menu");
// 		window.event.returnValue = false;
// 	});
// }
// DEFINING PROJECT PATH
var ProjectPath = "/banquedupeuple/src/";

new WOW().init();
$(document).ready(function() {
	toastr.options = {
		showDuration: '500',
		progressBar: true
	};
	if ($("#compteImport").attr('forceselect') != "") {
		var numeroCptImport = $("#compteImport").attr('forceselect');
		$(".forceSelect").val(numeroCptImport).change(); 
		
		$('#numeroCompte').trigger('change');
		$('#numeroCompteDebit').trigger('change');
	}

	$('.custom-select-sm').val(25).change();
	setTimeout(function() {
		$('.custom-select-sm').val(10).change();
	}, 1000);
	// **************************************************************
	// ==================|GESTION DEPOT-RETRAIT|==================
	// **************************************************************
	// =============[GESTION DES BOUTON SUBMIT]=============
	// DEP-RET
	$('#v-pills-depotRetrait-tab').click(function() {
		$('#choixOp').trigger('change');
	});
	// $('#depRetContrat').change(function(){
	//     if ($(this). prop("checked") == true) {
	//         if ($('#materialRegisterFormMontant').val()!="") {
	//             $('#btnDepRetForm').show();
	//         }
	//     }else{
	//         $('#btnDepRetForm').hide();
	//     }
	// });
	// VIREMENT
	$('#v-pills-virement-tab').click(function() {
	    var typeOper = 'VIREMENT';
		$.ajax({
			url: ProjectPath+'assets/ajax/getNumOPer.php',
			type: 'GET',
			data: { typeOp: typeOper },
			success: function(data) {
				// if (data != "") {
					window['numOper'] = data;
				// }
			}
		});
	});
	// $('#VirementContrat').change(function(){
	//     if ($(this). prop("checked") == true) {
	//         if ($('#montantVir').val()!="" && $("#numeroCompteCredit").val()!="Choisissez un Compte") {
	//             $('#btnNewVirement').show();
	//         }
	//     }else{
	//         $('#btnNewVirement').hide();
	//     }
	// });
    // RESET
    $('#btnDepRetForm').hide();
    
	$('#choixOp').change(function() {
		$('#materialRegisterFormMontant').val('');
			var typeOper = $('#choixOp option:selected').val();
		$.ajax({
			url: ProjectPath+'assets/ajax/getNumOPer.php',
			type: 'GET',
			data: { typeOp: typeOper },
			success: function(data) {
				// if (data != "") {
					window['numOper'] = data;
				// }
			}
		});
	});
	

	// =============[GESTION ID DU COMPTE]=============
	$('#numeroCompte').change(function() {
		// var numCpte = $(this).val();
		// $(this).attr("value", numCpte);
		var idCpte = $('#numeroCompte option:selected').attr('alt');
		window['soldeCompteSelect'] = Number($('#numeroCompte option:selected').attr('solde'));
		$('#idCompte').val(idCpte);
	});
	// console.log($('#choixOp option:selected').val());

	// =============[GESTION MONTANT DEP/RET]=============
	$('#materialRegisterFormMontant').blur(function() {
		if($('#idCompte').val() == ""){
			$('#btnDepRetForm').hide();
			toastr.error('REMPLISSEZ TOUS LES CHAMPS!', 'ERREUR', {
				timeOut: 5000
			});
		}
		if ($('#choixOp option:selected').val() == 'RETRAIT') {
            if (Number($(this).val()) <= 499 || Number($('#materialRegisterFormMontant').val()) >= soldeCompteSelect) {
                $('#btnDepRetForm').hide();
            }
        }else{
            if (Number($(this).val()) <= 500) {
                $('#btnDepRetForm').hide();
                toastr.error('MONTANT INFERIEUR A 500FCFA ', 'ERREUR', { timeOut: 5000 });
            }else{
			    var montantSaisi = Number($('#materialRegisterFormMontant').val());

                toastr.warning('Vous allez Déposer: ' + montantSaisi, 'ATTENTION', { timeOut: 5000 });
            }
		}

	});

	$('#materialRegisterFormMontant').change(function() {
		if ($('#choixOp option:selected').val() == 'RETRAIT') {
			var montantSaisi = Number($('#materialRegisterFormMontant').val());
			// alert(soldeCompteSelect);

			if (soldeCompteSelect <= montantSaisi) {
				$('#btnDepRetForm').hide();
				// alert('LE MONTANT SAISI EST INFERIEUR AU SOLDE SUR LE COMPTE');
				toastr['error']('LE MONTANT SAISI EST SUPERIEUR AU SOLDE SUR LE COMPTE!');
				setTimeout(function() {
					toastr['info']('Entrez un montant Inférieur au Solde: ' + soldeCompteSelect);
				}, 2000);
				setTimeout(function() {
					toastr['error']("LE BOUTON D'ENVOI DU FORMULAIRE EST BLOQUE!");
				}, 3000);
			} else {
				$('#btnDepRetForm').show();
				toastr.warning('Vous allez Retirer: ' + montantSaisi, 'ATTENTION', { timeOut: 5000 });
			}
		} else {
            $('#btnDepRetForm').show();
		}
	});
	// -------------TIRER UN RECU DEP-RET-------------
	$('#btnDepRetForm').click(function() {
		var typeOper = $('#choixOp option:selected').val();
		var numeroCompte = $('#numeroCompte option:selected').val();
		var idCli = $('#numeroCompte option:selected').attr('idCli');

		var montantOper = Number($('#materialRegisterFormMontant').val());
		var idUser = $('#userData').attr('idUser');
		setTimeout(function() {
			OpenInNewTab(ProjectPath+"assets/invoice.php?mt="+montantOper+"&typeOp="+typeOper+"&numC="+numeroCompte+"&numOp="+window['numOper']+"&idUsr="+idUser+"&idCpt="+idCli);
		}, 2000);
	});

	// =============[END OF GESTION MONTANT]=============
	// ***************************************|END OF GESTION DEPOT - RETRAIT|***************************************

	// **************************************************************
	// ==================|GESTION VIREMENT|==================
	// **************************************************************
    $('#btnNewVirement').hide();

	// =============[GESTION DES ID]=============
	$('#numeroCompteDebit').change(function() {
		var idCpteDebit = $('#numeroCompteDebit option:selected').attr('alt');
		window['soldeCompteDebit'] = Number($('#numeroCompteDebit option:selected').attr('solde'));
		$('#idCompteDebit').val(idCpteDebit);
		$('#idCompteCredit').trigger('change');
		if($('#idCompteCredit').val() == ""){
			$('#btnNewVirement').hide();
		}
	});
	$('#numeroCompteCredit').change(function() {
		var idCompteCredit = $('#numeroCompteCredit option:selected').attr('alt');
		window['soldeCompteCredit'] = Number($('#numeroCompteCredit option:selected').attr('solde'));
		$('#idCompteCredit').val(idCompteCredit);
		$('#idCompteCredit').trigger('change');
		if($('#idCompteDebit').val() == ""){
			$('#btnNewVirement').hide();
		}
	});

	// =============[GESTION DES NUMEROS DE COMPTE]=============
	$('#idCompteCredit').change(function() {
		if ($(this).val() == $('#idCompteDebit').val()) {
			$('#btnNewVirement').hide();
			toastr.error('Vous ne pouvez pas Virer sur un même Compte !', 'ERREUR', { timeOut: 5000 });

			setTimeout(function() {
				toastr.info('Choisissez Deux Comptes Différents !', 'AIDE', { timeOut: 5000 });
			}, 2000);
			setTimeout(function() {
				toastr['warning']('LE BOUTON SUBMIT EST BLOQUE!');
			}, 3000);
		}
	});

	// =============[GESTION MONTANT VIREMENT]=============
	$('#montantVir').change(function() {
		var montantSaisi = Number($('#montantVir').val());
		// alert(soldeCompteSelect);

		if (soldeCompteDebit <= montantSaisi) {
			$('#btnNewVirement').hide();
			// alert('LE MONTANT SAISI EST INFERIEUR AU SOLDE SUR LE COMPTE');
			toastr.error('Le Montant dans le Compte Débiteur est inférieur au Montant Saisi !', 'ERREUR', {
				timeOut: 6000
			});
			setTimeout(function() {
				toastr['info']('Entrez un montant Inférieur au Solde: ' + soldeCompteDebit);
			}, 2000);
			setTimeout(function() {
				toastr['error']("LE BOUTON D'ENVOI DU FORMULAIRE EST BLOQUE!");
			}, 3000);
		} else if (montantSaisi <= 500) {
			toastr['error']('LE MONTANT NE PEUT ETRE INFERIEUR A 500!');
			$('#btnNewVirement').hide();
		} else {
			$('#btnNewVirement').show();
			toastr.warning('Vous allez Maintenant Virer: ' + montantSaisi, 'ATTENTION', { timeOut: 5000 });
		}
	});
	$('#montantVir').blur(function() {
		if (Number($(this).val()) <= 500) {
            $('#btnDepRetForm').hide();
			toastr['error']('LE MONTANT NE PEUT ETRE INFERIEUR A 500!');
        }else if (Number($('#montantVir').val()) >= soldeCompteDebit) {
			toastr.error('Le Montant dans le Compte Débiteur est inférieur au Montant Saisi !', 'ERREUR', {
				timeOut: 5000
			});
		}else if($('#idCompteDebit').val() == ""){
			$('#btnNewVirement').hide();
			toastr.error('REMPLISSEZ TOUS LES CHAMPS!', 'ERREUR', {
				timeOut: 5000
			});
		}else if($('#idCompteCredit').val() == ""){
			$('#btnNewVirement').hide();
			toastr.error('REMPLISSEZ TOUS LES CHAMPS!', 'ERREUR', {
				timeOut: 5000
			});
		}
	});
	// -------------TIRER UN RECU VIREMENT-------------
	$('#btnNewVirement').click(function() {
		
			var typeOper = 'VIREMENT';
			var numeroCompteDeb = $('#numeroCompteDebit option:selected').val();
			var numeroCompteRet = $('#numeroCompteCredit option:selected').val();
			var idCli = $('#numeroCompteDebit option:selected').attr('idCli');

			var montantOper = Number($('#montantVir').val());
			var idUser = $('#userData').attr('idUser');
			setTimeout(function() {
				OpenInNewTab(ProjectPath+"assets/invoice.php?mt="+montantOper+"&typeOp="+typeOper+"&numCd="+numeroCompteDeb+"&numCc="+numeroCompteRet+"&numOp="+window['numOper']+"&idUsr="+idUser+"&idCpt="+idCli);
			}, 2000);
		
	});
	// =============[END OF GESTION MONTANT]=============
	// ***************************************|END OF GESTION VIREMENT|***************************************

	// **************************************************************
	// ==================|GESTION MODAL CLIENTS |==================
	// **************************************************************
	$('.clientBtn').click(function() {
		$('#defaultCheck17').prop('checked', false);
		$('#validateNewAcc').hide();

		var nomClientModal = $(this).attr('nomClient');
		var cniClientModal = $(this).attr('cni');
		var idClientModal = $(this).attr('idCpte');
		var nCpteClientModal = $(this).attr('nCpte');
		var soldeClientModal = $(this).attr('slde');
		var datCreat_Adress = $(this).attr('dCreat_Adrss');
		$('.card-title').text(nomClientModal);
		$('.card-text').text('Depuis le: ' + datCreat_Adress);
		$('.sold').text(soldeClientModal + ' Fcfa');

		$('.cniC').text('CNI: ' + cniClientModal);

		$('#panel1001').load(ProjectPath+'Model/clientInfo.php?id=' + idClientModal);
		$('#panel1002').load(ProjectPath+'Model/clientInfo.php?idC=' + idClientModal);

		$('#idCliNew').val(idClientModal);

		$('#validateNewAcc').click(function() {
			if ($('#SoldCliNew').val() == '' || Number($('#SoldCliNew').val()) < 5000) {
				toastr.danger('LE MONTANT DOIT ETRE SUPERIEUR A 5000', 'ERREUR !', { timeOut: 5000 });
			}
		});

		
		// $('#newAccountwithClient').attr("href", ProjectPath+'view/mainindex.php?page=newAccount&idCli='+idClientModal);
		// console.log(nomClientModal);
		// $.ajax({
		//     url: ProjectPath+"view/gestClient",
		//     method: "POST",
		//     data: { "nCpteClientModal": nCpteClientModal }
		//   })
	});
	$('#defaultCheck17').change(function() {
		$('#validateNewAcc').toggle();
	});

	// ***************************************|END OF GESTION MODAL CLIENT|***************************************

	// **************************************************************
	// ==================|GESTION PAGE COMPTE |==================
	// **************************************************************
	// -------------------|BLOCKER UN COMPTE|-------------------
	$('.btnCompte').click(function() {
		var idCompteAbloquer = $(this).attr('idCompt');
		var numCompteAbloquer = $(this).attr('numCpteB');
		if (idCompteAbloquer) {
			$('#modalConfirmBlock').modal();
			$('#compteBlocker').click(function() {
				$.ajax({
					url: ProjectPath+'assets/ajax/blockAccount.php',
					type: 'GET',
					data: { idBlock: idCompteAbloquer },
					success: function(data) {
						if (data == 1) {
							$('#modalConfirmBlock').modal('hide');
							setTimeout(function() {
								window.location.reload();
							}, 3000);

							toastr.warning('LE COMPTE: ' + numCompteAbloquer + ' A ETAIT BLOQUE', 'INFO !', {
								timeOut: 5000
							});
						}
					}
				});
			});
		}
	});
	// -------------------|DEBLOCKER UN COMPTE|-------------------
	$('.btnCompteD').click(function() {
		var idCompteAdebloquer = $(this).attr('idComptD');
		var numCompteAdebloquer = $(this).attr('numCpteD');
		if (idCompteAdebloquer) {
			$('#modalPushDeblock').modal();
			$('#compteDeblocker').click(function() {
				$.ajax({
					url: ProjectPath+'assets/ajax/blockAccount.php',
					type: 'GET',
					data: { idUnBlock: idCompteAdebloquer },
					success: function(data) {
						if (data == 1) {
							$('#modalPushDeblock').modal('hide');
							setTimeout(function() {
								window.location.reload();
							}, 3000);

							toastr.success('LE COMPTE: ' + numCompteAdebloquer + ' A ETAIT DEBLOQUE', 'INFO !', {
								timeOut: 5000
							});
						}
					}
				});
			});
		}
    });
	// -------------------|MODAL NEW OPERATION SUR UN COMPTE|-------------------
    $('.newOperBtn').click(function() {
		var numCompt = $(this).attr('numCpteB'); 
		var soldeCompt = $(this).attr('soldeCpteB'); 

		$('.compteInfo').text(numCompt);
		$('.compteInfoSolde').text(soldeCompt + ' FCFA');
		$('#newOperCptBtn').attr('href','?page=newOperation&numCompteSelect='+numCompt);

	});

	// **************************************************************
	// ==================|GESTION PAGE OPERATION |==================
	// **************************************************************
	// -------------------|SUPPRIMER UN COMPTE|-------------------
	$('.btnDelCompte').click(function() {
		var idOperADelete = $(this).attr('idOperDel');
		var idCpteAUpdate = $(this).attr('idCpteUpd');
		var numOperADelete = $(this).attr('numOperDel');
		var typeOperADelete = $(this).attr('typeOperDel');
		var mtOperADelete = $(this).attr('mtCpteUpd');
		if (idOperADelete) {
			$('#modalConfirmDelete').modal();
			$('#compteDeleter').click(function() {
				$.ajax({
					url: ProjectPath+'assets/ajax/blockAccount.php',
					type: 'GET',
					data: { idDelete: idOperADelete, idCptUpdate: idCpteAUpdate, typeOp: typeOperADelete, mtOp: mtOperADelete},
					success: function(data) {
						if (data == 1) {
							$('#modalConfirmDelete').modal('hide');
							$(".btnDelCompte[idOperDel='"+idOperADelete+"']").closest('tr').fadeOut(3000);
							
							setTimeout(function() {
								window.location.reload();
							}, 5000);
							toastr.warning('LE COMPTE: ' + numOperADelete + ' A ETAIT BLOQUE', 'INFO !', {
								timeOut: 5000
							});
						}
					}
				});
			});
		}
	});
	
});
// **************************************************************
// ==================|GESTION DATE ET HEURE |==================
// **************************************************************
function date_time(id) {
    date = new Date();
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array(
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Decembre'
    );
    d = date.getDate();
    day = date.getDay();
    days = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    h = date.getHours();
    if (h < 10) {
        h = '0' + h;
    }
    m = date.getMinutes();
    if (m < 10) {
        m = '0' + m;
    }
    s = date.getSeconds();
    if (s < 10) {
        s = '0' + s;
    }
    if (id == "date") {
        result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year;
        document.getElementById(id).innerHTML = result;
    }else{
        result = '' + h + ':' + m + ':' + s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("' + id + '");', '1000');
    }
    return true;
}
// **************************************************************
// ==================|GESTION NEW TAB INVOICE |==================
// **************************************************************
function OpenInNewTab(url) {

    var win = window.open(url, '_blank');
    win.focus();
  }