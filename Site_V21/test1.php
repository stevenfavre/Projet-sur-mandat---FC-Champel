<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');
$id_groupe = $_GET['id_groupe'];
$id_tournoi = $_GET['id_tournoi'];
$db = connectDB();
$sql = "UPDATE Matchs
JOIN Equipe ON ID_Equipe = FK_ID_Local OR ID_Equipe =  FK_ID_Visiteur 
JOIN Tournoi ON ID_Tournoi = FK_ID_Tournoi
SET Points_Equipe = 0 WHERE FK_ID_Groupe =  $id_groupe AND FK_ID_Tournoi = $id_tournoi";
$request = $db->prepare($sql);
$request->execute();

header('Location:classement_tournoi.php?id_groupe=' . $id_groupe.'&id_tournoi='.$id_tournoi);
