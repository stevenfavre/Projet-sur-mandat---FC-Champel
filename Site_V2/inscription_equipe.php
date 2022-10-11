<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');

$submitPost = filter_input(INPUT_GET, 'submit');

  if ($_GET['id_tournoi'] != null) {
    refreshSessionTournoi();
  }

  if (!empty($_GET['submit'])) {

    header("Location: inscription_equipe.php?id_tournoi=" . $_SESSION['tournoi']['ID_Tournoi']);



  }elseif(empty($_GET['submit'])){
    $equipe = filter_input(INPUT_GET, 'FK_ID_Equipe');
    inscription_equipe_tournoi($_SESSION['id_tournoi'], $equipe);
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Inscription - Equipe</title>
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
          <h3 class="fw-bold">Inscrivez une équipe</h3>
          <div class="card shadow-sm">
            <center>
              <form action="inscription_equipe.php" method="GET">
                <div class="mb-3 w-50 mx-auto">
                  </br>
                  <h5 class="fw-bold text-success mb-2">Choisissez votre équipe <i class="fa-solid fa-users"></i></h5>

                    <?php selection_equipe_incription1($_SESSION['id_tournoi']); ?>
               
                  </br></br>
                  <div><button class="btn btn-primary" type="submit" name="submit" value="ok">Inscrire</button>
                    </br></br>
                    <a class="btn btn-primary shadow" href="modifier_equipe_tournoi.php">Revenir</a>
                  </div>

                  <?php 
                  if ($submitPost == "ok") {
                  
                    echo "</br></br>";
                    echo "<h3 class=text-success>Votre equipe a été inscrite au match ! </h3>";
                    
                  } ?>
              </form>
            </center>
          </div>

        </div>
        <h5 class="fw-bold card-title"></h5>
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