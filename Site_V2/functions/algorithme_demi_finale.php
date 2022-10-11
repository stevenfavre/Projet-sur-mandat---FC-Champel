<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_quart_finale.php');
//require_once('algorithme_groupe.php');


$id_tournoi = $_GET["id_tournoi"];


$dateTournoi = getDateTournoi($id_tournoi);

$quartUn = $allTournois[0];
$quartDeux = $allTournois[1];
$quartTrois = $allTournois[2];
$quartQuatre = $allTournois[3];


function createDemiFinale($id_tournoi, $quartUn, $quartDeux, $quartTrois, $quartQuatre, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22)
{

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

    $insertDemiUne = insertDemi($dateTournoi, $heureDebut21, $heureFin21, "2", "0", $idEquipeGagnanteUne, $idEquipeGagnanteDeux, $id_tournoi);
    $insertDemiDeux = insertDemi($dateTournoi, $heureDebut22, $heureFin22, "2", "1", $idEquipeGagnanteTrois, $idEquipeGagnanteQuatre, $id_tournoi);

    $demiUne = getDemi($insertDemiUne);
    $demideux = getDemi($insertDemiDeux);

    $allDemi = [$demiUne, $demideux];

    return $allDemi;
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

$allDemi = createDemiFinale($id_tournoi, $quartUn, $quartDeux, $quartTrois, $quartQuatre, $dateTournoi, $heureDebut21, $heureFin21, $heureDebut22, $heureFin22);


header("Location:../match.php?id_tournoi=$id_tournoi");