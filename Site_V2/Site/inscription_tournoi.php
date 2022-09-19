<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');



//echo $_POST['submit'];

if (isset($_POST['submit'])) {
  $FK_ID_Tournoi = $_POST['FK_ID_Tournoi'];
  $FK_ID_Equipe = $_POST['FK_ID_Equipe'];
  inscription_equipe_tournoi($FK_ID_Tournoi, $FK_ID_Equipe);
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Inscription - Tournois</title>
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
          <p class="fw-bold text-success mb-2">Inscription</p>
          <h2 class="fw-bold">Inscrivez-vous au prochain tournoi</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
          <div>
            <form action="inscription_tournoi.php" class="p-3 p-xl-4" method="post">

              <p class="fw-bold text-success mb-2">Choisissez la date du tournoi auquel vous voulez participer</p>
              <select name="FK_ID_Tournoi" id="listeIdTournoi">
                <?php selection_tournoi_incription($ID_Tournoi) ?>
              </select>
              <br /><br />
              <p class="fw-bold text-success mb-2">Choisissez votre équipe</p>
              <select name="FK_ID_Equipe" id="listeIdTournoi">
                <?php selection_equipe_incription($IdEquipe) ?>
              </select>

              <br /><br />
              <div><button class="btn btn-primary shadow d-block w-100" type="submit" name="submit">S'inscrire</button></div>
              <br /><br />
              <div><button class="btn btn-primary shadow d-block w-100" type="reset" name="reset">Annuler</button></div>
            </form>
            <br /><br />
            <div><a href="Formulaire_insertion_club.php">Insertion des clubs</a></div>
            <br /><br />
            <div><a href="Formulaire_modification_club.php">Modification des clubs</a></div>
            <br /><br />
            <div><a href="Formulaire_suppression_club.php">Suppression des clubs</a></div>
            <br /><br />
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