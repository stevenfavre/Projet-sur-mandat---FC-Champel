<?php
require_once "steven_fonctions.php";
require_once "dbconnection.php";
require_once "debug.php";

// Définition de la constant concernant le nombre d'équipe idéal dans un groupe
define("NB_EQUIPES_IDEAL", 4);
define("NB_GROUPE_PARFAIT", 4);
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

// Fonction qui permet de récupérer les équipes dans un tournoi en fonction du statut recherché
function getInscriptions($fk_id_tournoi, $statut)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Inscription_Tournoi` WHERE `FK_ID_Tournoi` = " . $fk_id_tournoi . " AND Statut_Inscription_Tournoi = '" . $statut . "';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\" Select des inscriptions des équipes du tournoi du id : " . $fk_id_tournoi . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Fonction qui permet de mettre à jour le numéro du groupe de la base de données
function updateGroupe($id_equipe, $id_groupe)
{
    try {
        $db = connectDB();
        $sql = "UPDATE `Equipe` SET `FK_ID_Groupe` = '" . $id_groupe . "' WHERE `Equipe` . `ID_Equipe` = '" . $id_equipe . "'";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        echo "<script>alert(\" Update du groupe de l'id : " . $id_equipe . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}
