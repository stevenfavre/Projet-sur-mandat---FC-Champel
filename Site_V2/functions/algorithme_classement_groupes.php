<?php
require_once "dbconnection.php";
require_once "debug.php";

// Fonction répartissant les groupes dans les classements finales 
function affichageGroupes($tournoi)
{
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\" id=\"h5Texte\">" . "TOUS LES GROUPES DU TOURNOI ---> " . "</h5></ul></td>";
    foreach (selectionnerGroupeTous($tournoi) as $groupes) {
        echo "<td><ul><a href=\"classement_tournoi.php?id_groupe=" . $groupes['ID_Groupe'] . "\">" . contientNomGroupe($groupes['ID_Groupe']) . "</a></ul></td>";
    }
}

function affichageQuartFinal($tournoi)
{
    foreach (selectionnerMatchsQuarts($tournoi) as $matchs) {
        echo "<ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . contientMatch($matchs['ID_Match']) . "</h5></a></ul>";
    }
}

function affichageResulatsQuartsFinal($id_match)
{
    $hola = 1;

    echo "<h2 class=\"fw-bold text-success mb-2\">" . contientMatch($id_match) . "  " . "<i class=\"fa-regular fa-calendar-days\"></i></h2>";
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Match " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Victoires " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td></tr>";
    foreach (selectionnerMatchsQuarts($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " quart de finale " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td></tr>";
        } else
            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " quart de finale " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5></ul></td></tr>";
    }
}


function affichageVictoiresQuartsFinal($id_match)
{
    $hola = 1;

    foreach (selectionnerMatchsGroupe2($id_match) as $matchs) {
        echo  "<tr> 
        <td><ul><h5 class=\"fw-bold\">" . $hola++  . " quart de finale " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['Nom_Equipe'] . "/" .  $matchs['Points_Equipe'] . "</h5></ul></td>
        </tr>";
    }
}

function affichageResulatsEquipes($id_groupe)
{
    $hola = 1;
    echo "<tr><td><ul><h2 class=\"fw-bold text-success mb-2\">" . contientNomGroupe($id_groupe) . "  " . "</h2></ul></td></tr>";
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\"><tr>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\">Match " . "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " . "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\">Buts " .  "<i class=\"fa-light fa-goal-net\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\">Points " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
          </tr>
        </thead>";
    foreach (selectionnerMatchsGroupe($id_groupe) as $matchs) {
        echo "<tbody>
          <tr>
            <th scope=\"row\"><h5 class=\"fw-bold\">" . "Numéro " . $hola++ . "</h5></th>
            <td><h5 class=\"fw-bold\">"  . contientNomEquipe($matchs['FK_ID_Local']) . "  vs  " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
            <td><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"fw-bold\">" . contientPointsEquipe($matchs['FK_ID_Local']) . " - " .  contientPointsEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
          </tr>";
    }
}

function affichageResulatsEquipes2($id_groupe)
{
    $hola = 1;
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">CLASSEMENT" . "</h5></ul></td></tr>";
    foreach (selectionnerMatchsGroupe3($id_groupe) as $matchs) {
        echo  "<td><ul><h5 class=\"fw-bold\">" . $hola++ .
            "<i class=\"fa-solid fa-trophy\"></i>" . " " . $matchs['Nom_Equipe'] . " | Points " . $matchs['Points_Equipe']    .  "</h5></ul></td>";
    }
}

function affichageGagnantes($id_groupe)

{
    foreach (selectionnerMatchsGroupe2($id_groupe) as $matchs) {
        echo  "<td><ul><h5 class=\"fw-bold\">" .
            "<i class=\"fa-solid fa-trophy\"></i>" . " " . selectionnerEquipesGagnantes($matchs['ID_Groupe'])  . " points" .  "</h5></ul></td>";
    }
}

function affichageResulatsEquipes1($id_groupe)
{
    foreach (selectionnerMatchsGroupe($id_groupe) as $matchs) {
        if ($matchs['But_Local_Match'] > $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . calculerPointsLocal($matchs['FK_ID_Local']) .  "</h5>";
        elseif ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . calculerPointsVisiteur($matchs['FK_ID_Visiteur']) .  "</h5>";
        elseif ($matchs['But_Local_Match'] == $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . CalculerPointsNull($matchs['FK_ID_Local'], $matchs['FK_ID_Visiteur']) .  "</h5>";
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

        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $id_tournoi . " ";
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
        $sql = "SELECT * FROM Matchs WHERE FK_ID_Groupe = " . $id_groupe . "";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsGroupe2($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT  e.Nom_Equipe, e.Points_Equipe, g.Nom_Groupe, Type_Match
        FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe
          
        WHERE  Type_Match = 'Quart de final' ORDER BY e.Points_Equipe DESC ";

        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsGroupe3($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT  e.Nom_Equipe, e.Points_Equipe, g.Nom_Groupe
        FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe
        WHERE  m.FK_ID_Groupe = $id_groupe  ORDER BY e.Points_Equipe DESC ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerMatchsGroupe4($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT  e.Nom_Equipe, e.Points_Equipe, g.Nom_Groupe
        FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe ORDER BY e.Points_Equipe DESC ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerEquipesGagnantes($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT MAX(Points_Equipe) FROM Equipe WHERE FK_ID_Groupe = $id_groupe ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsGroupe1($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT ID_Match FROM  Matchs WHERE FK_ID_Groupe = $id_groupe";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->rowCount(PDO::FETCH_ASSOC);
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

function contientMatch($id_groupe)
{
    $nom = "Non existant";
    foreach (selectionnerMatch() as $groupe) {
        $nom = $groupe['Type_Match'];
    }
    return $nom;
}

function contientHeureMatch($id_groupe)
{
    $h = "Non existant";
    foreach (selectionnerMatchsGroupe($id_groupe) as $groupe) {
        $h = $groupe['Heure_Debut_Match'];
    }
    return $h;
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

function selectionnerMatch()
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Quart de finale' ";
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
        $sql = "SELECT *  FROM `Groupe`";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsQuarts($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Quart de finale' ORDER BY ID_Match ASC";
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
        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $tournoi . ";";
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
    foreach (selectionneEquipe($id_equipe) as $equipe) {
        $nom = $equipe['Points_Equipe'];
    }
    return $nom;
}


// Permet de retourner les informations d'un equipe grâce à son id_equipe
function selectionneEquipeID($id_equipe)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT Nom_Equipe FROM Equipe WHERE `ID_Equipe` = " . $id_equipe . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionneEquipe($id_equipe)
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
