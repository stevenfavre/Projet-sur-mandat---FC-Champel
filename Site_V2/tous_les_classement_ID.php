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
            <p class="fw-bold text-success mb-2">Classements</p>
            <h2 class="fw-bold">Classement du tournoi</h2>
          </div>
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-5 col-xl-6">
            <form action="classement_tournoi.php" method="get">

              <table class="table table-warning">
                <thead>
                  <tr>
                    <th>Place</th>
                    <th>Equipe</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1 place</td>
                    <td><?php gagnant1($_GET['id_tournoi']); ?></td>
                  </tr>
                  <tr class="warning">
                    <td>2 place</td>
                    <td><?php gagnant2($_GET['id_tournoi']); ?></td>

                  </tr>
                  <tr class="text-warning">
                    <td>3 place</td>
                    <td><?php gagnant3($_GET['id_tournoi']); ?></td>


                  </tr>
                  <tr>
                    <td>4 place</td>
                    <td><?php gagnant6($_GET['id_tournoi']); ?></td>
                  </tr>
                  <tr class="warning">
                    <td>5 place</td>
                    <td><?php gagnant8($_GET['id_tournoi']); ?></td>

                  </tr>
                  <tr class="text-warning">
                    <td>6 place</td>
                    <td><?php gagnant7($_GET['id_tournoi']); ?></td>


                  </tr>
                  <tr>
                    <td>7 place</td>
                    <td><?php gagnant10($_GET['id_tournoi']); ?></td>
                  </tr>
                  <tr class="warning">
                    <td>8 place</td>
                    <td><?php gagnant9($_GET['id_tournoi']); ?></td>

                  </tr>
                  <tr class="text-warning">
                    <td>9 place</td>
                    <td><?php gagnant12($_GET['id_tournoi']); ?></td>


                  </tr>
                  <tr>
                    <td>10 place</td>
                    <td><?php gagnant11($_GET['id_tournoi']); ?></td>
                  </tr>
                  <tr class="warning">
                    <td>11 place</td>
                    <td><?php gagnant14($_GET['id_tournoi']); ?></td>

                  </tr>
                  <tr class="text-warning">
                    <td>12 place</td>
                    <td><?php gagnant13($_GET['id_tournoi']); ?></td>


                  </tr>
                  <tr>
                    <td>13 place</td>
                    <td><?php gagnant16($_GET['id_tournoi']); ?></td>
                  </tr>
                  <tr class="warning">
                    <td>14 place</td>
                    <td><?php gagnant15($_GET['id_tournoi']); ?></td>

                  </tr>
                  <tr class="text-warning">
                    <td>15 place</td>
                    <td><?php gagnant17($_GET['id_tournoi']); ?></td>


                  </tr>


                  <tr class="warning">
                    <td>16 place</td>
                    <td><?php gagnant18($_GET['id_tournoi']); ?></td>

                  </tr>
                </tbody>
              </table>



            </form>
            </br>
            <a class="btn btn-primary shadow" href="match.php"><i class="fa-solid fa-arrow-left"></i></a>
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