 <?php
  include('./functions/dbconnection.php');
  include('./functions/tournoi.php');

  $submitPost = filter_input(INPUT_POST, 'submit');

  if ($_GET['id_tournoi'] != null) {
    refreshSessionTournoi();
  }

  if ($submitPost == "modifier") {

    $Date_debut = filter_input(INPUT_POST, 'Date_Debut_Tournoi');
    $Date_fin = filter_input(INPUT_POST, 'Date_Fin_Tournoi');
    $Fk_ID_Salle = filter_input(INPUT_POST, 'ID_Salle');
    update_tournoi($_SESSION['tournoi']['ID_Tournoi'], $Date_debut, $Date_fin, $Fk_ID_Salle);
    header("Location: afficher_tournois.php");
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
   <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>Modification - Tournoi</title>
   <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
   <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
 </head>

 <body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
   <?php include_once('default_pages/navbar.php'); ?>
   <section class="py-5">
     <div class="container bg-primary-gradient py-5">
       <div class="row mb-5">
         <div class="col-md-8 col-xl-6 text-center mx-auto">
           <h2 class="fw-bold">Informations tournoi du <?php echo date("d.m.Y", strtotime($_SESSION['tournoi']['Date_Debut_Tournoi'])); ?> </h2>
         </div>
       </div>
       <div class="card shadow-sm">
         <div class="card-body px-4 py-5 px-md-5">
           <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
           <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>

           <div class="row d-flex justify-content-center">
             <div class="col-md-6 col-xl-4">
               <div>
                 <form action="#" method="post">
                   <table>
               </div>

               <h5 class="fw-bold text-success mb-2">Dates tournoi</h5>

               <label for="Date_Debut_Tournoi">Date de début:<div class="mb-3"></label>
               <input class="form-control" type="date" name="Date_Debut_Tournoi" value="<?php echo $_SESSION['tournoi']['Date_Debut_Tournoi']; ?>" required>
             </div>
             <label for="Date_Fin_Tournoi">Date de fin:<div class="mb-3"></label>
             <input class="form-control" type="date" name="Date_Fin_Tournoi" value="<?php echo $_SESSION['tournoi']['Date_Fin_Tournoi'] ?>" required>
           </div>
           <h5 class="fw-bold text-success mb-2">Salles tournoi</h5>

           <label for="FK_ID_Salle">Salle tournoi :<div class="mb-3"></label>
           <select class="form-control" name="ID_Salle" required>
             <?php afficher_option_salle($_SESSION['tournoi']['FK_ID_Salle']); ?>
           </select>
         </div>
         </br></br>
         <a class="btn btn-primary shadow" role="button" href="match.php"><i class="fa-solid fa-arrow-left"></i></a>
         <button class="btn btn-primary" type="submit" name="submit" value="modifier">Modifier</button>
         </table>
       </div>
       </tbody>
       </form>
       </table>
     </div>
     </div>
   </section>
   <?php include_once('default_pages/footer.php'); ?>
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/js/script.min.js"></script>
 </body>

 </html>