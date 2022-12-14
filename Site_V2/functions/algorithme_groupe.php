<html>
<body>
<?php
require_once "steven_fonctions.php";
require_once "dbconnection.php";
require_once "debug.php";

session_start();

// Définition de la constant concernant le nombre d'équipe idéal dans un groupe
define("NB_EQUIPES_IDEAL", 4);
define("NB_GROUPE_PARFAIT", 4);
$id_tournoi = $_GET["id_tournoi"];
checkNBInscriptions(16, $id_tournoi);

// Fonction répartissant les équipes dans les différents groupes
function createGroupe($fk_id_tournoi)
{
    try {
        $redo = false;
        //$_SESSION['Groupes'] = array();
        $_SESSION['Equipes'] = array();

        // Groupe stockant les équipes
        $_SESSION['GroupeUn'] = array();
        $_SESSION['GroupeDeux'] = array();
        $_SESSION['GroupeTrois'] = array();
        $_SESSION['GroupeQuatre'] = array();

        foreach (getInscriptions($fk_id_tournoi, "Validé") as $equipes) {
            // Récupération des équipes individuellement
            $equipe = selectEquipeWithID($equipes['FK_ID_Equipe']);
            // Stockage des équipes dans une liste de session
            array_push($_SESSION['Equipes'], $equipe);
        }

        // Permet de confirmer le nombre d'équipe inscrites
        if (count($_SESSION['Equipes']) >= NB_EQUIPES_IDEAL) {

            shuffle($_SESSION['Equipes']);

            // https://stackoverflow.com/questions/23362451/php-generate-unique-teams-using-number-combination
            $division = array_chunk($_SESSION['Equipes'], NB_EQUIPES_IDEAL);

            foreach ($division[0] as $equipe) {
                array_push($_SESSION['GroupeUn'], $equipe);
                updateGroupe($equipe[0]['ID_Equipe'], 1);
            }

            foreach ($division[1] as $equipe) {
                array_push($_SESSION['GroupeDeux'], $equipe);
                updateGroupe($equipe[0]['ID_Equipe'], 2);
            }

            foreach ($division[2] as $equipe) {
                array_push($_SESSION['GroupeTrois'], $equipe);
                updateGroupe($equipe[0]['ID_Equipe'], 3);
            }

            foreach ($division[3] as $equipe) {
                array_push($_SESSION['GroupeQuatre'], $equipe);
                updateGroupe($equipe[0]['ID_Equipe'], 4);
            }

            header('Location: ../parametre_tournoi.php?id_tournoi=' . $fk_id_tournoi);
        }
    } catch (\Throwable $th) {
        //throw $th;
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

// Permet de réaliser un test sur le nombre d'inscription à un tournoi
function checkNBInscriptions($nb_inscriptions, $fk_id_tournoi)
{
    $inscriptions = getInscriptions($fk_id_tournoi, "Validé");

    if (count($inscriptions) >= $nb_inscriptions)
        createGroupe($fk_id_tournoi);
    else {
        echo "<script>";
        echo "alert(\"Le nombre d'équipe inscrites ne correspond pas au exigence requis pour lancer un tournoi. Nombre d'inscription actuelle : " . count($inscriptions) . " Nombre requis : 16\");";
        echo "location.href=\"../match.php?id_tournoi=" . $fk_id_tournoi . "\";";
        echo "</script>";
    }
    
}
