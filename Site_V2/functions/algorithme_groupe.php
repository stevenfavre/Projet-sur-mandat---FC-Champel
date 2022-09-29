<?php
require_once "steven_fonctions.php";
require_once "dbconnection.php";
require_once "debug.php";

session_start();

// Définition de la constant concernant le nombre d'équipe idéal dans un groupe
define("NB_EQUIPES_IDEAL", 4);
define("NB_GROUPE_PARFAIT", 4);
$id_tournoi = $_GET["id_tournoi"];
createGroupe($id_tournoi);

// Fonction répartissant les équipes dans les différents groupes
function createGroupe($fk_id_tournoi)
{
    $redo = false;
    //$_SESSION['Groupes'] = array();
    $_SESSION['Equipes'] = array();

    // Groupe stockant les équipes
    $_SESSION['GroupeUn'] = array();
    $_SESSION['GroupeDeux'] = array();
    $_SESSION['GroupeTrois'] = array();
    $_SESSION['GroupeQuatre'] = array();

    foreach (getInscriptions($fk_id_tournoi, "Validé") as $equipes) {
        // Récupération des équipes individuellement
        $equipe = selectEquipeWithID($equipes['FK_ID_Equipe']);
        // Stockage des équipes dans une liste de session
        array_push($_SESSION['Equipes'], $equipe);
    }

    if (count($_SESSION['Equipes']) >= NB_EQUIPES_IDEAL) {

        shuffle($_SESSION['Equipes']);

        // https://stackoverflow.com/questions/23362451/php-generate-unique-teams-using-number-combination
        $division = array_chunk($_SESSION['Equipes'], NB_EQUIPES_IDEAL);

        foreach ($division[0] as $equipe) {
            array_push($_SESSION['GroupeUn'], $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 1);
        }

        foreach ($division[1] as $equipe) {
            array_push($_SESSION['GroupeDeux'], $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 2);
        }

        foreach ($division[2] as $equipe) {
            array_push($_SESSION['GroupeTrois'], $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 3);
        }

        foreach ($division[3] as $equipe) {
            array_push($_SESSION['GroupeQuatre'], $equipe);
            updateGroupe($equipe[0]['ID_Equipe'], 4);
        }
    }
}

// Fonction qui permet de récupérer les équipes dans un tournoi en fonction du statut recherché
function getInscriptions($fk_id_tournoi, $statut)
{
    try {
        $db = connectDB();
        $sql = "SELECT * FROM `Inscription_Tournoi` WHERE `FK_ID_Tournoi` = " . $fk_id_tournoi . " AND Statut_Inscription_Tournoi = '" . $statut . "';";
        $request = $db->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo "<script>alert(\" Select des inscriptions des équipes du tournoi du id : " . $fk_id_tournoi . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}

// Fonction qui permet de mettre à jour le numéro du groupe de la base de données
function updateGroupe($id_equipe, $id_groupe)
{
    try {
        $db = connectDB();
        $sql = "UPDATE `Equipe` SET `FK_ID_Groupe` = '" . $id_groupe . "' WHERE `Equipe` . `ID_Equipe` = '" . $id_equipe . "'";
        $request = $db->prepare($sql);
        $request->execute();
    } catch (\Throwable $e) {
        echo "<script>alert(\" Update du groupe de l'id : " . $id_equipe . " + " . $e->getMessage() . "\");</script>";
        debug();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Liste des matchs</title>
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
                    <p class="fw-bold text-success mb-2">Liste des matchs</p>
                    <h3 class="fw-bold">Match du tournoi :&nbsp;</h3>
                    <p class="text-muted">&nbsp;<a href="modifier_equipe_tournoi.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Equipes inscrites</a></p>
                    <!-- <a class="btn btn-primary shadow" role="button" href="creer_match.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Créer un match</a> -->
                    <a class="btn btn-primary shadow" role="button" href="./functions/algorithme_groupe.php?id_tournoi=<?php echo $_SESSION['id_tournoi']; ?>">Créer les groupes</a>
                    <br><br>
                    <input type="text" id="recherche" onkeyup="recherche()" placeholder="Recherche..." title="Rechercher un match">
                    <?php
                    // afficherSalleEtDate($_GET['id_tournoi']);
                    ?>
                </div>
            </div>
            <div id="divContenu">
                <form action="match.php" method="get">
                    <?php
                    afficherMatch($_SESSION['id_tournoi']);
                    ?>
                </form>
            </div>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <!-- Site d'aide pour la réalisation du filtrage des équipes 
  https://www.w3schools.com/howto/howto_js_filter_lists.asp -->
    <script>
        function recherche() {
            var input, filter, div, div2, a, i, txtValue;
            input = document.getElementById("recherche");
            filter = input.value.toUpperCase();
            div = document.getElementById("divContenu");
            div2 = div.getElementsByClassName("equipe");
            console.log(div2);
            for (i = 0; i < div2.length; i++) {
                a = div2[i].getElementsByTagName("h5")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    div2[i].style.display = "";
                } else {
                    div2[i].style.display = "none";
                }
            }
        }
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>