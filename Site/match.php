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
          <a class="btn btn-primary shadow" role="button" href="creer_match.php?id_tournoi=<?php echo $_GET['id_tournoi']; ?>">Créer un match</a>
          <?php
          // afficherSalleEtDate($_GET['id_tournoi']);
          ?>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center mb-5">
          <h5 class="fw-bold text-center">Score : 0 - 0</h5>
        </div>
        <div class="col d-md-flex align-items-md-end align-items-lg-center mb-5">
          <div>
            <h5 class="fw-bold">Team B - Team D</h5>
            <p class="text-muted mb-4">Lieu :&nbsp;<br>Date :&nbsp;<br></p>
          </div>
        </div>
      </div>
      <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
        <div class="col text-center d-xl-flex order-md-last justify-content-xl-center align-items-xl-center mb-5">
          <h5 class="fw-bold text-center">Score : 0 - 0</h5>
        </div>
        <div class="col d-md-flex align-items-md-end align-items-lg-center mb-5">
          <div>
            <h5 class="fw-bold">Team A - Team B</h5>
            <p class="text-muted mb-4">Lieu :&nbsp;<br>Date :&nbsp;<br></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>