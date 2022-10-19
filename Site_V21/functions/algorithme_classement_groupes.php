<?php
require_once "dbconnection.php";
require_once "debug.php";



// Fonction répartissant les groupes dans les classements finales 
function affichageGroupes($tournoi)
{
    echo  "<table class=\"table table-bordered\">
  
    <tr>

            <th scope=\"col\"><CENTER><h5 class=\" text-success mb-2\"> Détails </h5></CENTER></th>
            <th scope=\"col\"><CENTER><h5 class=\" text-success mb-2\"> Classement </h5></CENTER></th></tr> 
   ";

    if (isset($_SESSION["Groupe1"])) {
        unset($_SESSION["Groupe1"]);
    }
    if (isset($_SESSION["Groupe2"])) {
        unset($_SESSION["Groupe2"]);
    }
    if (isset($_SESSION["Groupe3"])) {
        unset($_SESSION["Groupe3"]);
    }
    if (isset($_SESSION["Groupe4"])) {
        unset($_SESSION["Groupe4"]);
    }


    foreach (selectionnerTousLesGroupes($tournoi) as $groupes) {
        $tabClassement = array();
        echo "<td><CENTER><h5 class=\"bold\"></br></br><a href=\"classement_tournoi.php?id_groupe=" . $groupes['ID_Groupe'] . "&id_tournoi=" . $tournoi . "\">" . $groupes['Nom_Groupe'] . "</a></CENTER></h5></td>";
        $q = 1;
        $id_groupe = $groupes['ID_Groupe'];
        $monTableauToutBeau = array();
        $db = connectDB();
        $req = "SELECT DISTINCT  e.ID_Equipe, e.Nom_Equipe, e.Points_Equipe, e.Difference_But_Equipe, g.Nom_Groupe
                  FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
                  JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe 
                  WHERE  m.FK_ID_Groupe = $id_groupe AND m.FK_ID_Tournoi = $tournoi  
                  ORDER BY e.Points_Equipe DESC,
                    e.Difference_But_Equipe DESC ";

        foreach ($db->query($req) as $row) {
            $monTableauToutBeau[] = $row['Nom_Equipe'];
            $monTableauToutBeau[] = $row['Points_Equipe'];
            if ($row["Nom_Groupe"] == "Groupe A") {
                array_push($tabClassement, $row);
                $_SESSION["Groupe1"] = $tabClassement;
            } elseif ($row["Nom_Groupe"] == "Groupe B") {
                array_push($tabClassement, $row);
                $_SESSION["Groupe2"] = $tabClassement;
            } elseif ($row["Nom_Groupe"] == "Groupe C") {
                array_push($tabClassement, $row);
                $_SESSION["Groupe3"] = $tabClassement;
            } elseif ($row["Nom_Groupe"] == "Groupe D") {
                array_push($tabClassement, $row);
                $_SESSION["Groupe4"] = $tabClassement;
            }
        }
        echo "<td><h5 class=\"bold\">" . "<center>" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i></center>" .
            " " . "<center>" .  $monTableauToutBeau[0];
        echo "     | " . "<i class=\"fa-regular fa-star\"></i>      " . $monTableauToutBeau[1];

        echo "</h5>";

        echo "<h5 class=\"bold\">" . "<center>" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i></center>" .
            " " . "<center>" . $monTableauToutBeau[2];
        echo "     | " . "<i class=\"fa-regular fa-star\"></i>      " . $monTableauToutBeau[3];
        echo "</h5>";

        echo "<h5 class=\"bold\">" . "<center>" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i></center>" .
            " " . "<center>" . $monTableauToutBeau[4];
        echo "     |      " . "<i class=\"fa-regular fa-star\"></i>      " . $monTableauToutBeau[5];
        echo "</h5>";

        echo "<h5 class=\"bold\">" . "<center>" . $q++ . "  " . "<i class=\"fa-solid fa-trophy\"></i></center>" .
            " " . "<center>" .  $monTableauToutBeau[6];
        echo "     |     " . "<i class=\"fa-regular fa-star\"></i>      " . $monTableauToutBeau[7];
        echo "</h5></td></br></tr>";
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
}



function affichageResultatGroupes($tournoi)
{
    foreach (selectionnerMatchsGroupeTournoi($tournoi) as $groupe) {
        echo "<td><ul><CENTER>" . $groupe['Nom_Equipe']  . "</ul></td>";
    }
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
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerMatchsQuarts($id_match) as $matchs) {

        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
          <tr>
            <td><h5 class=\"bold\">"  . "Quart de finale n ° " .  $hola++ . "</h5></td>
            <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
            <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
            </tr>";
        } else
            echo "<tr>
        <td><h5 class=\"bold\">"  . "Quart de finale n ° " .  $hola++ . "</h5></td>
            <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
            <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
            </td></tr></tbody>";
    }
}

