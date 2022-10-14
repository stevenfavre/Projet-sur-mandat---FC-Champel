<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');

$submitPost = filter_input(INPUT_GET, 'submit');

if ($_GET['id_tournoi'] != null) {
  refreshSessionTournoi();
}

if (empty($_GET['FK_ID_Equipe'])) {
} elseif (!empty($_GET['FK_ID_Equipe'])) {
  $equipe = filter_input(INPUT_GET, 'FK_ID_Equipe');
  inscription_equipe_tournoi($_SESSION['id_tournoi'], $equipe);
  header("Location: modifier_equipe_tournoi.php?id_tournoi=" . $_SESSION['tournoi']['ID_Tournoi']);
}
if ($submitPost == "ok") {
  //inscription_toutes_equipes_tournoi($_SESSION['id_tournoi']);
  header("Location: modifier_equipe_tournoi.php?id_tournoi=" . $_SESSION['tournoi']['ID_Tournoi']);
}

function refreshSessionTournoi()
{
  $tournois = selection_tournoi($_GET['id_tournoi']);
  $_SESSION['tournoi'] = $tournois[0];
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Inscription - Equipe</title>
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
          <div class="col-md-10 col-xl-10 text-center mx-auto">
            <h2>Inscriptions équipes au tournoi du <?php echo date("d.m.Y", strtotime($_SESSION['tournoi']['Date_Debut_Tournoi'])); ?></h2>
            </br></br>
            <h6 class=" text-success mb-2">EQUIPES DISPONIBLES POUR CE TOURNOI <i class="fa-solid fa-users"></i></h6>
          </div>
        </div>
        <div class="col-md-18 col-xl-20">
          <form action="inscription_equipe.php" method="GET">

            <?php selection_equipe_incription1($_GET['id_tournoi']);
            ?>
            </br></br>
          </form>
        </div>
        </br></br>
        <h6 style="padding-left: 83%;">
          <a class="btn btn-primary shadow" role="button" href="match.php"><i class="fa-solid fa-arrow-left"></i></a></br></br>

          <button class="btn btn-primary" type="submit" name="submit" value="ok">Tout choisir</button>

          <!--  <a class="btn btn-primary shadow" role="button" href="testInscription.php?id_tournoi=<?php echo $_GET['id_tournoi'] ?>">Inscrire toutes les equipes</a> -->

        </h6>


      </div>


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