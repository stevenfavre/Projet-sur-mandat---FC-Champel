<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
//require_once('algorithme_groupe.php');


// Définition de la constant concernant le nombre d'équipe idéal au total dans le tournoi
define("NB_EQUIPES_IDEAL", 16);
define("NB_QUART_FINALE", 4);
define("NB_DEMI_FINALE", 2);
define("NB_FINALE", 1);
define("NB_MATCH_3_PLACE", 1);
define("NB_MATCH_5_8_PLACE", 4);


$groupeA = array (
    array("A1",1),
    array("A2",2),
    array("A3",3),
    array("A4",4),
  );

  $groupeB = array (
    array("B1",5),
    array("B2",6),
    array("B3",7),
    array("B4",8),
  );

  $groupeC = array (
    array("C1",9),
    array("C2",10),
    array("B3",11),
    array("B4",12),
  );

  $groupeD = array (
    array("D1",13),
    array("D2",14),
    array("B3",15),
    array("B4",16),
  );

function createQuartFinale($groupeA, $groupeB, $groupeC, $groupeD)
{
    $quartFinaleUn = array (
        ($groupeA[0]),
        ($groupeD[1]),
      );

      $quartFinaleDeux = array (
        ($groupeB[0]),
        ($groupeC[1]),
      );

      $quartFinaleTrois = array (
        ($groupeC[0]),
        ($groupeB[1]),
      );

      $quartFinaleQuart = array (
        ($groupeD[0]),
        ($groupeA[1]),
      );

     printMatchQuart($quartFinaleUn);
     printMatchQuart($quartFinaleDeux);
     printMatchQuart($quartFinaleTrois);
     printMatchQuart($quartFinaleQuart);
}

 createQuartFinale($groupeA, $groupeB, $groupeC, $groupeD);

 function printMatchQuart($match){
   echo $match[0][0] . " (" . $match[0][1] . " )" . " VS " . $match[1][0] . " (" . $match[1][1] . " )<br />";
 }

 function createDemiFinale(){

 }

 function createFinale(){
    
 }









