<?php
require('fpdf181/fpdf.php');
require_once("fpdf181/phpqrcode/qrlib.php");
require_once "../Model/db.php";
require_once '../routes/dir.php';


if (isset($_GET['typeOp'])) {

	$sql = "SELECT * FROM client WHERE id='".$_GET['idCpt']."'";
	$sql1 = "SELECT * FROM operation WHERE numOperation='".$_GET['numOp']."'";
	$leClient = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	$theOperation = $db->query($sql1)->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($leClient[0]['cni']);
	// C:\wamp64\www\Banque.sn\assets\invoice.php:9:
	// array (size=1)
	// 0 => 
	// 	array (size=6)
	// 	'id' => string '19' (length=2)
	// 	'cni' => string '1850250065' (length=10)
	// 	'nom' => string 'SECK' (length=4)
	// 	'prenom' => string 'Seydou' (length=6)
	// 	'adresse' => string 'Sipres Man DOu ay Foooo' (length=23)
	// 	'tel' => string '778612398' (length=9)

	$date = Date('d-m-Y');
	$time = date("h:i a"); 
	class PDF extends FPDF {
		function Header(){
			$this->SetFont('Arial','B',15);
			
			//dummy cell to put logo
			//$this->Cell(12,0,'',0,0);
			//is equivalent to:
			$this->Cell(12);
			
			//put logo
			$this->Image('DTS-LOGO-SMALL.png',10,10,10);
			
			$this->Cell(100,10,'LA BANQUE DU PEUPLE',0,0);
			$this->Cell(300	,10,'RECU',0,1);//end of line
			
			//dummy cell to give line spacing
			//$this->Cell(0,5,'',0,1);
			//is equivalent to:
			$this->Ln(5);
			
		}
		function Footer(){
			
			//Go to 1.5 cm from bottom
			$this->SetY(-15);
					
			$this->SetFont('Arial','',8);
			
			//width = 0 means the cell is extended up to the right margin
			$this->Cell(0,10,'Page '.$this->PageNo()." / {0} | Copyright : Orbit Law Tech",0,0,'C');
		}
	}


	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	$pdf = new PDF('P','mm','A4'); //use new class

	//define new alias for total page numbers
	$pdf->AliasNbPages('{pages}');

	$pdf->AddPage();

	//Image( file name , x position , y position , width [optional] , height [optional] )
	$pdf->Image('wm.png',10,10,189);

	//set font to arial, bold, 14pt
	$pdf->SetFont('Arial','',12);

	//Cell(width , height , text , border , end line , [align] )

	//normal row height=5.

	//set font to arial, regular, 12pt
	$pdf->SetFont('Arial','',12);

	$pdf->Cell(130	,5,'[146, Cite Keur Damel]',0,0);
	$pdf->Cell(59	,5,'',0,1);//end of line

	$pdf->Cell(130	,5,'[Dakar, SENEGAL, 00221]',0,0);
	$pdf->Cell(25	,5,'Date:',0,0);
	$pdf->Cell(34	,5,'Le '.$date,0,1);//end of line

	$pdf->Cell(130	,5,'Tel.: [+221778834583]',0,0);
	$pdf->Cell(25	,5,'No OP:',0,0);
	$pdf->Cell(34	,5,'['.$_GET['numOp'].']',0,1);//end of line

	$pdf->Cell(130	,5,'Orbit Law Tech',0,0);
	$pdf->Cell(25	,5,'ID USER: ',0,0);
	$pdf->Cell(34	,5,'['.$_GET['idUsr'].']',0,1);//end of line

	$pdf->Cell(130	,5,'',0,0);
	$pdf->Cell(25	,5,'HEURE: ',0,0);
	$pdf->Cell(34	,5,'['.$time.']',0,1);//end of line
	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,10,'',0,1);//end of line
	//make a dummy empty cell as a vertical spacer
	// $pdf->Cell(189	,10,'',0,1);//end of line

	//billing address
	$pdf->Cell(100	,5,'INFORMATIONS CLIENT',0,1);//end of line

	//add dummy cell at beginning of each line for indentation
	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'[Nom]: '.$leClient[0]['nom'],0,1);

	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'[Prenom]: '.$leClient[0]['prenom'],0,1);

	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'[Adresse]: '.utf8_decode($leClient[0]['adresse']),0,1);

	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'[Tel.]: '.$leClient[0]['tel'],0,1);

	$pdf->Cell(10	,5,'',0,0);
	$pdf->Cell(90	,5,'[CNI CLIENT]: '.$leClient[0]['cni'],0,1);

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,10,'',0,1);//end of line

	//invoice contents
	$pdf->SetFont('Arial','B',12);

	if ($_GET['typeOp'] == 'DEPOT' || $_GET['typeOp'] == 'RETRAIT') {
		$pdf->Cell(115	,5,'Description',1,0);
		$pdf->Cell(40	,5,'Numero Compte',1,0);
		$pdf->Cell(35	,5,'Montant',1,1);//end of line
	}else {
		$pdf->Cell(60	,5,'Description',1,0);
		$pdf->Cell(50	,5,'Numero Compte Debit',1,0);
		$pdf->Cell(50	,5,'Numero Compte Credit',1,0);
		$pdf->Cell(35	,5,'Montant',1,1);//end of line
	}

	

	$pdf->SetFont('Arial','',12);

	//Numbers are right-aligned so we give 'R' after new line parameter
	if ($_GET['typeOp'] == 'DEPOT' || $_GET['typeOp'] == 'RETRAIT') {
		$pdf->Cell(115	,5,$_GET['typeOp'],1,0);
		$pdf->Cell(40	,5,$_GET['numC'],1,0);
		$pdf->Cell(35	,5,$_GET['mt'],1,1,'R');//end of line

						//summary
					$pdf->Cell(115	,5,'',0,0);
					$pdf->Cell(40	,5,'Net HT',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,$_GET['mt'],1,1,'R');//end of line

					$pdf->Cell(115	,5,'',0,0);
					$pdf->Cell(40	,5,'TVA',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,'0',1,1,'R');//end of line

					$pdf->Cell(115	,5,'',0,0);
					$pdf->Cell(40	,5,'Pourc. TVA',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,'0%',1,1,'R');//end of line

					$pdf->Cell(115	,5,'',0,0);
					$pdf->Cell(40	,5,'Montant Total',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,$_GET['mt'],1,1,'R');//end of line
		// ASSIGN CONTENT TO QR
		$qrContent = "http://localhost".getProjectPath()."assets/invoice.php?numC=".$_GET['numC']."&mt=".$_GET['mt']."&typeOp=".$_GET['typeOp']."&numOp=".$_GET['numOp']."&idUsr=".$_GET['idUsr']."&idCpt=".$_GET['idCpt'];
		// http://localhost<?= getProjectPath() assets/invoice.php?mt=12000&typeOp=DEPOT&numC=DTSB-042019-12&numOp=DEP-30062019-25&idUsr=3&idCpt=19

	}else {
		$pdf->Cell(60	,5,$_GET['typeOp'],1,0);
		$pdf->Cell(50	,5,$_GET['numCd'],1,0);
		$pdf->Cell(50	,5,$_GET['numCc'],1,0);
		$pdf->Cell(35	,5,$_GET['mt'],1,1,'R');//end of line
		$pdf->Cell(195	,5,utf8_decode($theOperation[0]['details']),1,1);
					//summary
					$pdf->Cell(120	,5,'',0,0);
					$pdf->Cell(40	,5,'Net HT',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,$_GET['mt'],1,1,'R');//end of line
			
					$pdf->Cell(120	,5,'',0,0);
					$pdf->Cell(40	,5,'TVA',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,'0',1,1,'R');//end of line
			
					$pdf->Cell(120	,5,'',0,0);
					$pdf->Cell(40	,5,'Pourc. TVA',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,'0%',1,1,'R');//end of line
			
					$pdf->Cell(120	,5,'',0,0);
					$pdf->Cell(40	,5,'Montant Total',0,0);
					$pdf->Cell(12	,5,'FCFA',1,0);
					$pdf->Cell(23	,5,$_GET['mt'],1,1,'R');//end of line
		// ASSIGN CONTENT TO QR
		$qrContent = "http://localhost".getProjectPath()."assets/invoice.php?numCd=".$_GET['numCd']."&mt=".$_GET['mt']."&typeOp=".$_GET['typeOp']."&numCc=".$_GET['numCc']."&numOp=".$_GET['numOp']."&idUsr=".$_GET['idUsr']."&idCpt=".$_GET['idCpt'];
	}


	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,10,'',0,1);//end of line
	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,10,'',0,1);//end of line
	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,10,'',0,1);//end of line






	$pdf->Image("http://localhost".getProjectPath()."assets/qr_generator.php?code=".$qrContent, 10, 120, 30, 30, "png");
	$pdf->Output();
}
?>