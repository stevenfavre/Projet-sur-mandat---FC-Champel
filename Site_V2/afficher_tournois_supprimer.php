<?php
error_reporting(E_ERROR | E_PARSE);

include('./functions/dbconnection.php');
include('./functions/tournoi.php');

if (!empty($_GET['submit'])) {
  $_SESSION['submit'] = $_GET['submit'];
  $submit = filter_input(INPUT_GET, 'submit');
  $coupure = explode("-", $submit);
  $id_tournoi = $coupure[0];
  $option = $coupure[1];
  $Salle = $coupure[2];
  $DateDebut = $coupure[3];
  $Datefin = $coupure[4];
  if ($option == 'activer') {
    update_activer_logique($id_tournoi);
  } elseif ($option == 'terminer') {
    update_terminer_logique($id_tournoi);
  } elseif ($option == 'annuler') {
    update_suppresion_logique($id_tournoi);
  } elseif ($option == "modifier") {
    update_tournoi($id_tournoi, $DateDebut, $Datefin, $Salle);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Visualiser - Tournois</title>
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
            <p class="fw-bold text-success mb-2">Tous les tournois</p>
            <h1>Liste tournois</h1>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 col-xl-8">
            <form action="afficher_tournois.php" method="get">
              <table>
                <tbody>

                  <?php
                  afficher_date_tournoi();
                  ?>

                </tbody>
              </table>




            </form>



            <a class="btn btn-primary shadow" role="button" href="tournois.php">Retour</a></p>


            <h6 style="padding-left: 75%;">
              <a href="creer_tournoi.php" class="fw-bold"><i class="fa-solid fa-plus"></i> Ajouter inscription </a>

              </br></br>
              <a href="afficher_tournois_supprimer.php" class="fw-bold"><i class="fa-regular fa-trash-can"></i> Historique inscriptions </a>
            </h6>


          </div>


        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php');
  ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>