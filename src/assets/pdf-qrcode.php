<?php
require('fpdf181/fpdf.php');
require_once("fpdf181/phpqrcode/qrlib.php");

// QRcode::png("coded number here","qrcode.png");

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

$pdf->Image("http://localhost".getProjectPath()."assets/qr_generator.php?code=OrbitTurner", 10, 10, 20, 20, "png");

$pdf->Image("test.png", 40, 10, 20, 20, "png");

$pdf->Output();
