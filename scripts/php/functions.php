<?php
//Fichier de Fonctions

// On lance la session afin de pouvoir se servir dans le fichier de fonctions
// include 'session.php';


//Fonction de connexion à la base de données
function bdd_access()
{
    $bdd = null;
    $dsn = 'mysql:host=localhost;dbname=alstom_costing_calculator;charset=utf8';
    $user = 'root';
    $password = 'Admin_PMA_33';
    $pdo_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    // $dsn = 'mysql:host=rolandtest3-server.mysql.database.azure.com;dbname=alstom_costing_calculator;charset=utf8';
    // $user = 'jvdwzkzpuz';
    // $password = 'HNYO434SB660244Z$';
    // $pdo_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        //On se connecte à MySQL
        // $bdd = new PDO('mysql:host=rolandtest3-server.mysql.database.azure.com;dbname=alstom_costing_calculator','jvdwzkzpuz@rolandtest3-server.mysql.database.azure.com','HNYO434SB660244Z$');
        $bdd = new PDO($dsn, $user, $password, $pdo_options);
    } catch (Exception $e) {
        //En cas d'erreur, on affiche un message et on arrète tout
        die('Erreur : ' . $e->getMessage());
    }

    // echo "Bdd loaded!!!";

    return $bdd;
}

function devisesImport()
{
    $XML = simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");

    // echo $XML->Cube->Cube->Cube[0]["rate"];
    $currency = $XML->Cube->Cube->Cube[0]["rate"];
    //     foreach ($XML->Cube->Cube->Cube as $rate) {
    //         echo '1€=' . $rate["rate"] . ' ' . $rate["currency"] . '
    // ';
    //     }
    return $currency;
}


//Fonction qui génère un ID spécial pour se reconnecter
function specialIdGenerator($param, $preLong, $sufLong)
{
    $pre = genere_prefixe_aleatoire($preLong);
    $suf = genere_suffixe_aleatoire($sufLong);

    return $pre . $param . $suf;
}


//Fonction de rafraîchissemment
function refresher($url, $delay)
{
    // header("Location: $url ");
    header("refresh:$delay;url=$url");
}


// //La fonction de stockage du fichier dans un dossier spécifique
// function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
// {
//     //Test1 : Fichier correctement uploadé
//     if(!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;

//     //Test2 : Taille limite
//     if($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;

//     //Test3 : Extension
//     $ext = substr(strrchr($_FILES[$index]['name'],'.'), 1);
//     if($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;

//     //Déplacement
//     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
// }


function insertion()
{
}



function mdp($prefixe, $suffixe)
{
    $suffix = genere_suffixe_aleatoire(4);
}


//Génération du user
function genere_prefixe_aleatoire($longueur)
{

    $caractere_au_choix = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $prefixe = "";

    for ($i = 0; $i < $longueur; $i++)
        $prefixe .= ($i % 2) ? strtoupper($caractere_au_choix[array_rand($caractere_au_choix)]) : $caractere_au_choix[array_rand($caractere_au_choix)];
    return $prefixe;
}

//Génération du pass
function genere_suffixe_aleatoire($longueur)
{
    $caractere_au_choix = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $suffixe = "";

    for ($i = 0; $i < $longueur; $i++)
        $suffixe .= ($i % 2) ? strtoupper($caractere_au_choix[array_rand($caractere_au_choix)]) : $caractere_au_choix[array_rand($caractere_au_choix)];
    return $suffixe;
}




//Test de session

function time_checker($cpt)
{
    // if(time() - $_SESSION["login_time_stamp"] > $cpt)
    // {
    //     session_destroy();
    //     session_unset(); 

    // On définit les variables de redirection
    // $delay = 0;
    // $url = "../../index.html";

    // Affichage
    // echo '<script>alert("BIENVENUE '.$mailPragma9.' ")</script>';

    // On redirige
    //     refresher($url, $delay);
    // } 

    //subtract new timestamp from the old one
    if (time() - $_SESSION['timestamp'] > 60) {
        echo "<script>alert('1 Minuts over!');</script>";
        session_destroy();
        session_unset();
        // $_SESSION['logged_in'] = false;
        // header("Location: " . index.php); 
        //redirect to index.php
        // On définit les variables de redirection
        $delay = 0;
        $url = "../../index.html";

        // Affichage
        // echo '<script>alert("BIENVENUE '.$mailPragma9.' ")</script>';

        // On redirige
        refresher($url, $delay);
        exit;
    } else {
        $_SESSION['timestamp'] = time(); //set new timestamp
    }
}
