<?php
session_start(['cookie_lifetime' => 3600,]);

// Fonction permettant de faire la connection à la base de donnée
function insertion_tournoi($Date_debut, $Date_fin, $Fk_ID_Salle)
{
    try {
        $bdd = connectDB();
        $reponse = $bdd->query("SET NAMES 'utf8'");
        $reponse = $bdd->query("INSERT INTO `tournoi` (`ID_Tournoi`, `Date_Debut_Tournoi`, `Date_Fin_Tournoi`, `FK_ID_Salle`) VALUES (NULL, '" . $Date_debut . "', '" . $Date_fin . "', '" . $Fk_ID_Salle . "')");

        echo "L'insertion a été correctement réalisée.<br><br>";
        echo "Que voulez-vous faire maintenant?<br>";
    } catch (\Throwable $th) {
        //throw $th;
        echo "<script> alert(\"Insertion raté ! \");</script>";
    }

    return null;
}
function selection_salle_tournoi($ID_Salle)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Salle ORDER BY ID_Salle ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Salle'] . "'>" . $donnees['ID_Salle'] . "</option>";
    }

    $bdd = null;
}

function selection_tournoi($IdTournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi ORDER BY ID_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . $donnees['ID_Tournoi'] . "</option>";
    }

    $bdd = null;
}


function update_tournoi($IdTournoi, $Date_debut, $Date_fin, $Fk_ID_Salle)
{

    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE `tournoi` SET Date_Debut_Tournoi = '$Date_debut', Date_Fin_Tournoi = '$Date_fin', FK_ID_SALLE = '$Fk_ID_Salle' WHERE  `tournoi`.`ID_Tournoi` = '$IdTournoi'");
    echo "Le tournoi a bien été modifié.";
    echo "<br /><br />";
    echo "<a href='messages.php'>Retour à la page d'accueil...</a>";
    return null;
}


function afficher_infos_equipes_inscrites($Num)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Statut_Inscription_Tournoi  FROM `inscription_tournoi` AS i JOIN equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $Num;
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
function update_equipes_du_tournoi($IdTournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM inscription_tournoi ORDER BY ID_Inscription_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Inscription_Tournoi'] . "'>" . $donnees['Statut_Inscription_Tournoi'] . "</option>";
    }

    $bdd = null;
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

function afficher_tournoi()
{

    $bdd = connectDB();

    $reponse = $bdd->query("SELECT * FROM tournoi");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    $donneesTournois = $reponse->fetch();
    return $donneesTournois;
}

function inscription_equipe_tournoi($FK_ID_Tournoi, $FK_ID_Equipe)
{
    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");
    $reponse = $bdd->query("INSERT INTO `inscription_tournoi` (`ID_Inscription_Tournoi`, `Date_Inscription_Tournoi`, `Statut_Inscription_Tournoi`, `FK_ID_Tournoi`, `FK_ID_Equipe`) VALUES (NULL, '" . date('y-m-d') . "', 'En attente', '" . $FK_ID_Tournoi . "', '" . $FK_ID_Equipe . "')");

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
function selection_equipe_incription($IdTournoi)
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
