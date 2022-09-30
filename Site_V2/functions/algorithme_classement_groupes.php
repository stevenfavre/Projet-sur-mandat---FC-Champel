<?php
require_once "dbconnection.php";
require_once "debug.php";

// Définition de la constant concernant le nombre d'équipe idéal dans un groupe
define("NB_PREMIERES_EQUIPES", 2);
define("NB_GROUPE_PARFAIT", 4);

//creerclassementGroupes($id_tournoi);

// Fonction répartissant les groupes dans les classements finales 

function affichageGroupes($tournoi)
{
    foreach (selectionnerGroupeTous($tournoi) as $groupes) {
        echo "<a href=\"classement_tournoi.php?id_groupe=" . $groupes['ID_Groupe'] . "\">";
        echo "<ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . contientNomGroupe($groupes['ID_Groupe']) . "</h5></a></ul>";
    }
}

function affichageResulatsEquipes($id_groupe)
{

    //echo $id_groupe . ' ';
    echo "<h2 class=\"fw-bold text-success mb-2\">" . contientNomGroupe($id_groupe) . "  " . "<i class=\"fa-regular fa-calendar-days\"></i></h2>";
    echo "</br></br>";
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts  " . "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Points</h5></ul></td></tr>";

    foreach (selectionnerMatchsGroupe($id_groupe) as $matchs) {
        //echo $matchs['ID_Match'] . '<br>';

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

function remttreZero()
{

    try {
        $id_groupe = $_GET['id_groupe'];

        $db = connectDB();
        $sql = "UPDATE Equipe SET Points_Equipe = 0 WHERE FK_ID_Groupe = " . $id_groupe;
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}



function selectionnerMatchs($id_tournoi)
{
    try {
        $db = connectDB();

        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $id_tournoi . " ORDER BY `Date_Match`, `Heure_Debut_Match` ASC";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsGroupe($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM Matchs WHERE FK_ID_Groupe = $id_groupe";
        /*$sql = "SELECT e.Nom_Equipe, g.Nom_Groupe, t.Date_Debut_Tournoi, Heure_Debut_Match FROM `Matchs` AS m 
        JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe 
        JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe 
        JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi  
        WHERE `FK_ID_Groupe` = " . $id_groupe . ";";*/
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchID($id_match)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE `ID_Match` = " . $id_match . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function contientNomGroupe($id_groupe)
{
    $nom = "Non existant";
    foreach (selectionnerGroupe($id_groupe) as $groupe) {
        $nom = $groupe['Nom_Groupe'];
    }
    return $nom;
}

function selectionnerGroupe($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Groupe` WHERE `ID_Groupe` = " . $id_groupe . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerGroupeTous($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Groupe`";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerGroupeTournoi($tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Match` WHERE `FK_ID_Tournoi` = " . $tournoi . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}


function contientNomEquipe($id_equipe)
{
    $nom = "Non existant";
    foreach (selectionneEquipeID($id_equipe) as $equipe) {
        $nom = $equipe['Nom_Equipe'];
    }
    return $nom;
}

function contientPointsEquipe($id_equipe)
{
    $nom = "Non existant";
    foreach (selectionneEquipeID($id_equipe) as $equipe) {
        $nom = $equipe['Points_Equipe'];
    }
    return $nom;
}


// Permet de retourner les informations d'un equipe grâce à son id_equipe
function selectionneEquipeID($id_equipe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Equipe` WHERE `ID_Equipe` = " . $id_equipe . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Fonction qui permet de récupérer les équipes dans un tournoi en fonction du statut recherché
function getInscriptions($fk_id_tournoi, $statut)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Inscription_Tournoi` WHERE `FK_ID_Tournoi` = " . $fk_id_tournoi . " AND Statut_Inscription_Tournoi = '" . $statut . "';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\" Select des inscriptions des équipes du tournoi du id : " . $fk_id_tournoi . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}
