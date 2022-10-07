
<?php
include_once('dbconnection.php');
session_start(['cookie_lifetime' => 3600,]);


// Il s'agit d'une fonction qui va insérer les équipes que j'appel dans le formulaire d'insertion des équipes.  
function insertion_equipes($nomEquipe, $degreEquipe, $idClub)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("INSERT INTO `Equipe` (`Nom_Equipe`, `Degres_Equipe`, `FK_ID_Club`) VALUES ('$nomEquipe', '$degreEquipe', '$idClub')"); // sources : https://stackoverflow.com/questions/45946593/getting-the-primary-key-id-of-the-last-inserted-row-to-run-multiple-insert-opera


    $bdd = null;
}

// Il s'agit d'une fonction qui va les modifier le nom et degré des équipes que j'appel dans le formulaire de modification des équipes. 
function modification_equipes($idEquipe, $nomEquipe, $degreEquipe, $actifEquipe)
{

    $bdd = connectDB();

    $reponseDesEquipes = $bdd->query("SET NAMES 'utf8'");
    $reponseDesEquipes = $bdd->query("UPDATE `Equipe` SET `Nom_Equipe`='$nomEquipe',`Degres_Equipe`='$degreEquipe', `Actif_Equipe`='$actifEquipe'  WHERE `ID_Equipe` = $idEquipe");
}

// Il s'agit d'un fonction qui va va effectuer une suppression logique des équipes en selectionnant leur noms, le statut de l'équipe sera modifier en 0 et elle ne sera donc pas visible sur le site mais elle le sera encore dans la BDD. 
function suppression_equipes($idEquipe)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Equipe` SET `Actif_equipe` = 0 WHERE `Equipe`. `ID_Equipe` = '$idEquipe'");
}


// Il s'agit d'un fonction qui va mettre en place une liste déroulante dans le but de pouvoir sélectionner les équipes grâce à leurs noms.  
function selection_equipe()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT * FROM Equipe WHERE `Actif_equipe` = 1  ORDER BY ID_Equipe ASC");
    $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponseDesEquipes->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}

function selection_equipe_reactiver()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT * FROM Equipe WHERE `Actif_equipe` = 0 ORDER BY ID_Equipe ASC");
    $reponseDesClubs->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "<option value='" . $donneesDesClubs['ID_Equipe'] . "'>" . $donneesDesClubs['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}

function reactiver_equipe($idEquipe)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Equipe` SET `Actif_equipe` = 1 WHERE `ID_Equipe` = '$idEquipe'");
}

// Il s'agit d'un fonction qui va permettre d'afficher les noms et degrés des équipes si leur statut est égal à 1 ce qui signifie qu'elle sont visible sur le site.
function affichage_equipe()
{
    try {
        $bdd = connectDB();
        $bdd->query("SET NAMES 'utf8'");

        $reponseDesEquipes = $bdd->query("SELECT `Nom_Equipe`, `Degres_Equipe` FROM `Equipe` WHERE `Actif_Equipe` = 1");
        $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

        while ($donneesDesEquipes = $reponseDesEquipes->fetch()) {

            echo "<br />";
            echo "Nom de l'équipe : " . $donneesDesEquipes['Nom_Equipe'];
            echo "<br />";
            echo "Degré de l'équipe (niveau) : " . $donneesDesEquipes['Degres_Equipe'];
            echo "<br />";
        }

        $bdd = null;
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}

function afficherNomEquipe()
{

    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesEquipes = $bdd->query("SELECT * FROM `Equipe` WHERE `Actif_Equipe` = 1");
    $reponseDesEquipes->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesEquipes = $reponseDesEquipes->fetch()) {
        echo "<br />";
        echo  "<form action='./modifier_equipe_tournoi.php?Nom_Equipe ' method='POST'>" .  $donneesDesEquipes['Nom_Equipe'] . "       <input type='submit' class='btn btn-primary shadow' value='sélectionner'></form>";
        echo "<br />";
    }

    $bdd = null;
}



// Il s'agit d'un fonction qui va permettre d'insérer la rue, la localité et le NPA de l'adresse que j'appel dans le formulaire d'insertion des clubs afin d'insérer les adresses des clubs également. 
function insertion_adresse_club($rueAdresse, $localiteAdresse, $npaAdresse)
{

    $bdd = connectDB();

    $reponseDesAdresses = $bdd->query("SET NAMES 'utf8'");
    $reponseDesAdresses = $bdd->query("INSERT INTO `Adresse`(`Rue_Adresse`, `Localite_Adresse`, `NPA_Adresse`) VALUES ('$rueAdresse','$localiteAdresse','$npaAdresse')");

    return $bdd->lastInsertId();

    $bdd = null;
}


