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
$GroupeA = array();
$GroupeB = array();
$GroupeC = array();
$GroupeD = array();

function creerQuartFinale($GroupeA, $GroupeB, $GroupeC, $GroupeD)
{
    $bdd = connectDB();
    $sqlQuery = 'select * from  equipe';
    $req = $bdd->prepare($sqlQuery);
    $req->execute([]);
    $count = $req->rowCount();
    $equipes = $req->fetchAll();
    foreach ($equipes as $equipe) {
        echo $equipe;
    }
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
