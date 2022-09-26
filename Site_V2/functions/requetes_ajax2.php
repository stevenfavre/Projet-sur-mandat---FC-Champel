<?php

include_once('dbconnection.php');

//il s'agit d'ûne requête qui va chercher le nom et le degré de l'équipe en fonction de son Id qui est appelé dans mon formulaire de modification des équipes dans la partie ajax et Java Scrpit.
$idEquipe = filter_input(INPUT_GET, "nomEquipe", FILTER_UNSAFE_RAW);

$bdd = connectDB();
$reponseDesEquipe = $bdd->query("SET NAMES 'utf8'");
$reponseDesEquipe = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe`, `Nom_Groupe` FROM `equipe` JOIN `groupe` on FK_ID_Groupe = ID_Groupe WHERE `ID_Equipe` = '$idEquipe'");

echo json_encode($reponseDesEquipe->fetch());
