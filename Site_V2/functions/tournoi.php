<?php
session_start(['cookie_lifetime' => 3600,]); // Fonction permettant de faire la connection à la base de donnée



//Fonction permettant de vérifier que la date de début de création d'un tournoi ne soit pas déjà insérée dans notre base de donnée pour un autre tournoi déjà existant
function verificationDonneesTournois($Date_debut, $Date_fin)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = ("SELECT Date_Debut_Tournoi, Date_Fin_Tournoi FROM Tournoi WHERE $Date_debut like Date_Debut_Tournoi AND $Date_debut BETWEEN $Date_debut AND $Date_fin");
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
}

//Fonction permettant de faire l'insertion d'un nouveau tournoi dans la base de données
function insertion_tournoi($Date_debut, $Date_fin, $Fk_ID_Salle)
{

    try {
        $bdd = connectDB();
        $reponse = $bdd->query("SET NAMES 'utf8'");
        $reponse = $bdd->query("INSERT INTO Tournoi (`Date_Debut_Tournoi`, `Date_Fin_Tournoi`, `FK_ID_Salle`) VALUES ( '" . $Date_debut . "', '" . $Date_fin . "', '" . $Fk_ID_Salle . "')");

        echo "<p class=\"fw-bold text-success mb-2\">L'insertion a été correctement réalisée ! </p>";
    } catch (\Throwable $th) {
        //throw $th;
        echo "<script> alert(\"Insertion raté ! \");</script>";
    }

    return null;
}
//Fonction permettant d'afficher toutes les informations qui concernent le tournoi (tous les attributs), seulement lorque le tournoi est actif
function afficher_infos_tournois()
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = ("SELECT s.Nom_Salle, t.Date_Debut_Tournoi, t.Date_Fin_Tournoi, t.Actif_Tournoi FROM Tournoi AS t JOIN Salle AS s ON s.ID_Salle = t.FK_ID_Salle");
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();


    foreach ($reponse2 as $data) {
        if ($data['Actif_Tournoi'] == 1)
            echo "<strike><tr><td><ul>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
    <td><ul>" . date("d.m.Y", strtotime($data['Date_Fin_Tournoi'])) .  "</ul></td>
    <td><ul>" .  $data['Nom_Salle'] . "</ul></td></tr></strike>";
        else
            echo "<strike><tr><td><ul>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
    <td><ul>" . date("d.m.Y", strtotime($data['Date_Fin_Tournoi'])) .  "</ul></td>
    <td><ul>" .  $data['Nom_Salle'] . "</ul></td></tr></strike>";
    }
    return null;
}

///Fonction permettant de selectionner une salle sous forme de liste déroulante et dans un ordre ascendant
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

///Fonction permettant de selectionner une le degres d'une equipe sous forme de liste déroulante et dans un ordre ascendant
function selection_degre_equipe()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Equipe ORDER BY ID_Equipe ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Degres_Equipe'] . "</option>";
    }

    $bdd = null;
}
///Fonction permettant de selectionner une la date de début d'un tournoi existant sous forme de liste déroulante et dans un ordre ascendant
function selection_tournoi($id_tournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi WHERE ID_Tournoi = $id_tournoi");
    $reponse->setFetchMode(PDO::FETCH_BOTH);


    while ($donnees = $reponse->fetch()) {

        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . date("d.m.Y", strtotime($donnees['Date_Debut_Tournoi'])) . "</option>";
    }

    return null;
}
function selection_tournoi1()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi WHERE Actif_Tournoi = '1' ORDER BY Date_Debut_Tournoi ");
    $reponse->setFetchMode(PDO::FETCH_BOTH);


    while ($donnees = $reponse->fetch()) {

        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . date("d.m.Y", strtotime($donnees['Date_Debut_Tournoi'])) . "</option>";
    }

    return null;
}
function selection_tournoi_supprimer()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi  ORDER BY Date_Debut_Tournoi ");
    $reponse->setFetchMode(PDO::FETCH_BOTH);


    while ($donnees = $reponse->fetch()) {

        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . date("d.m.Y", strtotime($donnees['Date_Debut_Tournoi'])) . "</option>";
    }

    return null;
}
///Fonction permettant de modifier les attributs de la table tournoi.
function update_tournoi($IdTournoi, $Date_debut, $Date_fin, $Fk_ID_Salle)
{

    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Date_Debut_Tournoi = '$Date_debut', Date_Fin_Tournoi = '$Date_fin', FK_ID_SALLE = '$Fk_ID_Salle' WHERE ID_Tournoi = '$IdTournoi'");

    return null;
}

