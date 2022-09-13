<?php
session_start(['cookie_lifetime' => 3600,]);
require_once "functions/steven_fonctions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Liste des matchs</title>
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
          <p class="fw-bold text-success mb-2">Liste des matchs</p>
          <h3 class="fw-bold">Match du tournoi :&nbsp;</h3>
          <p class="text-muted">&nbsp;<a href="afficher_equipe_tournoi.php?id_tournoi=<?php echo $_GET['id_tournoi']; ?>">Equipes inscrites</a></p>
          <a class="btn btn-primary shadow" role="button" href="creer_match.php?id_tournoi=<?php echo $_GET['id_tournoi']; ?>">Créer un match</a>
          <?php
          // afficherSalleEtDate($_GET['id_tournoi']);
          ?>
        </div>
      </div>
      <form action="details_match.php" method="get">
        <?php
        afficherMatch($_GET['id_tournoi']);
        ?>
      </form>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>