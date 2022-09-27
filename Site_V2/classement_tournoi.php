<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');



//echo $_POST['submit'];

if (isset($_POST['submit'])) {
  $FK_ID_Tournoi = $_POST['FK_ID_Tournoi'];
  $FK_ID_Equipe = $_POST['FK_ID_Equipe'];
  inscription_equipe_tournoi($FK_ID_Tournoi, $FK_ID_Equipe);
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Classement - Tournois</title>
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
          <p class="fw-bold text-success mb-2">Classements</p>
          <h2 class="fw-bold">Classement final</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
          <div>
            <form action="classement_tournoi.php" class="p-3 p-xl-4" method="post">
              <div class="container">
                <h1>Quarts de finale</h1>
                <table class="table">
                  <thead>
                    <tr>
                      <th>QUART 1</th>
                      <th>Equipe</th>
                      <th>Score</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>QUART 2</td>
                      <td>Equipe</td>
                      <td>Score</td>
                    </tr>
                    <tr class="table-active">
                      <td>Active</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-primary">
                      <td>Primary</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-secondary">
                      <td>Secondary</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-success">
                      <td>Success</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-danger">
                      <td>Danger</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-warning">
                      <td>Warning</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-info">
                      <td>Info</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-light">
                      <td>Light</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="table-dark">
                      <td>Dark</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr>
                      <td class="table-primary">Primary</td>
                      <td class="table-success">Success</td>
                      <td class="table-warning">Warning</td>
                    </tr>
                  </tbody>
                </table>

                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th>Classe</th>
                      <th>Couleur</th>
                      <th>Couleur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Default</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="bg-info">
                      <td>Active</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                    <tr class="bg-warning">
                      <td>Primary</td>
                      <td>Une cellule</td>
                      <td>Une cellule</td>
                    </tr>
                  </tbody>
                </table>
              </div>
</body>

</html>

</form>

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