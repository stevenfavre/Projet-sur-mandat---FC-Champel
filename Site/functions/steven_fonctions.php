<?php
require_once "dbconnection.php";
require_once "debug.php";

// Fonction permettant d'afficher le code html correspondant au différent matchs
function afficherMatch($tournoi)
{
    // Pour chaque produit, les afficher de la manière suivante
    foreach (selectAllMatchTournoi($tournoi) as $t) {
        if ($t['ID_Match'] % 2 == 0) {
            echo "<div class=\"row row-cols-1 row-cols-md-2 mx-auto\" style=\"max-width: 900px;\">";
            echo "<div class=\"col d-xl-flex justify-content-xl-center align-items-xl-center mb-5\">";
            echo "<h5 class=\"fw-bold text-center\">Score : " . $t['But_Local_Match'] . " - " . $t['But_Visiteur_Match'] . "</h5>";
            echo "</div>";
            echo "<div class=\"col d-md-flex align-items-md-end align-items-lg-center mb-5\">";
            echo "<div>";
            echo "<h5 class=\"fw-bold\">" . returnNameEquipe($t['FK_ID_Local']) . " - " . returnNameEquipe($t['FK_ID_Visiteur']) . "</h5>";
            echo "<p class=\"text-muted mb-4\">Terrain : " . $t['FK_ID_Terrain'] . "&nbsp;<br>Date : " . $t['Date_Match'] . "&nbsp;<br>
            Heure de début : " . $t['Heure_Debut_Match'] . "&nbsp;<br>Heure de fin : " . $t['Heure_Fin_Match'] . "&nbsp;<br></p>";
            echo "</div></div></div>";
        } else {
            echo "<div class=\"row row-cols-1 row-cols-md-2 mx-auto\" style=\"max-width: 900px;\">";
            echo "<div class=\"col text-center d-xl-flex order-md-last justify-content-xl-center align-items-xl-center mb-5\">";
            echo "<h5 class=\"fw-bold text-center\">Score : " . $t['But_Local_Match'] . " - " . $t['But_Visiteur_Match'] . "</h5>";
            echo "</div>";
            echo "<div class=\"col d-md-flex align-items-md-end align-items-lg-center mb-5\">";
            echo "<div>";
            echo "<h5 class=\"fw-bold\">" . returnNameEquipe($t['FK_ID_Local']) . " - " . returnNameEquipe($t['FK_ID_Visiteur']) . "</h5>";
            echo "<p class=\"text-muted mb-4\">Terrain : " . $t['FK_ID_Terrain'] . "&nbsp;<br>Date : " . $t['Date_Match'] . "&nbsp;<br>
            Heure de début : " . $t['Heure_Debut_Match'] . "&nbsp;<br>Heure de fin : " . $t['Heure_Fin_Match'] . "&nbsp;<br></p>";
            echo "</div></div></div>";
        }
    }
}

// Permet de retourner la liste des matchs présent dans un tournoi
function selectAllMatchTournoi($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $id_tournoi . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Permet de retourner le nom de l'équipe
function returnNameEquipe($id_equipe)
{
    $nom = "Non existant";
    foreach (selectEquipeWithID($id_equipe) as $equipe) {
        $nom = $equipe['Nom_Equipe'];
    }
    return $nom;
}

// Permet de retourner les informations d'un equipe grâce à son id_equipe
function selectEquipeWithID($id_equipe)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Equipe` WHERE `ID_Equipe` = " . $id_equipe . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Permet de retourner le numéro du terrain
function returnNumeroTerrain($id_terrain)
{
    $numeroTerrain = 0;
    foreach (selectTerrainWithID($id_terrain) as $terrain) {
        $numeroTerrain = $terrain['Numero_Terrain'];
    }
    return $numeroTerrain;
}

// Permet de retourner les informations d'un terrain grâce à son id_terrain
function selectTerrainWithID($id_terrain)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Terrain` WHERE `ID_Terrain` = " . $id_terrain . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Permet d'afficher les informationsd'un tournoi, comme la salle et la date du tournoi grâce à son id_terrain
function afficherSalleEtDate($id_tournoi){
    foreach (selectAllTournoi() as $tournoi){
        echo "<h4 class=\"fw-bold\">Salle : " . selectSalleWithIDTerrain($tournoi['FK_ID_Terain']) . "&nbsp;</h4>";
    }
}

function selectAllTournoi(){
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Tournoi`;";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
}

/* function selectSalleWithIDTerrain($id_salle){
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Salle` WHERE `ID_Terrain` = " . $id_salle . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
} */


