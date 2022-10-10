<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
include('algorithme_quart_finale.php');

//require_once('algorithme_groupe.php');

$id_tournoi = $_GET["id_tournoi"];

$quartUn = $allTournois[0];
$quartDeux = $allTournois[1];
$quartTrois = $allTournois[2];
$quartQuatre = $allTournois[3];


function createMatch5A8ePlace($id_tournoi, $quartUn, $quartDeux, $quartTrois, $quartQuatre, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20)
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
  VALUES ('$dateTournoi', '$heureDebut18', '$heureFin18','11','PerdantsQuartDeux','4','2','$idEquipePerdanteTrois','$idEquipePerdanteQuatre', null,'$id_tournoi','1','1')");


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
   VALUES ('$dateTournoi', '$heureDebut19', '$heureFin19','11','Match_5Et6_place','4','2','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','1','1')");

    $insertMatch7e8ePlace = $bdd->query("SET NAMES 'utf8'");
    $insertMatch7e8ePlace = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi', '$heureDebut20', '$heureFin20','11','Match_7Et8_place','4','2','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','1','1')");
}


createMatch5A8ePlace($id_tournoi, $quartUn, $quartDeux, $quartTrois, $quartQuatre, $dateTournoi, $heureDebut17, $heureFin17, $heureDebut18, $heureFin18, $heureDebut19, $heureFin19, $heureDebut20, $heureFin20);
