<?php
//call the FPDF library
// include 'functions.php';

// use setasign\Fpdi\Fpdi;
require('../../utils/fpdf182/fpdf.php');

// require('makefont/makefont.php');

// MakeFont('../../../utils/Raleway/Raleway-VariableFont_wght.ttf','cp1252');

// //A4 width : 219mm
// //default margin : 10mm each side
// //writable horizontal : 219-(10*2)=189mm


class PDF extends FPDF
{
  function Header() {
    // Add font
    $this->AddFont('Raleway-Bold','','Raleway-Bold.php');
    // Select Raleway-Bold bold 15
    $this->SetFont('Raleway-Bold','',8);
    // Select a fixed color
    // $this->SetTextColor(0, 0, 0);
    $this->SetTextColor(111, 43, 74);
    // Move to the right
    $this->Cell(140);
    // Framed title
    $this->Cell(0,10,"ALSTOM COSTING TICKET",0,0,'C');
    // Line break
    $this->Ln(3);
  }

  function Footer() {
    // Add font
    $this->AddFont('Raleway-Bold','','Raleway-Bold.php');
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Raleway-Bold italic 8
    $this->SetFont('Raleway-Bold','',8);
    // Select a fixed color
    // $this->SetTextColor(0, 0, 0);
    $this->SetTextColor(111, 43, 74);
    // Print centered page number
    $this->Cell(0,10,'AT/ACC - Page '.$this->PageNo(),0,0,'C');
   }
}

// //create pdf object
// $pdf=new FPDF('P', 'mm', 'A4');
$pdf=new PDF();
$titre="SUMMARY OF YOUR TICKET";
$pdf->SetTitle($titre, true);
$pdf->SetAuthor('rct', true);
$pdf->SetCreator('ALSTOM S.A.R.L.', true);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('Raleway-Bold','','Raleway-Bold.php');
$pdf->SetTextColor(111, 43, 74);
// Set the image
$pdf->Image('../../assets/logos/Alstom_logo_PNG3.png',0,0,50);
/* _______________________________________________________________
   Titre & Sous-titre
  -----------------------------------------------------------------
*/
//Titre
$titre = "THERE'S YOUR RECIEPE";
$pdf->SetFont('Raleway-Bold','',18);
$pdf->Ln(15);
$pdf->Cell(49);
$pdf->MultiCell(0,5,$titre);
$pdf->Ln(2);

//Sous_titre
$sous_titre = "(SubTitle)";
$pdf->SetFont('Raleway-Bold','',14);
$pdf->Cell(75.5);
$pdf->MultiCell(0,5,$sous_titre);
$pdf->Ln(5);

// ------------------------------------------------------------------
// __________________________________________________________________


/* _______________________________________________________________
   L'identifiant
  -----------------------------------------------------------------
*/
//Identifiant
$Identifiant = "ID : #ACC********";
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$Identifiant);
$pdf->Ln(5);

// ------------------------------------------------------------------
// __________________________________________________________________


/* _______________________________________________________________
   Première catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_1 = 
"
      ------------------------------------------------------------------
        COMPUTE
      __________________________________________________________________
";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_1);
$pdf->Ln(3);

//Champ

$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0);
$pdf->MultiCell(0,5,$texte_1);
// $pdf->Ln(5);

$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0);
$pdf->MultiCell(0,5,$desc);
// $pdf->Ln(5);

// $pdf->SetFont('Raleway-Bold','',8);
// $pdf->SetTextColor(0);
// $pdf->MultiCell(0,1,$annotation);
// $pdf->Ln(5);

$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0);
$pdf->MultiCell(0,5,$texte_2);
$pdf->Ln(5);

// ------------------------------------------------------------------
// __________________________________________________________________


/* _______________________________________________________________
   Deuxième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_2 =
"
      ------------------------------------------------------------------
        NON COMPUTE
      __________________________________________________________________
";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_2);
$pdf->Ln(10);

//Tableau


/*
Les Champs

Dimensions papier A4	
297 x 210 mm	
29.7 x 21 cm
*/

$pdf->Ln(20);


/* _______________________________________________________________
   Huitième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_8 = 
"
      ------------------------------------------------------------------
        THE RECIEPE'S UNDER CONSTRUCTION
        (Will be available soon, about 5 days)
      __________________________________________________________________
";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_8);
$pdf->Ln(3);

//Champ
$texte_3 = "

MAIL :  



STATUS :                               MANAGER : 



SIGNATURE :



MANAGER SIGNATURE :
                
";

$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$texte_3);
$pdf->Ln(9);

$signature = "Cachet, Date, Signature
";

$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(120);
$pdf->MultiCell(0,10,$signature);
$pdf->Ln(5);

// ------------------------------------------------------------------
// __________________________________________________________________


// $pdf->Output();
$pdf->Output('I', 'generated.pdf');
// $pdf->Output('./Socle_Export/Socle_'..'_'.$_GET['prenom'].'.pdf');


?>