<?php

require_once './functions/steven_fonctions.php'

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Liste des tournois</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body>
  <?php include_once('default_pages/navbar.php'); ?>
  <section class="py-5">
    <div class="container py-5">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h1 class="fw-bold">Tournois</h1>
          <a class="btn btn-primary shadow" role="button" href="afficher_tournois.php">Liste de tournois</a>
          <a class="btn btn-primary shadow" role="button" href="afficher_demandes.php">Inscriptions tournoi</a>

          <br /><br />
          

          <p class="text-muted w-lg-50">Différents tournois géré grâce à notre système.&nbsp;</p>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
        <?php affichageAllTournois(); ?>
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>