<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_demi_finale.php');


$id_tournoi = $_GET["id_tournoi"];

$demiUn = $allDemi[0];
$demiDeux = $allDemi[1];


function createFinale($id_tournoi, $demiUn, $demiDeux, $dateTournoi, $heureDebut24, $heureFin24)
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

createFinale($id_tournoi, $demiUn, $demiDeux, $dateTournoi, $heureDebut24, $heureFin24);
