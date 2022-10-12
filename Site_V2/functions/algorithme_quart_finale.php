<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
//require_once('algorithme_groupe.php');

$id_tournoi = $_GET["id_tournoi"];
$dateTournoi = getDateTournoi($id_tournoi);


$groupeA = $_SESSION['GroupeUn'];
$groupeB = $_SESSION['GroupeDeux'];
$groupeC = $_SESSION['GroupeTrois'];
$groupeD = $_SESSION['GroupeQuatre'];


$heureDebut1 = calculDebut('13:00:00', 0, 11, 0);
$heureFin1 = calculDebut($heureDebut1, 0, 11, 0);
$heureDebut2 = calculDebut($heureFin1, 0, 11, 0);
$heureFin2 = calculDebut($heureDebut2, 0, 11, 0);
$heureDebut3 = calculDebut($heureFin2, 0, 11, 0);
$heureFin3 = calculDebut($heureDebut3, 0, 11, 0);
$heureDebut4 = calculDebut($heureFin3, 0, 11, 0);
$heureFin4 = calculDebut($heureDebut4, 0, 11, 0);
$heureDebut5 = calculDebut($heureDebut1, 0, 11, 0);
$heureFin5 = calculDebut($heureDebut5, 0, 11, 0);
$heureDebut6 = calculDebut($heureFin5, 0, 11, 0);
$heureFin6 = calculDebut($heureDebut6, 0, 11, 0);
$heureDebut7 = calculDebut($heureFin6, 0, 11, 0);
$heureFin7 = calculDebut($heureDebut7, 0, 11, 0);
$heureDebut8 = calculDebut($heureFin7, 0, 11, 0);
$heureFin8 = calculDebut($heureDebut8, 0, 11, 0);
$heureDebut9 = calculDebut($heureFin8, 0, 11, 0);
$heureFin9 = calculDebut($heureDebut9, 0, 11, 0);
$heureDebut10 = calculDebut($heureFin9, 0, 11, 0);
$heureFin10 = calculDebut($heureDebut10, 0, 11, 0);
$heureDebut11 = calculDebut($heureFin10, 0, 11, 0);
$heureFin11 = calculDebut($heureDebut11, 0, 11, 0);
$heureDebut12 = calculDebut($heureFin11, 0, 11, 0);
$heureFin12 = calculDebut($heureDebut12, 0, 11, 0);
$heureDebut13 = calculDebut($heureFin12, 0, 11, 0);
$heureFin13 = calculDebut($heureDebut13, 0, 11, 0);
$heureDebut14 = calculDebut($heureFin13, 0, 11, 0);
$heureFin14 = calculDebut($heureDebut14, 0, 11, 0);
$heureDebut15 = calculDebut($heureFin14, 0, 11, 0);
$heureFin15 = calculDebut($heureDebut15, 0, 11, 0);
$heureDebut16 = calculDebut($heureFin15, 0, 11, 0);
$heureFin16 = calculDebut($heureDebut16, 0, 11, 0);
$heureDebut17 = calculDebut($heureFin4, 0, 60, 0);
$heureFin17 = calculDebut($heureDebut17, 0, 11, 0);
$heureDebut18 = calculDebut($heureFin17, 0, 11, 0);
$heureFin18 = calculDebut($heureDebut18, 0, 11, 0);
$heureDebut19 = calculDebut($heureFin18, 0, 11, 0);
$heureFin19 = calculDebut($heureDebut19, 0, 11, 0);
$heureDebut20 = calculDebut($heureFin19, 0, 11, 0);
$heureFin20 = calculDebut($heureDebut20, 0, 11, 0);
$heureDebut21 = calculDebut($heureFin20, 0, 11, 0);
$heureFin21 = calculDebut($heureDebut21, 0, 11, 0);
$heureDebut22 = calculDebut($heureFin21, 0, 11, 0);
$heureFin22 = calculDebut($heureDebut22, 0, 11, 0);
$heureDebut23 = calculDebut($heureFin22, 0, 11, 0);
$heureFin23 = calculDebut($heureDebut23, 0, 11, 0);
$heureDebut24 = calculDebut($heureFin23, 0, 11, 0);
$heureFin24 = calculDebut($heureDebut24, 0, 11, 0);

