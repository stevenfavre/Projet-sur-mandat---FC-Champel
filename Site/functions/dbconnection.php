<?php
// session_start(['cookie_lifetime' => 3600,]);

// Fonction permettant de faire la connection à la base de donnée

function connectDB()

{
    $dbServer = "hhva.myd.infomaniak.com";
    $dbName = "hhva_t23_7_v1";
    $dbUser = "hhva_t23_7_v1";
    $dbPwd = "91qrBzoXMA";

    static $bdd = null;

    if ($bdd === null) {
        $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $bdd;
} 



/* function connectDB() //fonction qui permet de se connecter à la BDD
{
    $dbServer = "localhost";
    $dbName = "hhva_t23_7_v1";
    $dbUser = "root";
    $dbPwd = "";

    static $bdd = null;

    if ($bdd === null) {
        $bdd = new PDO("mysql:host=$dbServer;dbname=$dbName;charset=utf8", $dbUser, $dbPwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $bdd;
} */
