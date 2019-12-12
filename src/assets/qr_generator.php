<?php
require_once("fpdf181/phpqrcode/qrlib.php");

QRcode::png($_GET['code']);
