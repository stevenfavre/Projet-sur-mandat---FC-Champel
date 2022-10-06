<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');

if (!empty($_GET['submit'])) {
  $_SESSION['submit'] = $_GET['submit'];

  $submit = filter_input(INPUT_GET, 'submit');

  $coupure = explode("-", $submit);
  $id_inscription = $coupure[0];
  $option = $coupure[1];
  if ($option == 'modifier') {
    update_statut_equipes_tournoiTst($id_inscription);
  } elseif ($option == 'annuler') {
    update_statut_equipes($id_inscription);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Liste des équipes participant au tournoi</title>
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
          <h1 class="fw-bold text-success mb-2">Equipes inscrites</h1>
          <h3 class="fw-bold">Tournoi du <?php afficherDateTournoi($_SESSION['id_tournoi']); ?> &nbsp;</h3>
          </br></br>
          <h5 class="fw-bold text-success mb-2"><a href="inscription_equipe.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Inscrire une nouvelle equipe <i class="fa-solid fa-user-plus"></i></a></h5>
        </div>
      </div>
      <form action="#" method="get">
        <?php
        afficherEquipeInscrites($_SESSION['id_tournoi']);
        ?>
      </form>
      <a class="btn btn-primary shadow" href="match.php">Revenir</a>
    </div>
    </div>
    </form>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script>
  </script>
</body>

</html>