function calculDebut($temps, $hours, $minutes, $seconds)  // sources : https://forum.hardware.fr/hfr/Programmation/PHP/somme-heures-php-sujet_136188_1.htm
{
    $temp_string = explode(":", $temps);
    $totalHours = $temp_string[0] + $hours;
    $totalMinutes = $temp_string[1] + $minutes;
    if ($totalMinutes / 60 > 1) {
        $totalHours = $totalHours + floor($totalMinutes / 60);
        $totalMinutes = $totalMinutes % 60;
    }
    $totalSeconds = $temp_string[2] + $seconds;
    if ($totalSeconds / 60 > 1) {
        $totalMinutes = $totalHours + floor($totalSeconds / 60);
        $totalSeconds = $totalSeconds % 60;
    }
    if ($totalHours < 10) {
        $totalHours = "0" . $totalHours;
    }
    if ($totalMinutes < 10) {
        $totalMinutes = "0" . $totalMinutes;
    }
    if ($totalSeconds < 10) {
        $totalSeconds = "0" . $totalSeconds;
    }
    $myTime = $totalHours . ":" . $totalMinutes . ":" . $totalSeconds;

    return $myTime;
}

function createQuartFinale($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut1, $heureFin1, $heureDebut2, $heureFin2, $heureDebut3, $heureFin3, $heureDebut4, $heureFin4)
{
    $heureDebut1 = calculDebut('13:00:00', 0, 11, 0);
    $heureFin1 = calculDebut($heureDebut1, 0, 11, 0);
    $heureDebut2 = calculDebut($heureFin1, 0, 11, 0);
    $heureFin2 = calculDebut($heureDebut2, 0, 11, 0);
    $heureDebut3 = calculDebut($heureFin2, 0, 11, 0);
    $heureFin3 = calculDebut($heureDebut3, 0, 11, 0);
    $heureDebut4 = calculDebut($heureFin3, 0, 11, 0);
    $heureFin4 = calculDebut($heureDebut4, 0, 11, 0);
    $heureDebut5 = calculDebut($heureDebut1, 0, 11, 0);
    $heureFin5 = calculDebut($heureDebut5, 0, 11, 0);
    $heureDebut6 = calculDebut($heureFin5, 0, 11, 0);
    $heureFin6 = calculDebut($heureDebut6, 0, 11, 0);
    $heureDebut7 = calculDebut($heureFin6, 0, 11, 0);
    $heureFin7 = calculDebut($heureDebut7, 0, 11, 0);
    $heureDebut8 = calculDebut($heureFin7, 0, 11, 0);
    $heureFin8 = calculDebut($heureDebut8, 0, 11, 0);
    $heureDebut9 = calculDebut($heureFin8, 0, 11, 0);
    $heureFin9 = calculDebut($heureDebut9, 0, 11, 0);
    $heureDebut10 = calculDebut($heureFin9, 0, 11, 0);
    $heureFin10 = calculDebut($heureDebut10, 0, 11, 0);
    $heureDebut11 = calculDebut($heureFin10, 0, 11, 0);
    $heureFin11 = calculDebut($heureDebut11, 0, 11, 0);
    $heureDebut12 = calculDebut($heureFin11, 0, 11, 0);
    $heureFin12 = calculDebut($heureDebut12, 0, 11, 0);
    $heureDebut13 = calculDebut($heureFin12, 0, 11, 0);
    $heureFin13 = calculDebut($heureDebut13, 0, 11, 0);
    $heureDebut14 = calculDebut($heureFin13, 0, 11, 0);
    $heureFin14 = calculDebut($heureDebut14, 0, 11, 0);
    $heureDebut15 = calculDebut($heureFin14, 0, 11, 0);
    $heureFin15 = calculDebut($heureDebut15, 0, 11, 0);
    $heureDebut16 = calculDebut($heureFin15, 0, 11, 0);
    $heureFin16 = calculDebut($heureDebut16, 0, 11, 0);
    $heureDebut17 = calculDebut($heureFin4, 0, 60, 0);
    $heureFin17 = calculDebut($heureDebut17, 0, 11, 0);
    $heureDebut18 = calculDebut($heureFin17, 0, 11, 0);
    $heureFin18 = calculDebut($heureDebut18, 0, 11, 0);
    $heureDebut19 = calculDebut($heureFin18, 0, 11, 0);
    $heureFin19 = calculDebut($heureDebut19, 0, 11, 0);
    $heureDebut20 = calculDebut($heureFin19, 0, 11, 0);
    $heureFin20 = calculDebut($heureDebut20, 0, 11, 0);
    $heureDebut21 = calculDebut($heureFin20, 0, 11, 0);
    $heureFin21 = calculDebut($heureDebut21, 0, 11, 0);
    $heureDebut22 = calculDebut($heureFin21, 0, 11, 0);
    $heureFin22 = calculDebut($heureDebut22, 0, 11, 0);
    $heureDebut23 = calculDebut($heureFin22, 0, 11, 0);
    $heureFin23 = calculDebut($heureDebut23, 0, 11, 0);
    $heureDebut24 = calculDebut($heureFin23, 0, 11, 0);
    $heureFin24 = calculDebut($heureDebut24, 0, 11, 0);


    $quartFinaleUn = array(
        ($groupeA[0]),
        ($groupeD[1]),
    );

    $idEquipe1 = 0;
    foreach ($groupeA[0] as $equipe) {
        $idEquipe1 = $equipe['ID_Equipe'];
    }

    $idEquipe2 = 0;
    foreach ($groupeD[1] as $equipe) {
        $idEquipe2 = $equipe['ID_Equipe'];
    }

    $quartFinaleDeux = array(
        ($groupeB[0]),
        ($groupeC[1]),
    );

    $idEquipe3 = 0;
    foreach ($groupeB[0] as $equipe) {
        $idEquipe3 = $equipe['ID_Equipe'];
    }

    $idEquipe4 = 0;
    foreach ($groupeC[1] as $equipe) {
        $idEquipe4 = $equipe['ID_Equipe'];
    }


    $quartFinaleTrois = array(
        ($groupeC[0]),
        ($groupeB[1]),
    );

    $idEquipe5 = 0;
    foreach ($groupeC[0] as $equipe) {
        $idEquipe5 = $equipe['ID_Equipe'];
    }

    $idEquipe6 = 0;
    foreach ($groupeB[1] as $equipe) {
        $idEquipe6 = $equipe['ID_Equipe'];
    }


    $quartFinaleQuatre = array(
        ($groupeD[0]),
        ($groupeA[1]),
    );

    $idEquipe7 = 0;
    foreach ($groupeD[0] as $equipe) {
        $idEquipe7 = $equipe['ID_Equipe'];
    }

    $idEquipe8 = 0;
    foreach ($groupeA[1] as $equipe) {
        $idEquipe8 = $equipe['ID_Equipe'];
    }


    $insertquartUn = insertQuart($dateTournoi, $heureDebut1, $heureFin1, "1", "0", $idEquipe1, $idEquipe2, $id_tournoi);
    $insertquartDeux = insertQuart($dateTournoi, $heureDebut2, $heureFin2, "2", "1", $idEquipe3, $idEquipe4, $id_tournoi);
    $insertquartTrois = insertQuart($dateTournoi, $heureDebut3, $heureFin3, "3", "0", $idEquipe5, $idEquipe6, $id_tournoi);
    $insertquartQuatre = insertQuart($dateTournoi, $heureDebut4, $heureFin4, "5", "2", $idEquipe7, $idEquipe8, $id_tournoi);

    $quart1 = getTournois($insertquartUn);
    $quart2 = getTournois($insertquartDeux);
    $quart3 = getTournois($insertquartTrois);
    $quart4 = getTournois($insertquartQuatre);
}

function insertQuart($date, $heurDebut, $heureFin, $scoreLoc, $scoreVisit, $idEquipeLoc, $idEquipeVisit, $id_tournoi)
{
    $bdd = connectDB();

    $quart = $bdd->prepare("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$date','$heurDebut','$heureFin','11','Quart de finale','$scoreLoc','$scoreVisit','$idEquipeLoc','$idEquipeVisit', null,'" . $id_tournoi . "','1','1')");

    $bdd->beginTransaction();
    $quart->execute();
    $insertId = $bdd->lastInsertId();
    $bdd->commit();
    return $insertId;
}

function getTournois($id)
{
    $bdd = connectDB();
    $quart = $bdd->prepare("SELECT * FROM `Matchs` WHERE ID_Match = :idMatch");
    $quart->execute(array("idMatch" => $id));
    return $quart;
}

createQuartFinale($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut1, $heureFin1, $heureDebut2, $heureFin2, $heureDebut3, $heureFin3, $heureDebut4, $heureFin4);

header("Location:../match.php?id_tournoi=$id_tournoi");
