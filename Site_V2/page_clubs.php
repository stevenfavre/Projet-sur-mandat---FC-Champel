<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');

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
          <h2 class="fw-bold">Clubs</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
        </div>
        <table style="width: 70%;">
          <tbody>
            <tr>
              <td>
                <a href="Formulaire_insertion_club.php">Ajouter un club </a>
              </td>
              <td>
                <a href="Formulaire_modification_club.php"> Modifier un club</a>
              </td>
              <td>
                <a href="Formulaire_suppression_club.php">Supprimer un club</a>
              </td>
              <td>
                <a href="./affichage_club_actif.php">Tous les clubs</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>