<?php
require_once('./functions/dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('./functions/Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('./functions/debug.php');
require_once('./functions/steven_fonctions.php');

// Définition de la constant concernant le nombre d'équipe idéal au total dans le tournoi
define("NB_EQUIPES_IDEAL", 16);
define("NB_QUART_FINALE", 4);
define("NB_DEMI_FINALE", 2);
define("NB_FINALE", 1);
define("NB_MATCH_3_PLACE", 1);
define("NB_MATCH_5_8_PLACE", 4);

//Définition de 4 listes de 4 équipes 
$GroupeA = array($equipe1, $equipe2, $equipe3, $equipe4);
$GroupeB = array($equipe5, $equipe6, $equipe7, $equipe8);
$GroupeC = array($equipe9, $equipe10, $equipe11, $equipe12);
$GroupeD = array($equipe13, $equipe14, $equipe15, $equipe16);

function creerQuartFinale($GroupeA, $GroupeB, $GroupeC, $GroupeD)
{


    foreach ($GroupeA as $valeur) {
        $equipePremiereGroupeA = $GroupeA[0];
    }
    foreach ($GroupeA as $valeur) {
        $equipeDeuxiemeGroupeA = $GroupeA[1];
    }
    foreach ($GroupeA as $valeur) {
        $equipeTroisiemeGroupeA = $GroupeA[2];
    }
    foreach ($GroupeA as $valeur) {
        $equipeQuatriemeGroupeA = $GroupeA[2];
    }

    foreach ($GroupeB as $valeur) {
        $equipePremiereGroupeB = $GroupeB[0];
    }
    foreach ($GroupeB as $valeur) {
        $equipeDeuxiemeGroupeB = $GroupeB[1];
    }
    foreach ($GroupeB as $valeur) {
        $equipeTroisiemeGroupeB = $GroupeB[2];
    }
    foreach ($GroupeB as $valeur) {
        $equipeQuatriemeGroupeB = $GroupeB[2];
    }

    foreach ($GroupeC as $valeur) {
        $equipePremiereGroupeC = $GroupeC[0];
    }
    foreach ($GroupeC as $valeur) {
        $equipeDeuxiemeGroupeC = $GroupeC[1];
    }
    foreach ($GroupeC as $valeur) {
        $equipeTroisiemeGroupeC = $GroupeC[2];
    }
    foreach ($GroupeC as $valeur) {
        $equipeQuatriemeGroupeC = $GroupeC[2];
    }

    foreach ($GroupeD as $valeur) {
        $equipePremiereGroupeD = $GroupeD[0];
    }
    foreach ($GroupeD as $valeur) {
        $equipeDeuxiemeGroupeD = $GroupeD[1];
    }
    foreach ($GroupeD as $valeur) {
        $equipeTroisiemeGroupeD = $GroupeD[2];
    }
    foreach ($GroupeD as $valeur) {
        $equipeQuatriemeGroupeD = $GroupeD[2];
    }

     $Quartfinale1 = $equipePremiereGroupeA 
     $Quartfinale2 = 
     $Quartfinale3 =
     $Quartfinale4 =


}


function creerDemiFinale()
{
}


function creerFinale()
{
}

function creerMatch3Place()
{
}

function creerMatch5A8Place()
{
}
