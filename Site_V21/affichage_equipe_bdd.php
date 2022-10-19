<?php

require_once('./functions/dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('./functions/Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Contacts - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../Site/css_Sofian.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <p class="fw-bold text-success mb-2"></p>
                    <h2 class="fw-bold"></h2>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <h2 class="fw-bold">Liste des équipes</h2>
                    <br /><br />
                    <select name="Nom_Equipe" id="Nom_EquipeASelectionner" onchange="affichageSelectionEquipe()">
                        <?php selection_equipe(); ?>
                    </select>
                    <div id="concat"></div>
                </div>
            </div>
            <br /><br />
            <a href="./page_equipes.php">Retour</a>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>


    <script>
        $('select').on('change', function() {


        });


        affichageSelectionEquipe()

        function affichageSelectionEquipe() {
            $('#concat').empty();
            let equipeSelect = $("#Nom_EquipeASelectionner").val()

            $.ajax({
                url: 'functions/requetes_ajax2.php?nomEquipe=' + equipeSelect,
                type: "GET",
                success: function(data) {

                    let parsedData = JSON.parse(data)
                    console.log(parsedData)

                    let nomEquipe = parsedData[0]
                    let degreEquipe = parsedData[1]
                    let nomGroupeEquipe = parsedData[2]

                    var tabEquipe = '<br /><br /><table><tr><td><ul><h5 class="fw-bold card-title">Nom degré et groupe</h5></ul></td><td>'
                    tabEquipe += '<tr><td><ul>'
                    tabEquipe += nomEquipe
                    tabEquipe += '<tr><td><ul>'
                    tabEquipe += degreEquipe
                    tabEquipe += '<tr><td><ul>'
                    tabEquipe += nomGroupeEquipe
                    tabEquipe += '</ul></td></tr></table>'
                    $('#concat').append(tabEquipe);


                },
                error: function() {
                    alert("Une erreur est surevenue lors de la requete Ajax")
                }
            })
        }
    </script>





</body>

</html>