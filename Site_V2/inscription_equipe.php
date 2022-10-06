<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');

if (!empty($_GET['id_tournoi'])) {
  $_SESSION['id_tournoi'] = $_GET['id_tournoi'];
}

$submitPost = filter_input(INPUT_POST, 'submit');

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
    <div class="container bg-primary-gradient py-5">
      <div class="row">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2 class="fw-bold">Inscrivez une équipe</h2>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-body px-4 py-5 px-md-5">
          <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>

          <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
          <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
              <div>
                <form action="#" method="POST">
                  <div class="mb-3 w-50 mx-auto">
                    <label for="FK_ID_Equipe">Choisir une équipe :</label>
                    </br>
                    <select class="form-control" name="FK_ID_Equipe" required>
                      <?php selection_equipe_incription($_SESSION['id_tournoi']); ?>
                    </select>
                    </br></br>
                    <div><button class="btn btn-primary" type="submit" name="submit" value="ok">Inscrire</button>
                      </br></br>
                      <a class="btn btn-primary shadow" href="modifier_equipe_tournoi.php">Revenir</a>
                    </div>
                  </div>
                  <?php if ($submitPost == "ok") {
                    $equipe = filter_input(INPUT_POST, 'FK_ID_Equipe');
                    inscription_equipe_tournoi($_SESSION['id_tournoi'], $equipe);
                  } ?>
                </form>
              </div>
              </svg>
            </div>
            <h5 class="fw-bold card-title"></h5>
            <p class="text-muted card-text mb-4">&nbsp;</p>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <section></section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>