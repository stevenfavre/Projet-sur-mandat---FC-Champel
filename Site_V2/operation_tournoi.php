<?php
error_reporting(E_ERROR | E_PARSE);
session_start(['cookie_lifetime' => 3600,]);
require_once "functions/steven_fonctions.php";

if (!empty($_GET['id_tournoi']))
  $_SESSION['id_tournoi'] = $_GET['id_tournoi'];

$submit = filter_input(INPUT_GET, 'submit');

$arr = explode("-", $submit, 3);
$id_match = $arr[0];
$up_down = $arr[1];
$local_visiteur = $arr[2];

if ($up_down == 'U') { // S'il s'agit d'une augmentation du score
  updateUpScore($id_match, $local_visiteur);
} elseif ($up_down == 'D') { // S'il s'agit d'une réduction du score
  updateDownScore($id_match, $local_visiteur);
}
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
          <p class="fw-bold text-success mb-2">Lancer un tournoi</p>
          <h3 class="fw-bold">Lancer tournoi&nbsp;</h3>
          <nav class="navbar navbar-light navbar-expand-md sticky-top navbar-shrink py-3" id="mainNav">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item"><a class="nav-link" href="modifier_equipe_tournoi.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Equipes inscrites</a></li>
              <li class="nav-item"><a class="nav-link" href="./functions/algorithme_groupe.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Créer les groupes</a></li>
              <li class="nav-item"><a class="nav-link" href="classement_groupes.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Classement groupes</a></li>
              <li class="nav-item"><a class="nav-link" href="classement_quartsFinales.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Quarts de final </a> </li>
              <li class="nav-item"><a class="nav-link" href="classement_quartsFinales.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Demi final </a> </li>
            </ul>
          </nav>
          <br><br>
        </div>
      </div>
      <div id="divContenu">
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  </script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>