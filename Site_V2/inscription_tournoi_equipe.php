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
  <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Inscription - Tournois</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
  <?php include_once('default_pages/navbar.php'); ?>
  <section class="py-5">
    <div class="container bg-light">
      <div class="row -5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2 class="fw-bold">Inscrivez-vous au prochain tournoi</h2>
          <div class="card shadow-sm">
            <center>
              <form action="inscription_tournoi.php" class="p-3 p-xl-4" method="post">

                <h5 class="fw-bold text-success mb-2">Choisissez la date du tournoi auquel vous voulez participer <i class="fa-regular fa-calendar"></i> </h5>
                <select name="FK_ID_Tournoi" id="listeIdTournoi">
                  <?php selection_tournoi_incription($ID_Tournoi) ?>
                </select>
                <br /><br />
                <h5 class="fw-bold text-success mb-2">Choisissez votre équipe <i class="fa-solid fa-users"></i></h5>
                <select name="FK_ID_Equipe" id="listeIdTournoi">
                  <?php selection_equipe_incription($IdEquipe) ?>
                </select>
                <br /><br />
                <div><button class="btn btn-primary" type="submit" name="submit">S'inscrire</button>
                  <a class="btn btn-primary shadow" role="button" href="afficher_demandes.php">Revenir</a>
                </div>
              </form>
            </center>
          </div>
        </div>
      </div>
      <p class="text-muted card-text mb-4">&nbsp;</p>
    </div>
  </section>
  </div>
  </div>

  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>