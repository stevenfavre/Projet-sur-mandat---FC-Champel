<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');
include('./functions/algorithme_classement_groupes.php');

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
  <title>Classement - Tournois</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
  <?php include_once('default_pages/navbar.php'); ?>
  <section class="py-5">
    <div class="container" style="width: 9000px;margin: auto;border: 5px solid #FF0000;">
      <div class="container py-5">
        <div class="row mb-5">
          <div class="col-md-8 col-xl-6 text-center mx-auto">
          </div>
        </div>
        <CENTER>
          <h1 class="fw-bold text-success mb-2">Classements du tournoi </h1>

          <h2 class="fw- text-success">Tournoi du <?= date("d.m.Y", strtotime(afficherDateTournoi($_SESSION['id_tournoi']))) ?>&nbsp;</h2>
          </br>
          <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-xl-6">
              <form action="classement_tournoi.php" method="get">

                <table class="table" style="margin-left:auto;">
                  <thead>

                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <CENTER>
                          <h1>1 place <i class="fa-solid fa-trophy"></i></h1>
                      </td>
                      <td>
                        <CENTER>
                          <h1><?php gagnant4($_GET['id_tournoi']); ?></h1>
                      </td>
                    </tr>
                    <tr class="">
                      <td>
                        <CENTER>
                          <h2>2 place <i class="fa-solid fa-award"></i></h2>
                      </td>
                      <td>
                        <CENTER>
                          <h2><?php gagnant3($_GET['id_tournoi']); ?></h2>
                      </td>

                    </tr>

                    <td>
                      <CENTER>
                        <h3>3 place <i class="fa-solid fa-medal"></i></h3>
                    </td>
                    <td>
                      <CENTER>
                        <h3><?php gagnant5($_GET['id_tournoi']); ?></h3>
                    </td>


                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h3>4 place <i class="fa-solid fa-star"></i></h3>
                      </td>
                      <td>
                        <CENTER>
                          <h3><?php gagnant6($_GET['id_tournoi']); ?></h3>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h3>5 place <i class="fa-solid fa-star-half-stroke"></i></h3>
                      </td>
                      <td>
                        <CENTER>
                          <h3><?php gagnant8($_GET['id_tournoi']); ?></h3>
                      </td>

                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h4>6 place <i class="fa-regular fa-star"></i></h4>
                      </td>
                      <td>
                        <CENTER>
                          <h4><?php gagnant7($_GET['id_tournoi']); ?></h4>
                      </td>


                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h4>7 place </h4>
                      </td>
                      <td>
                        <CENTER>
                          <h4><?php gagnant10($_GET['id_tournoi']); ?></h4>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>8 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant9($_GET['id_tournoi']); ?></h5>
                      </td>

                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>9 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant12($_GET['id_tournoi']); ?></h5>
                      </td>


                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>10 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant11($_GET['id_tournoi']); ?></h5>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>11 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant14($_GET['id_tournoi']); ?></h5>
                      </td>

                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>12 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant13($_GET['id_tournoi']); ?></h5>
                      </td>


                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>13 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant16($_GET['id_tournoi']); ?></h5>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>14 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant15($_GET['id_tournoi']); ?></h5>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <CENTER>
                          <h5>15 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant17($_GET['id_tournoi']); ?></h5>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <CENTER>
                          <h5>16 place</h5>
                      </td>
                      <td>
                        <CENTER>
                          <h5><?php gagnant18($_GET['id_tournoi']); ?></h5>
                      </td>
                    </tr>
                  </tbody>
                </table>



              </form>
              </br>
              <a href="javascript:history.go(-1)"><i class="fa-solid fa-arrow-left"></i></a>
              <?php
              ?>
            </div>
          </div>
  </section>

  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>