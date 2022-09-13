<?php
session_start(['cookie_lifetime' => 3600,]);
require_once "./functions/steven_fonctions.php";

$submit = filter_input(INPUT_GET, 'submit');

if (substr($submit, 0, 1) == 'm') { // S'il s'agit de l'affichage d'un match
    refreshSessionMatch(selectMatchWithID(substr($submit, 2)));
} elseif (substr($submit, 0, 1) == 'U') { // S'il s'agit d'une augmentation du score
    updateUpScore($_SESSION['match']['ID_Match'], $submit[1]);
    refreshSessionMatch(selectMatchWithID($_SESSION['match']['ID_Match']));
} elseif (
    substr($submit, 0, 1) == 'D'
    && $_SESSION['match']['But_Local_Match'] != 0
    && $_SESSION['match']['But_Visiteur_Match'] != 0
) { // S'il s'agit d'une réduction du score
    updateDownScore($_SESSION['match']['ID_Match'], $submit[1]);
    refreshSessionMatch(selectMatchWithID($_SESSION['match']['ID_Match']));
}

function refreshSessionMatch($matchs)
{
    foreach ($matchs as $match)
        $_SESSION['match'] = $match;
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
                        <p class="fw-bold text-success mb-2"><?php echo "Numéro du tournoi : " . $_SESSION['match']['FK_ID_Tournoi'] ?></p>
                        <p class="fw-bold text-success mb-2"><?php echo $_SESSION['match']['Heure_Debut_Match'] . " -> " . $_SESSION['match']['Heure_Fin_Match'] ?></p>
                        <p class="fw-bold text-success mb-2"><?php echo "Catégorie : " . $_SESSION['match']['Type_Match'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            <form action="details_match.php" action="get">
                <table class="table">
                    <thead>
                        <td class="text-center">
                            <h3><?php echo returnNameEquipe($_SESSION['match']['FK_ID_Local']); ?></h3>
                        </td>
                        <td class="text-center">
                            <h3><?php echo returnNameEquipe($_SESSION['match']['FK_ID_Visiteur']); ?></h3>
                        </td>

                    </thead>
                    <tr style="height:15%">
                        <td class="text-center">
                            <button type="submit" class="btn btn-primary btn-xs" name="submit" value="UL<?php echo $_SESSION['match']['FK_ID_Local']; ?>">
                                <ion-icon name="chevron-up-outline"></ion-icon>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-primary btn-xs" name="submit" value="UV<?php echo $_SESSION['match']['FK_ID_Visiteur']; ?>">
                                <ion-icon name="chevron-up-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                    <tr style="height:15%">
                        <td>
                            <h3 class="text-center"><?php echo $_SESSION['match']['But_Local_Match']; ?></h3>
                        </td>
                        <td>
                            <h3 class="text-center"><?php echo $_SESSION['match']['But_Visiteur_Match']; ?></h3>
                        </td>
                    </tr>
                    <tr style="height:15%">
                        <td class="text-center">
                            <button type="submit" class="btn btn-primary btn-xs" name="submit" value="DL<?php echo $_SESSION['match']['FK_ID_Local']; ?>">
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-primary btn-xs" name="submit" value="DV<?php echo $_SESSION['match']['FK_ID_Visiteur']; ?>">
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </button>
                        </td>
                    </tr>
                </table>
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