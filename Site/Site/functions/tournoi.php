<?php
session_start(['cookie_lifetime' => 3600,]);

// Fonction permettant de faire la connection à la base de donnée
function insertion_tournoi($Date_debut, $Date_fin, $Fk_ID_Salle)
{
    try {
        $bdd = connectDB();
        $reponse = $bdd->query("SET NAMES 'utf8'");
        $reponse = $bdd->query("INSERT INTO Tournoi (`ID_Tournoi`, `Date_Debut_Tournoi`, `Date_Fin_Tournoi`, `FK_ID_Salle`) VALUES (NULL, '" . $Date_debut . "', '" . $Date_fin . "', '" . $Fk_ID_Salle . "')");

        echo "L'insertion a été correctement réalisée.<br><br>";
        echo "Que voulez-vous faire maintenant?<br>";
    } catch (\Throwable $th) {
        //throw $th;
        echo "<script> alert(\"Insertion raté ! \");</script>";
    }

    return null;
}

function afficher_infos_tournois()
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = ("SELECT s.Nom_Salle, t.Date_Debut_Tournoi, t.Date_Fin_Tournoi, t.Actif_Tournoi FROM Tournoi AS t JOIN Salle AS s ON s.ID_Salle = t.FK_ID_Salle WHERE t.Actif_Tournoi = '1' ");
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Date_Debut_Tournoi'] . "</ul></td>
        <td><ul>" . $data['Date_Fin_Tournoi'] .  "</ul></td>
        <td><ul>" .  $data['Nom_Salle'] . "</ul></td></tr>";
    }
    return null;
}

function selection_salle_tournoi()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Salle ORDER BY ID_Salle ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Salle'] . "'>" . $donnees['Nom_Salle'] . "</option>";
    }

    $bdd = null;
}
function selection_degre_equipe()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Equipe ORDER BY ID_Equipe ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Degres_Equipes'] . "</option>";
    }

    $bdd = null;
}

function selection_tournoi()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi WHERE Actif_Tournoi = '1' ORDER BY ID_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . $donnees['Date_Debut_Tournoi'] . "</option>";
    }

    $bdd = null;
}

function update_tournoi($IdTournoi, $Date_debut, $Date_fin, $Fk_ID_Salle)
{

    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Date_Debut_Tournoi = '$Date_debut', Date_Fin_Tournoi = '$Date_fin', FK_ID_SALLE = '$Fk_ID_Salle' WHERE ID_Tournoi = '$IdTournoi'");

    return null;
}


function afficher_infos_equipes_inscrites($Num)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $Num;
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul>" . $data['Nom_Club'] . "</ul></td>
        <td><ul>" . $data['Nom_Groupe'] . "</ul></td>
        <td><ul>" .  $data['Statut_Inscription_Tournoi'] . "</ul></td></tr>";
    }
    return null;
}
function afficher_infos_equipes_inscrites_modif()
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = 3 ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul>" . $data['Nom_Club'] . "</ul></td>
        <td><ul>" . $data['Nom_Groupe'] . "</ul></td> 

        ";
        if ($data['Statut_Inscription_Tournoi'] == "En attente") {
            echo "<td><ul><select name=\"Statut\" id=\"s\"><option valeur=\"ena\" selected>En attente</option>";
            echo "<option valeur=\"val\">Validée</option>
            <option valeur=\"ref\">Refusée</option>
            </select></ul></td></tr>";
        } else {
            echo "<td><ul>" . $data['Statut_Inscription_Tournoi'] . "</ul></td></tr>";
        }
    }
    return null;
}
function selectionner_noms_equipes_inscrites()
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = 3 ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {

        /* echo $data['Nom_Equipe']; */
        echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
    }
    /* echo '</select>'; */
    return null;
}

function afficher_infos_equipes_selectionnee()
{
    $IdInscriptionTournois = $_POST['FK_ID_Equipe'];

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Equipe = '$IdInscriptionTournois'";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul>" . $data['Nom_Club'] . "</ul></td>
        <td><ul>" . $data['Nom_Groupe'] . "</ul></td> 

        ";
        if ($data['Statut_Inscription_Tournoi'] == "En attente") {
            echo "<td><ul><select name=\"Statut\" id=\"s\"><option valeur=\"ena\" selected>En attente</option>";
            echo "<option valeur=\"val\">Validée</option>
            <option valeur=\"ref\">Refusée</option>
            </select></ul></td></tr>";
        } else {
            echo "<td><ul>" . $data['Statut_Inscription_Tournoi'] . "</ul></td></tr>";
        }
    }
    return null;
}

function update_statut_equipes_tournoiTst()

{
    $IdInscriptionTournois = $_POST['FK_ID_Equipe'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Inscription_Tournoi SET Statut_Inscription_Tournoi  = 'Validé' WHERE FK_ID_Equipe = '$IdInscriptionTournois'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
    }
    return null;
}

function afficher_degres_equipes_inscrites($Num)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $Num;
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Degres_Equipe'] . "</ul></td></tr>";
    }
    return null;
}
function afficher_clubs_equipes_inscrites($Num)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $Num;
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Nom_Club'] . "</ul></td></tr>";
    }
    return null;
}
function afficher_groupes_equipes_inscrites($Num)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $Num;
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . $data['Nom_Groupe'] . "</ul></td></tr>";
    }
    return null;
}

function update_equipes_du_tournoi()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Inscription_Tournoi ORDER BY ID_Inscription_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Inscription_Tournoi'] . "'>" . $donnees['FK_ID_Equipe'] . "</option>";
    }

    $bdd = null;
}




function update_suppresion_logique()
{

    $IdTournoi = $_POST['ID_Tournoi'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Actif_Tournoi = 0 WHERE ID_Tournoi = '$IdTournoi'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);
}




function delete_tournoi($idTournoi)
{
    $idTournoi = $_POST['ID_Tournoi'];

    $bdd = connectDB();
    $reponseClient = $bdd->query("SET NAMES 'utf8'");
    $reponseClient = $bdd->query("DELETE FROM Tournoi WHERE ID_Tournoi = '$idTournoi'");

    echo "Le tournoi a bien été supprimé.";
    echo "<br /><br />";
    echo "<a href='messages.php'>Retour à la page d'accueil...</a>";
    return null;
}



function inscription_equipe_tournoi($FK_ID_Tournoi, $FK_ID_Equipe)
{
    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");
    $reponse = $bdd->query("INSERT INTO Inscription_Tournoi (`ID_Inscription_Tournoi`, `Date_Inscription_Tournoi`, `Statut_Inscription_Tournoi`, `FK_ID_Tournoi`, `FK_ID_Equipe`) VALUES (NULL, '" . date('y-m-d') . "', 'En attente', '" . $FK_ID_Tournoi . "', '" . $FK_ID_Equipe . "')");

    echo "L'insertion a été correctement réalisée.<br><br>";
    echo "Que voulez-vous faire maintenant?<br>";

    return null;
}
function selection_tournoi_incription($IdTournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi ORDER BY Date_Debut_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . $donnees['Date_Debut_Tournoi'] . "</option>";
    }

    $bdd = null;
}
function selection_equipe_incription()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Equipe ORDER BY Nom_Equipe ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}