///Fonction permettant d'afficher toutes les informations d'une équipe inscrite selon le tournoi et sous forme de tableau 
function afficher_infos_equipes_inscrites($IdTournoi)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club WHERE FK_ID_Tournoi = " . $IdTournoi;
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    foreach ($reponse2 as $data) {
        echo $data['Nom_Equipe'];
    }
    return null;
}
///Fonction permettant d'fficher les informations  d'une équipe inscrite selon le tournoi et sous forme de tableau et qui affiche des nouvelles options selon le statut sous forme de liste déroulante.

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_demandes_noms_equipes_inscrites($IDEquipe = 0)
{
    $id_tournoi = $_SESSION['id_tournoi'];

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = $id_tournoi AND FK_ID_EQUIPE != $IDEquipe";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();


    foreach ($reponse2 as $data) {
        if ($IDEquipe == $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . "\">"  . $data['Nom_Equipe'] . "OK" . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] .  "selected>" . $data['Nom_Equipe'] . "</option>";
        }
    }

    return null;
}

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_noms_equipes_pas_inscrites_with_id($id_tournoi, $id_equipe = 0)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT i.FK_ID_Equipe, e.Nom_Equipe FROM `Inscription_Tournoi` AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = $id_tournoi  AND Statut_Inscription_Tournoi = 'En attente'";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();


    foreach ($reponse2 as $data) {
        if ($data['FK_ID_Equipe'] == $id_equipe) {
            echo "<option value=\"" . $data['FK_ID_Equipe'] . "\"selected>" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=\"" . $data['FK_ID_Equipe'] . "\">" . $data['Nom_Equipe'] . "</option>";
        }
    }

    return null;
}

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_noms_equipes_pas_inscrites($IDEquipe = 0)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE Statut_Inscription_Tournoi = 'En attente' ORDER BY Date_Inscription_Tournoi ASC";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($data['FK_ID_Equipe'] == $IDEquipe) {
            echo "<option value=" . $data['FK_ID_Equipe'] . "\" selected>" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] .  "\">" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}

//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi

//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi (les equipes dont linscription ets toujours en attente)
function afficher_Tournoi()
{

    $bdd = connectDB();

    $sql = "SELECT s.Nom_Salle, s.ID_Salle, t.ID_Tournoi, t.Date_Debut_Tournoi, t.Date_Fin_Tournoi, t.Actif_Tournoi FROM Tournoi AS t JOIN Salle AS s ON s.ID_Salle = t.FK_ID_Salle ORDER BY t.Date_Debut_Tournoi";
    $request = $bdd->prepare($sql);

    $request->execute();
    return  $request->fetchAll(PDO::FETCH_ASSOC);
}

function afficherDateTournoi()
{
    $date = "Non existante";
    foreach (afficher_Tournoi() as $tournoi) {
        $date = date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi']));
    }
    return $date;
}



function afficher_date_tournoi()
{

    echo "<h3 class=\"fw-bold text-success mb-2\">Tous les tournois</h3></br>";
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Opérations</h5>
   <a href=\"creer_tournoi.php\"class=\"fa-solid fa-plus\"</a>
    <a href=\"modifier_tournoi.php\"class=\"far fa-edit btn-light m-2\"</a>
    <a href=\"supprimer_tournoi.php\"class=\"fa-solid fa-trash\"</a></ul></td></tr>";


    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Date de début  " . "<i class=\"fa-regular fa-calendar-days\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Date de fin </h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Salle " . "<i class=\"fa-solid fa-location-dot\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Statut</h5></ul></td></tr>";

    foreach (afficher_Tournoi() as $tournoi) {
        if ($tournoi['Actif_Tournoi'] == 0)
            echo "<tr><td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h5></a></strike></ul></td>  
            <td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">"  . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) . "</h5></a></strike></ul></td>
            <td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">" . $tournoi['Nom_Salle'] .  "</h5></a></strike></ul></td>
            <td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Annulé" .  "</h5></a></strike></ul></td></tr>";

        elseif ($tournoi['Actif_Tournoi'] == 2)
            echo "<td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . $tournoi['Nom_Salle'] . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Terminé <i class=\"fa-solid fa-check\"\></i></h5></a></ul></td></tr>";

        else {

            echo "<td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . $tournoi['Nom_Salle'] . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\" id=\"h5Texte\">" . "Actif" .  "</h5></a></ul></td></tr>";
        }
    }
}


