<?php
require_once('./functions/dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('./functions/Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('./functions/debug.php');
require_once('./functions/steven_fonctions.php');


// Définition de la constant concernant le nombre d'équipe idéal au total dans le tournoi
define("NB_EQUIPES_IDEAL", 16);
define("NB_QUART_FINALE", 4);
define("NB_DEMI_FINALE", 2);
define("NB_FINALE", 1);
define("NB_MATCH_3_PLACE", 1);
define("NB_MATCH_5_8_PLACE", 4);


$id_tournoi = $_GET["id_tournoi"];
createGroupe($id_tournoi);

// Fonction répartissant les équipes dans les différents groupes
function createGroupe($fk_id_tournoi)
{
    $redo = false;
    //$_SESSION['Groupes'] = array();
    $_SESSION['Equipes'] = array();

    // Groupe stockant les équipes
    $GroupeUn = array();
    $GroupeDeux = array();
    $GroupeTrois = array();
    $GroupeQuatre = array();

    foreach (getInscriptions($fk_id_tournoi, "Validé") as $equipes) {
        // Récupération des équipes individuellement
        $equipe = selectEquipeWithID($equipes['FK_ID_Equipe']);
        // Stockage des équipes dans une liste de session
        array_push($_SESSION['Equipes'], $equipe);
    }

    if (count($_SESSION['Equipes']) >= NB_EQUIPES_IDEAL) {

        shuffle($_SESSION['Equipes']);

        // https://stackoverflow.com/questions/23362451/php-generate-unique-teams-using-number-combination
        $division = array_chunk($_SESSION['Equipes'], NB_EQUIPES_IDEAL);

        foreach ($division[0] as $equipe) {
            array_push($GroupeUn, $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 1);
        }

        foreach ($division[1] as $equipe) {
            array_push($GroupeDeux, $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 2);
        }

        foreach ($division[2] as $equipe) {
            array_push($GroupeTrois, $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 3);
        }

        foreach ($division[3] as $equipe) {
            array_push($GroupeQuatre, $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 4);
        }

    }
}

function createQuartFinale($GroupeUn, $GroupeDeux, $GroupeTrois, $GroupeQuatre){

    echo $GroupeUn[0] . " vs " . $GroupeQuatre[1];
    echo $GroupeUn[1] . " vs " . $GroupeQuatre[0];
    echo $GroupeDeux[0] . " vs " . $GroupeTrois[1];
    echo $GroupeDeux[1] . " vs " . $GroupeTrois[0];
    

}
