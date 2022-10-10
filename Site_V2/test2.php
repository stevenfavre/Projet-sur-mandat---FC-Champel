<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');
$id_tournoi = $_GET['id_tournoi'];
$db = connectDB();
$sql = "UPDATE Equipe SET Points_Equipe = 0 ";
$request = $db->prepare($sql);
$request->execute();
header('Location:classement_groupes1.php?id_tournoi=' . $id_tournoi);
