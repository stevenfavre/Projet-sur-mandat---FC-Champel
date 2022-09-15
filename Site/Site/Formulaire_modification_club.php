<?php

require_once('./functions/dbconnection.php');
require_once('./functions/Fonctions_Sofian.php');

$nomClub = filter_input(INPUT_POST,  'Nom_Club');
$nomClubModif = filter_input(INPUT_POST,  'Nom_ClubModif');
$urlImageClub = filter_input(INPUT_POST,  'Url_Image_Club');
$actifClub = filter_input(INPUT_POST,  'Actif_club');



if (!empty($nomClubModif) || !empty($urlImageClub) || !empty($actifClub)) {
    modification_club($nomClubModif, $urlImageClub, $nomClub, $actifClub);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Modification du club</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold text-success mb-2">Modification</p>
                    <h2 class="fw-bold">Modifiez les informations du club</h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <form action="#" class="p-3 p-xl-4" method="post">
                        <div>

                            <p class="fw-bold text-success mb-2">Informations actuelles avant les modifications</p>
                            <select name="Nom_Club" id="Nom_ClubSelect" onchange="affichageSelect()">
                                <?php selection_club() ?>
                            </select>
                            <br /><br />
                            <div class="mb-3"><img id="imgClub"></div>
                        </div>
                        <div>
                            <p class="fw-bold text-success mb-2">Modifications</p>
                            <div class="mb-3"><input class="form-control" type="text" id="Nom_ClubModif" name="Nom_ClubModif" placeholder="Nom du club"></div>
                            <div class="mb-3"><input class="form-control" type="text" id="Url_Image_ClubModif" name="Url_Image_Club" placeholder="Url de l'Image Club"></div>
                            <div class="mb-3"><input class="form-control" type="text" id="Actif_clubModif" name="Actif_club" placeholder="Statut du club"></div>
                            <div><input class="btn btn-primary shadow d-block w-100" value='Envoyer' type="submit"></div>
                            <br /><br />
                            <a href="./Formulaire_modification_equipe.php">Modifier une équipe du club</a>
                            <br /><br />
                            <a href="./inscription_tournoi.php">Retour à la page d'insciription au tournoi</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-xl-4 d-flex justify-content-center justify-content-xl-start">
                    <div class="d-flex flex-wrap flex-md-column justify-content-md-start align-items-md-start h-100">
                        <div class="d-flex align-items-center p-3">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>

    <script>
        $('select').on('change', function() {

            remplirFormulaire()
        });
        let nomClub = $("#Nom_ClubModif")
        let imgClub = $("#imgClub")
        affichageSelect()

        function affichageSelect() {
            let clubSelect = $("#Nom_ClubSelect").val()
            $.ajax({
                url: 'functions/requetes_ajax.php?IdClub=' + clubSelect,
                type: "GET",
                success: function(data) {
                    let parsedData = JSON.parse(data)
                    console.log(parsedData)

                    nomClub.val(parsedData.Nom_Club)
                    imgClub.attr("src", "assets/img/team/" + parsedData.Url_Image_Club)
                },
                error: function() {
                    alert("Une erreur est surevenue lors de la requete Ajax")
                }
            })
        }
    </script>
</body>

</html>