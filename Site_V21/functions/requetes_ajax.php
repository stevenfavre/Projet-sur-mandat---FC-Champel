<?php

include_once('dbconnection.php');

//il s'agit d'ûne requête qui va chercher le nom et le logo du club en fonction de son Id qui est appelé dans mon formulaire de modification des clubs dans la partie ajax et Java Scrpit.
$IdClub = filter_input(INPUT_GET, "IdClub", FILTER_UNSAFE_RAW);

$bdd = connectDB();
$reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
$reponseDesClubs = $bdd->query("SELECT `Nom_Club`, `Url_Image_Club` FROM `Club` WHERE `ID_Club` = '$IdClub'");

echo json_encode($reponseDesClubs->fetch());
