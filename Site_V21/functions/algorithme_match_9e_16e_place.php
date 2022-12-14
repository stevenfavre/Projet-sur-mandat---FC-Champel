<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
//require_once('algorithme_groupe.php');

$id_tournoi = $_GET["id_tournoi"];
$dateTournoi = getDateTournoi($id_tournoi);

$groupeA = $_SESSION['Groupe1'];
$groupeB = $_SESSION['Groupe2'];
$groupeC = $_SESSION['Groupe3'];
$groupeD = $_SESSION['Groupe4'];

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
function createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16)
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

    $idEquipe1 = 0;

    $idEquipe1 = $groupeA[2][0];


    $idEquipe2 = 0;
    $idEquipe2 = $groupeD[3][0];


    $idEquipe3 = 0;
    $idEquipe3 = $groupeB[2][0];


    $idEquipe4 = 0;
    $idEquipe4 = $groupeC[3][0];


    $idEquipe5 = 0;
    $idEquipe5 = $groupeC[2][0];


    $idEquipe6 = 0;
    $idEquipe6 = $groupeB[3][0];


    $idEquipe7 = 0;
    $idEquipe7 = $groupeD[2][0];


    $idEquipe8 = 0;
    $idEquipe8 = $groupeA[3][0];



    $bdd = connectDB();

    $insertMatchUn = $bdd->query("SET NAMES 'utf8'");
    $insertMatchUn = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut5','$heureFin5','11','3eA_VS_4eD','1','0','$idEquipe1','$idEquipe2', null,'$id_tournoi','2','1')");

    $insertMatchDeux = $bdd->query("SET NAMES 'utf8'");
    $insertMatchDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut6','$heureFin6','11','3eB_VS_4eC','2','1','$idEquipe3','$idEquipe4', null,'$id_tournoi','2','1')");

    $insertMatchTrois = $bdd->query("SET NAMES 'utf8'");
    $insertMatchTrois = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut7','$heureFin7','11','3eC_VS_4eB','3','0','$idEquipe5','$idEquipe6', null,'$id_tournoi','2','1')");

    $insertMatchQuatre = $bdd->query("SET NAMES 'utf8'");
    $insertMatchQuatre = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut8','$heureFin8','11','3eD_VS_4eA','0','1','$idEquipe7','$idEquipe8', null,'$id_tournoi','2','1')");


    $bdd = connectDB();
    $num = 4;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = '3eA_VS_4eD' AND FK_Id_Tournoi = $id_tournoi");

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

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = '3eB_VS_4eC' AND FK_Id_Tournoi = $id_tournoi");

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


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = '3eC_VS_4eB' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneTrois = 0;
    $idEquipePerduTrois = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneTrois = $valeur['FK_ID_Local'];
            $idEquipePerduTrois = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneTrois = $valeur['FK_ID_Visiteur'];
            $idEquipePerduTrois = $valeur['FK_ID_Local'];
        }
    }


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = '3eD_VS_4eA' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneQuatre = 0;
    $idEquipePerduQuatre = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneQuatre = $valeur['FK_ID_Local'];
            $idEquipePerduQuatre = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneQuatre = $valeur['FK_ID_Visiteur'];
            $idEquipePerduQuatre = $valeur['FK_ID_Local'];
        }
    }


    $insertMatchCinq = $bdd->query("SET NAMES 'utf8'");
    $insertMatchCinq = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut9','$heureFin9','11','Match5','1','0','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','2','1')");

    $insertMatchSix = $bdd->query("SET NAMES 'utf8'");
    $insertMatchSix = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut10','$heureFin10','11','Match6','2','1','$idEquipeGagneTrois','$idEquipeGagneQuatre', null,'$id_tournoi','2','1')");

    $insertMatchSept = $bdd->query("SET NAMES 'utf8'");
    $insertMatchSept = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut11','$heureFin11','11','Match7','3','0','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','2','1')");

    $insertMatchHuit = $bdd->query("SET NAMES 'utf8'");
    $insertMatchhuit = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut12','$heureFin12','11','Match8','0','1','$idEquipePerduTrois','$idEquipePerduQuatre', null,'$id_tournoi','2','1')");

    $bdd = connectDB();
    $num = 4;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Match5' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneCinq = 0;
    $idEquipePerduCinq = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneCinq = $valeur['FK_ID_Local'];
            $idEquipePerduCinq = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneCinq = $valeur['FK_ID_Visiteur'];
            $idEquipePerduCinq = $valeur['FK_ID_Local'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Match6' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneSix = 0;
    $idEquipePerduSix = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneSix = $valeur['FK_ID_Local'];
            $idEquipePerduSix = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneSix = $valeur['FK_ID_Visiteur'];
            $idEquipePerduSix = $valeur['FK_ID_Local'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Match7' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneSept = 0;
    $idEquipePerduSept = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneSept = $valeur['FK_ID_Local'];
            $idEquipePerduSept = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneSept = $valeur['FK_ID_Visiteur'];
            $idEquipePerduSept = $valeur['FK_ID_Local'];
        }
    }


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where Type_Match = 'Match8' and FK_Id_Tournoi = $id_tournoi");

    $idEquipeGagneHuit = 0;
    $idEquipePerduHuit = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneHuit = $valeur['FK_ID_Local'];
            $idEquipePerduHuit = $valeur['FK_ID_Visiteur'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagneHuit = $valeur['FK_ID_Visiteur'];
            $idEquipePerduHuit = $valeur['FK_ID_Local'];
        }
    }

    $insertMatch9Et10e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch9Et10e  = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$dateTournoi','$heureDebut13','$heureFin13','11','Match_9Et10_place','1','0','$idEquipeGagneCinq','$idEquipeGagneSix', null,'$id_tournoi','2','1')");

    $insertMatch11Et12e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch11Et12e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$dateTournoi','$heureDebut14','$heureFin14','11','Match_11Et12_place','2','1','$idEquipePerduCinq','$idEquipePerduSix', null,'$id_tournoi','2','1')");

    $insertMatch13Et14e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch13Et14e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$dateTournoi','$heureDebut15','$heureFin15','11','Match_13Et14_place','3','0','$idEquipeGagneSept','$idEquipeGagneHuit', null,'$id_tournoi','2','1')");

    $insertMatch15Et16e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch15Et16e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
    VALUES ('$dateTournoi','$heureDebut16','$heureFin16','11','Match_15Et16_place','0','1','$idEquipePerduSept','$idEquipePerduHuit', null,'$id_tournoi','2','1')");
}

createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16);
header("Location:../match.php?id_tournoi=$id_tournoi");
