<?php

include_once('dbconnection.php');

$idEquipe = filter_input(INPUT_GET, "nomEquipe", FILTER_UNSAFE_RAW);

$bdd = connectDB();
$reponseDesEquipe = $bdd->query("SET NAMES 'utf8'");
$reponseDesEquipe = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `equipe` WHERE `ID_Equipe` = '$idEquipe'");

echo json_encode($reponseDesEquipe->fetch());