// Il s'agit d'un fonction qui va permettre d'insérer le nom le logo et l'Id de l'adresse des clubs conrrespondante que j'appel dans le formulaire d'insertion des clubs. 
function insertion_club($nomClub, $urlImageClub, $idAdresse)   // soucres : https://stackoverflow.com/questions/45946593/getting-the-primary-key-id-of-the-last-inserted-row-to-run-multiple-insert-opera */
{

    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("INSERT INTO `Club` (`Nom_Club`, `Url_Image_Club`, `FK_ID_Adresse`) VALUES ('$nomClub', '$urlImageClub', '$idAdresse')");

    echo "<br /><br />";

    $bdd = null;
}

// Il s'agit d'un fonction qui va permettre de modifier le nom, le logo et le statut des clubs que j'appel dans le fomrulaire de modifications des clubs. 
function modification_club($nomClub, $urlImageClub, $idClub, $actifClub)
{

    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Nom_Club` = '$nomClub', `Url_Image_Club` = '$urlImageClub', `Actif_Club` = '$actifClub'  WHERE `Club`.`ID_Club` = '$idClub'");

    $bdd = null;
}

// Il s'agit d'un fonction qui va permettre de faire une suppression logique des clubs, ce qui signfie modifier son statut en 0 afin qu'ils ne soient plsu visible sur le site mais visible dans la BDD.
function suppression_club($idClub)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Actif_club` = 0 WHERE `ID_Club` = '$idClub'");
}

//Il s'agir d'une fonction qui permet de remettre le statut d'un club inactif à 1, que qui le rend à nouveau visible sur le site en plus de la BDD. 
function reactiver_club($idClub)
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("UPDATE `Club` SET `Actif_club` = 1 WHERE `ID_Club` = '$idClub'");
}

// Il s'agit d'un fonction qui va permettre d'afficher le nom, le logo, la rue la localité et le NPA de l'adresse des clubs qui ont comme statut 1 ce qui signifie qu'ils sont visibles sur le site. 
function afficher_ClubActif()
{
    $bdd = connectDB();

    $reponseDesClubs = $bdd->query("SET NAMES 'utf8'");
    $reponseDesClubs = $bdd->query("SELECT Nom_Club, Url_Image_Club, Rue_Adresse, Localite_Adresse, NPA_Adresse FROM Club JOIN Adresse on FK_ID_Adresse = ID_Adresse WHERE `Actif_Club` = 1;"); //sources : https://yard.onl/sitelycee/cours/php/Lesjointuresinternes.html
    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "Nom : " . " " . $donneesDesClubs['Nom_Club'];
        echo "<br /><br />";
        echo "Adresse : " . " " . $donneesDesClubs['Rue_Adresse'] . " " . $donneesDesClubs['NPA_Adresse'] . " " . $donneesDesClubs['Localite_Adresse'];
        echo "<br /><br />";
        echo '<div class=\"row d-flex justify-content-center\"> <img style="height: 200px; width: 200px;" src="assets/img/team/' . $donneesDesClubs['Url_Image_Club'] . '"></div>';
        echo "<br /><br />";
    }
}

// Il s'agit d'un fonction qui va permettre d'afficher le nom, le logo, la rue la localité et le NPA de l'adresse des clubs qui ont comme statut 1 ce qui signifie qu'ils sont visibles sur le site. 
function selection_club()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT * FROM Club WHERE `Actif_Club` = 1 ORDER BY ID_Club ASC");
    $reponseDesClubs->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "<option value='" . $donneesDesClubs['ID_Club'] . "'>" . $donneesDesClubs['Nom_Club'] . "</option>";
    }

    $bdd = null;
}

function selection_club_reactiver()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponseDesClubs = $bdd->query("SELECT * FROM Club WHERE `Actif_Club` = 0 ORDER BY ID_Club ASC");
    $reponseDesClubs->setFetchMode(PDO::FETCH_BOTH);

    while ($donneesDesClubs = $reponseDesClubs->fetch()) {
        echo "<option value='" . $donneesDesClubs['ID_Club'] . "'>" . $donneesDesClubs['Nom_Club'] . "</option>";
    }

    $bdd = null;
}


?>
