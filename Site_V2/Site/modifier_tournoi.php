 <?php
  include('./functions/dbconnection.php');
  include('./functions/tournoi.php');



  //echo $_POST['submit'];

  if (isset($_POST['submit'])) {

    $IdTournoi = $_POST['ID_Tournoi'];
    $Date_debut = $_POST['Date_Debut_Tournoi'];
    $Date_fin = $_POST['Date_Fin_Tournoi'];
    $Fk_ID_Salle = $_POST['ID_Salle'];
    update_tournoi($IdTournoi, $Date_debut, $Date_fin, $Fk_ID_Salle);
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

   <section class="py-5"></section>
   <section>

     <div class="container bg-primary-gradient py-5">
       <div class="row">
         <div class="col-md-8 col-xl-6 text-center mx-auto">

           <h2 class="fw-bold">Modification d'un tournoi</h2>
         </div>
       </div>

       <!--      <div class="py-5 p-lg-5">
         <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
           <div class="col mb-5">
             <div class="card shadow-sm">

             </div>
           </div>
         </div>
         <div class="col mb-5"> -->

       <div class="card shadow-sm">
         <div class="card-body px-4 py-5 px-md-5">
           <!-- <div class="bs-icon-lg d-flex justify-content-center align-items-center mb-3 bs-icon" style="top: 1rem;right: 1rem;position: absolute;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bezier"> -->
           <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5v-1zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"></path>
           <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5v-1zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>

           <table>
             <p class="fw-bold text-success mb-2">Tous les tournois</p>
             <tbody>
               <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
               <tr>
                 <td>
                   <ul>
                     <h5 class="fw-bold card-title">Date début</h5>
                   </ul>
                 </td>
                 <td>
                   <ul>
                     <h5 class="fw-bold card-title">Date fin </h5>

                   </ul>
                 </td>
                 <td>
                   <ul>
                     <h5 class="fw-bold card-title">Salle</h5>
                     <?php afficher_infos_tournois(); ?>
                   </ul>
                 </td>
               </tr>
             </tbody>
           </table>

           <table>
             <h5 class="fw-bold card-title">Modifier un tournoi</h5>
             <tbody>
               <tr>
                 <td>
                   <form action="modifier_tournoi.php" class="p-3 p-xl-4" method="post">
                     <p class="fw-bold text-success mb-2">Choisissez la date du tournoi que vous souhaitez modifier</p>
                     <select name="ID_Tournoi" id="listeIdTournoi">
                       <?php selection_tournoi(); ?>
                     </select>
                     <p class="fw-bold text-success mb-2">Modifier la date du tournoi</p>
                     <label for="text">Date de début:</label>
                     <div class="mb-3"><input class="form-control" type="date" id="date-1" name="Date_Debut_Tournoi" placeholder="Date de début"></div>
                     <label for="text">Date de fin:</label>
                     <div class="mb-3"><input class="form-control" type="date" id="date-2" name="Date_Fin_Tournoi" placeholder="Date de fin"></div>
                     <p class="fw-bold text-success mb-2">Modifier la salle du tournoi</p>
                     <label for="text">Salle Tournoi:</label>
                     <select name="ID_Salle" id="listeIdTournoi">
                       <?php selection_salle_tournoi(); ?>
                     </select>
                     <br /><br />
                     <div><button class="btn btn-primary" type="submit" name="submit">Modifier tournoi</button></div>
                     <br /><br />
                     <div><button class="btn btn-primary" type="reset" name="reset">Annuler</button></div>
                   </form>

   </section>
   </td>
   </tr>
   </tbody>
   </table>



   <?php include_once('default_pages/footer.php'); ?>
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/js/script.min.js"></script>
 </body>

 </html>