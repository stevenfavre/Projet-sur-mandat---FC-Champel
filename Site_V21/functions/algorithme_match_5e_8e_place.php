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

function createMatch5A8ePlace($id_tournoi, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20)
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

    $idEquipePerdanteUne = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipePerdanteUne = $valeur['FK_ID_Local'];
        } else {
            $idEquipePerdanteUne = $valeur['FK_ID_Visiteur'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipePerdanteDeux = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipePerdanteDeux = $valeur['FK_ID_Local'];
        } else {
            $idEquipePerdanteDeux = $valeur['FK_ID_Visiteur'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipePerdanteTrois = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipePerdanteTrois = $valeur['FK_ID_Local'];
        } else {
            $idEquipePerdanteTrois = $valeur['FK_ID_Visiteur'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Quart de finale' AND FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipePerdanteQuatre = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipePerdanteQuatre = $valeur['FK_ID_Local'];
        } else {
            $idEquipePerdanteQuatre = $valeur['FK_ID_Visiteur'];
        }
    }

    $insertMatchPerdantUn = $bdd->query("SET NAMES 'utf8'");
    $insertMatchPerdantUn = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut17','$heureFin17','10','PerdantsQuartUn','4','2','$idEquipePerdanteUne','$idEquipePerdanteDeux', null,'$id_tournoi','1','1')");

    $insertMatchPerdantDeux = $bdd->query("SET NAMES 'utf8'");
    $insertMatchPerdantDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi', '$heureDebut18', '$heureFin18','10','PerdantsQuartDeux','4','2','$idEquipePerdanteTrois','$idEquipePerdanteQuatre', null,'$id_tournoi','1','1')");


    //$num = 2;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs WHERE Type_Match = 'PerdantsQuartUn' AND FK_ID_Tournoi = $id_tournoi");

    $idEquipeGagneUne = 0;
    $idEquipePerduUne = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneUne = $valeur['FK_ID_Local'];
            $idEquipePerduUne = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneUne = $valeur['FK_ID_Visiteur'];
            $idEquipePerduUne = $valeur['FK_ID_Local'];
        }
    }


    //$num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'PerdantsQuartDeux' AND FK_ID_Tournoi = $id_tournoi");

    $idEquipeGagneDeux = 0;
    $idEquipePerduDeux = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneDeux = $valeur['FK_ID_Local'];
            $idEquipePerduDeux = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneDeux = $valeur['FK_ID_Visiteur'];
            $idEquipePerduDeux = $valeur['FK_ID_Local'];
        }
    }


    $insertMatch5e6ePlace = $bdd->query("SET NAMES 'utf8'");
    $insertMatch5e6ePlace = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
   VALUES ('$dateTournoi', '$heureDebut19', '$heureFin19','10','Match_5Et6_place','4','2','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','1','1')");

    $insertMatch7e8ePlace = $bdd->query("SET NAMES 'utf8'");
    $insertMatch7e8ePlace = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi', '$heureDebut20', '$heureFin20','10','Match_7Et8_place','4','2','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','1','1')");
}

createMatch5A8ePlace($id_tournoi, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20);

header("Location:../match.php?id_tournoi=$id_tournoi");
