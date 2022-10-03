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

    $futur_debut = forMatchPoul($_SESSION['GroupeUn'], $tournoi, $id_tournoi);
    $futur_debut = forMatchPoul($_SESSION['GroupeDeux'], $tournoi, $id_tournoi, $futur_debut);
    $futur_debut = forMatchPoul($_SESSION['GroupeTrois'], $tournoi, $id_tournoi, $futur_debut);
    $futur_debut = forMatchPoul($_SESSION['GroupeQuatre'], $tournoi, $id_tournoi, $futur_debut);
}

function forMatchPoul($groupe, $tournoi, $time_debut = null)
{

    if ($time_debut == null) {
        $time_debut = $_POST['time-debut'];
    }

    $time_match = strtotime($_POST['time-match']);
    $time_pause = strtotime($_POST['time-pause']);

    $time_fin = date('H:i:s', $_POST['time-match'] + $_POST['time-debut']);
    echo "<p>" . date('H:i:s', $_POST['time-debut']) . "</p>";
    //sqlMatchPoul($tournoi, $groupe[0][0], $groupe[1][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);

    $time_debut = strtotime('+' . ($time_pause * 3) + ($time_match * 3) . ' minutes', $time_fin);
    $time_fin = strtotime('+' . ($time_match * 4) + ($time_pause * 3) . ' minutes', $time_debut);
    //sqlMatchPoul($tournoi, $groupe[2][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";


    $time_debut = strtotime('+' . ($time_pause * 3) + ($time_match * 3) . ' minutes', $time_fin);
    $time_fin = strtotime('+' . ($time_match * 4) + ($time_pause * 3) . ' minutes', $time_debut);
    //sqlMatchPoul($tournoi, $groupe[0][0], $groupe[2][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";


    $time_debut = strtotime('+' . ($time_pause * 3) + ($time_match * 3) . ' minutes', $time_fin);
    $time_fin = strtotime('+' . ($time_match * 4) + ($time_pause * 3) . ' minutes', $time_debut);
    //sqlMatchPoul($tournoi, $groupe[1][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";


    $time_debut = strtotime('+' . ($time_pause * 3) + ($time_match * 3) . ' minutes', $time_fin);
    $time_fin = strtotime('+' . ($time_match * 4) + ($time_pause * 3) . ' minutes', $time_debut);
    //sqlMatchPoul($tournoi, $groupe[0][0], $groupe[3][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);
    //echo "<p>" . date('H:i:s', $time_debut) . "</p>";


    $time_debut = strtotime('+' . ($time_pause * 3) + ($time_match * 3) . ' minutes', $time_fin);
    $time_fin = strtotime('+' . ($time_match * 4) + ($time_pause * 3) . ' minutes', $time_debut);
    //sqlMatchPoul($tournoi, $groupe[1][0], $groupe[2][0], $time_debut, $time_fin, $groupe[0][0]['FK_ID_Groupe'], 1);

    return date('H:i:s', strtotime('+' . $time_match + $time_pause . ' minutes', $_GET['time_debut']));
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
        VALUES (NULL,  '" . $tournoi[0]['Date_Debut_Tournoi'] . "', '$heure_debut', '$heure_fin', '$minutes', 'Poul', '0', '0' , '" . $equipe1['ID_Equipe'] . "', '" . $equipe2['ID_Equipe'] . "', '$groupe', '" . $tournoi[0]['ID_Tournoi'] . "',  '$terrain', 1);";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