function affichageResulatsGenerales($tournoi)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerMatchsTous($tournoi) as $matchs) {

        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {
            echo "<tbody><tr>
                    <td><h5 class=\"bold\">"  . $matchs['Type_Match'] . "&nbsp" .   $hola++ . "</h5></td>
                    <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
                    <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
                    <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
                    </tr>";
        } else {
            echo "<tr>
                    <td><h5 class=\"bold\">"  . $matchs['Type_Match'] . "&nbsp" .  $hola++ . "</h5></td>
                        <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
                        <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
                        <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
                        </td></tr></tbody>";
        }
    }
}









function affichageResulatsDemiFinal($id_match)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerDemieFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
          <tr>
            <td><h5 class=\"bold\">"  . "Match demi finale n ° " .  $hola++ . "</h5></td>
            <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
            <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
            </tr>";
        } else
            echo "<tr>
        <td><h5 class=\"bold\">"  . "Match demi finale n ° " .  $hola++ . "</h5></td>
            <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
            <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
            </td></tr></tbody>";
    }
}

function affichageResulatsFinal($id_match)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . "Match finale n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . "Match finale n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
    }
}

function affichagePetiteFinal($id_match)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerPetiteFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . "Match petite finale n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . "Match petite finale n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
    }
}

function affichagePerdantQuartFinal1($id_match)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5></th>
            </tr>
          </thead>";
    foreach (selectionnerEquipesPerdantesQuartFinal($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . "Match perdants quart n ° 1 - 2 "  . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . "Match perdants quart n ° 1 - 2 " . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
    }
}