function afficher_date_tournoiUPDATE()
{

    echo "<tr><td><ul><h3 class=\"fw-bold text-success mb-2\">Tous les tournois</h3></ul></td></tr>";



    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Date début " . "<i class=\"fa-regular fa-calendar-days\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Date fin</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Salle " . "<i class=\"fa-solid fa-location-dot\"></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Statut</h5></ul></td></tr>";




    foreach (afficher_Tournoi() as $tournoi) {
        if ($tournoi['Actif_Tournoi'] == 1)
            echo "<tr><td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . $tournoi['Nom_Salle'] . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Actif" .  "</h5></a></ul></td></tr>";
    }
}

function afficher_date_tournoiDELETE()
{

    echo "<tr><td><ul><h3 class=\"fw-bold text-success mb-2\">Tous les tournois</h3></ul></td></tr>";



    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Date début</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Date fin</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Salle</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Statut</h5></ul></td></tr>";




    foreach (afficher_Tournoi() as $tournoi) {
        if ($tournoi['Actif_Tournoi'] == 0)
            echo "<tr><td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi annulé " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi']))   . "</h5></a></strike></ul></td>  
            <td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">"  . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) . "</h5></a></strike></ul></td>
            <td><ul><strike><h5 class=\"fw-bold\" id=\"h5Texte\">" .  $tournoi['Nom_Salle'] .  "</h5></a></strike></ul></td>
            <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Annulé" .  "</h5></a></ul></td></tr>";


        else
            echo "<td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Tournoi du " . date("d.m.Y", strtotime($tournoi['Date_Debut_Tournoi'])) . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . date("d.m.Y", strtotime($tournoi['Date_Fin_Tournoi'])) .  "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . $tournoi['Nom_Salle'] . "</h5></ul></td>
    <td><ul><h5 class=\"fw-bold\" id=\"h5Texte\">" . "Actif" .  "</h5></a></ul></td></tr>";
    }
}

//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription qui n'a pas été validé pour un tournoi ainsi que les informations du tournoi
function afficher_toutes_equipes_pas_inscrites()
{


    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE Statut_Inscription_Tournoi = 'En attente' ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
    echo "<h3 class=\"fw-bold text-success mb-2\">Toutes les equipes</h3>";
    foreach ($reponse2 as $data) {
        echo "<tr><td><ul><h5 class=\"fw-bold card-title\">Date inscription</h5>" . date("d.m.Y", strtotime($data['Date_Inscription_Tournoi'])) . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Equipe</h5>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Degré</h5>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Club</h5>" . $data['Nom_Club'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Groupe</h5>" . $data['Nom_Groupe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Date tournoi</h5>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Statut</h5>";




        if ($data['Statut_Inscription_Tournoi'] == "En attente") {
            echo "<select name=\"Statut\" id=\"s\"><option valeur=\"ena\" selected>En attente</option>";
            echo "<option valeur=\"val\">Valider</option>
        
            </select>";
        } else {
            echo $data['Statut_Inscription_Tournoi'] . "</ul></td></tr>";
        }
        echo "</ul></td></tr>";
    }
    return null;
}
//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi (equipes inscrites officiellement et pas inscrites), pour les icones Florent m'a aidé à insérer les boutons avec les liens trouvé sur le site Font Awesome
function afficher_toutes_demandes()
{


    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
    echo "<h3 class=\"fw-bold text-success mb-2\">Inscriptions</h3>";

    echo "<tr><td><ul><h5 class=\"fw-bold card-title\">Date inscription</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Equipe</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Degré</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Club</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Groupe</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Date tournoi</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Statut</h5></ul></td></tr>";

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . date("d.m.Y", strtotime($data['Date_Inscription_Tournoi'])) . "</ul></td>
        <td><ul>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul>" . $data['Nom_Club'] . "</ul></td>
        <td><ul>" . $data['Nom_Groupe'] . "</ul></td>
        <td><ul>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
        <td><ul>" . $data['Statut_Inscription_Tournoi'] . "</ul></td>
        <td><ul><a href=\"inscription_equipe.php\"class=\"fa-solid fa-plus\"</a></ul></td>
        <td><ul><a href=\"gerer_demandes.php\"class=\"far fa-edit btn-light m-2\"</a></ul></td>";
        echo "</ul></td><td><ul><a href=\"modifier_equipe_tournoi.php\"class=\"fa-solid fa-trash\"</a></ul></td></tr>";
    }
    return null;
}
//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi seulement pour les tournois qui auront lieu 

