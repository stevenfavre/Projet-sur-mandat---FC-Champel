<?php
require_once('dbconnection.php'); //Fait appel à la page se trouve la connexion à la BDD.
require_once('Fonctions_Sofian.php'); //Fait appel à la page où se trouvent les fonction 
require_once('debug.php');
require_once('steven_fonctions.php');
require_once('algorithme_quart_finale.php');

//require_once('algorithme_groupe.php');

function createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16)
{

    $matchUn = array(
        ($groupeA[2]),
        ($groupeD[3]),
    );

    $idEquipe1 = 0;
    foreach ($groupeA[2] as $equipe) {
        $idEquipe1 = $equipe['ID_Equipe'];
    }

    $idEquipe2 = 0;
    foreach ($groupeD[3] as $equipe) {
        $idEquipe2 = $equipe['ID_Equipe'];
    }

    $matchDeux = array(
        ($groupeB[2]),
        ($groupeC[3]),
    );

    $idEquipe3 = 0;
    foreach ($groupeB[2] as $equipe) {
        $idEquipe3 = $equipe['ID_Equipe'];
    }

    $idEquipe4 = 0;
    foreach ($groupeC[3] as $equipe) {
        $idEquipe4 = $equipe['ID_Equipe'];
    }


    $matchTrois = array(
        ($groupeC[2]),
        ($groupeB[3]),
    );

    $idEquipe5 = 0;
    foreach ($groupeC[2] as $equipe) {
        $idEquipe5 = $equipe['ID_Equipe'];
    }

    $idEquipe6 = 0;
    foreach ($groupeB[3] as $equipe) {
        $idEquipe6 = $equipe['ID_Equipe'];
    }


    $MatchQuatre = array(
        ($groupeD[2]),
        ($groupeA[3]),
    );

    $idEquipe7 = 0;
    foreach ($groupeD[2] as $equipe) {
        $idEquipe7 = $equipe['ID_Equipe'];
    }

    $idEquipe8 = 0;
    foreach ($groupeA[3] as $equipe) {
        $idEquipe8 = $equipe['ID_Equipe'];
    }


    $bdd = connectDB();

    $insertMatchUn = $bdd->query("SET NAMES 'utf8'");
    $insertMatchUn = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut5','$heureFin5','11','3eA_VS_4eD','1','0','$idEquipe1','$idEquipe2', null,'$id_tournoi','2','1')");

    $insertMatchDeux = $bdd->query("SET NAMES 'utf8'");
    $insertMatchDeux = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut6','$heureFin6','11','3eB_VS_4eC','2','1','$idEquipe3','$idEquipe4', null,'$id_tournoi','2','1')");

    $insertMatchTrois = $bdd->query("SET NAMES 'utf8'");
    $insertMatchTrois = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut7','$heureFin7','11','3eC_VS_4eB','3','0','$idEquipe5','$idEquipe6', null,'$id_tournoi','2','1')");

    $insertMatchQuatre = $bdd->query("SET NAMES 'utf8'");
    $insertMatchQuatre = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut8','$heureFin8','11','3eD_VS_4eA','0','1','$idEquipe7','$idEquipe8', null,'$id_tournoi','2','1')");


    $bdd = connectDB();
    $num = 4;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneUne = 0;
    $idEquipePerduUne = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneUne = $valeur['FK_ID_Local'];
            $idEquipePerduUne = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneUne = $valeur['FK_ID_Visiteur'];
            $idEquipePerduUne = $valeur['FK_ID_Local'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneDeux = 0;
    $idEquipePerduDeux = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneDeux = $valeur['FK_ID_Local'];
            $idEquipePerduDeux = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneDeux = $valeur['FK_ID_Visiteur'];
            $idEquipePerduDeux = $valeur['FK_ID_Local'];
        }
    }


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneTrois = 0;
    $idEquipePerduTrois = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneTrois = $valeur['FK_ID_Local'];
            $idEquipePerduTrois = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneTrois = $valeur['FK_ID_Visiteur'];
            $idEquipePerduTrois = $valeur['FK_ID_Local'];
        }
    }


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneQuatre = 0;
    $idEquipePerduQuatre = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneQuatre = $valeur['FK_ID_Local'];
            $idEquipePerduQuatre = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneQuatre = $valeur['FK_ID_Visiteur'];
            $idEquipePerduQuatre = $valeur['FK_ID_Local'];
        }
    }


    $insertMatchCinq = $bdd->query("SET NAMES 'utf8'");
    $insertMatchCinq = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut9','$heureFin9','11','Match5','1','0','$idEquipeGagneUne','$idEquipeGagneDeux', null,'$id_tournoi','2','1')");

    $insertMatchSix = $bdd->query("SET NAMES 'utf8'");
    $insertMatchSix = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut10','$heureFin10','11','Match6','2','1','$idEquipeGagneTrois','$idEquipeGagneQuatre', null,'$id_tournoi','2','1')");

    $insertMatchSept = $bdd->query("SET NAMES 'utf8'");
    $insertMatchSept = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut11','$heureFin11','11','Match7','3','0','$idEquipePerduUne','$idEquipePerduDeux', null,'$id_tournoi','2','1')");

    $insertMatchHuit = $bdd->query("SET NAMES 'utf8'");
    $insertMatchhuit = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut12','$heureFin12','11','Match8','0','1','$idEquipePerduTrois','$idEquipePerduQuatre', null,'$id_tournoi','2','1')");

    $bdd = connectDB();
    $num = 4;
    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneCinq = 0;
    $idEquipePerduCinq = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneCinq = $valeur['FK_ID_Local'];
            $idEquipePerduCinq = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneCinq = $valeur['FK_ID_Visiteur'];
            $idEquipePerduCinq = $valeur['FK_ID_Local'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneSix = 0;
    $idEquipePerduSix = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneSix = $valeur['FK_ID_Local'];
            $idEquipePerduSix = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneSix = $valeur['FK_ID_Visiteur'];
            $idEquipePerduSix = $valeur['FK_ID_Local'];
        }
    }

    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneSept = 0;
    $idEquipePerduSept = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneSept = $valeur['FK_ID_Local'];
            $idEquipePerduSept = $valeur['FK_ID_Visiteur'];
        } else {
            $idEquipeGagneSept = $valeur['FK_ID_Visiteur'];
            $idEquipePerduSept = $valeur['FK_ID_Local'];
        }
    }


    $num -= 1;

    $matchs = $bdd->query("SET NAMES 'utf8'");
    $matchs = $bdd->query("SELECT * FROM Matchs where FK_Id_Tournoi = $id_tournoi order by ID_Match desc limit $num;");

    $idEquipeGagneHuit = 0;
    $idEquipePerduHuit = 0;
    foreach ($matchs as $valeur) {
        if ($valeur['But_Local_Match'] > $valeur['But_Visiteur_Match']) {
            $idEquipeGagneHuit = $valeur['FK_ID_Local'];
            $idEquipePerduHuit = $valeur['FK_ID_Visiteur'];
        } elseif ($valeur['But_Local_Match'] < $valeur['But_Visiteur_Match']) {
            $idEquipeGagneHuit = $valeur['FK_ID_Visiteur'];
            $idEquipePerduHuit = $valeur['FK_ID_Local'];
        }
    }

    $insertMatch9Et10e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch9Et10e  = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut13','$heureFin13','11','Match9eEt10ePlace','1','0','$idEquipeGagneCinq','$idEquipeGagneSix', null,'$id_tournoi','2','1')");

    $insertMatch11Et12e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch11Et12e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut14','$heureFin14','11','Match11eEt12ePlace','2','1','$idEquipePerduCinq','$idEquipePerduSix', null,'$id_tournoi','2','1')");

    $insertMatch13Et14e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch13Et14e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut15','$heureFin15','11','Match13eEt14ePlace','3','0','$idEquipeGagneSept','$idEquipeGagneHuit', null,'$id_tournoi','2','1')");

    $insertMatch15Et16e = $bdd->query("SET NAMES 'utf8'");
    $insertMatch15Et16e = $bdd->query("INSERT INTO `Matchs`(`Date_Match`, `Heure_Debut_Match`, `Heure_Fin_Match`, `Duree_Match`, `Type_Match`, `But_Local_Match`, `But_Visiteur_Match`, `FK_ID_Local`, `FK_ID_Visiteur`, `FK_ID_Groupe`, `FK_ID_Tournoi`, `FK_ID_Terrain`, `Actif_Match`) 
  VALUES ('$dateTournoi','$heureDebut16','$heureFin16','11','Match15eEt16ePlace','0','1','$idEquipePerduSept','$idEquipePerduHuit', null,'$id_tournoi','2','1')");
}

createMatch9A16ePlace($id_tournoi, $groupeA, $groupeB, $groupeC, $groupeD, $dateTournoi, $heureDebut5, $heureFin5, $heureDebut6, $heureFin6, $heureDebut7, $heureFin7, $heureDebut8, $heureFin8, $heureDebut9, $heureFin9, $heureDebut10, $heureFin10, $heureDebut11, $heureFin11, $heureDebut12, $heureFin12, $heureDebut13, $heureFin13, $heureDebut14, $heureFin14, $heureDebut15, $heureFin15, $heureDebut16, $heureFin16);
