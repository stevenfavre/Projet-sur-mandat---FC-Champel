<?php
session_start(['cookie_lifetime' => 3600,]);
require_once "functions/steven_fonctions.php";

// Permet de contrôler quel type d'envoi de formulaire a été fourni
$submitPost = filter_input(INPUT_POST, 'submit');

if ($_GET['id_tournoi'] != null) {
    $_SESSION['id_tournoi'] = filter_input(INPUT_GET, 'id_tournoi');

    $tournoi = selectTournoiWithID($_SESSION['id_tournoi']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Paramètre du tournoi</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <section class="py-5">
        <div class="container justify-content-center py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h3 class="fw-bold">Paramètre du tournoi : <?= date("d.m.Y", strtotime(getDateTournoi($_SESSION['id_tournoi']))) ?>&nbsp;</h3>
                </div>
            </div>
            <form action="./functions/algorithme_match_poul.php" method="post">
                <div class="mb-3">
                    <label>Heure du premier match</label>
                    <input class="form-control mx-sm-3" style="max-width: 30%;" type="time" name="time-debut" min="08:00:00" value="08:00:00" step="1" required>
                </div>
                <div class="mb-3">
                    <label>Temps de match</label>
                    <input class="form-control mx-sm-3" style="max-width: 30%;" type="number" name="time-match" max="15" value="10" step="1" required>
                </div>
                <div class="mb-3">
                    <label>Temps de pause entre chaque match</label>
                    <input class="form-control mx-sm-3" style="max-width: 30%;" type="number" name="time-pause" max="10" value="2" step="1" required>
                </div>
                <br><br>
                <div class="mb-3">
                    <table class="table" style="border: none; margin: 0 auto 0 auto;">
                        <?php afficherTableauGroupe($_SESSION['id_tournoi']); ?>
                    </table>
                </div>

                <div class="mb-3">
                    <a href="./functions/algorithme_groupe.php?id_tournoi=<?=$_SESSION['id_tournoi']?>" class="btn btn-primary btn-sm">Rematch les groupes</a>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary btn-sm" type="submit" name="submit" value="submit">Lancer le tournoi</button>
                </div>

                <input type="hidden" name="id_tournoi" value="<?=$_SESSION['id_tournoi']?>" />
            </form>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>