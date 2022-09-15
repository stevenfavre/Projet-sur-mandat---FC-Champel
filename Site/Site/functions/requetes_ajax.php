<?php

include_once('dbconnection.php');

$IdClub = filter_input(INPUT_GET, "IdClub", FILTER_UNSAFE_RAW);

$bdd = connectDB();
$reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
$reponseDesClubs = $bdd->query("SELECT `Nom_Club`, `Url_Image_Club` FROM `club` WHERE `ID_Club` = '$IdClub'");

echo json_encode($reponseDesClubs->fetch());
