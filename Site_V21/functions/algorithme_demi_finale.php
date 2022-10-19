<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_groupe.php');
//require_once('algorithme_quart_finale.php');


$id_tournoi = $_GET["id_tournoi"];
$dateTournoi = getDateTournoi($id_tournoi);

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

function createDemiFinale($id_tournoi, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22)
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


    $bdd = connectDB();
    $num = 4;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagnanteUne = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteUne = $valeur['FK_ID_Local'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteUne = $valeur['FK_ID_Visiteur'];
        }
    }
    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagnanteDeux = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteDeux = $valeur['FK_ID_Local'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteDeux = $valeur['FK_ID_Visiteur'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagnanteTrois = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteTrois = $valeur['FK_ID_Local'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteTrois = $valeur['FK_ID_Visiteur'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagnanteQuatre = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteQuatre = $valeur['FK_ID_Local'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagnanteQuatre = $valeur['FK_ID_Visiteur'];
        }
    }

    $insertDemiUne = insertDemi($dateTournoi, $heureDebut21, $heureFin21, "2", "0", $idEquipeGagnanteUne, $idEquipeGagnanteDeux, $id_tournoi);
    $insertDemiDeux = insertDemi($dateTournoi, $heureDebut22, $heureFin22, "2", "1", $idEquipeGagnanteTrois, $idEquipeGagnanteQuatre, $id_tournoi);
}

function insertDemi($date, $heurDebut, $heureFin, $scoreLoc, $scoreVisit, $idEquipeLoc, $idEquipeVisit, $id_tournoi)
{
    $bdd = connectDB();

    $quart = $bdd->prepare("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$date','$heurDebut','$heureFin','10','Demi finale','$scoreLoc','$scoreVisit','$idEquipeLoc','$idEquipeVisit', null,'$id_tournoi','1','1')");

    $bdd->beginTransaction();
    $quart->execute();
    $insertId = $bdd->lastInsertId();
    $bdd->commit();
    return $insertId;
}

function getDemi($id)
{
    $bdd = connectDB();
    $quart = $bdd->prepare("SELECT * FROM `Matchs`WHERE ID_Match = :idMatch");
    $quart->execute(array("idMatch" => $id));
    return $quart;
}

createDemiFinale($id_tournoi, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22);


header("Location:../match.php?id_tournoi=$id_tournoi");
