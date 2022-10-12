<?php
require_once "dbconnection.php";
require_once "debug.php";

session_start();

// Fonction permettant d'afficher le code html correspondant au différent matchs
function afficherMatch($tournoi)
{
    // Pour chaque produit, les afficher de la manière suivante
    foreach (selectAllMatchTournoi($tournoi) as $t) {
        echo "<div class=\"equipe\">";
        echo "<div class=\"row row-cols-1 row-cols-md-2 mx-auto\" style=\"max-width: 95%;\">";
        echo "<div class=\"col text-center d-l-flex order-md-last justify-content-l-center align-items-l-center mb-2\">";
        echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $t['ID_Match'] . "-U-L\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chevron-compact-up\" viewBox=\"0 0 16 16\">
            <path fill-rule=\"evenodd\" d=\"M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894l6-3z\"/>
            </svg></button>";

        echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important; margin-left: 1% !important;\" value=\"" . $t['ID_Match'] . "-U-V\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chevron-compact-up\" viewBox=\"0 0 16 16\">
            <path fill-rule=\"evenodd\" d=\"M7.776 5.553a.5.5 0 0 1 .448 0l6 3a.5.5 0 1 1-.448.894L8 6.56 2.224 9.447a.5.5 0 1 1-.448-.894l6-3z\"/>
            </svg></button>";

        echo "<h6 class=\"fw-bold text-center\" style=\"margin-bottom: 0.5% !important; margin-top: 1% !important;\">" . $t['But_Local_Match'] . "&nbsp&nbsp &nbsp-&nbsp &nbsp&nbsp" . $t['But_Visiteur_Match'] . "</h6></a>
            <button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $t['ID_Match'] . "-D-L\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chevron-compact-down\" viewBox=\"0 0 16 16\">
            <path fill-rule=\"evenodd\" d=\"M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z\"/>
            </svg></button>";

        echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important; margin-left: 1% !important;\" value=\"" . $t['ID_Match'] . "-D-V\">
            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-chevron-compact-down\" viewBox=\"0 0 16 16\">
            <path fill-rule=\"evenodd\" d=\"M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z\"/>
            </svg></button>";
        echo "</div>";
        echo "<div class=\"col d-md-flex align-items-md-end align-items-lg-center mb-2\">";
        echo "<div id=\"container\">";
        echo "<a href=\"modifier_match.php?id_match=" . $t['ID_Match'] . "\">";

        // Si le match est actif, afficher le match normalement, sinon l'affiche avec une barre 
        if ($t['Actif_Match'] == 1)
            echo "<h5 class=\"fw-bold\" id=\"h5Texte\">" . returnNameEquipe($t['FK_ID_Local']) . " / " . returnNameEquipe($t['FK_ID_Visiteur']) .  "</h5></a>";
        else
            echo "<strike><h6 class=\"fw-bold\" id=\"h5Texte\">" . returnNameEquipe($t['FK_ID_Local']) . " / " . returnNameEquipe($t['FK_ID_Visiteur']) . " - " . $t['Type_Match'] . "</h6></a></strike>";

        echo "<p class=\"text-muted mb-4\">Date : " . date("d.m.Y", strtotime($t['Date_Match'])) . " / Terrain : " . $t['FK_ID_Terrain'] . "&nbsp;<br>";
        echo "Type de match : " . $t['Type_Match'] . " / Heure : " . $t['Heure_Debut_Match'] . "&nbsp;-> " . $t['Heure_Fin_Match'] . "&nbsp;<br></p>";
        echo "</div></div></div></div>";
    }
}

// Permet de retourner la liste des matchs présent dans un tournoi
function selectAllMatchTournoi($id_tournoi)
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

// Permet de retourner un match grâce à son id
function selectMatchWithID($id_match)
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
        debug($e->getMessage());
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

// Permet de retourner le nom de la salle
function returnNameSalle($id_salle)
{
    $nomSalle = "";
    foreach (selectSalleWithID($id_salle) as $salle) {
        $nomSalle = $salle['Nom_Salle'];
    }
    return $nomSalle;
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
        debug($e->getMessage());
    }
}

