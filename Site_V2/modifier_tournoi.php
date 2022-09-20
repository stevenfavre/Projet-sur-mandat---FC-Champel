 <?php
  include('./functions/dbconnection.php');
  include('./functions/tournoi.php');


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

   <section class="py-5">
     <div class="container bg-primary-gradient py-5">
       <div class="row">
         <div class="col-md-8 col-xl-6 text-center mx-auto">
           <h2 class="fw-bold">Modification d'un tournoi</h2>
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
                   <h5 class="fw-bold card-title"></h5>
                 </ul>
               </td>
               <td>
                 <ul>
                   <h5 class="fw-bold card-title"> </h5>
                 </ul>
               </td>
               <td>
               <td>
                 <ul>
                   <h5 class="fw-bold card-title"> </h5>
                 </ul>
               </td>
               <ul>
                 <h5 class="fw-bold card-title"></h5>
                 <?php afficher_date_tournoi(); ?>
                 </td>
             </tr>
           </tbody>
         </table>
         <table>
           <tbody>
             <tr>
               <td>
                 <ul>
                   <h5 class="fw-bold card-title"> </h5>
                 </ul>
               </td>
               <td>
               <td>
                 <ul>
                   <h5 class="fw-bold card-title"> </h5>
                 </ul>
               </td>
               <ul>
                 <form action="modifier_tournoi.php" class="p-3 p-xl-4" method="post">
                   <h3 class="fw-bold text-success mb-2">Modifier tournoi</h3>

                   <h5 class="fw-bold card-title\">Sélectionnez le tournoi que vous souhaitez modifier
                     <select name="ID_Tournoi" id="listeIdTournoi" onchange="afficheDetails()">
                       <?php selection_tournoi(); ?>
                     </select>
                   </h5>
                   <h5 class="fw-bold text-success mb-2">Modifier la date du tournoi</h5>
                   <label for="text">Date de début:<div class="mb-3"><input class="form-control" type="date" name="Date_Debut_Tournoi" placeholder="Date de début" id="dateDebut"></div></label>
                   <label for="text">Date de fin:<div class="mb-3"><input class="form-control" type="date" name="Date_Fin_Tournoi" placeholder="Date de fin" id="dateFin"></div></label>
                   <h5 class="fw-bold text-success mb-2">Modifier la salle du tournoi</h5>
                   <label for="text">Salle Tournoi:
                     <select name="ID_Salle" id="listeIdSalle">
                       <?php selection_salle_tournoi(); ?></select></label>
                   </br></br>
                   <button class="btn btn-primary" type="submit" name="submit">Modifier</button>
                   <button class="btn btn-primary" type="reset" name="reset">Annuler</button>
                   </br></br>
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

 <script>
   //aidée par Sebastien
   let inputDateDebut = $("#dateDebut")
   let inputDateFin = $("#dateFin")
   let selectSalle = $("#listeIdSalle")
   let selectDate = $("#listeIdTournoi")

   let listeTournois = {
     <?php
      $tournois = afficher_Tournoi();
      foreach ($tournois as $element) {
        echo "'" . $element["ID_Tournoi"] . "' : Array('" . $element["Date_Debut_Tournoi"] . "', '" . $element["Date_Fin_Tournoi"] . "', '" . $element["ID_Salle"] . "'),\n";
      }
      ?>
   }

   function afficheDetails() {
     let selectValue = selectDate.val()
     inputDateDebut.val(listeTournois[selectValue][0])
     inputDateFin.val(listeTournois[selectValue][1])
     selectSalle.val(listeTournois[selectValue][2])
   }
 </script>

 </html>