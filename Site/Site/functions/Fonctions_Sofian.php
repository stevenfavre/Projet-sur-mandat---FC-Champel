
<?php
include_once('dbconnection.php');
session_start(['cookie_lifetime' => 3600,]);

function insertion_equipes($nomEquipe, $degreEquipe, $idClub)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("INSERT INTO `Equipe` (`Nom_Equipe`, `Degres_Equipe`, `FK_ID_Club`) VALUES ('$nomEquipe', '$degreEquipe', '$idClub')");


    $bdd = null;
}


function modification_equipes($idEquipe, $nomEquipe, $degreEquipe, $actifEquipe)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("UPDATE `Equipe` SET `Nom_Equipe`='$nomEquipe',`Degres_Equipe`='$degreEquipe', `actif_Equipe`='$actifEquipe'  WHERE `ID_Equipe` = $idEquipe");
}

function afficher_info_equipe($nomEquipe)
{
    $bdd = connectDB();
    $reponseDesEquipe = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipe = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `Equipe` WHERE `Nom_Equipe` = '$nomEquipe'");

    while ($donneesDesEquipe = $reponseDesEquipe->fetch()) {
        echo "Nom club : " . $donneesDesEquipe['Nom_Club'];
        echo "<br /><br />";
        echo "Logo club : " . $donneesDesEquipe['Url_Image_Club'];
        echo "<br /><br />";
    }
}

function suppression_equipes($idEquipe)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Equipe` SET `Actif_equipe` = 0 WHERE `Equipe`. `ID_Equipe` = '$idEquipe'");
}


function selection_equipe()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT * FROM Equipe ORDER BY ID_Equipe ASC");
    $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponseDesEquipes->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}

function affichage_equipe()
{

    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `Equipe` WHERE `Actif_equipe` = 1");
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


function insertion_adresse_club($rueAdresse, $localiteAdresse, $npaAdresse)
{

    $bdd = connectDB();

    $reponseDesAdresses = $bdd->query("SET NAMES 'utf8'");
    $reponseDesAdresses = $bdd->query("INSERT INTO `Adresse`(`Rue_Adresse`, `Localite_Adresse`, `NPA_Adresse`) VALUES ('$rueAdresse','$localiteAdresse','$npaAdresse')");

    return $bdd->lastInsertId();

    $bdd = null;
}

function insertion_club($nomClub, $urlImageClub, $idAdresse)   /* soucres : https://stackoverflow.com/questions/45946593/getting-the-primary-key-id-of-the-last-inserted-row-to-run-multiple-insert-opera */
{

    $bdd = connectDB();


    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("INSERT INTO `Club` (`Nom_Club`, `Url_Image_Club`, `FK_ID_Adresse`) VALUES ('$nomClub', '$urlImageClub', '$idAdresse')");

    echo "<br /><br />";

    $bdd = null;
}


function modification_club($nomClub, $urlImageClub, $idClub, $actifClub)
{

    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Nom_Club` = '$nomClub', `Url_Image_Club` = '$urlImageClub', `Actif_club` = '$actifClub'  WHERE `club`.`ID_Club` = '$idClub'");

    $bdd = null;
}

function afficher_info_club($nomClub)
{
    $bdd = connectDB();
    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("SELECT `Nom_Club`, `Url_Image_Club` FROM `club` WHERE `Nom_Club` = '$nomClub'");

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "Nom club : " . $donneesDesClubs['Nom_Club'];
        echo "<br /><br />";
        echo "Logo club : " . $donneesDesClubs['Url_Image_Club'];
        echo "<br /><br />";
    }
}

function suppression_club($idClub)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Actif_club` = 0 WHERE `ID_Club` = '$idClub'");
}

function afficher_ClubActif()
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("SELECT `Nom_Club` FROM `Club` WHERE `Actif_club` = 1");

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "Nom club : " . $donneesDesClubs['Nom_Club'];
        echo "<br /><br />";
    }
}

function selection_club()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT * FROM Club ORDER BY ID_Club ASC");
    $reponseDesClubs->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "<option value='" . $donneesDesClubs['ID_Club'] . "'>" . $donneesDesClubs['Nom_Club'] . "</option>";
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
