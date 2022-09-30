<?php
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
          <p class="fw-bold text-success mb-2">Liste des matchs</p>
          <h3 class="fw-bold">Match du tournoi :&nbsp;</h3>
          <p class="text-muted">&nbsp;<a href="modifier_equipe_tournoi.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Equipes inscrites</a></p>
          <!-- <a class="btn btn-primary shadow" role="button" href="creer_match.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Créer un match</a> -->
          <a class="btn btn-primary shadow" role="button" href="./functions/algorithme_groupe.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Créer les groupes</a>
          <a class="btn btn-primary shadow" role="button" href="classement_groupes.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Classement des groupes</a>
          <br><br>
          <input type="text" id="recherche" onkeyup="recherche()" placeholder="Recherche..." title="Rechercher un match">
          <?php
          // afficherSalleEtDate($_GET['id_tournoi']);
          ?>
        </div>
      </div>
      <div id="divContenu">
        <form action="match.php" method="get">
          <?php
          afficherMatch($_SESSION['id_tournoi']);
          ?>
        </form>
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <!-- Site d'aide pour la réalisation du filtrage des équipes 
  https://www.w3schools.com/howto/howto_js_filter_lists.asp -->
  <script>
    function recherche() {
      var input, filter, div, div2, a, i, txtValue;
      input = document.getElementById("recherche");
      filter = input.value.toUpperCase();
      div = document.getElementById("divContenu");
      div2 = div.getElementsByClassName("equipe");
      console.log(div2);
      for (i = 0; i < div2.length; i++) {
        a = div2[i].getElementsByTagName("h5")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          div2[i].style.display = "";
        } else {
          div2[i].style.display = "none";
        }
      }
    }
  </script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>