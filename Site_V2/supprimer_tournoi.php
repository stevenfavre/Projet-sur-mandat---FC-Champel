 <?php
  include('./functions/dbconnection.php');
  include('./functions/tournoi.php');


  $submit = null;
  if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
  }
  if ($submit == "modifier") {
    update_activer_logique();
  }

  if ($submit == "supprimer") {

    update_suppresion_logique();
  }


  ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="utf-8">
   <script src="https://kit.fontawesome.com/5a023d1c0f.js" crossorigin="anonymous"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>Annulation - Tournoi</title>
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
           <h2 class="fw-bold">Annulation d'un tournoi</h2>
         </div>
       </div>
       <div class="card shadow-sm">
         <div class="card-body px-4 py-5 px-md-5">
         </div>
         <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
         <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
         <table>
           <tbody>
             <tr>
               <td>
                 <ul>
                   <?php afficher_date_tournoiDELETE(); ?>
                 </ul>
               </td>
             </tr>
           </tbody>
         </table>

         <table>
           <tbody>
             <tr>
               <td>
                 <ul>
                   <form action="supprimer_tournoi.php" class="p-3 p-xl-4" method="post">
                     <h3 class="fw-bold text-success mb-2">Annuler tournoi</h3>
                     <h5 class="fw-bold">Choisisir tournoi
                       <select name="ID_Tournoi" id="listeIdTournoi">
                         <?php selection_tournoi_supprimer();
                          ?>
                       </select>

                       <?php
                        if ($submit == "modifier") {
                          echo "<h5 class=\"fw-bold text-success mb-2\">Action réalisée avec succès !</h5>";
                          update_activer_logique();
                        }

                        if ($submit == "supprimer") {
                          echo "<h5 class=\"fw-bold text-success mb-2\">Action réalisée avec succès !</h5>";

                          update_suppresion_logique();
                        }
                        ?>
                     </h5>
                     <br /><br />
                     <button class="btn btn-primary" type="submit" name="submit" value="supprimer">Supprimer</button>
                     <button class="btn btn-primary" type="submit" name="submit" value="modifier">Activer</button>
                     <a class="btn btn-primary shadow" role="button" href="afficher_tournois.php">Revenir</a>
                 </ul>
               </td>
             </tr>
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