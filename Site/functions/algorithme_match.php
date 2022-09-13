<?php
require_once "steven_fonctions.php";
require_once "dbconnection.php";
require_once "debug.php";

// Définition de la constant concernant le nombre d'équipe idéal dans un groupe
define("NB_EQUIPES_IDEAL", 4);

// Fonction répartissant les équipes dans les différents groupes
function createGroupe($fk_id_tournoi) {

    $_SESSION['Equipes'] = array();
    foreach(getInscriptions($fk_id_tournoi, "En attente") as $equipes) {

        // Récupération des équipes individuellement
        $equipe = selectEquipeWithID($equipes['FK_ID_Equipe']);
        // Stockage des équipes dans une liste de session
        array_push($_SESSION['Equipes'], $equipe);

        /* echo "<p>" . $equipe[0]['Nom_Equipe'] . "</p>"; */
    }

    if(fmod($_SESSION['Equipes'], NB_EQUIPES_IDEAL) == 0) {
        
    } else if(fmod($_SESSION['Equipes'], NB_EQUIPES_IDEAL) == 1) {

    } else if(fmod($_SESSION['Equipes'], NB_EQUIPES_IDEAL) == 2) {

    } else if(fmod($_SESSION['Equipes'], NB_EQUIPES_IDEAL) == 3) {

    }
}

// 
// https://stackoverflow.com/questions/23362451/php-generate-unique-teams-using-number-combination
function getTeam($candidates, $team_size = 3)
{
    shuffle($candidates);
    return array_chunk($candidates, $team_size);
}


// Fonction qui permet de récupérer les équipes dans un tournoi en fonction du statut recherché
function getInscriptions($fk_id_tournoi, $statut) {
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Inscription_Tournoi` WHERE `FK_ID_Tournoi` = " . $fk_id_tournoi . " AND Statut_Inscription_Tournoi = '" . $statut ."';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\" Select des inscriptions des équipes du tournoi du id : " . $fk_id_tournoi . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}

