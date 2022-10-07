<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
//require_once('algorithme_groupe.php');


// Définition de la constant concernant le nombre d'équipe idéal au total dans le tournoi
define("NB_QUART_FINALE", 4);
define("NB_DEMI_FINALE", 2);
define("NB_FINALE", 1);
define("NB_MATCH_3_PLACE", 1);
define("NB_MATCH_5_8_PLACE", 4);

$id_tournoi = $_GET["id_tournoi"];

$groupeA = $_SESSION['GroupeUn'];
$groupeB = $_SESSION['GroupeDeux'];
$groupeC = $_SESSION['GroupeTrois'];
$groupeD = $_SESSION['GroupeQuatre'];

$dateTournoi = getDateTournoi($id_tournoi);

$heureDebut1 = calculDebut('10:00:00', 0, 11, 0);
$heureFin1 = calculDebut($heureDebut1, 0, 11, 0);
$heureDebut2 = calculDebut($heureFin1, 0, 11, 0);
$heureFin2 = calculDebut($heureDebut2, 0, 11, 0);
$heureDebut3 = calculDebut($heureFin2, 0, 11, 0);
$heureFin3 = calculDebut($heureDebut3, 0, 11, 0);
$heureDebut4 = calculDebut($heureFin3, 0, 11, 0);
$heureFin4 = calculDebut($heureDebut4, 0, 11, 0);
$heureDebut5 = calculDebut('12:30:00', 0, 11, 0);
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
$heureDebut17 = calculDebut($heureFin16, 0, 11, 0);
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


function calculDebut($temps, $hours, $minutes, $seconds)  // soucres : https://forum.hardware.fr/hfr/Programmation/PHP/somme-heures-php-sujet_136188_1.htm
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
  $heureDebut1 = calculDebut('10:00:00', 0, 11, 0);
  $heureFin1 = calculDebut($heureDebut1, 0, 11, 0);
  $heureDebut2 = calculDebut($heureFin1, 0, 11, 0);
  $heureFin2 = calculDebut($heureDebut2, 0, 11, 0);
  $heureDebut3 = calculDebut($heureFin2, 0, 11, 0);
  $heureFin3 = calculDebut($heureDebut3, 0, 11, 0);
  $heureDebut4 = calculDebut($heureFin3, 0, 11, 0);
  $heureFin4 = calculDebut($heureDebut4, 0, 11, 0);
  $heureDebut5 = calculDebut('12:30:00', 0, 11, 0);
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
  $heureDebut17 = calculDebut($heureFin16, 0, 11, 0);
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


  $bdd = connectDB();

  $insertquartUn = $bdd->query("SET NAMES 'utf8'");
  $insertquartUn = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut1','$heureFin1','11','Quart de finale','1','0','$idEquipe1','$idEquipe2', null,'$id_tournoi','1','1')");

  $insertquartDeux = $bdd->query("SET NAMES 'utf8'");
  $insertquartDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut2','$heureFin2','11','Quart de finale','2','1','$idEquipe3','$idEquipe4', null,'$id_tournoi','1','1')");

  $insertquartTrois = $bdd->query("SET NAMES 'utf8'");
  $insertquartTrois = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut3','$heureFin3','11','Quart de finale','3','0','$idEquipe5','$idEquipe6', null,'$id_tournoi','1','1')");

  $insertquartQuatre = $bdd->query("SET NAMES 'utf8'");
  $insertquartQuatre = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut4','$heureFin4','11','Quart de finale','0','1','$idEquipe7','$idEquipe8', null,'$id_tournoi','1','1')");

  createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16);
  //createMatch5A8ePlace($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre, $dateTournoi, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20);
  createDemiFinale($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22);
}

createQuartFinale($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut1, $heureFin1, $heureDebut2, $heureFin2, $heureDebut3, $heureFin3, $heureDebut4, $heureFin4);


function createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16)
{
  $matchUn = array(
    ($groupeA[2]),
    ($groupeD[3]),
  );

  $idEquipe1 = 0;
  foreach ($groupeA[2] as $equipe) {
    $idEquipe1 = $equipe['ID_Equipe'];
  }

  $idEquipe2 = 0;
  foreach ($groupeD[3] as $equipe) {
    $idEquipe2 = $equipe['ID_Equipe'];
  }

  $matchDeux = array(
    ($groupeB[2]),
    ($groupeC[3]),
  );

  $idEquipe3 = 0;
  foreach ($groupeB[2] as $equipe) {
    $idEquipe3 = $equipe['ID_Equipe'];
  }

  $idEquipe4 = 0;
  foreach ($groupeC[3] as $equipe) {
    $idEquipe4 = $equipe['ID_Equipe'];
  }


  $matchTrois = array(
    ($groupeC[2]),
    ($groupeB[3]),
  );

  $idEquipe5 = 0;
  foreach ($groupeC[2] as $equipe) {
    $idEquipe5 = $equipe['ID_Equipe'];
  }

  $idEquipe6 = 0;
  foreach ($groupeB[3] as $equipe) {
    $idEquipe6 = $equipe['ID_Equipe'];
  }


  $MatchQuatre = array(
    ($groupeD[2]),
    ($groupeA[3]),
  );

  $idEquipe7 = 0;
  foreach ($groupeD[2] as $equipe) {
    $idEquipe7 = $equipe['ID_Equipe'];
  }

  $idEquipe8 = 0;
  foreach ($groupeA[3] as $equipe) {
    $idEquipe8 = $equipe['ID_Equipe'];
  }



  $bdd = connectDB();

  $insertMatchUn = $bdd->query("SET NAMES 'utf8'");
  $insertMatchUn = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut5','$heureFin5','11','3eA_VS_4eD','1','0','$idEquipe1','$idEquipe2', null,'$id_tournoi','1','1')");

  $insertMatchDeux = $bdd->query("SET NAMES 'utf8'");
  $insertMatchDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut6','$heureFin6','11','3eB_VS_4eC','2','1','$idEquipe3','$idEquipe4', null,'$id_tournoi','1','1')");

  $insertMatchTrois = $bdd->query("SET NAMES 'utf8'");
  $insertMatchTrois = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut7','$heureFin7','11','3eC_VS_4eB','3','0','$idEquipe5','$idEquipe6', null,'$id_tournoi','1','1')");

  $insertMatchQuatre = $bdd->query("SET NAMES 'utf8'");
  $insertMatchQuatre = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut8','$heureFin8','11','3eD_VS_4eA','0','1','$idEquipe7','$idEquipe8', null,'$id_tournoi','1','1')");


  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  VALUES ('$dateTournoi','$heureDebut9','$heureFin9','11','Match5','1','0','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','1','1')");

  $insertMatchSix = $bdd->query("SET NAMES 'utf8'");
  $insertMatchSix = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut10','$heureFin10','11','Match6','2','1','$idEquipeGagneTrois','$idEquipeGagneQuatre', null,'$id_tournoi','1','1')");

  $insertMatchSept = $bdd->query("SET NAMES 'utf8'");
  $insertMatchSept = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut11','$heureFin11','11','Match7','3','0','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','1','1')");

  $insertMatchHuit = $bdd->query("SET NAMES 'utf8'");
  $insertMatchhuit = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut12','$heureFin12','11','Match8','0','1','$idEquipePerduTrois','$idEquipePerduQuatre', null,'$id_tournoi','1','1')");

  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  VALUES ('$dateTournoi','$heureDebut13','$heureFin13','11','Match9eEt10ePlace','1','0','$idEquipeGagneCinq','$idEquipeGagneSix', null,'$id_tournoi','1','1')");

  $insertMatch11Et12e = $bdd->query("SET NAMES 'utf8'");
  $insertMatch11Et12e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut14','$heureFin14','11','Match11eEt12ePlace','2','1','$idEquipePerduCinq','$idEquipePerduSix', null,'$id_tournoi','1','1')");

  $insertMatch13Et14e = $bdd->query("SET NAMES 'utf8'");
  $insertMatch13Et14e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut15','$heureFin15','11','Match13eEt14ePlace','3','0','$idEquipeGagneSept','$idEquipeGagneHuit', null,'$id_tournoi','1','1')");

  $insertMatch15Et16e = $bdd->query("SET NAMES 'utf8'");
  $insertMatch15Et16e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut16','$heureFin16','11','Match15eEt16ePlace','0','1','$idEquipePerduSept','$idEquipePerduHuit', null,'$id_tournoi','1','1')");
}

