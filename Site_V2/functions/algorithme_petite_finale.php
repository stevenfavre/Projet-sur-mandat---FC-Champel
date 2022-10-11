<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_demi_finale.php');
//require_once('algorithme_groupe.php');

$id_tournoi = $_GET["id_tournoi"];

$demiUn = $allDemi[0];
$demiDeux = $allDemi[1];

function createMatch3eEt4ePlace($id_tournoi, $demiUn, $demiDeux, $dateTournoi, $heureDebut23, $heureFin23)
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
  VALUES ('$dateTournoi','$heureDebut23','$heureFin23','11','Petite finale','4','2','$idEquipePerdanteDemiUne','$idEquipePerdanteDemiDeux', null,'$id_tournoi','1','1')");
}

createMatch3eEt4ePlace($id_tournoi, $demiUn, $demiDeux, $dateTournoi, $heureDebut23, $heureFin23);