<?php

include_once('dbconnection.php');

$nomEquipe = filter_input(INPUT_GET, "nomEquipe", FILTER_UNSAFE_RAW);

$bdd = connectDB();
$reponseDesEquipe = $bdd->query("SET NAMES 'utf8'");
$reponseDesEquipe = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `equipe` WHERE `Nom_Equipe` = '$nomEquipe'");

echo json_encode($reponseDesEquipe->fetch());
