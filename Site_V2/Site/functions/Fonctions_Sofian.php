
<?php
include_once('dbconnection.php');
session_start(['cookie_lifetime' => 3600,]);

function insertion_equipes($nomEquipe, $degreEquipe, $FK_ID_Club, $FK_ID_Groupe)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("INSERT INTO `Equipe` (`ID_Equipe`, `Nom_Equipe`, `Degres_Equipe`, `FK_ID_Club`, `FK_ID_Groupe`) VALUES (NULL,'$nomEquipe', '$degreEquipe', '$FK_ID_Club', '$FK_ID_Groupe')");

    echo "<br /><br />";

    $bdd = null;
}

function modification_equipes($idEquipe, $nomEquipe, $degreEquipe)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("UPDATE `Equipe` SET `Nom_Equipe`='$nomEquipe',`Degres_Equipe`='$degreEquipe' WHERE `ID_Equipe` = $idEquipe");
}

function suppression_equipes($idEquipe)
{
    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("DELETE FROM `Equipe` WHERE ID_Equipe = '$idEquipe'");
}

function selection_equipe($idEquipe)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT * FROM Equipe ORDER BY ID_Equipe ASC");
    $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponseDesEquipes->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['ID_Equipe'] . "</option>";
    }

    $bdd = null;
}

function affichage_equipe()
{

    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `Equipe` WHERE 1");
    $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesEquipes = $reponseDesEquipes->fetch()) {

        echo "<br />";
        echo "Nom de l'équipe : " . $donneesDesEquipes['Nom_Equipe'];
        echo "<br />";
        echo "Degré de l'équipe (niveau) : " . $donneesDesEquipes['Degres_Equipe'];
        echo "<br />";
    }

    $bdd = null;
}

function insertion_club($nomClub, $urlImageClub, $FK_Id_Adresse)
{

    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("INSERT INTO `Club` (`ID_Club`, `Nom_Club`, `Url_Image_Club`, `FK_ID_Adresse`) VALUES (NULL,'$nomClub', '$urlImageClub', '$FK_Id_Adresse')");

    echo "<br /><br />";

    $bdd = null;
}

function modification_club($idClub, $nomClub, $urlImageClub)
{

    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Nom_Club` = '$nomClub', `Url_Image_Club` = ' $urlImageClub' WHERE `club`.`ID_Club` = '$idClub'");

    $bdd = null;
}

function suppression_club($idClub)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("DELETE FROM `Club` WHERE ID_Club = '$idClub'");
}

function selection_club($idClub)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT * FROM Club ORDER BY ID_Club ASC");
    $reponseDesClubs->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "<option value='" . $donneesDesClubs['ID_Club'] . "'>" . $donneesDesClubs['ID_Club'] . "</option>";
    }

    $bdd = null;
}

function affichage_logo()
{

    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT `Url_Image_Club`FROM `Club`");
    $reponseDesClubs->setFetchMode(PDO::FETCH_ASSOC);

    $donneesDesclubs = $reponseDesClubs->fetchAll();
    foreach ($donneesDesclubs as $donnees) {
        echo 'Logo <img style="height="200px" ; width="200px"" src="assets\img\team\\' . $donnees['Url_Image_Club'] . '" alt="' . $donnees['Url_Image_Club'] . '" ><br />';
    }

    $bdd = null;
}


?>