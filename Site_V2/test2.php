<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');

$id_groupe = $_GET['id_groupe'];

$db = connectDB();
$sql = "UPDATE Equipe SET Points_Equipe = 0 WHERE FK_ID_Groupe = " . $id_groupe;
$request = $db->prepare($sql);
$request->execute();

function calculerPointsLocal($id_equipe)
{
    $db = connectDB();
    $sql = 'UPDATE Equipe SET Points_Equipe = Points_Equipe + 3 WHERE ID_Equipe =' . $id_equipe;
    $request = $db->prepare($sql);
    $request->execute();
}

function calculerPointsVisiteur($id_equipe)
{

    try {
        $db = connectDB();
        $sql = "UPDATE Equipe SET Points_Equipe = Points_Equipe + 3 WHERE ID_Equipe = " . $id_equipe . ";";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function calculerPointsNull($id_equipe, $id_equipe2)
{

    try {
        $db = connectDB();
        $sql = "UPDATE Equipe SET Points_Equipe = Points_Equipe + 1 WHERE ID_Equipe = " . $id_equipe;
        $request = $db->prepare($sql);
        $request->execute();
        $sql1 = "UPDATE Equipe SET Points_Equipe = Points_Equipe + 1 WHERE ID_Equipe = " . $id_equipe2;
        $request1 = $db->prepare($sql1);
        $request1->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}


function affichagePointsEquipes($id_groupe)
{

   
    echo "<h2 class=\"fw-bold text-success mb-2\">" . contientNomGroupe($id_groupe) . "  " . "<i class=\"fa-regular fa-calendar-days\"></i></h2>";
    echo "</br></br>";
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Points</h5></ul></td></tr>";

    foreach (selectionnerMatchsGroupe($id_groupe) as $matchs) {
    

        if ($matchs['But_Local_Match'] > $matchs['But_Visiteur_Match'])
            echo  "<tr> 
        <td><ul><h5 class=\"fw-bold\">"  . contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . "/" .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">" .  contientPointsEquipe($matchs['FK_ID_Local']) . " - " .  contientPointsEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $matchs['FK_ID_Local'] .  "-modifierL-" . $matchs['FK_ID_Groupe'] . "\"> Calculer Points</button></ul></td></tr>";
        //<td><ul><button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $matchs['FK_ID_Local'] .  "-modifierL\"> Calculer Points</button></ul></td></tr>";
        elseif ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match'])
            echo  "<tr>
        <td><ul><h5 class=\"fw-bold\">" .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">" .  $matchs['But_Local_Match'] . "/" .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
       <td><ul><h5 class=\"fw-bold\">" . contientPointsEquipe($matchs['FK_ID_Local']) . " - " .  contientPointsEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
       <td><ul><button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $matchs['FK_ID_Visiteur'] . "-modifierV-" .  $matchs['FK_ID_Groupe'] . "\"> Calculer Points</button></ul></td></tr>";
        elseif ($matchs['But_Local_Match'] == $matchs['But_Visiteur_Match'])
            echo  "<tr>
       
        <td><ul><h5 class=\"fw-bold\">" .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">" .  $matchs['But_Local_Match'] . "/" .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">" .  contientPointsEquipe($matchs['FK_ID_Local']) . " - " .  contientPointsEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>

        <td><ul><button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $matchs['FK_ID_Local'] . "-modifierA-" .  $matchs['FK_ID_Groupe'] . "-" . $matchs['FK_ID_Visiteur'] . "\"> Calculer Points</button></ul></td></tr>";
    }
}

header('Location:classement_tournoi.php?id_groupe='.$id_groupe);