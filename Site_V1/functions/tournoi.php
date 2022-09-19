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

    $sql = ("SELECT s.Nom_Salle, t.Date_Debut_Tournoi, t.Date_Fin_Tournoi, t.Actif_Tournoi FROM Tournoi AS t JOIN Salle AS s ON s.ID_Salle = t.FK_ID_Salle WHERE t.Actif_Tournoi = '1' ");
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();


    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
        <td><ul>" . date("d.m.Y", strtotime($data['Date_Fin_Tournoi'])) .  "</ul></td>
        <td><ul>" .  $data['Nom_Salle'] . "</ul></td></tr>";
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
function selection_tournoi()
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi WHERE Actif_Tournoi = '1' ORDER BY ID_Tournoi ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Tournoi'] . "'>" . date("d.m.Y", strtotime($donnees['Date_Debut_Tournoi'])) . "</option>";
    }

    $bdd = null;
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
///Fonction permettant d'fficher les informations  d'une équipe inscrite selon le tournoi et sous forme de tableau et qui affiche des nouvelles options selon le statut sous forme de liste déroulante.
function afficher_infos_equipes_inscrites_modif()
{
    $IdInscriptionTournois = $_SESSION['id_inscription'];

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
//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_demandes_noms_equipes_inscrites($IDEquipe = null)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = 3 AND Statut_Inscription_Tournoi = 'En attente' ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($IDEquipe != $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . ">" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}
//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription qui a été validé pour le tournoi choisi, sous forme de liste déroulante 
function selectionner_noms_equipes_inscrites($IDEquipe = null)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE Statut_Inscription_Tournoi = 'Validé' ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($IDEquipe != $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . ">" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription qui a été validé pour le tournoi choisi, sous forme de liste déroulante 
function selectionner_noms_equipes_inscrites_with_id($IDEquipe = null, $id_tournoi)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = " . $id_tournoi . " AND Statut_Inscription_Tournoi = 'Validé' ";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($IDEquipe != $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . ">" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_noms_equipes_pas_inscrites_with_id($IDEquipe = null, $id_tournoi)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE FK_ID_Tournoi = " . $id_tournoi . " AND Statut_Inscription_Tournoi = 'En attente' ORDER BY Date_Inscription_Tournoi ASC";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($IDEquipe != $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . ">" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}

//fonction permettant de sélectionner les noms des équipes ayant fait une demande d'inscription pour un tournoi qui n'a pas été encore validé, sous forme de liste déroulante 
function selectionner_noms_equipes_pas_inscrites($IDEquipe = null)
{

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT * FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe WHERE Statut_Inscription_Tournoi = 'En attente' ORDER BY Date_Inscription_Tournoi ASC";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    /* echo "<select name=EQUIPE>"; */
    foreach ($reponse2 as $data) {
        if ($IDEquipe != $data['FK_ID_Equipe']) {
            echo "<option value=" . $data['FK_ID_Equipe'] . ">" . $data['Nom_Equipe'] . "</option>";
        } else {
            echo "<option value=" . $data['FK_ID_Equipe'] . " selected>" . $data['Nom_Equipe'] . "</option>";
        }
        /* echo $data['Nom_Equipe']; */
    }
    /* echo '</select>'; */
    return null;
}

//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi
function afficher_infos_equipes_selectionnee()
{
    $IdInscriptionTournois = $_POST['FK_ID_Equipe'];

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE FK_ID_Equipe = '$IdInscriptionTournois'";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
    echo "<h3 class=\"fw-bold text-success mb-2\">Demande validée</h3>";
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
//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription pour un tournoi ainsi que les informations du tournoi (les equipes dont linscription ets toujours en attente)
function afficher_infos_equipes_desinscrite()
{
    $IdInscriptionTournois = $_POST['FK_ID_Equipe'];

    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE FK_ID_Equipe = '$IdInscriptionTournois'";
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();
    echo "<h3 class=\"fw-bold text-success mb-2\">Equipe désinscrite</h3>";
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
//fonction permettant d'afficher les  équipes ayant fait une demande d'inscription qui a été validée pour un tournoi ainsi que les informations du tournoi
function afficher_toutes_equipes_inscrites()
{


    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql = "SELECT e.Nom_Equipe, e.Degres_Equipe, g.Nom_Groupe, c.Nom_Club, t.Date_Debut_Tournoi, Date_Inscription_Tournoi, Statut_Inscription_Tournoi  FROM Inscription_Tournoi AS i JOIN Equipe AS e ON e.ID_Equipe = i.FK_ID_Equipe JOIN Groupe as g ON g.ID_Groupe = e.FK_ID_Groupe JOIN Club as c ON c.ID_Club = e.FK_ID_Club JOIN Tournoi as t ON t.ID_Tournoi = i.FK_ID_Tournoi WHERE Statut_Inscription_Tournoi = 'Validé' ";
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
function afficher_tournois()
{
    $bdd = connectDB();

    $bdd->query("SET NAMES 'utf8'");

    $sql =  ("SELECT s.Nom_Salle, t.Date_Debut_Tournoi, t.Date_Fin_Tournoi, t.Actif_Tournoi FROM Tournoi AS t JOIN Salle AS s ON s.ID_Salle = t.FK_ID_Salle WHERE t.Actif_Tournoi = '1' ");
    $req = $bdd->prepare($sql);

    $req->execute();
    $reponse2 = $req->fetchAll();

    echo "<h3 class=\"fw-bold text-success mb-2\">Tous les tournois</h3>";

    echo "<tr><td><ul><h5 class=\"fw-bold card-title\">Date début</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Date fin</h5></ul></td>
    <td><ul><h5 class=\"fw-bold card-title\">Salle</h5></ul></td></tr>";

    foreach ($reponse2 as $data) {
        echo "<tr><td><ul>" . date("d.m.Y", strtotime($data['Date_Debut_Tournoi'])) . "</ul></td>
        <td><ul>" . date("d.m.Y", strtotime($data['Date_Fin_Tournoi'])) . "</ul></td>
        <td><ul>" .  $data['Nom_Salle'] . "</ul></td>
        <td><ul><a href=\"creer_tournoi.php\"class=\"fa-solid fa-plus\"</a></ul></td>
        <td><ul><a href=\"modifier_tournoi.php\"class=\"far fa-edit btn-light m-2\"</a></ul></td>";
        echo "</ul></td><td><ul><a href=\"supprimer_tournoi.php\"class=\"fa-solid fa-trash\"</a></ul></td></tr>";
    }

    return null;
}
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
function update_statut_equipes_tournoiTst()

{
    $IdInscriptionTournois = $_SESSION['id_inscription'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE `Inscription_Tournoi` SET `Statut_Inscription_Tournoi`  = 'Validé' WHERE `FK_ID_Equipe` = '$IdInscriptionTournois'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    return null;
}
//fonction permetant de modifier le statut de l'inscription le faire passer de validé à en attente
function update_statut_equipes()

{
    $IdInscriptionTournois = $_SESSION['id_inscription'];
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("UPDATE Inscription_Tournoi SET Statut_Inscription_Tournoi  = 'En attente' WHERE FK_ID_Equipe = '$IdInscriptionTournois'");
    $reponse->setFetchMode(PDO::FETCH_BOTH);


    return null;
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
function inscription_equipe_tournoi($FK_ID_Tournoi, $FK_ID_Equipe)
{
    $bdd = connectDB();
    $reponse = $bdd->query("SET NAMES 'utf8'");
    $reponse = $bdd->query("INSERT INTO Inscription_Tournoi (`ID_Inscription_Tournoi`, `Date_Inscription_Tournoi`, `Statut_Inscription_Tournoi`, `FK_ID_Tournoi`, `FK_ID_Equipe`) VALUES (NULL, '" . date('y-m-d') . "', 'En attente', '" . $FK_ID_Tournoi . "', '" . $FK_ID_Equipe . "')");

    echo "L'insertion a été correctement réalisée.<br><br>";
    echo "Que voulez-vous faire maintenant?<br>";

    return null;
}
//fonction permetant de selectionner la date de début d'un tournoi sous forme de liste déroulante
function selection_tournoi_incription($IdTournoi)
{
    $bdd = connectDB();
    $bdd->query("SET NAMES 'utf8'");

    $reponse = $bdd->query("SELECT * FROM Tournoi ORDER BY Date_Debut_Tournoi ASC");
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

    $reponse = $bdd->query("SELECT * FROM Equipe ORDER BY Nom_Equipe ASC");
    $reponse->setFetchMode(PDO::FETCH_BOTH);

    while ($donnees = $reponse->fetch()) {
        echo "<option value='" . $donnees['ID_Equipe'] . "'>" . $donnees['Nom_Equipe'] . "</option>";
    }

    $bdd = null;
}