// Permet de retourner les informations d'une salle grâce à son id_salle
function selectSalleWithID($id_salle)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Salle` WHERE `ID_Salle` = " . $id_salle . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet d'afficher les informationsd'un tournoi, comme la salle et la date du tournoi grâce à son id_terrain
function afficherSalleEtDate($id_tournoi)
{
    foreach (selectAllTournoi() as $tournoi) {
        echo "<h4 class=\"fw-bold\">Salle : " . selectIDSalleWithIDTerrain($tournoi['FK_ID_Terain']) . "&nbsp;</h4>";
    }
}

// Permet de retourner la liste de tout les tournois 
function selectAllTournoi()
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Tournoi` WHERE Actif_Tournoi = 1 OR Actif_Tournoi = 2 ORDER BY `Date_Debut_Tournoi` ASC";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\"" . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Permet de retourner la liste de tout les tournois 
function selectTournoiWithID($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Tournoi` WHERE ID_Tournoi = " . $id_tournoi;
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet de retourner la date du tournoi
function getDateTournoi($tournoi)
{
    foreach (selectTournoiWithID($tournoi) as $t) {
        return $t['Date_Debut_Tournoi'];
    }
}

// 
function selectIDSalleWithIDTerrain($id_terrain)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Salle` WHERE `ID_Terrain` = " . $id_terrain . ";";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet d'augmenter le score de l'équipe fournit en paramètres
function updateUpScore($id_match, $localORvisiteur)
{
    try {
        $db = connectDB();

        if ($localORvisiteur == "L") {
            $sql = "UPDATE Matchs SET But_Local_Match = But_Local_Match + 1 WHERE ID_Match = " . $id_match . ";";
        } else {
            $sql = "UPDATE `Matchs` SET `But_Visiteur_Match` = `But_Visiteur_Match` + 1 WHERE `ID_Match` = " . $id_match . ";";
        }

        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet de réduire le score de l'équipe fournit en paramètres
function updateDownScore($id_match, $localORvisiteur)
{
    try {
        $db = connectDB();

        if ($localORvisiteur == "L") {
            $sql = "UPDATE Matchs SET But_Local_Match = But_Local_Match - 1 WHERE ID_Match = " . $id_match . ";";
        } else {
            $sql = "UPDATE Matchs SET But_Visiteur_Match = But_Visiteur_Match - 1 WHERE ID_Match = " . $id_match . ";";
        }

        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet de créer un match dans la bsase de données
function insertMatch($date_match, $heure_debut, $heure_fin, $duree_match, $type_match, $fk_id_local, $fk_id_visiteur, $fk_id_tournoi, $fk_id_terrain, $fk_id_groupe = 1)
{
    // Code permettant de récupérer les minutes du temps
    $to_time = strtotime($heure_fin);
    $from_time = strtotime($heure_debut);
    $minutes = round(abs($to_time - $from_time) / 60, 2);

    try {
        $db = connectDB();
        $sql = "INSERT INTO `Matchs` (`ID_Match`, `Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`)
        VALUES (NULL,  '$date_match', '$heure_debut', '$heure_fin', '$minutes', '$type_match', '0', '0' , '$fk_id_local', '$fk_id_visiteur', '$fk_id_groupe', '$fk_id_tournoi',  '$fk_id_terrain', 1);";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet d'afficher tout les tournois 
function affichageAllTournois()
{
    // Pour chaque tournoi, les afficher de la manière suivante
    foreach (selectAllTournoi() as $tournoi) {
        echo "<div class=\"col mb-4\">
          <div><a href=\"match.php?id_tournoi=" . $tournoi['ID_Tournoi'] . "\"><img class=\"rounded img-fluid shadow w-100 fit-cover\" src=\"assets/img/products/2173435-silhouette-joueur-de-football-tir-rapide-un-ballon-sur-un-fond-blanc-illustration-vectoriel.jpg\" style=\"height: 250px;\"></a>
            <div class=\"py-4\">
              <h4 class=\"fw-bold\">Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h4>
              <p class=\"text-muted\">Ce tournoi est organisé à la " . returnNameSalle($tournoi['FK_ID_Salle']) . ".</p>
            </div>
          </div>
        </div>";
    }
}

// Permet d'afficher les select du match
function afficherSelectMatch($id_tournoi)
{
    // Select de l'équipe local
    echo "<select name=\"equipe-local\" class=\"form-control mb-3\" id=\"local\">";
    afficher_option_equipes($id_tournoi);
    echo "</select>";

    // Select de l'équipe visiteur
    echo "<select name=\"equipe-visiteur\" class=\"form-control mb-3\" id=\"visiteur\">";
    afficher_option_equipes($id_tournoi);
    echo "</select>";

    // Select du terrain à utiliser
    echo "<select name=\"terrain\" class=\"form-control mb-3\" >";
    afficher_option_terrain($id_tournoi);
    echo "</select>";
}

// Permet d'afficher les options des équipes à inscrire
function afficher_option_equipes($id_tournoi, $id_equipe = 0)
{
    try {
        $bdd = connectDB();
        $sql = "SELECT i.FK_ID_Equipe, e.Nom_Equipe FROM `Inscription_Tournoi` AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = " . $id_tournoi . " ORDER BY e.Nom_Equipe ASC";
        $req = $bdd->prepare($sql);
        $req->execute();
        $reponse = $req->fetchAll();

        foreach ($reponse as $data) {
            if ($data['FK_ID_Equipe'] == $id_equipe) {
                echo "<option value=\"" . $data['FK_ID_Equipe'] . "\" selected>" . $data['Nom_Equipe'] . "</option>";
            } else {
                echo "<option value=\"" . $data['FK_ID_Equipe'] . "\">" . $data['Nom_Equipe'] . "</option>";
            }
        }
    } catch (\Throwable $th) {
        debug($th->getMessage());
    }
}

// Permet d'afficher les options des terrains
function afficher_option_terrain($id_tournoi)
{
    try {
        $bdd = connectDB();
        $sql = "SELECT t.ID_Terrain, t.Numero_Terrain FROM `Terrain` AS t JOIN Salle AS s ON t.FK_ID_Salle_T = s.ID_Salle JOIN Tournoi AS tou ON tou.FK_ID_Salle = s.ID_Salle WHERE tou.ID_Tournoi = " . $id_tournoi;
        $req = $bdd->prepare($sql);
        $req->execute();
        $reponse = $req->fetchAll();

        foreach ($reponse as $data)
            echo "<option value=\"" . $data['ID_Terrain'] . "\">" . $data['Numero_Terrain'] . "</option>";
    } catch (Exception $e) {
        debug($e->getMessage());
    }
}

// Permet de mettre à jour les informations des matchs 
function updateMatch($id_match, $id_local, $id_visiteur, $time_debut, $time_fin, $minutes, $type, $equipe_local, $equipe_visiteur)
{
    try {
        $db = connectDB();
        $sql = "UPDATE Matchs SET `Heure_Debut_Match` = '" . $time_debut . "', `Heure_Fin_Match` = '" . $time_fin . "', `Duree_Match` = '" . $minutes . "', `Type_Match` = '" . $type . "', "
            . "`But_Local_Match` = '" . $equipe_local . "', `But_Visiteur_Match` = '" . $equipe_visiteur . "', `FK_ID_Local` = '" . $id_local . "', `FK_ID_Visiteur` = '" . $id_visiteur . "' WHERE `Matchs` . `ID_Match` = " . $id_match;
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

// Permet de mettre à jour le statut actif des matchs 
function updateActifMatch($id_match, $actif_inactif)
{
    try {
        $db = connectDB();
        $sql = "UPDATE Matchs SET `Actif_Match` = '" . $actif_inactif . "' WHERE `Matchs` . `ID_Match` = " . $id_match;
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function afficherTableauGroupe($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM Groupe ORDER BY Nom_Groupe";
        $request = $db->prepare($sql);
        $request->execute();
        $reponse = $request->fetchAll();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }

    echo '<thead><tr><td><b>' . $reponse[0]['Nom_Groupe'] . '</b></td><td><b>' . $reponse[1]['Nom_Groupe'] . '</b></td><td><b>' . $reponse[2]['Nom_Groupe'] . '</b></td><td><b>' . $reponse[3]['Nom_Groupe'] . '</b></tr></theade>';

    echo '<tbody><tr><td>' . $_SESSION['GroupeUn'][0][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeDeux'][0][0]['Nom_Equipe'] . '</td><td>' .
        $_SESSION['GroupeTrois'][0][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeQuatre'][0][0]['Nom_Equipe'] . '</td></tr>';

    echo '<tr><td>' . $_SESSION['GroupeUn'][1][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeDeux'][1][0]['Nom_Equipe'] . '</td><td>' .
        $_SESSION['GroupeTrois'][1][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeQuatre'][1][0]['Nom_Equipe'] . '</td></tr>';

    echo '<tr><td>' . $_SESSION['GroupeUn'][2][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeDeux'][2][0]['Nom_Equipe'] . '</td><td>' .
        $_SESSION['GroupeTrois'][2][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeQuatre'][2][0]['Nom_Equipe'] . '</td></tr>';

    echo '<tr><td>' . $_SESSION['GroupeUn'][3][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeDeux'][3][0]['Nom_Equipe'] . '</td><td>' .
        $_SESSION['GroupeTrois'][3][0]['Nom_Equipe'] . '</td><td>' . $_SESSION['GroupeQuatre'][3][0]['Nom_Equipe'] . '</td></tr></tbody>';
}

function selectMatchPoul($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $id_tournoi . " AND `Type_Match` = 'Poule';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectMatchQuartFinale($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE `FK_ID_Tournoi` = " . $id_tournoi . " AND `Type_Match` = 'Quart de finale';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