function affichagePerdantDernierePlace($id_match)
{
    $hola = 1;
    foreach (selectionnerEquipesPerdantesDernierePlace1($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {
            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . "Match 5-6 place " .  "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . "Match 5-6 place " .   "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
    }
}

function affichagePerdantDernierePlace1($id_match)
{
    $hola = 1;
    foreach (selectionnerEquipesPerdantesDernierePlace($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " Match 7-8 place" .   "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . " Match 7-8 place " .   "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
    }
}
function affichagePerdantDernierePlace2($id_match)
{
    $hola = 1;
    echo  "<tr><table class=\"table\"><thead class=\"thead-dark\">
    <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Victoires " .  "<i class=\"fa-regular fa-pen-to-square\"></i></h5>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Classement " .  "</h5></th>
            </tr>
          </thead>";

    foreach (selectionnerEquipesPerdantesDernierePlace2($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur'])  . "</h5></td>
              </tr>";
        } else
            $h = 1;
        echo "<tr>
          <td><h5 class=\"bold\">"  . " n ° " .  $h++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              <td><h5 class=\"bold\">"  . " 9 ème " . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</br>" .  " 10 ème "  . contientNomEquipe($matchs['FK_ID_Visiteur']) .   "</h5>
              </td></tr></tbody>";
    }
}
function affichagePerdantDernierePlace3($id_match)
{
    $hola = 3;
    foreach (selectionnerEquipesPerdantesDernierePlace3($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " n ° 3" .   "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur'])  . "</h5></td>
              </tr>";
        } else
            $h = 1;
        echo "<tr>
          <td><h5 class=\"bold\">"  . " n ° " .  $h++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              <td><h5 class=\"bold\">"  . " 11 ème " . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</br>" .  " 12 ème "  . contientNomEquipe($matchs['FK_ID_Visiteur']) .   "</h5>
              </td></tr></tbody>";
    }
}
function affichagePerdantDernierePlace4($id_match)
{
    $hola = 1;
    foreach (selectionnerEquipesPerdantesDernierePlace4($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur'])  . "</h5></td>
              </tr>";
        } else
            $h = 1;
        echo "<tr>
          <td><h5 class=\"bold\">"  . " n ° " .  $h++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              <td><h5 class=\"bold\">"  . " 13 ème " . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</br>" .  " 14 ème "  . contientNomEquipe($matchs['FK_ID_Visiteur']) .   "</h5>
              </td></tr></tbody>";
    }
}
function affichagePerdantDernierePlace5($id_match)
{
    $hola = 1;
    foreach (selectionnerEquipesPerdantesDernierePlace5($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " n ° " .  $hola++ . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5> 
              <td><h5 class=\"bold\">"  . " 15 ème "  .   contientNomEquipe($matchs['FK_ID_Visiteur']) . "</br>" .  " 16 ème "  . contientNomEquipe($matchs['FK_ID_Local']) .   "</h5></td>
              </tr>";
        } else if ($matchs['But_Local_Match'] > $matchs['But_Visiteur_Match']) {
            echo "<tr>
            <td><h5 class=\"bold\">"  . " n ° " . "</h5></td>
                <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
                <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
                <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
                </td></tr></tbody>";
        }
    }
}


function affichagePerdantQuartFinal2($id_match)
{
    $hola = 1;



    foreach (selectionnerEquipesPerdantesQuartFinal2($id_match) as $matchs) {
        if ($matchs['But_Local_Match'] < $matchs['But_Visiteur_Match']) {

            echo "<tbody>
            <tr>
              <td><h5 class=\"bold\">"  . " Match perdants  quart n ° 3 - 4 "  . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  .  "<i class=\"fa-solid fa-trophy\"></i>" . " " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
              </tr>";
        } else
            echo "<tr>
          <td><h5 class=\"bold\">"  . " Match perdants  quart n ° 3 - 4 " . "</h5></td>
              <td><h5 class=\"bold\">"  .   contientNomEquipe($matchs['FK_ID_Local']) . " VS " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
              <td><h5 class=\"bold\">"  .  $matchs['But_Local_Match'] . " vs " .  $matchs['But_Visiteur_Match'] . "</h5></td>
              <td><h5 class=\"bold\">"  . "<i class=\"fa-solid fa-trophy\"></i>" . " " . contientNomEquipe($matchs['FK_ID_Local']) . "</h5>
              </td></tr></tbody>";
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

function affichageResulatsEquipes($id_groupe, $id_tournoi)
{
    $hola = 1;

    echo  "</br><tr><table class=\"table\"><thead class=\"thead-dark\">
            </br><th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Match "  .  "</h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Equipes " .  "<i class=\"fa-solid fa-people-group\"></i>" . " vs " .
        "<i class=\"fa-solid fa-people-group\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Buts " .   "<i class=\"fa-regular fa-futbol\"></i></h5></th>
            <th scope=\"col\"><h5 class=\"fw-bold text-success mb-2\"> Points " .  "<i class=\"fa-regular fa-star\"></i></h5></th>
           
          </tr>
        </thead>";
    $listeEquipe = [];
    $butsMarques0 = 0;
    $butsMarques1 = 0;
    $butsMarques2 = 0;
    $butsMarques3 = 0;
    $butsEncaisse0 = 0;
    $butsEncaisse1 = 0;
    $butsEncaisse2 = 0;
    $butsEncaisse3 = 0;
    $differenceBut0 = 0;
    $differenceBut1 = 0;
    $differenceBut2 = 0;
    $differenceBut3 = 0;


    foreach (selectionnerMatchsGroupe($id_groupe, $id_tournoi) as $matchs) {
        echo "<tbody>
          <tr>
            <td><h5 class=\"bold\">"  . "n ° " .  $hola++ . "</h5></td>
            <td><h5 class=\"bold\">"  . contientNomEquipe($matchs['FK_ID_Local']) . "  VS  " .  contientNomEquipe($matchs['FK_ID_Visiteur']) . "</h5>
            <td><h5 class=\"bold\">"  . $matchs['But_Local_Match'] . " VS " .  $matchs['But_Visiteur_Match'] . "</h5></td>
            <td><h5 class=\"bold\">" . contientPointsEquipe($matchs['FK_ID_Local']) . " - " .  contientPointsEquipe($matchs['FK_ID_Visiteur']) . "</h5></td>
             <td><h5 class=\"bold\">"  . "</h5></td>
          </tr></tbody>";

        if (!in_array(contientNomEquipe($matchs['FK_ID_Local']), $listeEquipe)) {
            array_push($listeEquipe, contientNomEquipe($matchs['FK_ID_Local']));
        }
        if (!in_array(contientNomEquipe($matchs['FK_ID_Visiteur']), $listeEquipe)) {
            array_push($listeEquipe, contientNomEquipe($matchs['FK_ID_Visiteur']));
        }
    }
    foreach (selectionnerMatchsGroupe($id_groupe, $id_tournoi) as $matchs) {
        if ($listeEquipe[0] == contientNomEquipe($matchs['FK_ID_Local'])) {
            $butsMarques0 += $matchs['But_Local_Match'];
            $butsEncaisse0 += $matchs['But_Visiteur_Match'];
        }
        if ($listeEquipe[0] == contientNomEquipe($matchs['FK_ID_Visiteur'])) {
            $butsMarques0 += $matchs['But_Visiteur_Match'];
            $butsEncaisse0 += $matchs['But_Local_Match'];
        }
        if ($listeEquipe[1] == contientNomEquipe($matchs['FK_ID_Local'])) {
            $butsMarques1 += $matchs['But_Local_Match'];
            $butsEncaisse1 += $matchs['But_Visiteur_Match'];
        }
        if ($listeEquipe[1] == contientNomEquipe($matchs['FK_ID_Visiteur'])) {
            $butsMarques1 += $matchs['But_Visiteur_Match'];
            $butsEncaisse1 += $matchs['But_Local_Match'];
        }
        if ($listeEquipe[2] == contientNomEquipe($matchs['FK_ID_Local'])) {
            $butsMarques2 += $matchs['But_Local_Match'];
            $butsEncaisse2 += $matchs['But_Visiteur_Match'];
        }
        if ($listeEquipe[2] == contientNomEquipe($matchs['FK_ID_Visiteur'])) {
            $butsMarques2 += $matchs['But_Visiteur_Match'];
            $butsEncaisse2 += $matchs['But_Local_Match'];
        }
        if ($listeEquipe[3] == contientNomEquipe($matchs['FK_ID_Local'])) {
            $butsMarques3 += $matchs['But_Local_Match'];
            $butsEncaisse3 += $matchs['But_Visiteur_Match'];
        }
        if ($listeEquipe[3] == contientNomEquipe($matchs['FK_ID_Visiteur'])) {
            $butsMarques3 += $matchs['But_Visiteur_Match'];
            $butsEncaisse3 += $matchs['But_Local_Match'];
        }
    }
    '<br>';
    $differenceBut0 = $butsMarques0 - $butsEncaisse0;
    $differenceBut1 = $butsMarques1 - $butsEncaisse1;
    $differenceBut2 = $butsMarques2 - $butsEncaisse2;
    $differenceBut3 = $butsMarques3 - $butsEncaisse3;



    updateButs($listeEquipe[0], $differenceBut0);
    updateButs($listeEquipe[1], $differenceBut1);
    updateButs($listeEquipe[2], $differenceBut2);
    updateButs($listeEquipe[3], $differenceBut3);
}


function updateButs($nom_equipe, $butsMarques)
{
    $db = connectDB();
    $sql = "UPDATE Equipe SET Difference_But_Equipe = :butMarque WHERE Nom_Equipe = :nomEquipe";
    $request = $db->prepare($sql);
    $request->execute([
        'nomEquipe' => $nom_equipe,
        'butMarque' => $butsMarques
    ]);
}

function affichageResulatsEquipes2($id_groupe, $id_tournoi)
{
    $hola = 1;
    echo "<tr><CENTER><h2 class=\"fw-bold text-success mb-2\">Classement du "  . contientNomGroupe($id_groupe) . "</h2></tr></br>";
    foreach (selectionnerMatchsGroupe3($id_groupe, $id_tournoi) as $matchs) {
        echo  "<td><CENTER><h5 class=\"fw-bold\">" . $hola++ .
            "  " . "<i class=\"fa-solid fa-trophy\"></i>
            </h5>" . " <h5 style='margin-left:70px;'>" .  $matchs['Nom_Equipe'] . "<br>Points " . $matchs['Points_Equipe']  . "<i class=\"fa-regular fa-star\"></i><br>  Différence de buts " . $matchs['Difference_But_Equipe'] . " </h5></td>";
    }
}

function affichageGagnantes($id_groupe)

{
    foreach (selectionnerMatchsGroupe2($id_groupe) as $matchs) {
        echo  "<td><ul><h5 class=\"fw-bold\">" .
            "<i class=\"fa-solid fa-trophy\"></i>" . " " . selectionnerEquipesGagnantes($matchs['ID_Groupe'])  . " points" .  "</h5></ul></td>";
    }
}

function affichageResulatsEquipes1($id_groupe, $id_tournoi)
{
    foreach (selectionnerMatchsGroupe($id_groupe, $id_tournoi) as $matchs) {
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

function selectionnerMatchsGroupe($id_groupe, $id_tournoi)
{

    try {
        $db = connectDB();
        $sql = "SELECT * FROM Matchs
        WHERE FK_ID_Groupe = $id_groupe AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerButs($id_groupe, $id_tournoi)
{

    try {
        $db = connectDB();
        $sql = "SELECT e.ID_Equipe, m.FK_ID_Local, m.FK_ID_Visiteur, m.But_Local_Match,
        m.But_Visiteur_Match FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe = m.FK_ID_Visiteur 
        WHERE  m.FK_ID_Groupe = $id_groupe AND m.FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll();
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
        $sql = "SELECT DISTINCT  e.Nom_Equipe, 
        e.Points_Equipe, 
        g.Nom_Groupe, 
        Type_Match, 
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

function selectionnerMatchsGroupe3($id_groupe, $id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT  e.Nom_Equipe, e.Points_Equipe, e.Difference_But_Equipe, g.Nom_Groupe
        FROM Matchs AS m JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe
        WHERE  m.FK_ID_Groupe = $id_groupe AND FK_ID_Tournoi = $id_tournoi 
        ORDER BY e.Points_Equipe DESC,
        e.Difference_But_Equipe DESC
        ; ";


        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerButParEquipeJesus($nom_equipe, $id_tournoi)
{
    $db = connectDB();
    $sql = "SELECT DISTINCT m.But_Local_Match, m.But_Visiteur_Match, m.But_Total_Equipe
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe
        WHERE  e.Nom_Equipe = $nom_equipe 
        AND FK_ID_Tournoi = $id_tournoi";
    $request = $db->prepare($sql);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
function selectionnerButParEquipe($id_groupe, $id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT m.But_Local_Match, m.But_Visiteur_Match
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe as g ON g.ID_Groupe = m.FK_ID_Groupe
        WHERE  m.FK_ID_Groupe = $id_groupe 
        AND FK_ID_Tournoi = $id_tournoi";

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

function selectionnerPointsEquipes($id_groupe)
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

function contientHeureMatch($id_groupe, $id_tournoi)
{
    $h = "Non existant";
    foreach (selectionnerMatchsGroupe($id_groupe, $id_tournoi) as $groupe) {
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

function selectionnerTousLesGroupes($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT g.ID_Groupe, g.Nom_Groupe
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe AS  g ON g.ID_Groupe = m.FK_ID_Groupe
        JOIN Tournoi AS t ON t.ID_Tournoi = m.FK_ID_Tournoi

        WHERE m.FK_ID_Tournoi = $id_tournoi AND Type_Match = 'Poule' ";

        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsEtClassement($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT g.ID_Groupe, g.Nom_Groupe
        FROM Matchs AS m 
        JOIN Equipe AS e ON e.ID_Equipe = m.FK_ID_Local OR e.ID_Equipe =  m.FK_ID_Visiteur
        JOIN Groupe AS  g ON g.ID_Groupe = m.FK_ID_Groupe
        JOIN Tournoi AS t ON t.ID_Tournoi = m.FK_ID_Tournoi

        WHERE m.FK_ID_Tournoi = $id_tournoi ";

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

function selectionnerMatchsQuarts($id_tournoi)
{
    try {

        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Quart de finale ' AND FK_ID_Tournoi = $id_tournoi ";

        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerMatchsTous($id_tournoi)
{
    try {

        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE  FK_ID_Tournoi = $id_tournoi ";

        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}



function selectionnerDemieFinal($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Demi finale' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerFinal($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Finale' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerPetiteFinal($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Petite finale' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerEquipesPerdantesQuartFinal($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'PerdantsQuartUn' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerEquipesPerdantesDernierePlace1($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_5Et6_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerEquipesPerdantesDernierePlace($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_7Et8_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerEquipesPerdantesDernierePlace2($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_9Et10_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerEquipesPerdantesDernierePlace3($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_11Et12_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerEquipesPerdantesDernierePlace4($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_13Et14_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}
function selectionnerEquipesPerdantesDernierePlace5($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'Match_15Et16_place' AND FK_ID_Tournoi = $id_tournoi ";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        debug($e->getMessage());
    }
}

function selectionnerEquipesPerdantesQuartFinal2($id_tournoi)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Matchs` WHERE Type_Match = 'PerdantsQuartDeux' AND FK_ID_Tournoi = $id_tournoi ";
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

function contientIDEquipe($id_equipe)
{
    $nom = "Non existant";
    foreach (selectionneIDEquipe($id_equipe) as $equipe) {
        $nom = $equipe['ID_Equipe'];
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

function selectionneIDEquipe($id_equipe)
{
    try {
        $db = connectDB();
        $sql = "SELECT DISTINCT ID_Equipe FROM Equipe WHERE `ID_Equipe` = " . $id_equipe . ";";
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

function gagnant3($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Finale' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant4($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Finale' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place15;
}





function gagnant5($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Petite Finale' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place15;
}

function gagnant6($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Petite Finale' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place16 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place15 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place15;
}
function gagnant7($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_5Et6_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant8($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_5Et6_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}
function gagnant9($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_7Et8_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant10($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_7Et8_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}
function gagnant11($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_9Et10_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant12($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_9Et10_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}

function gagnant13($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_11Et12_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant14($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_11Et12_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}


function gagnant15($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_13Et14_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}

function gagnant16($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_13Et14_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}

function gagnant17($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_15Et16_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();

    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] > $data['But_Visiteur_Match']) {
            $place15 = $data['FK_ID_Local'];
        } else {
            $place16 = contientNomEquipe($data['FK_ID_Visiteur']);
        }
    }
    echo $place16;
}


function gagnant18($id_tournoi)
{

    $db = connectDB();
    $sql = "SELECT But_Visiteur_Match, But_Local_Match, FK_ID_Visiteur, FK_ID_Local   FROM Matchs  
        WHERE Type_Match = 'Match_15Et16_place' AND FK_ID_Tournoi = $id_tournoi ";
    $request = $db->prepare($sql);
    $request->execute();
    $reponse = $request->fetchAll();
    foreach ($reponse as $data) {
        if ($data['But_Local_Match'] < $data['But_Visiteur_Match']) {
            $place15 = contientNomEquipe($data['FK_ID_Local']);
        } else {
            $place16 = $data['FK_ID_Visiteur'];
        }
    }
    echo $place15;
}
