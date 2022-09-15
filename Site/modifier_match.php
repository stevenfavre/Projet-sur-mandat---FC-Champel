<!-- 

Projet          : Site de tournoi en ligne
Description     : Site permettant d'avoir une organisation de match automatisées.

Page actuelle   : modifier_match.php
Détails         : Page permettant d'afficher les champs d'un match 
                  pour permettre à l'utilisateur de modifier les informations du match.

-->
<?php

require_once "./functions/steven_fonctions.php";

// Permet de contrôler quel type d'envoi de formulaire a été fourni
$submitPost = filter_input(INPUT_POST, 'submit');

if ($_GET['id_match'] != null) {
    refreshSessionMatch();
}

if ($submitPost == 'modifier') {

    // Récupération des données permettant la création du produit
    $id_local = filter_input(INPUT_POST, 'equipe_local');
    $id_visiteur = filter_input(INPUT_POST, 'equipe_visiteur');
    $time_debut = filter_input(INPUT_POST, 'time-debut');
    $time_fin = filter_input(INPUT_POST, 'time-fin');
    $type = filter_input(INPUT_POST, 'type-match');
    $type = str_replace("'", "\'", $type);
    $but_local = filter_input(INPUT_POST, 'but_local');
    $but_visiteur = filter_input(INPUT_POST, 'but_visiteur');

    // Code permettant de récupérer les minutes du temps
    $to_time = strtotime($time_fin);
    $from_time = strtotime($time_debut);
    $minutes = round(abs($to_time - $from_time) / 60, 2);

    // Permet de faire l'insertion d'un match dans la base de données
    updateMatch($_SESSION['match']['ID_Match'], $id_local, $id_visiteur, $time_debut, $time_fin, $minutes, $type, $equipe_local, $equipe_visiteur);
    header("Location: match.php?id_tournoi=" . $_SESSION['match']['FK_ID_Tournoi']);
} else if ($submitPost == 'activer') {

    updateActifMatch($_SESSION['match']['ID_Match'], 1);
    refreshSessionMatch();
} else if ($submitPost == 'annuler') {

    updateActifMatch($_SESSION['match']['ID_Match'], 0);
    refreshSessionMatch();
}

function refreshSessionMatch()
{
    $matchs = selectMatchWithID($_GET['id_match']);
    $_SESSION['match'] = $matchs[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Détail du match</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <header class="bg-primary-gradient">
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h2 class="fw-bold">Détail du match du : <?php echo $_SESSION['match']['Date_Match']; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container center-block">
            <form action="#" method="POST">
                <div class="mb-3 w-50 mx-auto">
                    <label for="equipe_local">Equipe local :</label>
                    <select class="form-control" name="equipe_local" required>
                        <?php afficher_option_equipes($_SESSION['match']['FK_ID_Tournoi'], $_SESSION['match']['FK_ID_Local']); ?>
                    </select>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="equipe_visiteur">Equipe local :</label>
                    <select class="form-control" name="equipe_visiteur" required>
                        <?php afficher_option_equipes($_SESSION['match']['FK_ID_Tournoi'], $_SESSION['match']['FK_ID_Visiteur']); ?>
                    </select>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="time-debut">Heure de départ :</label>
                    <input class="form-control" type="time" name="time-debut" min="08:00" max="19:00" value="<?php echo $_SESSION['match']['Heure_Debut_Match']; ?>" required>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="time-debut">Heure de départ :</label>
                    <input class="form-control" type="time" name="time-debut" min="08:00" max="19:00" value="<?php echo $_SESSION['match']['Heure_Debut_Match']; ?>" required>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="time-fin">Heure de fin :</label>
                    <input class="form-control" type="time" name="time-fin" min="08:00" max="19:00" value="<?php echo $_SESSION['match']['Heure_Fin_Match']; ?>" required>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="type-match">Type de match :</label>
                    <input class="form-control" type="text" name="type-match" placeholder="Type de match" value="<?php echo $_SESSION['match']['Type_Match']; ?>" maxlength="25" required>
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="but_local">Nombre de but local :</label>
                    <input class="form-control" type="string" name="but_local" min="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="But Local" value="<?php echo $_SESSION['match']['But_Local_Match']; ?>" required maxlength="2">
                </div>
                <div class="mb-3 w-50 mx-auto">
                    <label for="but_visiteur">Nombre de but visiteur :</label>
                    <input class="form-control" type="string" name="but_visiteur" min="0" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="But Visiteur" value="<?php echo $_SESSION['match']['But_Visiteur_Match']; ?>" required maxlength="2">
                </div>
        </div>
        <div class="mb-3 text-center">
            <button class="btn btn-primary" type="submit" name="submit" value="modifier">Modifier le match</button>
            <br><br>
            <?php
            if ($_SESSION['match']['Actif_Match'] == 1) {
                echo "<button class=\"btn btn-primary\" type=\"submit\" name=\"submit\" value=\"annuler\">Annuler le match</button>";
            } else {
                echo "<button class=\"btn btn-primary\" type=\"submit\" name=\"submit\" value=\"activer\">Reprogrammer le match</button>";
            }
            ?>
        </div>
        </form>
        </div>
        <div class="container">

        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>