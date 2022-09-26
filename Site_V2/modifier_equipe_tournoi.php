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
          <h3 class="fw-bold">Tournoi du <?php selection_tournoi($_SESSION['id_tournoi']); ?> &nbsp;</h3>
          </br></br>
          <h5 class="fw-bold text-success mb-2"><a href="inscription_equipe.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Inscrire une nouvelle equipe</a></h5>
          <!-- <p class=\"fw-bold text-success mb-2\">L'insertion a été correctement réalisée ! </p> -->
        </div>
      </div>
      <form action="#" method="get">
        <?php
        afficherEquipeInscrites($_SESSION['id_tournoi']);
        ?>
      </form>
      <a class="btn btn-primary shadow" href="tournois.php">Revenir</a>
    </div>
    </div>
    </form>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script>
    $('select').on('change', function() {


    });

    affichageSelect()

    function affichageSelect() {
      $('#concat').empty();
      let EquipeSelect = $("#EquipeIdTournoi").val()

      $.ajax({
        url: 'functions/ajax.php?FK_ID_Equipe=' + EquipeSelect,
        type: "GET",
        success: function(data) {

          let parsedData = JSON.parse(data)
          console.log(parsedData)

          let nomEquipe = parsedData[6]
          let degreEquipe = parsedData[7]
          let clubEquipe = parsedData[14]
          let groupeEquipe = parsedData[12]
          let StatutEquipe = parsedData[2]

          var tabEquipe = '<br /><br /><table><tr><td><ul><h5 class="fw-bold card-title">Nom equipe</h5></ul></td><td><ul><h5 class="fw-bold card-title">Degré</h5></ul></td><td><ul><h5 class="fw-bold card-title">Club</h5></ul></td><td><ul><h5 class="fw-bold card-title">Groupe</h5></ul></td><td><ul><h5 class="fw-bold card-title">Statut</h5></ul></td></tr>'
          tabEquipe += '<tr><td><ul>'
          tabEquipe += nomEquipe
          tabEquipe += '</ul></td>'
          tabEquipe += '<td><ul>'
          tabEquipe += degreEquipe
          tabEquipe += '</ul></td>'
          tabEquipe += '<td><ul>'
          tabEquipe += clubEquipe
          tabEquipe += '</ul></td>'
          tabEquipe += '<td><ul>'
          tabEquipe += groupeEquipe
          tabEquipe += '</ul></td>'
          tabEquipe += '<td><ul>'
          tabEquipe += StatutEquipe
          tabEquipe += '</ul></td></tr></table>'
          $('#concat').append(tabEquipe);

        },
        error: function() {
          alert("Une erreur est surevenue lors de la requete Ajax")
        }
      })
    }
  </script> <!-- script sofian  -->
</body>

</html>