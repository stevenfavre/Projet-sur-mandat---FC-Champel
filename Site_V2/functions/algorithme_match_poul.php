<?php
require_once "steven_fonctions.php";
require_once "dbconnection.php";
require_once "debug.php";

session_start();

creerMatchPoul();

function creerMatchPoul()
{
    $id_tournoi = $_POST['id_tournoi'];
    $tournoi = selectTournoiWithID($id_tournoi);

    $time_debut = $_POST['time-debut'];

    $futur_debut = forMatchPoul($_SESSION['GroupeUn'], $tournoi, $time_debut);
    $futur_debut = forMatchPoul($_SESSION['GroupeDeux'], $tournoi, $futur_debut);
    $futur_debut = forMatchPoul($_SESSION['GroupeTrois'], $tournoi, $futur_debut);
    $futur_debut = forMatchPoul($_SESSION['GroupeQuatre'], $tournoi, $futur_debut);
}

function forMatchPoul($groupe, $tournoi, $time_debut = "08:00:00")
{
    $time_match = $_POST['time-match'];
    $time_pause = $_POST['time-pause'];
    $time_calcul = $time_debut;

    $time_fin = calculerIntervalTemps($time_debut, 0, $time_match);
    sqlMatchPoul($tournoi, $groupe[0][0], $groupe[1][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);

    $time_debut = calculerIntervalTemps($time_fin, 0, $time_match * 3 + $time_pause * 3);
    $time_fin = calculerIntervalTemps($time_fin, 0, $time_match * 4 + $time_pause * 3);
    sqlMatchPoul($tournoi, $groupe[2][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";

    $time_debut = calculerIntervalTemps($time_fin, 0, $time_match * 3 + $time_pause * 3);
    $time_fin = calculerIntervalTemps($time_fin, 0, $time_match * 4 + $time_pause * 3);
    sqlMatchPoul($tournoi, $groupe[0][0], $groupe[2][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";


    $time_debut = calculerIntervalTemps($time_fin, 0, $time_match * 3 + $time_pause * 3);
    $time_fin = calculerIntervalTemps($time_fin, 0, $time_match * 4 + $time_pause * 3);
    sqlMatchPoul($tournoi, $groupe[1][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";

    $time_debut = calculerIntervalTemps($time_fin, 0, $time_match * 3 + $time_pause * 3);
    $time_fin = calculerIntervalTemps($time_fin, 0, $time_match * 4 + $time_pause * 3);
    sqlMatchPoul($tournoi, $groupe[0][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";

    $time_debut = calculerIntervalTemps($time_fin, 0, $time_match * 3 + $time_pause * 3);
    $time_fin = calculerIntervalTemps($time_fin, 0, $time_match * 4 + $time_pause * 3);
    sqlMatchPoul($tournoi, $groupe[1][0], $groupe[2][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);

    return calculerIntervalTemps($time_calcul, 0, $time_match + $time_pause);
}

function sqlMatchPoul($tournoi, $equipe1, $equipe2, $heure_debut, $heure_fin, $groupe = null, $terrain = 1)
{
    // Code permettant de récupérer les minutes du temps
    $to_time = strtotime($heure_fin);
    $from_time = strtotime($heure_debut);
    $minutes = round(abs($to_time - $from_time) / 60, 2);

    try {
        $db = connectDB();
        $sql = "INSERT INTO `Matchs` (`ID_Match`, `Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`)
        VALUES (NULL,  '" . $tournoi[0]['Date_Debut_Tournoi'] . "', '$heure_debut', '$heure_fin', '$minutes', 'Poule', '0', '0' , '" . $equipe1['ID_Equipe'] . "', '" . $equipe2['ID_Equipe'] . "', '$groupe', '" . $tournoi[0]['ID_Tournoi'] . "',  '$terrain', 1);";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function calculerIntervalTemps($temps = "08:00:00", $heure = 0, $minutes = 10)
{
    // Séparation du temps en différentes variables
    $temps_string = explode(":", $temps);
    $total_heures = $temps_string[0] + $heure;
    $total_minutes = $temps_string[1] + $minutes;
    $total_secondes = $temps_string[2];

    if ($total_minutes / 60 > 1) {
        $total_heures = $total_heures + floor($total_minutes / 60);
        $total_minutes = $total_minutes % 60;
    }

    if ($total_heures < 10)
        $total_heures = "0" . $total_heures;

    if ($total_minutes < 10)
        $total_minutes = "0" . $total_minutes;

    $temps_final = $total_heures . ":" . $total_minutes . ":" . $total_secondes;

    return $temps_final;
}

header("Location:../match.php?id_tournoi=$id_tournoi");
