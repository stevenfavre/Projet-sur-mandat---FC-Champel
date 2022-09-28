<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_groupe.php');


// Définition de la constant concernant le nombre d'équipe idéal au total dans le tournoi
define("NB_EQUIPES_IDEAL", 16);
define("NB_QUART_FINALE", 4);
define("NB_DEMI_FINALE", 2);
define("NB_FINALE", 1);
define("NB_MATCH_3_PLACE", 1);
define("NB_MATCH_5_8_PLACE", 4);

//Récupértion des groupes depuis l'algorithme
$_SESSION['GroupeUn'];
$_SESSION['GroupeDeux'];
$_SESSION['GroupeTrois'];
$_SESSION['GroupeQuatre'];

function createQuartFinale()
{
}


$bdd = connectDB();
$bdd->query("SET NAMES 'utf8'");



$quartFinaleUn = $bdd->query("INSERT INTO `Matchs`(`ID_Match`, `Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','Quart de finale','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]')");
$quartFinaleUn->setFetchMode(PDO::FETCH_BOTH);
