<?php
require_once "dbconnection.php";
require_once "debug.php";



// Fonction répartissant les groupes dans les classements finales 
function affichageGroupes($tournoi)
{
    echo  "<table class=\"table table-bordered\"><thead class=\"thead\"><tr>
    <tr>
            <th scope=\"col\"><CENTER><h5 class=\"fw-bold text-success mb-2\"> Détails  " . "</h5></CENTER></th>
            <th scope=\"col\"><CENTER><h5 class=\"fw-bold text-success mb-2\"> Classement  " . "</h5></CENTER></th>
    </tr> 
    </thead>";

    foreach (selectionnerTousLesGroupes($tournoi) as $groupes) {
        echo "<td><ul><CENTER><h5 class=\"fw-bold\">" . "<a href=\"classement_tournoi.php?id_groupe=" . $groupes['ID_Groupe'] . "\">" . $groupes['Nom_Groupe'] . "</a></CENTER></h5></ul></td>";
        $q = 1;
        $id_groupe = $groupes['ID_Groupe'];
        $monTableauToutBeau = array();
        $db = connectDB();
        $req = "SELECT DISTINCT  e.Nom_Equipe, e.Points_Equipe, g.Nom_Groupe
                  FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
                  JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe 
                  WHERE  m.FK_ID_Groupe = $id_groupe AND m.FK_ID_Tournoi = $tournoi  ORDER BY e.Points_Equipe DESC ";


        foreach ($db->query($req) as $row) {
            $monTableauToutBeau[] = $row['Nom_Equipe'];
            $monTableauToutBeau[] = $row['Points_Equipe'];
        }
        echo "<td><ul><h5 class=\"fw-bold\">" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i>" .
            " " .  $monTableauToutBeau[0];
        echo "     |    " . $monTableauToutBeau[1];
        echo " points " . "</h5>";

        echo "<h5 class=\"fw-bold\">" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i>" .
            "  " . $monTableauToutBeau[2];
        echo "     |     " . $monTableauToutBeau[3];
        echo " points " . "</h5></ul></td></tr>";
    }
    echo " </table>";
}

function affichageResulatsToutesEquipes($id_tournoi)
{
    foreach (selectionnerMatchsGroupeTous($id_tournoi) as $matchs) {
        if ($matchs['But_Local_Match'] > $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . calculerPointsLocal($matchs['FK_ID_Local']) .  "</h5>";
        elseif ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . calculerPointsVisiteur($matchs['FK_ID_Visiteur']) .  "</h5>";
        elseif ($matchs['But_Local_Match'] == $matchs['But_Visiteur_Match'])
            echo  "<h5 class=\"fw-bold\">" . CalculerPointsNull($matchs['FK_ID_Local'], $matchs['FK_ID_Visiteur']) .  "</h5>";
    }
    header('Location:./classement_groupes.php?id_tournoi=' . $id_tournoi);
}
function affichageResultatGroupes($tournoi)
{
    foreach (selectionnerMatchsGroupeTournoi($tournoi) as $groupe) {
        echo "<td><ul><CENTER>" . $groupe['Nom_Equipe']  . "</ul></td>";
    }
}

function creerClassementGroupe($tournoi)
{
}

function affichageQuartFinal($tournoi)
{
    foreach (selectionnerMatchsQuarts($tournoi) as $matchs) {
        echo "<ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . contientMatch($matchs['ID_Match']) . "</h5></a></ul>";
    }
}

function affichageClassements($id_match)
{

    foreach (selectionnerGroupeTournoi($id_match) as $matchs) {
        echo "<tr><td><ul><h5 class=\"fw-bold\">"  .  $matchs['Type_Match'] . "</h5></ul></td></tr>";
    }
}

function affichageResulatsQuartsFinal($id_match)
{
    $hola = 1;
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Matchs " . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts " .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Victoires"  . "</h5></ul></td></tr>";
    foreach (selectionnerMatchsQuarts($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . "QUART " . $hola++   . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td></tr>";
        } else
            echo "<tr><td><ul><h5 class=\"fw-bold\">" . "QUART " . $hola++  . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5></ul></td></tr>";
    }
}

function affichageResulatsQuartsFinal1($tournoi)
{
    $EquipeGagnagte = 0;
    $EquipeGAGNATE = 0;

    foreach (selectionnerMatchsQuarts($tournoi) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {
            $EquipeGagnagte = $matchs['FK_ID_Local'];
        } else if ($matchs['But_Visiteur_Match'] > $matchs['But_Local_Match']) {
            $EquipeGAGNATE = $matchs['FK_ID_Visiteur'];
        }
    }
}

function affichageResulatsDemiFinal($id_match)
{
    $hola = 1;


    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Match " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Victoires " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td></tr>";
    foreach (selectionnerDemieFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match demi final " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td></tr>";
        } else
            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match demi final  " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5></ul></td></tr>";
    }
}

function affichageResulatsFinal($id_match)
{
    $hola = 1;


    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Match " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Victoires " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td></tr>";
    foreach (selectionnerFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match final " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td></tr>";
        } else
            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match final " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5></ul></td></tr>";
    }
}

function affichagePetiteFinal($id_match)
{
    $hola = 1;


    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Match " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipes " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Buts " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Victoires " .  "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td></tr>";
    foreach (selectionnerPetiteFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match petite finale " . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  .  contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></ul></td></tr>";
        } else
            echo "<tr><td><ul><h5 class=\"fw-bold\">" . $hola++  . " match petite finale " . "</h5></ul></td>
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
    echo "<tr><td><ul><CENTER><h5 class=\"fw-bold text-success mb-2\">CLASSEMENT" . "</h5>";
    foreach (selectionnerMatchsGroupe3($id_groupe) as $matchs) {
        echo  "<tr><td><CENTER><ul><h5 class=\"fw-bold\">" . $hola++ .
            "  " . "<i class=\"fa-solid fa-trophy\"></i></h5>" . " <h5>" .  $matchs['Nom_Equipe'] . " | Points " . $matchs['Points_Equipe']    .  "</h5></ul></td></tr>";
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

function selectionnerMatchsGroupeTous($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM Matchs WHERE Type_Match = 'Poule' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsGroupe($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM Matchs WHERE FK_ID_Groupe = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerMatchsGroupeTournoi($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT e.Nom_Equipe, MAX(e.Points_Equipe) , g.ID_Groupe,  g.Nom_Groupe, t.ID_Tournoi, Type_Match
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Tournoi as t ON t.ID_Tournoi = m.FK_ID_Tournoi
        WHERE  m.FK_ID_Groupe = $id_tournoi ";

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

function selectionnerTousLesGroupes()
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

function selectionnerMatch()
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` ";
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
        $sql = "SELECT DISTINCT e.Nom_Equipe, e.Points_Equipe, g.ID_Groupe, g.Nom_Groupe
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe AS  g ON g.ID_Groupe = m.FK_ID_Groupe
        JOIN Tournoi AS t ON t.ID_Tournoi = m.FK_ID_Tournoi

        WHERE m.FK_ID_Tournoi = $id_groupe AND Type_Match = 'Poule' ";

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
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Quart de finale ' ";

        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}



function selectionnerDemieFinal($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Demi finale' ORDER BY ID_Match ASC";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerFinal($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Finale' ORDER BY ID_Match ASC";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerPetiteFinal($id_groupe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Petite finale' ORDER BY ID_Match ASC";
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
        $sql = "SELECT DISTINCT Type_Match FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $tournoi . ";";
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