//Fonction permettat d'aficher toutes les demandes d'inscription pas validés
function afficher_toutes_demandes_inscrites()
{


    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE Statut_Inscription_Tournoi = 'En attente' ORDER BY Date_Inscription_Tournoi ASC";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
    echo "<h3 class=\"fw-bold text-success mb-2\">En attente</h3>";
    foreach ($reponse2 as $data) {
        echo "<tr><td><ul><h5 class=\"fw-bold card-title\">Date inscription</h5>" . date("d.m.Y", strtotime($data['Date_Inscription_Tournoi'])) . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Equipe</h5>" . $data['Nom_Equipe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Degré</h5>" . $data['Degres_Equipe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Club</h5>" . $data['Nom_Club'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Groupe</h5>" . $data['Nom_Groupe'] . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Date tournoi</h5>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
        <td><ul><h5 class=\"fw-bold card-title\">Statut</h5>" .  $data['Statut_Inscription_Tournoi'] . "</ul></td></tr>";
    }

    return null;
}
//fonction permetant de modifier le statut de l'inscription le faire passer de en attente à validé
function update_statut_equipes_tournoiTst($id_inscription)
{
    $bdd = connectDB();
    $sql = 'UPDATE inscription_tournoi SET Statut_Inscription_Tournoi = :test WHERE ID_Inscription_Tournoi = :idTournoi';
    $request = $bdd->prepare($sql);
    $request->execute(
        [
            'idTournoi' => $id_inscription,
            'test' => 'Validé'
        ]
    );
}

function update_statut_inscriptions($id_inscription)
{
    try {
        $bdd = connectDB();
        $sql = "UPDATE `Inscription_Tournoi` SET `Statut_Inscription_Tournoi`  = 'Validé' WHERE ID_Inscription_Tournoi = " . $id_inscription . ";";
        $request = $bdd->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}


//fonction permetant de modifier le statut de l'inscription le faire passer de validé à en attente
function update_statut_equipes($id_inscription)
{
    try {
        $bdd = connectDB();
        $sql = "UPDATE `Inscription_Tournoi` SET `Statut_Inscription_Tournoi`  = 'En attente' WHERE ID_Inscription_Tournoi = " . $id_inscription . ";";
        $request = $bdd->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function update_statut_equipes_en_attente($id_inscription)
{
    try {
        $bdd = connectDB();
        $sql = "UPDATE `Inscription_Tournoi` SET `Statut_Inscription_Tournoi`  = 'En attente'WHERE ID_Inscription_Tournoi = " . $id_inscription . ";";
        $request = $bdd->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
//fonction permetant de modifier le statut de l'inscription le faire passer de validé à en attente en récupérant l'équipe choisie
function afficher_inscription_equipes()

{
    $IdInscriptionTournois = $_POST['FK_ID_Equipe'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Inscription_Tournoi SET Statut_Inscription_Tournoi  = 'Validé' WHERE FK_ID_Equipe = '$IdInscriptionTournois'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);


    return null;
}
//fonction permetant d'afficher les équipes inscirtes au tournoi
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



//fonction permetant de faire la suppression logique en modifiant l'actif de la table tournoi qui passe de 1 à 0 
function update_suppresion_logique()
{

    $IdTournoi = $_POST['ID_Tournoi'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Actif_Tournoi = 0 WHERE ID_Tournoi = '$IdTournoi'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);
}
//fonction permetant de faire la suppression logique en modifiant l'actif de la table tournoi qui passe de 0 à 1 
function update_activer_logique()
{

    $IdTournoi = $_POST['ID_Tournoi'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Actif_Tournoi = 1 WHERE ID_Tournoi = '$IdTournoi'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);
}

function update_terminer_logique()
{

    $IdTournoi = $_POST['ID_Tournoi'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Tournoi SET Actif_Tournoi = 2 WHERE ID_Tournoi = '$IdTournoi'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);
}




//fonction permetant de faire une suppression physique d'un tournoi
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


//fonction permetant de d'inscrire une équipe déjà existante au tournoi
function inscription_equipe_tournoi($ID_Tournoi, $equipe)
{

    try {
        $bdd = connectDB();

        $sql = ("INSERT INTO Inscription_Tournoi (`ID_Inscription_Tournoi`, `Date_Inscription_Tournoi`, `Statut_Inscription_Tournoi`, `FK_ID_Tournoi`, `FK_ID_Equipe`) VALUES (NULL, '" . date('y-m-d') . "', 'En attente', '" . $ID_Tournoi . "', '" . $equipe . "')");

        $request = $bdd->prepare($sql);
        $request->execute();
        echo "<p class=\"fw-bold text-success mb-2\">L'insertion a été correctement réalisée ! </p>";
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
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
//fonction permetant de selectionner la date de début d'un tournoi sous forme de liste déroulante
function selection_tournoi_incription($IdTournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi WHERE Actif_Tournoi = '1' ORDER BY Date_Debut_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . date("d.m.Y", strtotime($donnees['Date_Debut_Tournoi'])) . "</option>";
    }

    $bdd = null;
}
//fonction permetant de sélectionner les nom des equipes existantes dans la base de données
function selection_equipe_incription()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Equipe WHERE Actif_Equipe = '1' ");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}

function selectionner_equipe_tournoi($id_tournoi)
{

    $bdd = connectDB();
    $sql = "SELECT * FROM Inscription_Tournoi WHERE FK_ID_Tournoi = " . $id_tournoi . " ORDER BY FK_ID_Tournoi ASC";
    $request = $bdd->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function selectionner_inscriptions()
{

    $bdd = connectDB();
    $sql = "SELECT * FROM Inscription_Tournoi ORDER BY FK_ID_Tournoi ASC";
    $request = $bdd->prepare($sql);


    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function afficher_toutes_inscriptions()
{
?>
    <p style="padding-right: 80%;"></p>
    <a href="inscription_tournoi_equipe.php" class="fa-solid fa-plus">Nouvelle inscription tournoi</a>
    </br></br>

<?php
    echo "<tr><td><ul><h5 class=\"fw-bold text-success mb-2\">Tournoi  " . "<i class=\"fa-regular fa-calendar-days\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Equipe " . "<i class=\"fa-solid fa-people-group\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Groupe " . "<i class=\"fa-solid fa-users-viewfinder\"></i></h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Statut</h5></ul></td>
    <td><ul><h5 class=\"fw-bold text-success mb-2\">Valider/Annuler inscription</h5></ul></td></tr>";


    foreach (selectionnerInscription_all() as $inscription) {
        echo "<div><a href=\"afficher_demandes.php?id_inscription_tournoi=" . $inscription['ID_Inscription_Tournoi'] . "\">";

        if ($inscription['Statut_Inscription_Tournoi'] != "Validé")

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . date("d.m.Y", strtotime($inscription['Date_Debut_Tournoi'])) . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">" .  $inscription['Nom_Equipe'] . "</h5></ul></td> 
        <td><ul><h5 class=\"fw-bold\">" .  $inscription['Nom_Groupe'] . "</h5></ul></td>
        <td><ul><h5 class=\"fw-bold\">  " .  $inscription['Statut_Inscription_Tournoi'] . "<i class=\"fa-solid fa-hourglass\"></i></h5></ul></td>
        <td><ul><button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscription['ID_Inscription_Tournoi'] . "-modifier\">Valider</button></ul></td></tr>";

        else

            echo "<tr><td><ul><h5 class=\"fw-bold\">" . date("d.m.Y", strtotime($inscription['Date_Debut_Tournoi'])) . "</h5></ul></td>
             <td><ul><h5 class=\"fw-bold\">" .  $inscription['Nom_Equipe'] . "</h5></ul></td> 
             <td><ul><h5 class=\"fw-bold\">" .  $inscription['Nom_Groupe'] . "</h5></ul></td>
            <td><ul><h5 class=\"fw-bold text-success mb-2\">  " .  $inscription['Statut_Inscription_Tournoi'] . "</h5></ul></td>
            <td><ul><button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscription['ID_Inscription_Tournoi'] . "-annuler\">Annuler</button></td></tr>";

        echo "</div>";
    }
}
function afficherEquipeInscrites($id_tournoi)

{
    foreach (selectionner_equipe_tournoi($id_tournoi) as $inscrite) {
        echo "<div class=\"inscription\">";
        echo "<div class=\"row row-cols-1 row-cols-md-2 mx-auto\" style=\"max-width: 95%;\">";
        echo "<div class=\"col text-center d-l-flex order-md-last justify-content-l-center align-items-l-center mb-2\">";

        if ($inscrite['Statut_Inscription_Tournoi'] != "Validé")
            echo "<button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscrite['ID_Inscription_Tournoi'] . "-modifier\">Valider</button>";

        else
            echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscrite['ID_Inscription_Tournoi'] . "-annuler\">Annuler</button>";


        echo "</div>";
        echo "<div class=\"col d-md-flex align-items-md-end align-items-lg-center mb-2\">";
        echo "<div id=\"container\">";
        echo "<a href=\"modifier_equipe_tournoi.php?id_inscription_tournoi=" . $inscrite['ID_Inscription_Tournoi'] . "\">";

        if ($inscrite['Statut_Inscription_Tournoi'] != "Validé")
            echo "<h5 class=\"fw-bold\" id=\"h5Texte\">" . contientEquipeInscrite($inscrite['FK_ID_Equipe']) . " / " . contientGroupeInscrit($inscrite['FK_ID_Equipe'])  .  " / Catégorie  " . contientCatégorieInscrit($inscrite['FK_ID_Equipe']) . "</br>" . "Club " . contientClubInscrit($inscrite['FK_ID_Equipe']) . "</h5></a>";
        else
            echo "<h5 class=\"fw-bold\" id=\"h5Texte\">" . contientEquipeInscrite($inscrite['FK_ID_Equipe']) . " / " . contientGroupeInscrit($inscrite['FK_ID_Equipe'])  . " /  Catégorie  " . contientCatégorieInscrit($inscrite['FK_ID_Equipe']) . "</br>" . "Club " . contientClubInscrit($inscrite['FK_ID_Equipe']) . "</h5></a>";

        echo "<p class=\"text-muted mb-4\">Date d'inscription : " . date("d.m.Y", strtotime($inscrite['Date_Inscription_Tournoi'])) . "&nbsp;
        Statut inscription ---><i class=\"fa-solid fa-hourglass\"></i>" . $inscrite['Statut_Inscription_Tournoi'] .   " &nbsp;</p>";
        echo "</div></div></div></div>";
    }
}

function afficherEquipeInscritesSansId()
{
    foreach (selectionner_inscriptions() as $inscrite) {
        echo "<div class=\"inscription\">";
        echo "<div class=\"row row-cols-1 row-cols-md-2 mx-auto\" style=\"max-width: 95%;\">";
        echo "<div class=\"col text-center d-l-flex order-md-last justify-content-l-center align-items-l-center mb-2\">";

        if ($inscrite['Statut_Inscription_Tournoi'] != "Validé")
            echo "<button type=\"\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscrite['ID_Inscription_Tournoi'] . "-modifier\">Valider</button>";
        else
            echo "<button type=\"submit\" class=\"btn btn-primary btn-sm\" name=\"submit\" style=\"padding: 0px 12px !important;\" value=\"" . $inscrite['ID_Inscription_Tournoi'] . "-annuler\">Annuler</button>";

        echo "</div>";
        echo "<div class=\"col d-md-flex align-items-md-end align-items-lg-center mb-2\">";
        echo "<div id=\"container\">";
        echo "<a href=\"modifier_equipe_tournoi.php?id_inscription_tournoi=" . $inscrite['ID_Inscription_Tournoi'] . "\">";

        if ($inscrite['Statut_Inscription_Tournoi'] != "Validé")
            echo "<h5 class=\"fw-bold\" id=\"h5Texte\">" . contientEquipeInscrite($inscrite['FK_ID_Equipe']) . " / " . contientGroupeInscrit($inscrite['FK_ID_Equipe'])  .  " / Catégorie  " . contientCatégorieInscrit($inscrite['FK_ID_Equipe']) . "</br>" . "Club " . contientClubInscrit($inscrite['FK_ID_Equipe']) . "</h5></a>";
        else
            echo "<h5 class=\"fw-bold\" id=\"h5Texte\">" . contientEquipeInscrite($inscrite['FK_ID_Equipe']) . " / " . contientGroupeInscrit($inscrite['FK_ID_Equipe'])  . " /  Catégorie  " . contientCatégorieInscrit($inscrite['FK_ID_Equipe']) . "</br>" . "Club " . contientClubInscrit($inscrite['FK_ID_Equipe']) . "</h5></a>";

        echo "<p class=\"text-muted mb-4\">Date d'inscription : " . date("d.m.Y", strtotime($inscrite['Date_Inscription_Tournoi'])) . "&nbsp;
        Statut inscription ---> " . $inscrite['Statut_Inscription_Tournoi'] .  "&nbsp;</p>";
        echo "</div></div></div></div>";
    }
}

function contientEquipeInscrite($id_inscription)
{
    $nomEquipe = "Inconnu";
    foreach (selectionnerInscriptionID($id_inscription) as $inscription) {
        $nomEquipe = $inscription['Nom_Equipe'];
    }
    return  $nomEquipe;
}



function contientGroupeInscrit($id_inscription)
{
    $nomG = "Inconnu";
    foreach (selectionnerInscriptionID($id_inscription) as $inscription) {
        $nomG = $inscription['Nom_Groupe'];
    }
    return  $nomG;
}

function contientCatégorieInscrit($id_inscription)
{
    $Deg = "Inconnu";
    foreach (selectionnerInscriptionID($id_inscription) as $inscription) {
        $Deg = $inscription['Degres_Equipe'];
    }
    return  $Deg;
}

function contientClubInscrit($id_inscription)
{
    $c = "Inconnu";
    foreach (selectionnerInscriptionID($id_inscription) as $inscription) {
        $c = $inscription['Nom_Club'];
    }
    return  $c;
}

function contientTournoiInscrit()
{
    $dateTournoi = "Inconnu";
    foreach (selectionnerInscription_all() as $inscription) {
        $dateTournoi = date("d.m.Y", strtotime($inscription['Date_Debut_Tournoi']));
    }
    return  $dateTournoi;
}

function selectionnerInscriptionID($IdInscriptionTournois)
{
    try {
        $bdd = connectDB();
        $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE FK_ID_Equipe = '$IdInscriptionTournois'";
        $request = $bdd->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerInscription_all()
{
    try {
        $bdd = connectDB();
        $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, ID_Inscription_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi";
        $request = $bdd->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function contientEquipeInscriteSANSID($IdInscriptionTournois)
{
    $nomEquipe = "Inconnu";
    foreach (selectionnerInscriptionID($IdInscriptionTournois) as $inscription) {
        $nomEquipe = $inscription['Nom_Equipe'];
    }
    return  $nomEquipe;
}

function selectionner_inscription($fk_id_tournoi, $statut)
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
