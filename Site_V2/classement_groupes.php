<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');

if (!empty($_GET['submit'])) {
  $_SESSION['submit'] = $_GET['submit'];
  $submit = filter_input(INPUT_GET, 'submit');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Classement - Tournois</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
  <?php include_once('default_pages/navbar.php'); ?>
  <section class="py-5">
    <div class="container" style="width: 5000px;margin: auto;border: 5px solid #FF0000;">
      <div class="container py-5">
        <div class="row mb-5">
          <div class="col-md-8 col-xl-6 text-center mx-auto">
            <p class="fw-bold text-success mb-2">Tous les groupes</p>
            <h1>Classement groupes</h1>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 col-xl-6">
            <form action="classement_groupes.php" method="get">
              <table>
                <tbody>

                  <?php
                  affichageGroupes($_SESSION['id_tournoi']);
                  //affichageResultatGroupes($_SESSION['id_tournoi']); SELECT MAX
                  ?>
                </tbody>
              </table>
              <?php
              if (empty($_GET['id_tournoi'])) { ?>
                <!-- <a class="btn btn-primary shadow" role="button" href="test2.php?id_tournoi=<?php echo $id_groupe1 ?>">Réinitialisation points</a> -->
                <!--  <a class="btn btn-primary shadow" role="button" href="classement_groupes1.php?id_tournoi=<?php $_GET['id_tournoi'] ?>">Calculer tous les points</a> -->
              <?php    } else { ?>
                <!--  <a class="btn btn-primary shadow" role="button" href="test2.php?id_tournoi=<?php echo $_GET['id_tournoi'] ?>">Réinitialisation points</a> -->
                <!-- <a class="btn btn-primary shadow" role="button" href="classement_groupes1.php?id_tournoi=<?php echo $_GET['id_tournoi'] ?>">Calculer tous les points</a> -->

              <?php }

              ?>
            </form>
            </br></br>
            <!--     <a class="btn btn-primary shadow" href="javascript:history.go(-1)">Revenir</a> -->
            <a class="btn btn-primary shadow" href="match.php">Revenir</a>
            <br /><br />
            <a class="btn btn-primary shadow" role="button" href="./functions/algorithme_quart_finale.php?id_tournoi=<?php echo $_SESSION['id_tournoi'] ?>">Générer quarts de finale</a>
            <br /><br />
            <a class="btn btn-primary shadow" role="button" href="./functions/algorithme_match_9e_16e_place.php?id_tournoi=<?php echo $_SESSION['id_tournoi'] ?>">Générer matchs 9ème à 16ème place</a>

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