<?php
include('./functions/dbconnection.php');
include('./functions/tournoi.php');



//echo $_POST['submit'];

if (isset($_POST['submit'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Home - Brand</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
  <?php include_once('default_pages/navbar.php'); ?>

  <section class="py-5"></section>
  <section>
    <div class="container bg-primary-gradient py-5">
      <div class="row">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h3 class="fw-bold text-success mb-2">Tournoi du 07.09.2022</h3>
          <h1 class="fw-bold">Equipes inscrites au tournoi</h1>
        </div>
      </div>
      <div class="py-5 p-lg-5">

        <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
          <div class="col mb-5">
            <div class="card shadow-sm">


            </div>
          </div>
        </div>
        <div class="col mb-5">

          <div class="card shadow-sm">
            <div class="card-body px-4 py-5 px-md-5">
              <!-- <div class="bs-icon-lg d-flex justify-content-center align-items-center mb-3 bs-icon" style="top: 1rem;right: 1rem;position: absolute;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier"> -->
              <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
              <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>

              <table>
                <tbody>
                  <tr>
                    <td>
                      <ul>
                        <h5 class="fw-bold card-title">Equipe</h5>
                      </ul>
                    </td>

                    <td>
                      <ul>
                        <h5 class="fw-bold card-title">Degré</h5>
                      </ul>
                    </td>
                    <td>
                      <ul>
                        <h5 class="fw-bold card-title">Club</h5>

                      </ul>
                    </td>
                    <td>
                      <ul>
                        <h5 class="fw-bold card-title">Groupe</h5>
                      </ul>

                    </td>
                    <td>
                      <ul>
                        <h5 class="fw-bold card-title">Statut</h5>
                      </ul>
                    </td>
                  </tr>
                </tbody>
                <?php afficher_infos_equipes_inscrites(3) ?>
              </table>
              <br /><br />
              <a class="btn btn-primary shadow" role="button" href="modifier_equipe_tournoi.php">Modifier</a>
              <br /><br />
              <a class="btn btn-primary shadow" role="button" href="inscription_equipe.php">Inscrire une équipe</a>
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