<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');

$id_tournoi = $_GET['id_tournoi'];


$bdd = connectDB();
$sql = "SELECT * FROM `Equipe` WHERE ID_Equipe not in (SELECT FK_ID_Equipe FROM Inscription_Tournoi WHERE FK_ID_Tournoi = $id_tournoi AND Statut_Inscription_Tournoi = 'validé');";
$request = $bdd->prepare($sql);
$request->execute();
$reponse = $request->fetchAll();

foreach ($reponse as $data) {
  inscription_equipe_tournoi($id_tournoi, $data['ID_Equipe']);
}
header("Location: modifier_equipe_tournoi.php?id_tournoi=" . $_SESSION['tournoi']['ID_Tournoi']);
