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
    $this->Cell(0,10,"Récapitulatif de la Commande",0,0,'C');
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
    $this->Cell(0,10,'P9/TSC - Page '.$this->PageNo(),0,0,'C');
   }
}

// //create pdf object
// $pdf=new FPDF('P', 'mm', 'A4');
$pdf=new PDF();
$titre="Récapitulatif de la Commande";
$pdf->SetTitle($titre, true);
$pdf->SetAuthor('rct', true);
$pdf->SetCreator('Pragma9', true);
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
$titre = "Récapitulatif de la Commande";
$pdf->SetFont('Raleway-Bold','',18);
$pdf->Ln(15);
$pdf->Cell(40);
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
$Identifiant = "ID Commande : #id_de_commande";
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
$categorie_1 = "1. COMPUTE";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_1);
$pdf->Ln(3);

//Champ
$texte_1 = "
Raison sociale du client :  {}
Intitulé de la mission :  {}
Période de réalisation : de {} à {}                                  Durée en jours : 
Noms des consultants : {}, {}


Montant global HT du contrat : {} €
";
$texte_2 = "


Est-ce votre première mission avec ce Cabinet conseil ?  {}                                  
Combien d'autres missions avez-vous confié à ce Cabinet conseil : 

";

$desc = "Descriptif de la mission : {}"; 

$annotation = "compléter éventuellement le descriptif sur papier libre";


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
$categorie_2 = "2. MANAGED DISKS";
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
//set font to Raleway-Bold, bold, 10pt
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(111, 43, 74);

$pdf->Cell(65, 8, "", 'TRBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "Insuffisant", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Assez bon", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Bon", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "Excellent", 'TRB', 1, 'C', 0);
$pdf->SetFont('Raleway-Bold','',9);
$pdf->Cell(65, 8, "Respect des délais convenus dans l’EB", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(65, 8, "Mobilisation des expertises convenues", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);


$axes_progres = "
Commentaires, axes de progrès : 
";
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$axes_progres);
$pdf->Ln(20);






















/* _______________________________________________________________
   Troisième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_3 = "3. Qualité de l'offre (des livrables)";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_3);
$pdf->Ln(5);

//Tableau


/*
Les Champs

Dimensions papier A4	
297 x 210 mm	
29.7 x 21 cm
*/
//set font to Raleway-Bold, bold, 10pt
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(111, 43, 74);

$pdf->Cell(65, 8, "", 'TRBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "Insuffisant", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Assez bon", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Bon", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "Excellent", 'TRB', 1, 'C', 0);
$pdf->SetFont('Raleway-Bold','',9);
$pdf->Cell(65, 8, "Pertinence de la réponse à vos besoins", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(65, 8, "Fond (pertinence et granularité)", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(65, 8, "Forme (efficacité et niveau d’expression)", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);


$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$axes_progres);
$pdf->Ln(20);






/* _______________________________________________________________
   Quatrième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_4 = "4. Attitude orientée client";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_4);
$pdf->Ln(5);

//Tableau


/*
Les Champs

Dimensions papier A4	
297 x 210 mm	
29.7 x 21 cm
*/
//set font to Raleway-Bold, bold, 10pt
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(111, 43, 74);

$pdf->Cell(69, 8, "", 'TRBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "Insuffisant", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Assez bon", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Bon", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "Excellent", 'TRB', 1, 'C', 0);
$pdf->SetFont('Raleway-Bold','',9);
$pdf->Cell(69, 8, "Prise en compte des contraintes du client", 'RBL', 0, 'C', 0); 
// $pdf->MultiCell(69, 8, "Prise en compte des contraintes du client, de ses habitudes de travail, de sa culture projet", 'RBL', 'C', false); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Adaptation des méthodes au contexte", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 1, 'C', 0);
$pdf->Cell(69, 8, "Capacité d’écoute", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Aptitude pédagogique", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);


$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$axes_progres);
$pdf->Ln(20);



/* _______________________________________________________________
   Cinquième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_5 = "5. Relations avec le Cabinet conseil et les consultants";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_5);
$pdf->Ln(5);

//Tableau


/*
Les Champs

Dimensions papier A4	
297 x 210 mm	
29.7 x 21 cm
*/
//set font to Raleway-Bold, bold, 10pt
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(111, 43, 74);

$pdf->Cell(69, 8, "", 'TRBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "Insuffisant", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Assez bon", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Bon", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "Excellent", 'TRB', 1, 'C', 0);
$pdf->SetFont('Raleway-Bold','',9);
$pdf->Cell(69, 8, "Qualité des échanges (tél., entretiens …)", 'RBL', 0, 'C', 0); 
// $pdf->MultiCell(69, 8, "Prise en compte des contraintes du client, de ses habitudes de travail, de sa culture projet", 'RBL', 'C', false); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Qualité des documents reçus", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 1, 'C', 0);
$pdf->Cell(69, 8, "Devoir de conseil :", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Apport de valeur (composante technique)", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Apport de valeur (composante Marché public)", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Alerte", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);


$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$axes_progres);
$pdf->Ln(20);


/* _______________________________________________________________
   Sixième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_6 = "6. Déroulement de la mission";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_6);
$pdf->Ln(5);

//Tableau


/*
Les Champs

Dimensions papier A4	
297 x 210 mm	
29.7 x 21 cm
*/
//set font to Raleway-Bold, bold, 10pt
$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(111, 43, 74);

$pdf->Cell(69, 8, "", 'TRBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "Insuffisant", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Assez bon", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "Bon", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "Excellent", 'TRB', 1, 'C', 0);
$pdf->SetFont('Raleway-Bold','',9);
$pdf->Cell(69, 8, "Animation et rythme de l'action", 'RBL', 0, 'C', 0); 
// $pdf->MultiCell(69, 8, "Prise en compte des contraintes du client, de ses habitudes de travail, de sa culture projet", 'RBL', 'C', false); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Apport intellectuel", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'TRB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'TRB', 1, 'C', 0);
$pdf->Cell(69, 8, "Supports et moyens utilisés", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Mode d'évaluation", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Adéquation avec les objectifs de la mission", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Réactivité", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);
$pdf->Cell(69, 8, "Prise en compte des changements", 'RBL', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0);
$pdf->Cell(30, 8, "", 'RB', 0, 'C', 0); 
$pdf->Cell(30, 8, "", 'RB', 1, 'C', 0);


$pdf->SetFont('Raleway-Bold','',10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0,5,$axes_progres);
$pdf->Ln(20);


/* _______________________________________________________________
   Septième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_7 = "7. Commentaires généraux du client";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_7);
$pdf->Ln(50);



/* _______________________________________________________________
   Hutième catégorie
  -----------------------------------------------------------------
*/
//Catégorie
$categorie_8 = "8. Référence de la mission";
$pdf->SetFont('Raleway-Bold','',12);
$pdf->SetTextColor(111, 43, 74);
$pdf->MultiCell(0,5,$categorie_8);
$pdf->Ln(3);

//Champ
$texte_3 = "

Adresse : 



N° Siret :                               Registre du commerce : 



Nom, Fonction, tel. et courriel du signataire :
                
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