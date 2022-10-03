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

function createMatch9A16ePlace()
{
}

function createQuartFinale($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD)
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


  $bdd = connectDB();

  $insertquartUn = $bdd->query("SET NAMES 'utf8'");
  $insertquartUn = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:00:00','10:11:00','11','Quart de finale','1','0','$idEquipe1','$idEquipe2', null,'$id_tournoi','1','1')");

  $insertquartDeux = $bdd->query("SET NAMES 'utf8'");
  $insertquartDeux = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:15:00','10:26:00','11','Quart de finale','2','1','$idEquipe3','$idEquipe4', null,'$id_tournoi','1','1')");

  $insertquartTrois = $bdd->query("SET NAMES 'utf8'");
  $insertquartTrois = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:30:00','10:31:00','11','Quart de finale','3','0','$idEquipe5','$idEquipe6', null,'$id_tournoi','1','1')");

  $insertquartQuatre = $bdd->query("SET NAMES 'utf8'");
  $insertquartQuatre = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','10:40:00','10:51:00','11','Quart de finale','0','1','$idEquipe7','$idEquipe8', null,'$id_tournoi','1','1')");

  createMatch5A8ePlace($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre);
  createDemiFinale($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre);
}

createQuartFinale($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD);

function createMatch5A8ePlace($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre)
{
  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipePerdanteUne = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteUne = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteUne = $valeur['FK_ID_Visiteur'];
    }
  }
  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipePerdanteDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipePerdanteTrois = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteTrois = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteTrois = $valeur['FK_ID_Visiteur'];
    }
  }

  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipePerdanteQuatre = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteQuatre = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteQuatre = $valeur['FK_ID_Visiteur'];
    }
  }

  $insertMatchPerdantUn = $bdd->query("SET NAMES 'utf8'");
  $insertMatchPerdantUn = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:20:00','11:31:00','11','Perdants des quarts 1','4','2','$idEquipePerdanteUne','$idEquipePerdanteDeux', null,'$id_tournoi','1','1')");

  $insertMatchPerdantDeux = $bdd->query("SET NAMES 'utf8'");
  $insertMatchPerdantDeux = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:20:00','11:31:00','11','Perdants des quarts 2','4','2','$idEquipePerdanteTrois','$idEquipePerdanteQuatre', null,'$id_tournoi','1','1')");


  $num = 2;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagneUne = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagneUne = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagneUne = $valeur['FK_ID_Visiteur'];
    }
  }

  $idEquipePerduUne = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerduUne = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerduUne = $valeur['FK_ID_Visiteur'];
    }
  }

  $num -= 1;

  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagneDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagneDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagneDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $idEquipePerduDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerduDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerduDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  // $insertMatch5e6ePlace = $bdd->query("SET NAMES 'utf8'");
  // $insertMatch5e6ePlace = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  // VALUES ('2022-09-24','11:20:00','11:31:00','11','Match pour la 5ème place','4','2','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','1','1')");

  // $insertMatch7e8ePlace = $bdd->query("SET NAMES 'utf8'");
  // $insertMatch7e8ePlace = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  // VALUES ('2022-09-24','11:20:00','11:31:00','11','Match pour la 5ème place','4','2','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','1','1')");
}


function createDemiFinale($id_tournoi, $insertquartUn, $insertquartDeux, $insertquartTrois, $insertquartQuatre)
{


  $bdd = connectDB();
  $num = 4;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagnanteQuatre = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteQuatre = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteQuatre = $valeur['FK_ID_Visiteur'];
    }
  }


  $insertDemiUne = $bdd->query("SET NAMES 'utf8'");
  $insertDemiUne = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:00:00','11:11:00','11','Demi finale','2','1','$idEquipeGagnanteUne','$idEquipeGagnanteDeux', null,'$id_tournoi','1','1')");

  $insertDemiDeux = $bdd->query("SET NAMES 'utf8'");
  $insertDemiDeux = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','11:20:00','11:31:00','11','Demi finale','4','2','$idEquipeGagnanteTrois','$idEquipeGagnanteQuatre', null,'$id_tournoi','1','1')");


  createMatch3eEt4ePlace($id_tournoi, $insertDemiUne, $insertDemiDeux);
  createFinale($id_tournoi, $insertDemiUne, $insertDemiDeux);
}

function createMatch3eEt4ePlace($id_tournoi, $insertDemiUne, $insertDemiDeux)
{


  $bdd = connectDB();
  $num = 2;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipePerdanteDemiDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipePerdanteDemiDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $insertPetiteFinale = $bdd->query("SET NAMES 'utf8'");
  $insertPetiteFinale = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','16:00:00','16:21:00','11','Match pour la 3ème place','4','2','$idEquipePerdanteDemiUne','$idEquipePerdanteDemiDeux', null,'$id_tournoi','1','1')");
}


function createFinale($id_tournoi, $insertDemiUne, $insertDemiDeux)
{


  $bdd = connectDB();
  $num = 3;
  $matchs = $bdd->query("SET NAMES 'utf8'");
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

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
  $matchs = $bdd->query("SELECT * FROM Matchs order by ID_Match desc limit $num;");

  $idEquipeGagnanteDemiDeux = 0;
  foreach ($matchs as $valeur) {
    if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiDeux = $valeur['FK_ID_Local'];
    } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
      $idEquipeGagnanteDemiDeux = $valeur['FK_ID_Visiteur'];
    }
  }

  $insertFinale = $bdd->query("SET NAMES 'utf8'");
  $insertFinale = $bdd->query("INSERT INTO `matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('2022-09-24','16:00:00','16:21:00','11','Finale','4','2','$idEquipeGagnanteDemiUne','$idEquipeGagnanteDemiDeux', null,'$id_tournoi','1','1')");
}
