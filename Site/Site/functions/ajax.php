<?php

include_once('dbconnection.php');

$IdInscriptionTournois = filter_input(INPUT_GET, "FK_ID_Equipe");
$bdd = connectDB();
$reponseIns = $bdd->query("SET NAMES 'utf8'");
$reponseIns = $bdd->query("SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE  FK_ID_Equipe = '$IdInscriptionTournois'");
/* $reponseIns = $bdd->query("SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE  FK_ID_Equipe = '$IdInscriptionTournois'"); */


echo json_encode($reponseIns->fetch());
