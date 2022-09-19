<?php
session_start(['cookie_lifetime' => 3600,]);
require_once "functions/steven_fonctions.php";

// Permet de contrôler quel type d'envoi de formulaire a été fourni
$submitPost = filter_input(INPUT_POST, 'submit');

if ($_GET['id_tournoi'] != null) {
    $_SESSION['id_tournoi'] = filter_input(INPUT_GET, 'id_tournoi');
}

// Si le formulaire permettant d'indiquer les informations du match on été soumise, permet la récupération ainsi que l'exécution de la base de données
if ($submitPost == 'submit') {

    // Récupération des données permettant la création du produit
    $date = filter_input(INPUT_POST, 'date');
    $time_debut = filter_input(INPUT_POST, 'time-debut');
    $time_fin = filter_input(INPUT_POST, 'time-fin');
    $type = filter_input(INPUT_POST, 'type-match');
    $type = str_replace("'", "\'", $type);
    $equipe_local = filter_input(INPUT_POST, 'equipe-local');
    $equipe_visiteur = filter_input(INPUT_POST, 'equipe-visiteur');
    $terrain = filter_input(INPUT_POST, 'terrain');

    // Permet de faire l'insertion d'un match dans la base de données
    insertMatch($date, $time_debut, $time_fin, '0', $type, $equipe_local, $equipe_visiteur, $_SESSION['id_tournoi'], $terrain);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Créer un match</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold">Créer un match :&nbsp;</h3>
                </div>
            </div>
            <form action="creer_match.php" method="post" onsubmit="checkEquipe()">
                <div class="mb-3"><input class="form-control" type="date" name="date" required></div>
                <div class="mb-3"><input class="form-control" type="time" name="time-debut" min="08:00" max="19:00" required></div>
                <div class="mb-3"><input class="form-control" type="time" name="time-fin" min="08:00" max="19:00" required></div>
                <div class="mb-3"><input class="form-control" type="text" name="type-match" placeholder="Type de match" maxlength="25" required></div>
                <?php
                afficherSelectMatch($_SESSION['id_tournoi']);
                ?>
                <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit" name="submit" value="submit">Créer le match</button></div>
            </form>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        function checkEquipe() {
            var optionLocal = document.getElementById("local").value;
            var optionVisiteur = document.getElementById("visiteur").value;

            if (optionLocal == optionVisiteur) {
                alert("Les équipes doivent être différentes pour le match !");
            } else {
                alert("Match crée !");
            }
        }
    </script>
</body>

</html>