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


$groupeA = $_SESSION['GroupeUn'];
$groupeB = $_SESSION['GroupeDeux'];
$groupeC = $_SESSION['GroupeTrois'];
$groupeD = $_SESSION['GroupeQuatre'];

function createQuartFinale($groupeA, $groupeB, $groupeC, $groupeD)
{
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

  /*$idGroupeA = 0;
  foreach ($groupeA as $groupe) {
    $idGroupeA = $groupe['ID_Equipe'];
  }
  $idGroupeB = 0;
  foreach ($groupeB as $groupe) {
    $idGroupeB = $groupe['ID_Equipe'];
  }
  $idGroupeC = 0;
  foreach ($groupeC as $groupe) {
    $idGroupeC = $groupe['ID_Equipe'];
  }
  $idGroupeD = 0;
  foreach ($groupeD as $groupe) {
    $idGroupeD = $groupe['ID_Equipe'];
  }*/

  /* print_r($quartFinaleUn);
  echo "<br /><br />";
  print_r($quartFinaleDeux);
  echo "<br /><br />";
  print_r($quartFinaleTrois);
  echo "<br /><br />";
  print_r($quartFinaleQuatre);
  */

  $bdd = connectDB();

  $insertquartUn = $bdd->query("SET NAMES 'utf8'");
  $insertquartUn = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:00:00','10:11:00','11','Quart de finale','1','0','$idEquipe1','$idEquipe2', null,'1','1','1')");

  $insertquartDeux = $bdd->query("SET NAMES 'utf8'");
  $insertquartDeux = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:15:00','10:26:00','11','Quart de finale','2','1','$idEquipe3','$idEquipe4', null,'1','1','1')");

  $insertquartTrois = $bdd->query("SET NAMES 'utf8'");
  $insertquartTrois = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:30:00','10:31:00','11','Quart de finale','3','0','$idEquipe5','$idEquipe6', null,'1','1','1')");

  $insertquartQuatre = $bdd->query("SET NAMES 'utf8'");
  $insertquartQuatre = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:40:00','10:51:00','11','Quart de finale','0','1','$idEquipe7','$idEquipe8', null,'1','1','1')");

  //print_r($insertquartUn);
  // echo "<br /><br />";
  // print_r($insertquartDeux);
  // echo "<br /><br />";
  // print_r($insertquartTrois);
  // echo "<br /><br />";
  // print_r($insertquartQuatre);
  // echo "<br /><br />";

  createDemiFinale($insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre);
}

createQuartFinale($groupeA, $groupeB, $groupeC, $groupeD);


function createDemiFinale($insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre)
{
  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagnanteUne = 0;
  foreach ($matchs as $match) {
    if ($match['But_Local_Match'] > $match['But_Visiteur_Match']) {
      $idEquipeGagnanteUne = $match['FK_ID_Local'];
    } elseif ($match['But_Local_Match'] < $match['But_Visiteur_Match']) {
      $idEquipeGagnanteUne = $match['FK_ID_Visiteur'];
    }
  }
  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagnanteDeux = 0;
  foreach ($matchs as $match) {
    if ($match['But_Local_Match'] > $match['But_Visiteur_Match']) {
      $idEquipeGagnanteDeux = $match['FK_ID_Local'];
    } elseif ($match['But_Local_Match'] > $match['But_Visiteur_Match']) {
      $idEquipeGagnanteDeux = $match['FK_ID_Visiteur'];
    }
  }

  echo $idEquipeGagnanteUne;
  echo "<br /><br />";
  echo $idEquipeGagnanteDeux;

  $insertDemiUne = $bdd->query("SET NAMES 'utf8'");
  $insertDemiUne = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:00:00','11:11:00','11','Demi finale','2','1','$idEquipeGagnanteUne','$idEquipeGagnanteDeux', '1','1','1','1')");

  /*$idEquipeGagnanteTrois = 0;
  foreach ($insertquartTrois as $match) {
    if ($match['But_Local_Match'] > $match[`But_Visiteur_Match`]) {
      $idEquipeGagnanteTrois = $match['FK_ID_Local'];
    } elseif ('But_Local_Match' < `But_Visiteur_Match`) {
      $idEquipeGagnanteTrois = $match[`FK_ID_Visiteur`];
    }
  }

  $idEquipeGagnanteQuatre = 0;
  foreach ($insertquartQuatre as $match) {
    if ($match['But_Local_Match'] > $match[`But_Visiteur_Match`]) {
      $idEquipeGagnanteQuatre = $match['FK_ID_Local'];
    } elseif ($match['But_Local_Match'] < $match[`But_Visiteur_Match`]) {
      $idEquipeGagnanteQuatre = $match[`FK_ID_Visiteur`];
    }
  }

  $insertDemiDeux = $bdd->query("SET NAMES 'utf8'");
  $insertDemiDeux = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:00:00','11:11:00','11','Demi finale','4','2','$idEquipeGagnanteTrois','$idEquipeGagnanteQuatre', null,'1','1','1')");*/
}



function createFinale()
{
}

function createMatch5A8ePlace()
{
}

function createMatch9A16ePlce()
{
}