function createMatch5A8ePlace($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20)
{
  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  VALUES ('$dateTournoi','$heureDebut17','$heureFin17','11','PerdantsQuartUn','4','2','$idEquipePerdanteUne','$idEquipePerdanteDeux', null,'$id_tournoi','1','1')");

  $insertMatchPerdantDeux = $bdd->query("SET NAMES 'utf8'");
  $insertMatchPerdantDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut18','$heureFin18','11','PerdantsQuartDeux','4','2','$idEquipePerdanteTrois','$idEquipePerdanteQuatre', null,'$id_tournoi','1','1')");

  $num = 2;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs WHERE FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
   VALUES ('$dateTournoi','$heureDebut19','$heureFin19','11','Match_5Et6_place','4','2','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','1','1')");

  $insertMatch7e8ePlace = $bdd->query("SET NAMES 'utf8'");
  $insertMatch7e8ePlace = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut20','$heureFin20','11','Match_7Et8_place','4','2','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','1','1')");
}


function createDemiFinale($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22)
{
  $heureDebut1 = calculDebut('10:00:00', 0, 11, 0);
  $heureFin1 = calculDebut($heureDebut1, 0, 11, 0);
  $heureDebut2 = calculDebut($heureFin1, 0, 11, 0);
  $heureFin2 = calculDebut($heureDebut2, 0, 11, 0);
  $heureDebut3 = calculDebut($heureFin2, 0, 11, 0);
  $heureFin3 = calculDebut($heureDebut3, 0, 11, 0);
  $heureDebut4 = calculDebut($heureFin3, 0, 11, 0);
  $heureFin4 = calculDebut($heureDebut4, 0, 11, 0);
  $heureDebut5 = calculDebut('12:30:00', 0, 11, 0);
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
  $heureDebut17 = calculDebut($heureFin16, 0, 11, 0);
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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

  $idEquipeGagnanteQuatre = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteQuatre = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteQuatre = $valeur['FK_ID_Visiteur'];
    }
  }


  $insertDemiUne = $bdd->query("SET NAMES 'utf8'");
  $insertDemiUne = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut21','$heureFin21','11','Demi finale','2','1','$idEquipeGagnanteUne','$idEquipeGagnanteDeux', null,'$id_tournoi','1','1')");

  $insertDemiDeux = $bdd->query("SET NAMES 'utf8'");
  $insertDemiDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut22','$heureFin22','11','Demi finale','4','2','$idEquipeGagnanteTrois','$idEquipeGagnanteQuatre', null,'$id_tournoi','1','1')");


  createMatch3eEt4ePlace($id_tournoi, $insertDemiUne, $insertDemiDeux, $dateTournoi, $heureDebut23, $heureFin23);
  createFinale($id_tournoi, $insertDemiUne, $insertDemiDeux, $dateTournoi, $heureDebut24, $heureFin24);
}

function createMatch3eEt4ePlace($id_tournoi, $insertDemiUne, $insertDemiDeux, $dateTournoi, $heureDebut23, $heureFin23)
{


  $bdd = connectDB();
  $num = 2;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

  $idEquipePerdanteDemiUne = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiUne = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiUne = $valeur['FK_ID_Visiteur'];
    }
  }
  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

  $idEquipePerdanteDemiDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $insertPetiteFinale = $bdd->query("SET NAMES 'utf8'");
  $insertPetiteFinale = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut23','$heureFin23','11','Match_3ème_place','4','2','$idEquipePerdanteDemiUne','$idEquipePerdanteDemiDeux', null,'$id_tournoi','1','1')");
}


function createFinale($id_tournoi, $insertDemiUne, $insertDemiDeux, $dateTournoi, $heureDebut24, $heureFin24)
{


  $bdd = connectDB();
  $num = 3;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

  $idEquipeGagnanteDemiUne = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiUne = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiUne = $valeur['FK_ID_Visiteur'];
    }
  }
  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs where FK_ID_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

  $idEquipeGagnanteDemiDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $insertFinale = $bdd->query("SET NAMES 'utf8'");
  $insertFinale = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut24','$heureFin24','11','Finale','4','2','$idEquipeGagnanteDemiUne','$idEquipeGagnanteDemiDeux', null,'$id_tournoi','1','1')");
}
