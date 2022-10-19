<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');
$id_tournoi = $_GET['id_tournoi'];
$bdd = connectDB();
$sql = "INSERT INTO Inscription_Tournoi FROM `Equipe` WHERE ID_Equipe not in (SELECT FK_ID_Equipe 
FROM Inscription_Tournoi WHERE FK_ID_Tournoi = $id_tournoi AND Statut_Inscription_Tournoi = 'validé');";
$request = $bdd->prepare($sql);
$request->execute();
header('Location:inscription_equipe.php?id_tournoi=' . $id_tournoi);
